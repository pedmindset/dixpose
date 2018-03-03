@extends('layouts.admin')

@section('title', 'Admin')

@section('styles')

@endsection

@section('content')
 
                    <div class="row page-titles">
                        <div class="col-md-5 align-self-center">
                            <h4 class="text-themecolor">Dashboard</h4>
                        </div>
                        <div class="col-md-7 align-self-center text-right">
                            <div class="d-flex justify-content-end align-items-center">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                    <li class="breadcrumb-item active">Admin</li>
                                </ol>
                                <button type="button" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Create New</button>
                            </div>
                        </div>
                    </div>
                    <!-- ============================================================== -->
                    <!-- End Bread crumb and right sidebar toggle -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- Start Page Content -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
<!-- Dashboard Elements and Features -->
<!-- ============================================================== -->
<div class="row">
        <!-- Total clients served clm -->
        <div class="card-group">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="d-flex no-block align-items-center">
                                <div>
                                    <!--<h3><i class="icon-screen-desktop"></i></h3>-->
                                    <p class="text-muted">TOTAL CLIENTS SERVED</p>
                                </div>
                                <div class="ml-auto">
                                    <h2 class="counter text-primary">1200</h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="progress">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: 85%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <!-- Total clients served clm -->
    
        <!--Total clients not served clm-->
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="d-flex no-block align-items-center">
                                <div>
                                    <!--<h3><i class="icon-note"></i></h3>-->
                                    <p class="text-muted">TOTAL CLIENTS NOT SERVED</p>
                                </div>
                                <div class="ml-auto">
                                    <h2 class="counter text-cyan">350</h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="progress">
                                <div class="progress-bar bg-cyan" role="progressbar" style="width: 85%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <!--Total clients not served clm-->
    
        <!-- Total bins collected  -->
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="d-flex no-block align-items-center">
                                <div>
                                    <!--<h3><i class="icon-doc"></i></h3>-->
                                    <p class="text-muted">TOTAL BINS COLLECTED</p>
                                </div>
                                <div class="ml-auto">
                                    <h2 class="counter text-purple">6000</h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="progress">
                                <div class="progress-bar bg-purple" role="progressbar" style="width: 85%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <!-- Total bins collected  -->
    
        <!-- Today's work progress -->
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="d-flex no-block align-items-center">
                                <div>
                                    <!--<h3><i class="icon-bag"></i></h3>-->
                                    <p class="text-muted">TOTAL WORK PROGRESS</p>
                                </div>
                                <div class="ml-auto">
                                    <h2 class="counter text-success">80%</h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="progress">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 85%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- todays work progress -->
    </div>
    <!-- ============================================================== -->
    <!-- End Info box -->
    <!-- ============================================================== -->
     <!--START OF THE SCHEDULING CARDS-->
                <!--TODAY'S SCHEDULES-->
                <div class="row">
                    <!-- Column -->
                    <div class="col-lg-6 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">TODAY'S SCHEDULE</h5>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>SECTOR</th>
                                        <th>SUPERVISOR</th>
                                        <th>DRIVER</th>
                                        <th>NO OF CLIENTS</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td><a href="javascript:void(0)" class="link"> 1A</a></td>
                                        <td>Steve Horton</td>
                                        <td><span class="text-muted"> Nana Kweku</span></td>
                                        <td> 200</td>

                                    </tr>
                                    <tr>
                                        <td><a href="javascript:void(0)" class="link"> 2A</a></td>
                                        <td>Charles S Boyle</td>
                                        <td><span class="text-muted"> John Doe </span></td>
                                        <td> 300</td>

                                    </tr>
                                    <tr>
                                        <td><a href="javascript:void(0)" class="link"> 1C</a></td>
                                        <td>Lucy Doe</td>
                                        <td><span class="text-muted"> Emma Watson</span></td>
                                        <td> 100</td>

                                    </tr>
                                    <tr>
                                        <td><a href="javascript:void(0)" class="link"> 2B</a></td>
                                        <td>Teresa  Doe</td>
                                        <td><span class="text-muted"> George Osodo</span></td>
                                        <td> 350</td>

                                    </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->


                <!--END OF TODAY'S SCHEDULE-->

                <!--START OF TOMORROW'S SCHEDULE-->

                    <div class="col-lg-6 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">TOMORROW'S SCHEDULE</h5>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>SECTOR</th>
                                        <th>SUPERVISOR</th>
                                        <th>DRIVER</th>
                                        <th>NO OF CLIENTS</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td><a href="javascript:void(0)" class="link"> 1A</a></td>
                                        <td>Steve Horton</td>
                                        <td><span class="text-muted">Nana Kweku</span></td>
                                        <td> 200</td>

                                    </tr>
                                    <tr>
                                        <td><a href="javascript:void(0)" class="link"> 2A</a></td>
                                        <td>Charles S Boyle</td>
                                        <td><span class="text-muted">John Doe </span></td>
                                        <td> 300</td>

                                    </tr>
                                    <tr>
                                        <td><a href="javascript:void(0)" class="link"> 1C</a></td>
                                        <td>Lucy Doe</td>
                                        <td><span class="text-muted"> Emma Watson</span></td>
                                        <td> 100</td>

                                    </tr>
                                    <tr>
                                        <td><a href="javascript:void(0)" class="link"> 2B</a></td>
                                        <td>Teresa  Doe</td>
                                        <td><span class="text-muted"> George Osodo</span></td>
                                        <td> 350</td>

                                    </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                </div>
                <!--END OF TOMORROW'S SCHEDULE-->

                <!--START OF OVERDUE SCHEDULE-->

                <div class="row">
                    <!-- Column -->
                    <div class="col-lg-12 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">OVERDUE SCHEDULE'S</h5>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>SECTOR</th>
                                        <th>SUPERVISOR</th>
                                        <th>DRIVER</th>
                                        <th>NO OF CLIENTS</th>
                                        <th>DATE</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td><a href="javascript:void(0)" class="link"> 1A</a></td>
                                        <td>Steve Horton</td>
                                        <td><span class="text-muted"></i> Nana Kweku</span></td>
                                        <td> 200</td>
                                        <td> 20/02/2018</td>

                                    </tr>
                                    <tr>
                                        <td><a href="javascript:void(0)" class="link"> 2A</a></td>
                                        <td>Charles S Boyle</td>
                                        <td><span class="text-muted"></i> John Doe </span></td>
                                        <td> 300</td>
                                        <td> 21/2/2018</td>

                                    </tr>
                                    <tr>
                                        <td><a href="javascript:void(0)" class="link"> 1C</a></td>
                                        <td>Lucy Doe</td>
                                        <td><span class="text-muted"> Emma Watson</span></td>
                                        <td> 100</td>
                                        <td> 23/2/2018</td>

                                    </tr>
                                    <tr>
                                        <td><a href="javascript:void(0)" class="link"> 2B</a></td>
                                        <td>Teresa  Doe</td>
                                        <td><span class="text-muted"> George Osodo</span></td>
                                        <td> 350</td>
                                        <td> 24/2/2018</td>

                                    </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!--START OF OVERDUE SCHEDULE-->


                <!--END OF THE SCHEDULING CARDS-->
               
    <!-- ============================================================== -->
    <!-- Advanced search tool-->
    <!-- ============================================================== -->
    <div class="row">
        <!-- Column -->
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="ml-auto">
                                <select class="custom-select b-0">
                                    <option>SECTOR 2C</option>
                                    <option value="1">SECTOR 7A</option>
                                    <option value="2" selected="">SECTOR 5D</option>
                                    <option value="3">SECTOR 2A</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="ml-auto">
                                <select class="custom-select b-0">
                                    <option>Clients Served</option>
                                    <option value="1">Clients not Served</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="ml-auto">
                                <select class="custom-select b-0">
                                    <option>Driver</option>
                                    <option value="1">Nana Osborne</option>
                                    <option value="2"> John Kweku</option>
                                    <option value="3">Kale Kasee</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="ml-auto">
                                <select class="custom-select b-0">
                                    <option>Date</option>
                                    <option value="1"> 24-Feb-2018</option>
                                    <option value="2"> 23-Feb-2018</option>
                                    <option value="3"> 22-Feb-2018</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Column -->
    </div>
    <!-- ============================================================== -->
    <!-- Advanced Search tool -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Feed and erning -->
    <!-- ============================================================== -->
    
    <!-- ============================================================== -->
    <!-- Review -->
    <!-- ============================================================== -->
    <div class="row">
        <!-- Column -->
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">FIELD STATUS</h5>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Client Name</th>
                                <th>Pick Up Time</th>
                                <th>Bins Collected</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Remarks</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><a href="javascript:void(0)" class="link"> #53431</a></td>
                                <td>Steve N. Horton</td>
                                <td><span class="text-muted"><i class="fa fa-clock-o"></i> 10:15:20 am</span></td>
                                <td> 4</td>
                                <td class="text-center">
                                    <div class="label label-table label-success">COLLECTED</div>
                                </td>
                                <td class="text-center">-</td>
                            </tr>
                            <tr>
                                <td><a href="javascript:void(0)" class="link"> #53432</a></td>
                                <td>Charles S Boyle</td>
                                <td><span class="text-muted"><i class="fa fa-clock-o"></i> 10:20:30 am</span></td>
                                <td> 3</td>
                                <td class="text-center">
                                    <div class="label label-table label-success">COLLECTED</div>
                                </td>
                                <td class="text-center">-</td>
                            </tr>
                            <tr>
                                <td><a href="javascript:void(0)" class="link"> #53433</a></td>
                                <td>Lucy Doe</td>
                                <td><span class="text-muted"><i class="fa fa-clock-o"></i> 10:25:34 am</span></td>
                                <td> 3</td>
                                <td class="text-center">
                                    <div class="label label-table label-success">COLLECTED</div>
                                </td>
                                <td class="text-center">-</td>
                            </tr>
                            <tr>
                                <td><a href="javascript:void(0)" class="link"> #53434</a></td>
                                <td>Teresa L. Doe</td>
                                <td><span class="text-muted"><i class="fa fa-clock-o"></i> 10:40:30 am</span></td>
                                <td> 4</td>
                                <td class="text-center">
                                    <div class="label label-table label-success">COLLECTED</div>
                                </td>
                                <td class="text-center">-</td>
                            </tr>
                            <tr>
                                <td><a href="javascript:void(0)" class="link"> #53435</a></td>
                                <td>Teresa L. Doe</td>
                                <td><span class="text-muted"><i class="fa fa-clock-o"></i> 10:45:20 am</span></td>
                                <td>0</td>
                                <td class="text-center">
                                    <div class="label label-table label-danger">NOT COLLECTED</div>
                                </td>
                                <td class="text-center"> Customer house was closed</td>
                            </tr>
                            <tr>
                                <td><a href="javascript:void(0)" class="link"> #53437</a></td>
                                <td>Irish Resturant</td>
                                <td><span class="text-muted"><i class="fa fa-clock-o"></i> 11:00:40 am</span></td>
                                <td>7</td>
                                <td class="text-center">
                                    <div class="label label-table label-success">COLLECTED</div>
                                </td>
                                <td class="text-center">-</td>
                            </tr>
                            <tr>
                                <td><a href="javascript:void(0)" class="link"> #536584</a></td>
                                <td>Fufu Joint</td>
                                <td><span class="text-muted"><i class="fa fa-clock-o"></i> 11:10:29 am</span></td>
                                <td> 4</td>
                                <td class="text-center">
                                    <div class="label label-table label-success">COLLECTED</div>
                                </td>
                                <td class="text-center">-</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Column -->
    </div>
    <!-- ============================================================== -->
    <!-- End of Dashboard Elements and Features -->
                    <!-- ============================================================== -->
                    <!-- End PAge Content -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->        
@endsection

@section('scripts')

@endsection

