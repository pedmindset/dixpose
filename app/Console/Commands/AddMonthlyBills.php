<?php


namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Models\Customer;
use App\Models\Collection;
use App\Models\Invoice;
use Carbon\Carbon;

class AddMonthlyBills extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bills:customers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Raise Monthly Bills';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        /* Get customer id, classification, active and frequency from the customer table
        * Use Customer id to find all collections for the current month where collection is status is collected
        * Get the Collected bins using the collection id to find all collecctions on the collectio_bin table
        */
        $current = Carbon::now();

        $collections = DB::table('collections')->whereBetween(
                       'created_at', [
                           $current->startOfMonth()->toDateTimeString(),
                           $current->endOfMonth()->toDateTimeString()
                        ]
                    )->where('status', 'Collected')
                    ->get();


        $increment = '';

     
        
        DB::beginTransaction();
        foreach ($collections as $collection) {
          
            
            //get last record
            $record = Invoice::latest()->orderBy('id', 'DESC')->first();
            if($record){
                $splitString = explode("-",$record->number);
                $code = $splitString[1] + 1;
                $increment = $code;
                $increment++;
                $nextInvoiceNumber = $splitString[0].'-'.$increment;
                
            } else{
                $string = 'BILL';
                $number = 1011;
                $nextInvoiceNumber = "$string-$number";
            }
            
            //now add into database $nextInvoiceNumber as a next number.
            //assume it will faill
            
                $amount = DB::table('bin_collection')
                                  ->join('bins', 'bins.id', '=', 'bin_collection.bin_id')
                                  ->where('bin_collection.collection_id', $collection->id)
                                  ->select('bins.price')
                                  ->get()->sum('price');

                $invoice = Invoice::firstOrCreate(
                    ['collection_id' => $collection->id],
                        [
                            'customer_id' => $collection->customer_id,
                            'company_id' => $collection->company_id,
                            'number' => $nextInvoiceNumber,
                            'amount' => $amount,
                            'due_date' => $current->addDays(7),
                            'status' => 'Not Paid'
                        ]
                    );

                    if($invoice->created){
                        DB::commit();
                    }else{
                        DB::rollback();
                    }
                   


          
        }
        
   
    }
}
