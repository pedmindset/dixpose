<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Invoice;
use App\Models\Customer;
use App\Models\MonthlyInvoice;
use Illuminate\Console\Command;

class AddMonthlyInvoice extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'invoice:monthly';

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
        $current = Carbon::now();
        //get all invoices within a month 
        $customers = Customer::select('id','comapany_id')->get();

        DB::beginTransaction();
        foreach ($customers as $customer) 
        {
            //assume it will fail
            $success = false;

            $invoices = Invoice::where('customer_id', $customer->id)
            ->whereBetween(
                'created_at', [
                    $current->startOfMonth()->toDateTimeString(),
                    $current->endOfMonth()->toDateTimeString()
                 ]
             )->get('price');
             $amount = $invoices->sum('price');

                    try{
                            $monthlyInvoice = new MonthlyInvoice;
                            $monthlyInvoice->company_id = $customer->company_id;
                            $monthlyInvoice->customer_id = $customer->customer_id;
                            $monthlyInvoice->number = $number;
                            $monthlyInvoice->status = 'Not Paid';
                            $monthlyInvoice->due_date = $current->addDays(7);
                            $monthlyInvoice->amount = $amount;
                            $monthlyInvoice->save();

                        if ($monthlyInvoice->wasRecentlyCreated) {
                            $sucesses = true;
                        }
                    } catch(\Exception $e){
                        ///catch error
                    }
           if($success)
           {
                DB::commit();
                
            } else 
            {
                DB::rollback();
            }
        }

    }
}
