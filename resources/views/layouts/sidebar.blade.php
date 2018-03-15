<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- User Profile-->
        <div class="user-profile">
            <div class="user-pro-body">
                <div><img src="{{ asset('images/kevin.jpeg') }}" alt="user-img" class="img-circle"></div>
                <div class="dropdown">
                    <a href="javascript:void(0)"class="dropdown-toggle u-dropdown link hide-menu" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->name}}<span class="caret"></span></a>
                    <div class="dropdown-menu animated flipInY">
                        <!-- text-->
                        <a href="javascript:void(0)"class="dropdown-item"><i class="ti-user"></i> My Profile</a>
                        <!-- text-->
                        <!-- text-->
                        <!-- text-->
                        <div class="dropdown-divider"></div>
                        <!-- text-->
                        <a href="javascript:void(0)"class="dropdown-item"><i class="ti-settings"></i> Account Setting</a>
                        <!-- text-->
                        <div class="dropdown-divider"></div>
                        <!-- text-->
                        <a href="{{ url('/logout') }}" class="dropdown-item"><i class="fa fa-power-off"></i> Logout</a>
                        <!-- text-->
                    </div>
                </div>
            </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <!--<li class="nav-small-cap">--- OPERATIONS</li>-->
                <li><a class="waves-effect waves-dark" href="{{ url('manager/dashboard' )}}" aria-expanded="false"><i class="fa fa-tachometer"></i><span class="hide-menu">Dashboard</span></a></li>
                <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)"aria-expanded="false"><i class="fa fa-user"></i><span class="hide-menu">Schedule</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{ url('schedules/create') }}">Add Schedule </a></li>
                        <li><a href="{{ url('schedules') }}">Manage schedules</a></li>
                        
                    </ul>
                </li>
                <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)"aria-expanded="false"><i class="fa fa-globe"></i><span class="hide-menu">Zones </span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{ url('zones/create') }}">Add Zone </a></li>
                        <li><a href="{{ url('zones') }}">Manage Zones</a></li>
                        
                    </ul>
                </li>
                <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)"aria-expanded="false"><i class="fa fa-map"></i><span class="hide-menu">Sector </span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{ url('servicezones/create') }}">Add Sector </a></li>
                        <li><a href="{{ url('servicezones') }}">Manage Sectors</a></li>
                        
                    </ul>
                </li>
                <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)"aria-expanded="false"><i class="fa fa-map"></i><span class="hide-menu">Classification </span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{ url('classifications/create') }}">Add Classification </a></li>
                        <li><a href="{{ url('classifications') }}">Manage Classifications</a></li>
                        
                    </ul>
                </li>
                <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)"aria-expanded="false"><i class="fa fa-pause"></i><span class="hide-menu">Bins </span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{ url('bins/create') }}">Add Bin</a></li>
                        <li><a href="{{ url('bins') }}">Manage Bins</a></li>
                        
                    </ul>
                </li>
               
                <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)"aria-expanded="false"><i class="fa fa-user"></i><span class="hide-menu">Customers </span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{ url('customers/create') }}">Add Customer </a></li>
                        <li><a href="{{ url('customers/sort/classification') }}">Sort by Classification </a></li>
                        <li><a href="{{ url('customers/sort/zone') }}">Sort by Zone </a></li>
                        <li><a href="{{ url('customers/sort/service_zone') }}">Sort by Sector </a></li>
                        <li><a href="{{ url('customers') }}">Manage Customers</a></li>
                        
                    </ul>
                </li>
                <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)"aria-expanded="false"><i class="fa fa-user"></i><span class="hide-menu">Drivers </span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{ url('drivers/create') }}">Add Driver </a></li>
                        <li><a href="{{ url('drivers') }}">Manage Drivers</a></li>
                        
                    </ul>
                </li>
                
                <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)"aria-expanded="false"><i class="fa fa-truck"></i><span class="hide-menu">Trucks </span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{ url('trucks/create') }}">Add Truck </a></li>
                        <li><a href="{{ url('trucks') }}">Manage Trucks</a></li>
                        
                    </ul>
                </li>
                <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)"aria-expanded="false"><i class="fa fa-user"></i><span class="hide-menu">Supervisor </span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{ url('supervisors/create') }}">Add Supervisor </a></li>
                        <li><a href="{{ url('supervisors') }}">Manage supervisors</a></li>
                        
                    </ul>
                </li>
                <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)"aria-expanded="false"><i class="fa fa-user"></i><span class="hide-menu">Schedule</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{ url('schedules/create') }}">Add Schedule </a></li>
                        <li><a href="{{ url('schedules') }}">Manage schedules</a></li>
                        
                    </ul>
                </li>
                
                
                <li class="nav-small-cap">--- SUPPORT</li>
                <li> <a class="waves-effect waves-dark" href="{{ url('/logout') }}" aria-expanded="false"><i class="fa fa-circle-o text-success"></i><span class="hide-menu">Log Out</span></a></li>
                <li> <a class="waves-effect waves-dark" href="#" aria-expanded="false"><i class="fa fa-circle-o text-info"></i><span class="hide-menu">FAQ</span></a></li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
