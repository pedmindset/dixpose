@extends('layouts.admin')

@section('title', 'Operations Manager Dashbaord')

@section('styles')

<link href="{{ asset('node_modules/chartist-js/dist/chartist.min.css') }}" rel="stylesheet">
<link href="{{ asset('node_modules/chartist-js/dist/chartist-init.css') }} rel="stylesheet">
<link href="{{ asset('node_modules/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.css')}}" rel="stylesheet">
<link href="{{ asset('node_modules/css-chart/css-chart.css')}}" rel="stylesheet">
<link href="{{ asset('dist/css/pages/widget-page.css') }}" rel="stylesheet">
{{--  <link href="{{ asset('dist/css/pages/easy-pie-chart.css') }}" rel="stylesheet">  --}}




@endsection

@section('content')
  
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">Operations Dashboard</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                <li class="breadcrumb-item active">Operations Dashboard</li>
            </ol>
            {{--  <button type="button" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Create New</button>  --}}
        </div>
    </div>
</div>
<!-- ============================================================== -->
<!-- End Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- Info box -->
<!-- ============================================================== -->
<!--.row -->
<div class="row">
    <div class="col-lg-3 col-sm-6 col-xs-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title text-uppercase">Zoness</h5>
                <div class="d-flex align-items-center no-block m-t-20 m-b-10">
                    <h1><i class="ti-map-alt text-info"></i></h1>
                    <div class="ml-auto">
                        <h1 class="text-muted">{{ $numberOfZones }}</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6 col-xs-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title text-uppercase">Sectors</h5>
                <div class="d-flex align-items-center no-block m-t-20 m-b-10">
                    <h1><i class="ti-location-pin text-purple"></i></h1>
                    <div class="ml-auto">
                        <h1 class="text-muted">{{ $numberOfSectors }}</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6 col-xs-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title text-uppercase">Bin Types</h5>
                <div class="d-flex align-items-center no-block m-t-20 m-b-10">
                    <h1><i class="fa fa-trash-o text-danger"></i></h1>
                    <div class="ml-auto">
                        <h1 class="text-muted">{{ $numberOfBins}}</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6 col-xs-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title text-uppercase">Customers</h5>
                <div class="d-flex align-items-center no-block m-t-20 m-b-10">
                    <h1><i class="icon-user text-success"></i></h1>
                    <div class="ml-auto">
                    <h1 class="text-muted">{{ $numberOfCustomers }}</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.row -->
<!-- ============================================================== -->
<!-- End Info box -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- Over Visitor, Our income , slaes different and  sales prediction -->
<!-- ============================================================== -->
<!-- .row -->
<div class="row">
    <div class="col-lg-8">
        <div class="card ">
            <div class="card-body ">
                <div class="d-flex m-b-40 align-items-center ">
                    <div class="row p-15">
                    <h5 class="card-title p-l-15">SCHEDULE FOR THE DAY</h5>
                    <div class="white-box">
                            </div>
                            <div class="table-responsive">

                    <table class="table table-hover" id="table1">
                            <thead>
                                <tr>
                                    <th>Supervisor Name</th>
                                    <th>Driver name </th>
                                    <th>Sector</th>
                                    <th>Status </th>
                                    <th class="text-nowrap">Edit</th>
                                    
                                </tr>
                            </thead>
                           
                            <tbody>
                                    @foreach($schedulesYearly as $schedule)
                                <tr>    
                                        <td>{{ $schedule->supervisor->name or '' }}</td>
                                        <td>{{ $schedule->driver->name or '' }}</td>
                                        <td>{{ $schedule->service_zone->name or '' }}</td>
                                        <td>{{ $schedule->status or ''}}</td>
                                        <td class="text-nowrap">
                                                <a href="{{ action('JourneyController@edit',$schedule->id) }}" data-toggle="tooltip" data-original-title="Edit"> <i class="text-left fa fa-pencil text-inverse m-r-10"></i> </a>

                                        </td>
                                                
                                       
                                    
                                    </tr>
                                    @endforeach
                            </tbody>
                            
                        </table>
                            </div>
                </div>
                </div>
                
                <div style="height:auto;"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="row">
                <div class="col-md-12">
                        <div class="card bg-primary">
                                <div class="card-body">
                                    <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                        <!-- Carousel items -->
                                        <div class="carousel-inner">
                                            <div class="carousel-item active flex-column">
                                                <i class="fa fa-list-ul fa-2x text-white"></i>
                                                <p class="text-white">Todays' Schedule</p>
                                            <h2 class="text-white font-light">Total <span class="font-bold">{{ $numberOfSchedulesDaily }}</span></h2><br>
                                                <div class="text-white m-t-20">
                                                        <i>- Todays' Report</i>
    
                                                </div>
                                            </div>
                                            <div class="carousel-item flex-column">
                                                <i class="fa fa-list-ul fa-2x text-white"></i>
                                                <p class="text-white ">Todays' Completed Schedule</p>
                                                <h2 class="text-white font-light">Total <span class="font-bold">{{ $numberOfCompletedSchedulesDaily }}</span></h2><br>
                                          <h4 class="text-white font-light">Percentage of Total {{ percentage($numberOfSchedulesDaily, $numberOfCompletedSchedulesDaily) }}</h4>
                                                <div class="text-white m-t-20"> 
                                                </div>
                                            </div>
                                            <div class="carousel-item flex-column">
                                                    <i class="fa fa-list-ul fa-2x text-white"></i>
                                                    <p class="text-white ">Todays' Pending Schedule</p>
                                            <h2 class="text-white font-light">Total <span class="font-bold">{{ $numberOfPendingSchedulesDaily }}</span></h2><br>
                                              <h4 class="text-white font-light">Percentage of Total {{ percentage($numberOfSchedulesDaily, $numberOfPendingSchedulesDaily) }}</h4>
                                                    <div class="text-white m-t-20">
                                                        
                                                    </div>
                                                </div>
                                                    <div class="carousel-item  flex-column">
                                                        <i class="fa fa-list-ul fa-2x text-white"></i>
                                                        <p class="text-white ">Weeks' Schedule</p>
                                                    <h2 class="text-white font-light">Total <span class="font-bold">{{ $numberOfSchedulesWeekly }}</span></h2><br>
                                                        
                                                        <div class="text-white m-t-20">
                                                        <i>- Weeks' Report</i>
    
                                                        </div>
                                                    </div>
                                                <div class="carousel-item flex-column">
                                                        <i class="text-white fa fa-list-ul fa-2x text-white"></i>
                                                        <p class="text-white ">Weeks' Completed Schedule</p>
                                                        <h2 class="text-white font-light">Total <span class="font-bold">{{ $numberOfCompletedSchedulesWeekly }}</span></h2><br>
                                                  <h4 class="text-white font-light">Percentage of Total {{ percentage($numberOfSchedulesWeekly, $numberOfCompletedSchedulesWeekly) }}</h4>
                                                        <div class="text-white m-t-20">
                                                        
                                                        </div>
                                                    </div>
                                            <div class="carousel-item flex-column">
                                                <i class="text-white fa fa-list-ul fa-2x text-white"></i>
                                                <p class="text-white ">Weeks' Pending Schedule </p>
                                                <h2 class="text-white font-light">Total <span class="font-bold">{{ $numberOfPendingSchedulesWeekly }}</span></h2><br>
                                          <h4 class="text-white font-light">Percentage of Total {{ percentage($numberOfSchedulesWeekly, $numberOfPendingSchedulesWeekly) }}</h4>
                                                <div class="text-white m-t-20">
                                                
                                                </div>
                                            </div>
                                               
                                            
                                            <div class="carousel-item flex-column">
                                                <i class="text-white fa fa-list-ul fa-2x text-white"></i>
                                                <p class="text-white ">Months' Schedule</p>
                                            <h2 class="text-white font-light">Total <span class="font-bold">{{ $numberOfSchedulesMonthly }}</span></h2><br>
                                                <div class="text-white m-t-20">
                                                        <i>- Months' Report</i>
    
                                                </div>
                                            </div>
                                        <div class="carousel-item flex-column">
                                            <i class="text-white fa fa-list-ul fa-2x text-white"></i>
                                            <p class="text-white ">Months' Completed Schedule</p>
                                            <h2 class="text-white font-light">Total <span class="font-bold">{{ $numberOfCompletedSchedulesMonthly }}</span></h2><br>
                                        <h4 class="text-white font-light">Percentage of Total {{ percentage($numberOfSchedulesMonthly, $numberOfCompletedSchedulesMonthly) }}</h4>
                                            <div class="text-white m-t-20">
                                                
                                            </div>
                                        </div>
                                        <div class="carousel-item flex-column">
                                            <i class="text-white fa fa-list-ul fa-2x text-white"></i>
                                            <p class="text-white ">Months' Pending Schedule </p>
                                            <h2 class="text-white font-light">Total <span class="font-bold">{{ $numberOfPendingSchedulesMonthly }}</span></h2><br>
                                      <h4 class="text-white font-light">Percentage of Total {{ percentage($numberOfSchedulesMonthly, $numberOfPendingSchedulesMonthly) }}</h4>
                                            <div class="text-white m-t-20">
                                                
                                            </div>
                                        </div>
    
    
                                        </div>
                                    </div>
                                </div>
                            </div>
    
                </div>
            <div class="col-md-12">
                    <div class="card bg-white">
                            <div class="card-body">
                                <div id="myCarousel" class="carousel slide vert" data-ride="carousel">
                                    <!-- Carousel items -->
                                    <div class="carousel-inner">
                                        <div class="carousel-item active flex-column">
                                            <i class="fa fa-truck fa-2x"></i>
                                            <p class="">Today's Total Collections</p>
                                            <h2 class=" font-light">Total <span class="font-bold">{{ $numberOfCollectionsDaily }}</span></h2><br>
                                            <div class=" m-t-20">
                                                    <i>- Todays' Report</i>
                                            </div>
                                        </div>
                                        <div class="carousel-item flex-column">
                                            <i class="fa fa-truck fa-2x "></i>
                                            <p class="">Todays' Completed Collections</p>
                                            <h2 class=" font-light">Total <span class="font-bold">{{ $numberOfCompletedCollectionsDaily }}</span></h2><br>
                                                <h4 class=" font-light">Percentage of Total {{ percentage($numberOfCollectionsDaily, $numberOfCompletedCollectionsDaily) }}%</h4>
                                            <div class="m-t-20">
                                            </div>
                                        </div>
                                        <div class="carousel-item flex-column">
                                                <i class="fa fa-truck fa-2x"></i>
                                                <p class="">Todays' Pending Collection</p>
                                                <h2 class="font-light">Total <span class="font-bold">{{ $numberOfPendingCollectionsDaily }}</span></h2><br>
                                                    <h4 class="font-light">Percentage of Total {{ percentage($numberOfCollectionsDaily, $numberOfPendingCollectionsDaily) }}%</h4>
                                                <div class="m-t-20">
                                                </div>
                                            </div>
                                            <div class="carousel-item flex-column">
                                                <i class="fa fa-truck fa-2x"></i>
                                                <p class="">Weeks Total Collections</p>
                                                <h2 class="font-light">Total <span class="font-bold">{{ $numberOfCollectionsWeekly }}</span></h2><br>
                                                <div class="m-t-20">
                                                        <i>- Weeks' Report</i>

                                                </div>
                                            </div>
                                            <div class="carousel-item flex-column">
                                                    <i class="fa fa-truck fa-2x"></i>
                                                    <p class="">Weeks Pending Collection</p>
                                            <h2 class="font-light">Total <span class="font-bold">{{ $numberOfPendingCollectionsWeekly }}</span></h2><br>
                                                <h4 class="font-light">Percentage of Total {{ percentage($numberOfCollectionsWeekly, $numberOfPendingCollectionsWeekly) }}%</h4>
                                                    <div class="m-t-20">
                                                    
                                                    </div>
                                                </div>
                                        <div class="carousel-item flex-column">
                                            <i class="fa fa-truck fa-2x"></i>
                                            <p class="">Weeks Completed Collection</p>
                                    <h2 class="font-light">Total <span class="font-bold">{{ $numberOfCompletedCollectionsWeekly }}</span></h2><br>
                                        <h4 class="font-light">Percentage of Total {{ percentage($numberOfCollectionsWeekly, $numberOfCompletedCollectionsWeekly) }}%</h4>
                                            <div class="m-t-20">
                                            
                                            </div>
                                        </div>
                                        <div class="carousel-item flex-column">
                                            <i class="fa fa-truck fa-2x"></i>
                                            <p class="">Months Total Collections</p>
                                            <h2 class="font-light">Total <span class="font-bold">{{ $numberOfCollectionsMonthly }}</span></h2><br>
                                            <div class="m-t-20">
                                                    <i>- Months' Report</i>

                                            </div>
                                        </div>
                                        <div class="carousel-item flex-column">
                                                <i class="fa fa-truck fa-2x"></i>
                                                <p class="">Months Pending Collection</p>
                                        <h2 class="font-light">Total <span class="font-bold">{{ $numberOfPendingCollectionsMonthly }}</span></h2><br>
                                            <h4 class="font-light">Percentage of Total {{ percentage($numberOfCollectionsMonthly, $numberOfPendingCollectionsMonthly) }}%</h4>
                                                <div class="text-white m-t-20">
                                                    
                                                </div>
                                            </div>
                                    <div class="carousel-item flex-column">
                                        <i class="fa fa-truck fa-2x"></i>
                                        <p class="">Months Completed Collection</p>
                                <h2 class="font-light">Total <span class="font-bold">{{ $numberOfCompletedCollectionsMonthly }}</span></h2><br>
                                    <h4 class="font-light">Percentage of Total {{ percentage($numberOfCollectionsMonthly, $numberOfCompletedCollectionsMonthly) }}%</h4>
                                        <div class="m-t-20">
                                            
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>

            </div>
           
            <div class="col-md-12">
                    <div class="card bg-success">
                            <div class="card-body">
                                <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Carousel items -->
                                    <div class="carousel-inner">
                                        <div class="carousel-item active flex-column">
                                            <i class="fa fa-trash-o fa-2x text-white"></i>
                                            <p class="text-white">Todays' Bins Collected</p>
                                            <h2 class="text-white font-light">Total <span class="font-bold">{{ $numberOfBinsCollectedDaily }}</span></h2><br>
                                            <div class="text-white m-t-20">
                                                    <i>- Todays' Report</i>
                                            </div>
                                        </div>
                                        
                                        <div class="carousel-item flex-column">
                                                <i class="fa fa-trash-o fa-2x text-white"></i>
                                                <p class="text-white">Weeks Bins Collected</p>
                                                <h2 class="text-white font-light">Total <span class="font-bold">{{ $numberOfBinsCollectedWeekly }}</span></h2><br>
                                                <div class="text-white m-t-20">
                                                        <i>- Weeks' Report</i>
                                                </div>
                                            </div>
                                            <div class="carousel-item flex-column">
                                                    <i class="fa fa-trash-o fa-2x text-white"></i>
                                                    <p class="text-white">Months Bins collected</p>
                                                    <h2 class="text-white font-light">Total <span class="font-bold">{{ $numberOfBinsCollectedMonthly }}</span></h2><br>
                                                    <div class="text-white m-t-20">
                                                            <i>- Months' Report</i>
                                                    </div>
                                                </div>
                                        <div class="carousel-item flex-column">
                                            <i class="fa fa-trash-o fa-2x text-white"></i>
                                            <p class="text-white">Bins Collected - 3 months Jan</p>
                                            <h2 class="text-white font-light">Total <span class="font-bold">{{ $numberOfBinsCollectedQuarterly }}</span></h2><br>
                                            <div class="text-white m-t-20">
                                                    <i>- Quarterly Report</i>
                                            </div>
                                        </div>
                                        <div class="carousel-item flex-column">
                                            <i class="fa fa-trash-o fa-2x text-white"></i>
                                            <p class="text-white">Bins Collected - 1 year</p>
                                            <h2 class="text-white font-light">Total <span class="font-bold">{{ $numberOfBinsCollectedYearly }}</span></h2><br>
                                            <div class="text-white m-t-20">
                                                    <i>- Yearly Report</i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

            </div>
        </div>
    </div>
</div>
<!-- /.row -->

        
         
                            <div class="row p-3">
                                   <h3 class=" card-title">Realtime Analysis</h3>
                            </div>
                                <div class="row">
                                    <!-- column -->
                                    <div class="col-lg-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <h4 class="card-title">Todays' Collection Ratio </h4>
                                                <div>
                                                    {!! $pieCollectionsDaily->render() !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- column -->
                                    <!-- column -->
                                    <div class="col-lg-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <h4 class="card-title">Weeks Collection Ratio</h4>
                                                <div>
                                                    {!! $pieCollectionsWeekly->render() !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- column -->
                            
                                    <!-- column -->
                                    <div class="col-lg-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <h4 class="card-title">Todays' Schedules Ratio </h4>
                                                <div>
                                                    {!! $pieSchedulesDaily->render() !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- column -->
                                    <!-- column -->
                                    <div class="col-lg-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <h4 class="card-title">Weeks' Schedules Ratio</h4>
                                                <div>
                                                    {!! $pieSchedulesWeekly->render() !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- column -->
                                </div>
                                <div class="row">
                                   
                                    <!-- column -->
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <h4 class="card-title">Collections' Statistics </h4>
                                                <div>
                                                    {!! $barCollectionsStatistics->render() !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- column -->
                                </div>
                
                            
                

                                            
                        
                
       

               

    <!-- ============================================================== -->
    <!-- End of Dashboard Elements and Features -->
                    <!-- ============================================================== -->
                    <!-- End PAge Content -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->        
@endsection

@section('scripts')

<script src="{{ asset('node_modules/sparkline/jquery.sparkline.min.js')}}"></script>
<script src="{{ asset('node_modules/gauge/gauge.min.js')}}"></script>
{{--  <script src="{{ asset('dist/js/pages/widget-data.js')}}"></script>
{{--  <!-- EASY PIE CHART JS -->

<script src="{{ asset('node_modules/jquery.easy-pie-chart/dist/jquery.easypiechart.min.js')}}"></script>
<script src="{{ asset('node_modules/jquery.easy-pie-chart/easy-pie-chart.init.js')}}"></script>  

<!-- Chart JS --> --}}
<script src=//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js charset=utf-8></script>
{{--   {!! $PieCollectionsDaily->script() !!}  --}}


@endsection

