<?php

namespace App\Http\Controllers\Manager;

use Auth;
use Carbon\Carbon;
use App\Models\Bin;
use App\Models\Zone;
use App\Models\Truck;
use App\Models\Driver;
use App\Models\Journey;
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


        public function dashbaord()
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
            $numberOfschedulesYearly = $this->number_of_schedules_yearly();

            //Get schedules for the quarter
            $schedulesQuarterly = $this->schedules_quarterly();
            $numberOfschedulesQuarterly = $this->number_of_schedules_quarterly();

            //Get schedules for the month 
            $schedulesMonthly = $this->schedules_monthly(); 
            $numberOfschedulesMonthly = $this->number_of_schedules_monthly();

            //Get schedules for the week
            $schedulesWeekly = $this->schedules_weekly();
            $numberOfschedulesWeekly = $this->number_of_schedules_weekly();

            //Get schedules for the day
            $schedulesDaily = $this->schedules_daily();
            $numberOfschedulesDaily = $this->number_of_schedules_daily();


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
        


            
            return view('manager/dashboard', 
                                    compact(
                                        //general operations data
                                        'zones', '$numberOfZones',
                                        'sectors', 'numberOfSectors', 
                                        'bins', 'numberOfBins', 
                                        'classifications', 'numberOfClassifications',
                                        //scheduling
                                        'schedulesYearly', 'numberOfschedulesYearly', 
                                        'schedulesQuarterly', 'numberOfschedulesQuarterly', 
                                        'schedulesMonthly', 'numberOfschedulesMonthly', 
                                        'schedulesWeekly', 'numberOfschedulesWeekly',
                                        //collections
                                        'completedCollectionsYearly', 'numberOfCompletedCollectionsYearly',
                                        'pendingCollectionsYearly', 'numberOfpendingCollectionsYearly',
                                        'completedCollectionsQuarterly', 'numberOfCompletedCollectionsQuarterly',
                                        'pendingCollectionsQuarterly', 'numberOfPendingCollectionsQuarterly',
                                        'completedCollectionsMonthly', 'numberOfCompletedCollectionsMonthly',
                                        'pendingCollectionsMonthly', 'numberOfPendingCollectionsMonthly',
                                        'completedCollectionsDaily', 'numberOfCompletedCollectionsDaily',
                                        'pendingCollectionsDaily', 'numberOfPendingCollectionsDaily',
                                        //bins
                                        'binsCollectedYearly', 'numberOfBinsCollectedYearly',
                                        'binsCollectedQuarterly', 'numberOfBinsCollectedQuarterly',
                                        'binsCollectedMonthly', 'numberOfBinsCollectedMonthly',
                                        'binsCollectedWeekly', 'numberOfBinsCollectedWeekly',
                                        'binsCollectedDaily', 'numberOfBinsCollectedDaily'

                                        
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
            $sectors = SectorZone::where('company_id', Auth::user()->company_id)
                                 ->get();
            return $sectors;
            
        }


        public function number_of_sectors()
        {
            //show the number of sectors by company
            $numberOfSectors = $this->sectors()->count();

            return $numberOfZones;
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
            $bins = Classification::where('company_id', Auth::user()->company_id)
                                 ->get();
            return $classifications;
            
        }


        public function number_of_classifications()
        {
            //show the number of classifications by company
            $numberOfBins = $this->classifications()->count();

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

        public function dialy_scope($between, $method)
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
            $schedules = DB::table('journeys')->where('company_id', Auth::user()->company_id);

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
            $numberOfschedulesYearly = $this->schedules_yearly()
                                                 ->count();

            return $numberOfschedulesYearly;
        }

        public function schedules_quarterly()
        {
            //Get schedules for the Quarter
            $schedulesForTheQuarter = $this->quarterly_scope('pickupdate', $this->schedules());

            return $schedulesForTheQuarter;
        }

        public function number_of_schedules_quarterly()
        {
            //Get the number of schedules for the Quarter
            $numberOfschedulesForTheQuarter = $this->schedules_quarterly()
                                                 ->count();
            return $numberOfschedulesQuarterly;
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
            $numberOfschedulesMonthly = $this->schedules_monthly()
                                                 ->count();
            return $numberOfschedulesMonthly;
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
            $numberOfschedulesWeekly = $this->schedules_weekly()
                                                 ->count();
            return $numberOfschedulesWeekly;
        }

        public function schedules_daily()
        {
            //Get schedules for the Day
            $schedulesDaily = $this->dialy_scope('pickupdate', $this->schedules());

            return $schedulesDaily;
        }

        public function number_of_schedules_daily()
        {
            //Get the number of schedules for the Day
            $numberOfschedulesDaily = $this->schedules_daily()
                                                 ->count();
            return $numberOfschedulesDaily;
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
            $collections = DB::table('collections')->where('company_id', Auth::user()->company_id);
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
            $PendingCollectionsYearly = $this->yearly_scope('created_at', $this->get_all_pending_collections());
            return $PendingCollectionsYearly;
        }

        public function number_of_completed_collections_yearly()
        {
            //Get the number of completd collections for the year
            $numberOfCompletedCollectionsYearly = $this->get_all_completed_collections()->count();

            return $numberOfCompletedCollectionsYearly;
        }

        public function number_of_pending_collection_yearly()
        {
            //Get the number of pending collections for the year
            $numberOfPendingCollectionsYearly = $this->pending_collections_yearly()->count();

            return $numberOfPendingCollectionsYearly;

        }

        public function completed_collections_quarterly()
        {
            //Get collections for the quartey
            $CompletedCollectionsForTheQuarter = $this->quarterly_scope('created_at', $this->get_all_completed_collections());
            return $CompletedCollectionsForTheQuarter;
        }

        public function pending_collections_quarterly()
        {
            //Get collections for the Quarter
            $PendingCollectionsForTheQuarter = $this->quarterly_scope('created_at', $this->get_all_pending_collections());
            return $PendingCollectionsForTheQuarter;
        }

        public function number_of_completed_collections_quarterly()
        {
            //Get the number of completd collections for the Quarter
            $numberOfCompletedCollectionsForTheQuarter = $this->completed_collections_quarterly()->count();

            return $numberOfCompletedCollectionsForTheQuarter;
        }

        public function number_of_pending_collections_quarterly()
        {
            //Get the number of pending collections for the Quarter
            $numberOfPendingCollectionsForTheQuarter = $this->pending_collections_quarterly()->count();

            return $numberOfPendingCollectionsForTheQuarter;

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
            $CompletedCollectionsDaily =  $this->dialy_scope('created_at', $this->get_all_completed_collections());
            return $CompletedCollectionsDaily;
        }

        public function pending_collections_daily()
        {
            //Get collections for the Day
            $PendingCollectionsDaily =  $this->dialy_scope('created_at', $this->get_all_pending_collections());
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



}
