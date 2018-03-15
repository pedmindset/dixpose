<?php

namespace App\Http\Controllers\Manager;

use Auth;
use Carbon\Carbon;
use App\Models\Bin;
use App\Models\Zone;
use App\Models\Truck;
use App\Models\Driver;
use App\Models\Journey;
use App\Models\Payment;
use App\Models\Invoice;
use App\Models\Customer;
use App\Models\Supervisor;
use App\Models\Collection;
use App\Models\ServiceZone;
use Illuminate\Http\Request;
use App\Models\Classification;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;


class DashboardController extends Controller
{

    public function __contruct(Carbon $carbon)
    {
        $this->middleware('auth');
    }

       /*     
        1. Zone Report
        -How many zones a compnay has
        2. Sector Report
        -How many Sectors a company has
        3. Bins Report
        -Types of bins created
        4. Classification report
        -How many classification a company have
        5. Scheduling Report
        -schedules for the year,quater,month,week, breakdown by day
        -customer scheduling report
        6. Collection Report
        -collections made in a year
        -collection made in a quartey
        -collection made in a month
        -Collections to be made in a week
        -Collections made in the week
        -customers served in the week
        -Total bins collected in the week
        -total work progress
        7. Customer Report 
        -How many customers a company has 
        */

        public function getDate(){
            return now();
        }


        public function index()
        {
            
            //show the number and list of zones by company
            $zones = $this->zones();
            $numberOfZones = $this->number_of_zones();


            //show the number and list of sectors by company
            $sectors = $this->sectors();
            $numberOfSectors = $this->number_of_sectors();


            //Show the number and list of bins by company
            $bins = $this->bins();
            $numberOfBins = $this->number_of_bins();


            //Show the number and list of classifications by company
            $classifications = $this->classifications();
            $numberOfClassifications = $this->number_of_classifications();


            //Schedules reports
            //Get all schedules till date
            $schedules = $this->schedules();

            //Get schedules for the year
            $schedulesYearly = $this->schedules_yearly();
            $numberOfSchedulesYearly = $this->number_of_schedules_yearly();

            //Get schedules for the quarter
            $schedulesQuarterly = $this->schedules_quarterly();
            $numberOfSchedulesQuarterly = $this->number_of_schedules_quarterly();

            //Get schedules for the month 
            $schedulesMonthly = $this->schedules_monthly(); 
            $numberOfSchedulesMonthly = $this->number_of_schedules_monthly();

            //Get schedules for the week
            $schedulesWeekly = $this->schedules_weekly();
            $numberOfSchedulesWeekly = $this->number_of_schedules_weekly();

            //Get schedules for the day
            $schedulesDaily = $this->schedules_daily();
            $numberOfSchedulesDaily = $this->number_of_schedules_daily();

            //Get Pending Schedules Yearly
            $pendingSchedulesYearly = $this->pending_schedules_yearly();
            $numberOfPendingSchedulesYearly = $this->number_of_pending_schedules_yearly();

            //Get Pending Schedules quarterly
            $pendingSchedulesQuarterly = $this->pending_schedules_quarterly();
            $numberOfPendingSchedulesQuarterly = $this->pending_schedules_quarterly();

            //Get Pending Schedules Monthly
            $pendingSchedulesMonthly = $this->pending_schedules_monthly();
            $numberOfPendingSchedulesMonthly = $this->number_of_pending_schedules_monthly();

            //Get Pending Schedules weekly
            $pendingSchedulesWeekly = $this->pending_schedules_weekly();
            $numberOfPendingSchedulesWeekly = $this->number_of_pending_schedules_weekly();

            //Get Pending Schedules Daily
            $pendingSchedulesDaily = $this->pending_schedules_daily();
            $numberOfPendingSchedulesDaily = $this->number_of_pending_schedules_daily();

            //Get completed Schedules Yearly
            $completedSchedulesYearly = $this->completed_schedules_yearly();
            $numberOfCompletedSchedulesYearly = $this->number_of_completed_schedules_yearly();

            //Get completed Schedules quarterly
            $completedSchedulesQuarterly = $this->completed_schedules_quarterly();
            $numberOfCompletedSchedulesQuarterly = $this->completed_schedules_quarterly();

            //Get completed Schedules Monthly
            $completedSchedulesMonthly = $this->completed_schedules_monthly();
            $numberOfCompletedSchedulesMonthly = $this->number_of_completed_schedules_monthly();

            //Get completed Schedules weekly
            $completedSchedulesWeekly = $this->completed_schedules_weekly();
            $numberOfCompletedSchedulesWeekly = $this->number_of_completed_schedules_weekly();

            //Get completed Schedules Daily
            $completedSchedulesDaily = $this->completed_schedules_daily();
            $numberOfCompletedSchedulesDaily = $this->number_of_completed_schedules_daily();


            //Collections Reports
            //Get all completed Collections Yearly
            $completedCollectionsYearly = $this->completed_collections_yearly();
            $numberOfCompletedCollectionsYearly = $this->number_of_completed_collections_yearly();

            //Get all pending Collections Yearly
            $pendingCollectionsYearly = $this->pending_collections_yearly();
            $numberOfpendingCollectionsYearly = $this->number_of_pending_collections_yearly();

            //Get Completed Collections Quarterly
            $completedCollectionsQuarterly = $this->completed_collections_quarterly();
            $numberOfCompletedCollectionsQuarterly = $this->number_of_completed_collections_quarterly();

            //Get Pending Collections Quarterly
            $pendingCollectionsQuarterly = $this->pending_collections_quarterly();
            $numberOfPendingCollectionsQuarterly = $this->number_of_pending_collections_quarterly();

            //Get Completed Collections Monthly
            $completedCollectionsMonthly = $this->completed_collections_monthly();
            $numberOfCompletedCollectionsMonthly = $this->number_of_completed_collections_monthly();

            //Get Pending Collections Monthly
            $pendingCollectionsMonthly = $this->pending_collections_monthly();
            $numberOfPendingCollectionsMonthly= $this->number_of_pending_collections_monthly();

            //Get Completed Collections Weekly
            $completedCollectionsWeekly = $this->completed_collections_weekly();
            $numberOfCompletedCollectionsWeekly = $this->number_of_completed_collections_weekly();

            //Get Pending Collections Weekly
            $pendingCollectionsWeekly = $this->pending_collections_weekly();
            $numberOfPendingCollectionsWeekly = $this->number_of_pending_collections_weekly();

            //Get Completed Collections Daily
            $completedCollectionsDaily = $this->completed_collections_daily();
            $numberOfCompletedCollectionsDaily = $this->number_of_completed_collections_daily();

            //Get Pending Collections Daily
            $pendingCollectionsDaily = $this->pending_collections_daily();
            $numberOfPendingCollectionsDaily = $this->number_of_pending_collections_daily();

             //Get all  collections Yearly
            $collectionsYearly = $this->collections_yearly();
            $numberOfCollectionsYearly = $this->number_of_collections_yearly();

            //Get  collections Quarterly
            $collectionsQuarterly = $this->collections_quarterly();
            $numberOfCollectionsQuarterly = $this->number_of_collections_quarterly();

            //Get  collections Monthly
            $collectionsMonthly = $this->collections_monthly();
            $numberOfCollectionsMonthly= $this->number_of_collections_monthly();
   
            //Get  collections Weekly
            $collectionsWeekly = $this->collections_weekly();
            $numberOfCollectionsWeekly = $this->number_of_collections_weekly();

            //Get  collections Daily
            $collectionsDaily = $this->collections_daily();
            $numberOfCollectionsDaily = $this->number_of_collections_daily();


            //Bins Report
            //Bins Collected Yearly
            $binsCollectedYearly = $this->bins_collected_yearly();
            $numberOfBinsCollectedYearly = $this->number_of_bins_collected_yearly();

            //Total Bins Collected Yearly
            $binsCollectedQuarterly = $this->bins_collected_quarterly();
            $numberOfBinsCollectedQuarterly = $this->number_of_bins_collected_quarterly();

            //Bins Collected Monthly
            $binsCollectedMonthly = $this->bins_collected_monthly();
            $numberOfBinsCollectedMonthly = $this->number_of_bins_collected_monthly();

            //Bins Collected Weekly
            $binsCollectedWeekly = $this->bins_collected_weekly();
            $numberOfBinsCollectedWeekly = $this->number_of_bins_collected_weekly();

            //Total Bins Collected Daily
            $binsCollectedDaily = $this->bins_collected_daily();
            $numberOfBinsCollectedDaily = $this->number_of_bins_collected_daily();

            //customer numbers
            $customers = $this->get_all_customers();
            $numberOfCustomers = $this->total_customers();

            //charts
            //collections
            $pieCollectionsDaily = $this->pie_collections_daily();
            $pieCollectionsWeekly = $this->pie_collections_weekly();
            $barCollectionsStatistics = $this->bar_collection_statictics();

            //Schedules
            $pieSchedulesDaily = $this->pie_schedules_daily();
            $pieSchedulesWeekly = $this->pie_schedules_weekly();
        

            return view('manager/dashboard', 
                                    compact(
                                        //general operations data
                                        'zones', 'numberOfZones',
                                        'sectors', 'numberOfSectors', 
                                        'bins', 'numberOfBins', 
                                        'classifications', 'numberOfClassifications',
                                        //scheduling
                                        'schedulesYearly', 'numberOfSchedulesYearly', 
                                        'schedulesQuarterly', 'numberOfSchedulesQuarterly', 
                                        'schedulesMonthly', 'numberOfSchedulesMonthly', 
                                        'schedulesWeekly', 'numberOfSchedulesWeekly',
                                        'schedulesDaily', 'numberOfSchedulesDaily',
                                        'pendingSchedulesYearly', 'numberOfPendingSchedulesYearly',
                                        'pendingSchedulesQuarterly', 'numberOfPendingSchedulesQuarterly',
                                        'pendingSchedulesMonthly', 'numberOfPendingSchedulesMonthly',
                                        'pendingSchedulesWeekly', 'numberOfPendingSchedulesWeekly',
                                        'pendingSchedulesDaily', 'numberOfPendingSchedulesDaily',
                                        'completedSchedulesYearly', 'numberOfCompletedSchedulesYearly',
                                        'completedSchedulesQuarterly', 'numberOfCompletedSchedulesQuarterly',
                                        'completedSchedulesMonthly', 'numberOfCompletedSchedulesMonthly',
                                        'completedSchedulesWeekly', 'numberOfCompletedSchedulesWeekly',
                                        'completedSchedulesDaily', 'numberOfCompletedSchedulesDaily',
                                        //collections
                                        'completedCollectionsYearly', 'numberOfCompletedCollectionsYearly',
                                        'pendingCollectionsYearly', 'numberOfpendingCollectionsYearly',
                                        'completedCollectionsQuarterly', 'numberOfCompletedCollectionsQuarterly',
                                        'pendingCollectionsQuarterly', 'numberOfPendingCollectionsQuarterly',
                                        'completedCollectionsMonthly', 'numberOfCompletedCollectionsMonthly',
                                        'pendingCollectionsMonthly', 'numberOfPendingCollectionsMonthly',
                                        'completedCollectionsWeekly', 'numberOfCompletedCollectionsWeekly',
                                        'pendingCollectionsWeekly','numberOfPendingCollectionsWeekly',
                                        'completedCollectionsDaily', 'numberOfCompletedCollectionsDaily',
                                        'pendingCollectionsDaily', 'numberOfPendingCollectionsDaily',
                                        'collectionsYearly', 'numberOfCollectionsYearly',
                                        'collectionsQuarterly', 'numberOfCollectionsQuarterly',
                                        'collectionsMonthly', 'numberOfCollectionsMonthly',
                                        'collectionsWeekly', 'numberOfCollectionsWeekly',
                                        'collectionsDaily', 'numberOfCollectionsDaily',
                                        //bins
                                        'binsCollectedYearly', 'numberOfBinsCollectedYearly',
                                        'binsCollectedQuarterly', 'numberOfBinsCollectedQuarterly',
                                        'binsCollectedMonthly', 'numberOfBinsCollectedMonthly',
                                        'binsCollectedWeekly', 'numberOfBinsCollectedWeekly',
                                        'binsCollectedDaily', 'numberOfBinsCollectedDaily',
                                        //customers
                                        'customers', 'numberOfCustomers',
                                        //charts
                                        //collections
                                        'pieCollectionsDaily', 'pieCollectionsWeekly',
                                        'pieSchedulesDaily', 'pieSchedulesWeekly',
                                        'barCollectionsStatistics'
                                        
                                        
                                    )
                    );
            
        }


        public function zones()
        {
            //show the list of zones by company
            $zones = Zone::where('company_id', Auth::user()->company_id)
                         ->get();
           return $zones;
        }


        public function number_of_zones()
        {
             //show the number of zones by company
            $numberOfZones = $this->zones()->count();

            return $numberOfZones;
        }


        public function sectors()
        {
            //show the list of sectors by company
            $sectors = ServiceZone::where('company_id', Auth::user()->company_id)
                                 ->get();
            return $sectors;
            
        }


        public function number_of_sectors()
        {
            //show the number of sectors by company
            $numberOfSectors = $this->sectors()->count();

            return $numberOfSectors;
        }

        public function bins()
        {
            //show the list of Bins by company
            $bins = Bin::where('company_id', Auth::user()->company_id)
                                 ->get();
            return $bins;
            
        }


        public function number_of_bins()
        {
            //show the number of Bins by company
            $numberOfBins = $this->bins()->count();

            return $numberOfBins;
        }

        public function classifications()
        {
            //show the list of classifications by company
            $classifications = Classification::where('company_id', Auth::user()->company_id)
                                 ->get();
            return $classifications;
            
        }


        public function number_of_classifications()
        {
            //show the number of classifications by company
            $numberOfClassifications = $this->classifications()->count();

            return $numberOfClassifications;
        }

        public function yearly_scope($between, $method)
        {
            $yearlyScope = $method->whereBetween(
                $between, [
                    now()->startOfYear()->toDateTimeString(), 
                    now()->endOfYear()->toDateTimeString()
                ]
            )->get();

            return $yearlyScope;
        }


        public function quarterly_scope($between, $method)
        {
            $quarterlyScope = $method->whereBetween(
                $between, [
                    now()->startOfQuarter()->toDateTimeString(), 
                    now()->endOfQuarter()->toDateTimeString()
                ]
            )->get();

            return $quarterlyScope;
        }

        public function monthly_scope($between, $method)
        {
            $monthlyScope = $method->whereBetween(
                $between, [
                    now()->startOfMonth()->toDateTimeString(), 
                    now()->endOfMonth()->toDateTimeString()
                ]
            )->get();

            return $monthlyScope;
        }

        public function weekly_scope($between, $method)
        {
            $weeklyScope = $method->whereBetween(
                $between, [
                    now()->startOfWeek()->toDateTimeString(), 
                    now()->endOfWeek()->toDateTimeString()
                ]
            )->get();

            return $weeklyScope;
        }

        public function daily_scope($between, $method)
        {
            $dailyScope = $method->whereBetween(
                $between, [
                    now()->startOfDay()->toDateTimeString(), 
                    now()->endOfDay()->toDateTimeString()
                ]
            )->get();

            return $dailyScope;
        }

       


        public function schedules()
        {
            //Get all schedules till date
            $schedules = Journey::where('company_id', Auth::user()->company_id)
                                  ->orderBy('id', 'desc');

            return $schedules;
        }


        public function schedules_yearly()
        {
            //Get schedules for the year
            $schedulesYearly = $this->yearly_scope('pickupdate', $this->schedules());

            return $schedulesYearly;
        }
        

        public function number_of_schedules_yearly()
        {
            //Get the number of schedules for the year
            $numberOfSchedulesYearly = $this->schedules_yearly()
                                                 ->count();

            return $numberOfSchedulesYearly;
        }

        public function schedules_quarterly()
        {
            //Get schedules for the Quarter
            $schedulesQuarterly = $this->quarterly_scope('pickupdate', $this->schedules());

            return $schedulesQuarterly;
        }

        public function number_of_schedules_quarterly()
        {
            //Get the number of schedules for the Quarter
            $numberOfSchedulesQuarterly = $this->schedules_quarterly()
                                                 ->count();
            return $numberOfSchedulesQuarterly;
        }

        public function schedules_monthly()
        {
            //Get schedules for the Month
            $schedulesMonthly = $this->monthly_scope('pickupdate', $this->schedules());

            return $schedulesMonthly;
        }

        public function number_of_schedules_monthly()
        {
            //Get the number of schedules for the Month
            $numberOfSchedulesMonthly = $this->schedules_monthly()
                                                 ->count();
            return $numberOfSchedulesMonthly;
        }

        public function schedules_weekly()
        {
            //Get schedules for the Week
            $schedulesWeekly = $this->weekly_scope('pickupdate', $this->schedules());

            return $schedulesWeekly;
        }

        public function number_of_schedules_weekly()
        {
            //Get the number of schedules for the Week
            $numberOfSchedulesWeekly = $this->schedules_weekly()
                                                 ->count();
            return $numberOfSchedulesWeekly;
        }

        public function schedules_daily()
        {
            //Get schedules for the Day
            $schedulesDaily = $this->daily_scope('pickupdate', $this->schedules());

            return $schedulesDaily;
        }

        public function number_of_schedules_daily()
        {
            //Get the number of schedules for the Day
            $numberOfSchedulesDaily = $this->schedules_daily()
                                                 ->count();
            return $numberOfSchedulesDaily;
        }

        public function pending_schedules()
        {
            //Get all unstarted pending_schedules till date
            $pending_schedules = Journey::where('company_id', Auth::user()->company_id)
                                              ->where('status', 'created');

            return $pending_schedules;
        }

        public function pending_schedules_yearly()
        {
            //Get pending_schedules for the year
            $pendingSchedulesYearly = $this->yearly_scope('pickupdate', $this->pending_schedules());

            return $pendingSchedulesYearly;
        }
        

        public function number_of_pending_schedules_yearly()
        {
            //Get the number of pending_schedules for the year
            $numberOfPendingSchedulesYearly = $this->pending_schedules_yearly()
                                                 ->count();

            return $numberOfPendingSchedulesYearly;
        }

        public function pending_schedules_quarterly()
        {
            //Get pending_schedules for the Quarter
            $pendingSchedulesQuarterly = $this->quarterly_scope('pickupdate', $this->pending_schedules());

            return $pendingSchedulesQuarterly;
        }

        public function number_of_pending_schedules_quarterly()
        {
            //Get the number of pending_schedules for the Quarter
            $numberOfPendingSchedulesQuarterly = $this->pending_schedules_quarterly()
                                                 ->count();
            return $numberOfPendingSchedulesQuarterly;
        }

        public function pending_schedules_monthly()
        {
            //Get pending_schedules for the Month
            $pendingSchedulesMonthly = $this->monthly_scope('pickupdate', $this->pending_schedules());

            return $pendingSchedulesMonthly;
        }

        public function number_of_pending_schedules_monthly()
        {
            //Get the number of pending_schedules for the Month
            $numberOfPendingSchedulesMonthly = $this->pending_schedules_monthly()
                                                 ->count();
            return $numberOfPendingSchedulesMonthly;
        }

        public function pending_schedules_weekly()
        {
            //Get pending_schedules for the Week
            $pendingSchedulesWeekly = $this->weekly_scope('pickupdate', $this->pending_schedules());

            return $pendingSchedulesWeekly;
        }

        public function number_of_pending_schedules_weekly()
        {
            //Get the number of pending_schedules for the Week
            $numberOfPendingSchedulesWeekly = $this->pending_schedules_weekly()
                                                 ->count();
            return $numberOfPendingSchedulesWeekly;
        }

        public function pending_schedules_daily()
        {
            //Get pending_schedules for the Day
            $pendingSchedulesDaily = $this->daily_scope('pickupdate', $this->pending_schedules());

            return $pendingSchedulesDaily;
        }

        public function number_of_pending_schedules_daily()
        {
            //Get the number of pending_schedules for the Day
            $numberOfPendingSchedulesDaily = $this->pending_schedules_daily()
                                                 ->count();
            return $numberOfPendingSchedulesDaily;
        }

        public function started_schedules()
        {
            //Get all unstarted started_schedules till date
            $started_schedules = Journey::where('company_id', Auth::user()->company_id)
                                              ->where('status', 'Started');

            return $started_schedules;
        }

        public function started_schedules_yearly()
        {
            //Get started_schedules for the year
            $startedSchedulesYearly = $this->yearly_scope('pickupdate', $this->started_schedules());

            return $startedSchedulesYearly;
        }
        

        public function number_of_started_schedules_yearly()
        {
            //Get the number of started_schedules for the year
            $numberOfStartedSchedulesYearly = $this->started_schedules_yearly()
                                                 ->count();

            return $numberOfStartedSchedulesYearly;
        }

        public function started_schedules_quarterly()
        {
            //Get started_schedules for the Quarter
            $startedSchedulesQuarterly = $this->quarterly_scope('pickupdate', $this->started_schedules());

            return $startedSchedulesQuarterly;
        }

        public function number_of_started_schedules_quarterly()
        {
            //Get the number of started_schedules for the Quarter
            $numberOfStartedSchedulesQuarterly = $this->started_schedules_quarterly()
                                                 ->count();
            return $numberOfStartedSchedulesQuarterly;
        }

        public function started_schedules_monthly()
        {
            //Get started_schedules for the Month
            $startedSchedulesMonthly = $this->monthly_scope('pickupdate', $this->started_schedules());

            return $startedSchedulesMonthly;
        }

        public function number_of_started_schedules_monthly()
        {
            //Get the number of started_schedules for the Month
            $numberOfStartedSchedulesMonthly = $this->started_schedules_monthly()
                                                 ->count();
            return $numberOfStartedSchedulesMonthly;
        }

        public function started_schedules_weekly()
        {
            //Get started_schedules for the Week
            $startedSchedulesWeekly = $this->weekly_scope('pickupdate', $this->started_schedules());

            return $startedSchedulesWeekly;
        }

        public function number_of_started_schedules_weekly()
        {
            //Get the number of started_schedules for the Week
            $numberOfStartedSchedulesWeekly = $this->started_schedules_weekly()
                                                 ->count();
            return $numberOfStartedSchedulesWeekly;
        }

        public function started_schedules_daily()
        {
            //Get started_schedules for the Day
            $startedSchedulesDaily = $this->daily_scope('pickupdate', $this->started_schedules());

            return $startedSchedulesDaily;
        }

        public function number_of_started_schedules_daily()
        {
            //Get the number of started_schedules for the Day
            $numberOfStartedSchedulesDaily = $this->started_schedules_daily()
                                                 ->count();
            return $numberOfStartedSchedulesDaily;
        }

        public function completed_schedules()
        {
            //Get all unstarted completed_schedules till date
            $completed_schedules = Journey::where('company_id', Auth::user()->company_id)
                                              ->where('status', 'Completed');

            return $completed_schedules;
        }

        public function completed_schedules_yearly()
        {
            //Get completed_schedules for the year
            $completedSchedulesYearly = $this->yearly_scope('pickupdate', $this->completed_schedules());

            return $completedSchedulesYearly;
        }
        

        public function number_of_completed_schedules_yearly()
        {
            //Get the number of completed_schedules for the year
            $numberOfCompletedSchedulesYearly = $this->completed_schedules_yearly()
                                                 ->count();

            return $numberOfCompletedSchedulesYearly;
        }

        public function completed_schedules_quarterly()
        {
            //Get completed_schedules for the Quarter
            $completedSchedulesQuarterly = $this->quarterly_scope('pickupdate', $this->completed_schedules());

            return $completedSchedulesQuarterly;
        }

        public function number_of_completed_schedules_quarterly()
        {
            //Get the number of completed_schedules for the Quarter
            $numberOfCompletedSchedulesQuarterly = $this->completed_schedules_quarterly()
                                                 ->count();
            return $numberOfCompletedSchedulesQuarterly;
        }

        public function completed_schedules_monthly()
        {
            //Get completed_schedules for the Month
            $completedSchedulesMonthly = $this->monthly_scope('pickupdate', $this->completed_schedules());

            return $completedSchedulesMonthly;
        }

        public function number_of_completed_schedules_monthly()
        {
            //Get the number of completed_schedules for the Month
            $numberOfCompletedSchedulesMonthly = $this->completed_schedules_monthly()
                                                 ->count();
            return $numberOfCompletedSchedulesMonthly;
        }

        public function completed_schedules_weekly()
        {
            //Get completed_schedules for the Week
            $completedSchedulesWeekly = $this->weekly_scope('pickupdate', $this->completed_schedules());

            return $completedSchedulesWeekly;
        }

        public function number_of_completed_schedules_weekly()
        {
            //Get the number of completed_schedules for the Week
            $numberOfCompletedSchedulesWeekly = $this->completed_schedules_weekly()
                                                 ->count();
            return $numberOfCompletedSchedulesWeekly;
        }

        public function completed_schedules_daily()
        {
            //Get completed_schedules for the Day
            $completedSchedulesDaily = $this->daily_scope('pickupdate', $this->completed_schedules());

            return $completedSchedulesDaily;
        }

        public function number_of_completed_schedules_daily()
        {
            //Get the number of completed_schedules for the Day
            $numberOfCompletedSchedulesDaily = $this->completed_schedules_daily()
                                                 ->count();
            return $numberOfCompletedSchedulesDaily;
        }

        public function get_schedule_report($dateFrom, $dateTo)
        {
            //get schedule report based on specified dates
            $scheduleReport = $this->schedules()->whereBetween(
                'pickupdate', [
                    $dateFrom,
                    $dateTo
                ]
            )->get();

            return $scheduleReport;
        }


        public function collections()
        {
            //Get all collections
            $collections = Collection::where('company_id', Auth::user()->company_id)
                                         ->orderBy('id', 'desc');
            return $collections;
        }


        public function get_all_completed_collections()
        {
            //get all completed collections
            $completedCollections = $this->collections()->where('status', 'Collected');

            return $completedCollections;
        }

        public function get_all_pending_collections()
        {
            //Get all pending collections
            $pendingCollections = $this->collections()->where('status', 'Pending');

            return $pendingCollections;
        }


        public function completed_collections_yearly()
        {
            //Get collections for the year
            $completedCollectionsYearly = $this->yearly_scope('created_at', $this->get_all_completed_collections());

            return $completedCollectionsYearly;
        }

        public function pending_collections_yearly()
        {
            //Get collections for the year
            $pendingCollectionsYearly = $this->yearly_scope('created_at', $this->get_all_pending_collections());
            return $pendingCollectionsYearly;
        }

        public function number_of_completed_collections_yearly()
        {
            //Get the number of completd collections for the year
            $numberOfCompletedCollectionsYearly = $this->get_all_completed_collections()->count();

            return $numberOfCompletedCollectionsYearly;
        }

        public function number_of_pending_collections_yearly()
        {
            //Get the number of pending collections for the year
            $numberOfPendingCollectionsYearly = $this->pending_collections_yearly()->count();

            return $numberOfPendingCollectionsYearly;

        }

        public function completed_collections_quarterly()
        {
            //Get collections for the quartey
            $CompletedCollectionsQuarterly = $this->quarterly_scope('created_at', $this->get_all_completed_collections());
            return $CompletedCollectionsQuarterly;
        }

        public function pending_collections_quarterly()
        {
            //Get collections for the Quarter
            $PendingCollectionsQuarterly = $this->quarterly_scope('created_at', $this->get_all_pending_collections());
            return $PendingCollectionsQuarterly;
        }

        public function number_of_completed_collections_quarterly()
        {
            //Get the number of completd collections for the Quarter
            $numberOfCompletedCollectionsQuarterly = $this->completed_collections_quarterly()->count();

            return $numberOfCompletedCollectionsQuarterly;
        }

        public function number_of_pending_collections_quarterly()
        {
            //Get the number of pending collections for the Quarter
            $numberOfPendingCollectionsQuarterly = $this->pending_collections_quarterly()->count();

            return $numberOfPendingCollectionsQuarterly;

        }


        public function completed_collections_monthly()
        {
            //Get collections for the month
            $CompletedCollectionsMonthly = $this->monthly_scope('created_at', $this->get_all_completed_collections());
            return $CompletedCollectionsMonthly;
        }

        public function pending_collections_monthly()
        {
            //Get collections for the Month
            $PendingCollectionsMonthly =  $this->monthly_scope('created_at', $this->get_all_pending_collections());
            return $PendingCollectionsMonthly;
        }

        public function number_of_completed_collections_monthly()
        {
            //Get the number of completd collections for the Month
            $numberOfCompletedCollectionsMonthly = $this->completed_collections_monthly()->count();

            return $numberOfCompletedCollectionsMonthly;
        }

        public function number_of_pending_collections_monthly()
        {
            //Get the number of pending collections for the Month
            $numberOfPendingCollectionsMonthly = $this->pending_collections_monthly()->count();

            return $numberOfPendingCollectionsMonthly;

        }

        public function completed_collections_weekly()
        {
            //Get collections for the week
            $CompletedCollectionsWeekly =  $this->weekly_scope('created_at', $this->get_all_completed_collections());
            return $CompletedCollectionsWeekly;
        }

        public function pending_collections_weekly()
        {
            //Get collections for the Week
            $PendingCollectionsWeekly =  $this->weekly_scope('created_at', $this->get_all_pending_collections());
            return $PendingCollectionsWeekly;
        }

        public function number_of_completed_collections_weekly()
        {
            //Get the number of completd collections for the Week
            $numberOfCompletedCollectionsWeekly = $this->completed_collections_weekly()->count();

            return $numberOfCompletedCollectionsWeekly;
        }

        public function number_of_pending_collections_weekly()
        {
            //Get the number of pending collections for the Week
            $numberOfPendingCollectionsWeekly = $this->pending_collections_weekly()->count();

            return $numberOfPendingCollectionsWeekly;

        }

        public function completed_collections_daily()
        {
            //Get collections for the day
            $CompletedCollectionsDaily =  $this->daily_scope('created_at', $this->get_all_completed_collections());
            return $CompletedCollectionsDaily;
        }

        public function pending_collections_daily()
        {
            //Get collections for the Day
            $PendingCollectionsDaily =  $this->daily_scope('created_at', $this->get_all_pending_collections());
            return $PendingCollectionsDaily;
        }

        public function number_of_completed_collections_daily()
        {
            //Get the number of completd collections for the Day
            $numberOfCompletedCollectionsDaily = $this->completed_collections_daily()->count();

            return $numberOfCompletedCollectionsDaily;
        }

        public function number_of_pending_collections_daily()
        {
            //Get the number of pending collections for the Day
            $numberOfPendingCollectionsDaily = $this->pending_collections_daily()->count();

            return $numberOfPendingCollectionsDaily;

        }

        public function pending_collections_tomorrow()
        {
            //Get the Pending collection for tomorrow
             $PendingCollectionsForTheTomorrow = $this->get_all_pending_collections()
                    ->whereBetween(
                        'created_at', [
                            now()->endOfDay()->toDateTimeString(), 
                            now()->addDays(2)->toDateTimeString()
                        ]
                    )->get();
            return $PendingCollectionsForTheTomorrow;

        }

        public function collections_yearly()
        {
            //Get collections for the year
            $collectionsYearly = $this->yearly_scope('created_at', $this->collections());
            return $collectionsYearly;
        }

      

        public function number_of_collections_yearly()
        {
            //Get the number of  collections for the year
            $numberOfCollectionsYearly = $this->collections_yearly()->count();

            return $numberOfCollectionsYearly;

        }

       
        public function collections_quarterly()
        {
            //Get collections for the Quarter
            $collectionsQuarterly = $this->quarterly_scope('created_at', $this->collections());
            return $collectionsQuarterly;
        }

      

        public function number_of_collections_quarterly()
        {
            //Get the number of  collections for the Quarter
            $numberOfCollectionsQuarterly = $this->collections_quarterly()->count();

            return $numberOfCollectionsQuarterly;

        }

       

        public function collections_monthly()
        {
            //Get collections for the Month
            $collectionsMonthly =  $this->monthly_scope('created_at', $this->collections());
            return $collectionsMonthly;
        }

      

        public function number_of_collections_monthly()
        {
            //Get the number of  collections for the Month
            $numberOfCollectionsMonthly = $this->collections_monthly()->count();

            return $numberOfCollectionsMonthly;

        }

      
        public function collections_weekly()
        {
            //Get collections for the Week
            $collectionsWeekly =  $this->weekly_scope('created_at', $this->collections());
            return $collectionsWeekly;
        }

       

        public function number_of_collections_weekly()
        {
            //Get the number of  collections for the Week
            $numberOfCollectionsWeekly = $this->collections_weekly()->count();

            return $numberOfCollectionsWeekly;

        }

       

        public function collections_daily()
        {
            //Get collections for the Day
            $collectionsDaily =  $this->daily_scope('created_at', $this->collections());
            return $collectionsDaily;
        }

      
        public function number_of_collections_daily()
        {
            //Get the number of  collections for the Day
            $numberOfCollectionsDaily = $this->collections_daily()->count();

            return $numberOfCollectionsDaily;

        }

        public function get_collection_report($dateFrom, $dateTo)
        {
            //Get the Total Bins Collected
            //custom reports based on dates
             $collectionsReport = $this->get_all_completed_collections()
                    ->whereBetween(
                        'created_at', [
                            $dateFrom, 
                            $dateTo
                        ]
                    )->get();
            return $collectionsReport;
        }

        public function total_bins_collected()
        {
            $binsCollected = DB::table('collections')
                                ->join('bin_collection', 'collections.id', '=', 'bin_collection.collection_id')
                                ->join('bins', 'bins.id', '=', 'bin_collection.bin_id')
                                ->select(DB::raw('count(*) as bins_count', 'company_id', 'created_at'))
                                ->where('collections.company_id', Auth::user()->company_id)
                                ->get();
            return $binsCollected;
        }

        public function bins_collected()
        {
            $binsCollected = DB::table('collections')
                                ->join('bin_collection', 'collections.id', '=', 'bin_collection.collection_id')
                                ->join('bins', 'bins.id', '=', 'bin_collection.bin_id')
                                ->select('collections.*')
                                ->where('collections.company_id', Auth::user()->company_id);
            return $binsCollected;
        }

        public function bins_collected_yearly()
        {
            //Get the bins collections for the year
            $binsCollectedYearly = $this->yearly_scope('collections.created_at', $this->bins_collected());

            return $binsCollectedYearly;
        }

        public function number_of_bins_collected_yearly()
        {
            //Get the number of bins collections for the year
            $numberOfBinsCollectedYearly = $this->bins_collected_yearly()->count();

            return $numberOfBinsCollectedYearly;

        }

        public function bins_collected_quarterly()
        {
            //Get the bins collections for the Quarter
            $binsCollectedQuarterly = $this->quarterly_scope('collections.created_at', $this->bins_collected());

            return $binsCollectedQuarterly;
        }

        public function number_of_bins_collected_quarterly()
        {
            //Get the number of bins collections for the quarter
            $numberOfBinsCollectedQuarterly = $this->bins_collected_quarterly()->count();

            return $numberOfBinsCollectedQuarterly;

        }

        public function bins_collected_monthly()
        {
            //Get the bins collections for the Month
            $binsCollectedMonthly = $this->monthly_scope('collections.created_at', $this->bins_collected());

            return $binsCollectedMonthly;
        }

        public function number_of_bins_collected_monthly()
        {
            //Get the number of bins collections for the Month
            $numberOfBinsCollectedMonthly = $this->bins_collected_monthly()->count();

            return $numberOfBinsCollectedMonthly;

        }

        public function bins_collected_weekly()
        {
            //Get the bins collections for the Week
            $binsCollectedWeekly = $this->weekly_scope('collections.created_at', $this->bins_collected());

            return $binsCollectedWeekly;
        }

        public function number_of_bins_collected_weekly()
        {
            //Get the number of bins collections for the weekly
            $numberOfBinsCollectedWeekly = $this->bins_collected_weekly()->count();

            return $numberOfBinsCollectedWeekly;

        }

        public function bins_collected_daily()
        {
            //Get the bins collections for the day
            $binsCollectedDaily = $this->daily_scope('collections.created_at', $this->bins_collected());

            return $binsCollectedDaily;
        }

        public function number_of_bins_collected_daily()
        {
            //Get the number of bins collections for the day
            $numberOfBinsCollectedDaily = $this->bins_collected_daily()->count();

            return $numberOfBinsCollectedDaily;

        }


        public function get_bin_report($dateFrom, $dateTo)
        {
            //Get the Total Bins Collected
            //custom reports based on dates
             $binReport = $this->bins_collected()
                    ->whereBetween(
                        'created_at', [
                            $dateFrom, 
                            $dateTo
                        ]
                    )->get();
            return $binReport;
        }

        public function get_all_customers(){

            $customers = Customer::where('company_id', Auth::user()->company_id)->get();
            return $customers;
        }

        public function total_customers()
        {
            $numberOfCustomers = $this->get_all_customers()->count();

            return $numberOfCustomers;
        }

    //    public function chart_pie_collections_daily()
    //    {
    //         $chart =  Charts::create('pie', 'chartjs')
    //                 ->title('Collection Ratio Per Day')
    //                 ->labels(['Collected', 'Pending', ])
    //                 ->values([number_of_completed_collections_daily(),number_of_pending_collections_daily()])
    //                 ->dimensions(1000,500)
    //                 ->responsive(true)
    //                 ->loader(true)
    //                 ->loaderDuration(2000)
    //                 ->loaderColor('#FF0000')
    //                 ->colors(['#ff0000', '#00ff00']);

    //         return $chart;
    //    }

    //    public function chart_bar_collections_all()
    //    {
    //        $chart = Charts::create('bar', 'chartjs')
    //                 ->title('Collections Analysis')
    //                 ->loader(true)
    //                 ->colors(['#ff0000', '#00ff00', '#0000ff','#f0ff00', '#f000ff'])
    //                 ->labels(['Year', 'Quarter', 'Month', 'Week', 'Today'])
    //                 ->dataset('Test 1', [1,2,3])
    //                 ->dataset('Test 2', [0,6,0])
    //                 ->dataset('Test 3', [3,4,1])
    //                 ->dataset('Test 4', [0,6,0])
    //                 ->dataset('Test 5', [3,4,1]);

    //         return $chart;
    //    }

    public function pie_collections_daily()
    {
        $chart = app()->chartjs
        ->name('CollectionRatioDaily')
        ->type('pie')
        ->labels(['Completed', 'Pending'])
        ->size(['width' => 0, 'height' => 300])
        ->datasets([
            [
                'backgroundColor' => ['rgba(152,235,239,0.8)', 'rgba(243,245,246,5.9)'],
                'hoverBackgroundColor' => ['rgba(152,235,239,1.8)', 'rgba(243,245,246,7.9)'],
                'data' => [
                    $this->number_of_completed_collections_daily(), 
                    $this->number_of_pending_collections_daily()
                    ]
            ]
        ])
        ->options([
            'responsive' => true,
        ]);

              
        return $chart;
    }

    public function pie_collections_weekly()
    {
        $chart = app()->chartjs
        ->name('CollectionRatioWeekly')
        ->type('pie')
        ->labels(['Completed', 'Pending'])
        ->size(['width' => 0, 'height' => 300])
        ->datasets([
            [
                'backgroundColor' => ['rgba(152,235,239,0.8)', 'rgba(243,245,246,0.9)'],
                'hoverBackgroundColor' => ['rgba(152,235,239,1.8)', 'rgba(243,245,246,1.9)'],
                'data' => [
                    $this->number_of_completed_collections_weekly(), 
                    $this->number_of_pending_collections_weekly()
                    ]
            ]
        ])
        ->options([
            'responsive' => true,
        ]);

              
        return $chart;
    }

    public function pie_schedules_daily()
    {
        $chart = app()->chartjs
        ->name('ScheduleRatioDaily')
        ->type('pie')
        ->labels(['Completed','Started', 'Pending'])
        ->size(['width' => 0, 'height' => 300])
        ->datasets([
            [
                'backgroundColor' => ['rgba(54, 162, 235, 0.2)','rgba(243,245,246,5.9)', 'rgba(255, 99, 132, 0.3'],
                'hoverBackgroundColor' => ['rgba(54, 162, 235, 4.2)','rgba(243,245,246,9.9)', 'rgba(255, 99, 132, 4.3'],
                'data' => [
                    $this->number_of_completed_schedules_daily(),
                    $this->number_of_started_schedules_daily(), 
                    $this->number_of_pending_schedules_daily()
                    ]
            ]
        ])
        ->options([
            'responsive' => true,
        ]);

              
        return $chart;
    }


    public function pie_schedules_weekly()
    {
        $chart = app()->chartjs
        ->name('ScheduleRatioWeekly')
        ->type('pie')
        ->labels(['Completed', 'Started', 'Pending'])
        ->size(['width' => 0, 'height' => 300])
        ->datasets([
            [
                'backgroundColor' => ['rgba(54, 162, 235, 0.2)', 'rgba(243,245,246,5.9)', 'rgba(255, 99, 132, 0.3'],
                'hoverBackgroundColor' => ['rgba(54, 162, 235, 4.2)', 'rgba(243,245,246,9.9)', 'rgba(255, 99, 132, 4.3'],
                'data' => [
                    $this->number_of_completed_schedules_weekly(),
                    $this->number_of_started_schedules_weekly(), 
                    $this->number_of_pending_schedules_weekly()
                    ]
            ]
        ])
        ->options([
            'responsive' => true,
        ]);

              
        return $chart;
    }

        
    public function bar_collection_statictics()
    {
        $dataset_one = [
            $this->number_of_completed_collections_yearly(),
            $this->number_of_completed_collections_quarterly(),
            $this->number_of_completed_collections_monthly(),
            $this->number_of_completed_collections_weekly(),
            $this->number_of_completed_collections_daily()
        ];

        $dataset_two = [
            $this->number_of_pending_collections_yearly(),
            $this->number_of_pending_collections_quarterly(),
            $this->number_of_pending_collections_monthly(),
            $this->number_of_pending_collections_weekly(),
            $this->number_of_pending_collections_daily()
        ];


        $options = [];
        $options['scales']
                ['yAxes'][]['linear'] = true;
        $options['scales']['yAxes'][]['linear'] = true;
        $options['responsive'] = true;


        // scales: {
        //     yAxes: [{
        //         type: 'linear', // only linear but allow scale type registration. This allows extensions to exist solely for log scale for instance
        //         display: true,
        //         position: 'left',
        //         id: 'y-axis-1',
        //     }, {
        //         type: 'linear', // only linear but allow scale type registration. This allows extensions to exist solely for log scale for instance
        //         display: true,
        //         position: 'right',
        //         id: 'y-axis-2',
        //         gridLines: {
        //             drawOnChartArea: false
        //         }
        //     }],

        $chart = app()->chartjs
         ->name('CollectionStatictics')
         ->type('bar')
         ->size(['width' => 0, 'height' => 300])
         ->labels(['Year', 'Quarter', 'Month', 'Week', 'Day'])
         ->datasets([
             [
                 "label" => "Completed",
                 'backgroundColor' => ['rgba(54, 162, 235, 0.2)','rgba(54, 162, 235, 0.2)','rgba(54, 162, 235, 0.2)','rgba(54, 162, 235, 0.2)','rgba(54, 162, 235, 0.2)'],
                 'data' => $dataset_one,
             ],
             [
                 "label" => "Pending",
                 'backgroundColor' => ['rgba(255, 99, 132, 0.3)','rgba(255, 99, 132, 0.3)','rgba(255, 99, 132, 0.3)','rgba(255, 99, 132, 0.3)','rgba(255, 99, 132, 0.3)'],
                 'data' => $dataset_two,
             ],
            
           
         ])
         ->options($options);

         return $chart;


    }



}
