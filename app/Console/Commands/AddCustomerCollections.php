<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Models\Customer;
use Carbon\Carbon;


class AddCustomerCollections extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'collection:customers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Raisng Customer weekly collections';

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
        //raise customer collections 
        /**
         * find all customers 
         * get their company_id and frequency
         * create a collection based on their company id and frequency
         */
        $current = Carbon::now();

        $customers = Customer::select('id', 'company_id', 'frequency', 'active')
                    //->where('active', 1)
                    ->get();
                           

        DB::beginTransaction();
            foreach ($customers as $customer) {
                  $success = False;   
                    try{
                        for ($i=0; $i < $customer->frequency; $i++) { 

                              // Copyright: http://snippets.dzone.com/posts/show/3123
                              $len = 5;
                              $base='ABCDEFGHKLMNOPQRSTWXYZabcdefghjkmnpqrstwxyz1234567890';
                              $max=strlen($base)-1;
                              $activatecode= '';
                              mt_srand((double)microtime()*1000000);
                              while (strlen($activatecode)<$len+1)
                              $activatecode.=$base{mt_rand(0,$max)};
                              $code = $activatecode;
                              $rand = str_random(3);

                              $collection = DB::table('collections')->insert([
                                        'company_id' => $customer->company_id,
                                        'customer_id' => $customer->id,
                                        'status' => 'Pending',
                                        'code' => "$rand-$code",
                                        'created_at' => $current
                                    ]);

                            //  $collection = Collection::updateOrCreate(
                            //         ['code' => $collections->code],
                            //         [
                            //             'company_id' => $customer->company_id,
                            //             'customer_id' => $customer->id,
                            //             'status' => 'Pending',
                            //             'created_at' => $current
                            //         ]);
                           
                                if($collection){
                                    $success = true;
                                }  
                        };
                    }catch(\Exception $e){
                            //catch error
                    }
                        if ($success) {
                            DB::commit();
                            
                        } else {
                            DB::rollback();
                        }
                        
                 }

                

    }
}
