<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Models\Customer;


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
         * create a collection based on their company id and frequecy
         */
        $customers = Customer::select('id', 'company_id', 'frequency')->get();
        foreach ($customers as $customer) {
            
            for ($i=0; $i < $customer->frequency; $i++) { 
                    
                    DB::table('collections')->insert([
                        'company_id' => $customer->company_id,
                        'customer_id' => $customer->id,
                        'status' => 'Pending',
                        'created_at' => now()
                    ]);
                
            };
        }

    }
}
