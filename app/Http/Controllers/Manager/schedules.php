<?
    class started_schedulesStarted
    {
        public function index()
        {
            //collections Reports
          

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

             return view('manager/dashboard', 
             compact(
              
                //collections
                'collectionsYearly', 'numberOfCollectionsYearly',
                'collectionsQuarterly', 'numberOfCollectionsQuarterly',
                'collectionsMonthly', 'numberOfCollectionsMonthly',
                'collectionsDaily', 'numberOfCollectionsDaily'
               
                 
                 
             )
);

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
    }