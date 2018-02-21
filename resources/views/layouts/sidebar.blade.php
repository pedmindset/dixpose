<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- User Profile-->
        <div class="user-profile">
            <div class="user-pro-body">
                <div><img src="{{ asset('images/users/2.jpg') }}" alt="user-img" class="img-circle"></div>
                <div class="dropdown">
                    <a href="javascript:void(0)"class="dropdown-toggle u-dropdown link hide-menu" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Kevin Gawo<span class="caret"></span></a>
                    <div class="dropdown-menu animated flipInY">
                        <!-- text-->
                        <a href="javascript:void(0)"class="dropdown-item"><i class="ti-user"></i> My Profile</a>
                        <!-- text-->
                        <a href="javascript:void(0)"class="dropdown-item"><i class="ti-wallet"></i> My Balance</a>
                        <!-- text-->
                        <a href="javascript:void(0)"class="dropdown-item"><i class="ti-email"></i> Inbox</a>
                        <!-- text-->
                        <div class="dropdown-divider"></div>
                        <!-- text-->
                        <a href="javascript:void(0)"class="dropdown-item"><i class="ti-settings"></i> Account Setting</a>
                        <!-- text-->
                        <div class="dropdown-divider"></div>
                        <!-- text-->
                        <a href="{{ url('/login') }}" class="dropdown-item"><i class="fa fa-power-off"></i> Logout</a>
                        <!-- text-->
                    </div>
                </div>
            </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <!--<li class="nav-small-cap">--- OPERATIONS</li>-->
                <li><a class="waves-effect waves-dark" href="#" aria-expanded="false"><i class="fa fa-tachometer"></i><span class="hide-menu">Dashboard</span></a></li>
                <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)"aria-expanded="false"><i class="fa fa-globe"></i><span class="hide-menu">Zones </span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="#">Add Zones </a></li>
                        <li><a href="#">Manager Zones</a></li>
                        
                    </ul>
                </li>
                <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)"aria-expanded="false"><i class="fa fa-map"></i><span class="hide-menu">Services Zones </span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="#">Add Service Zones </a></li>
                        <li><a href="#">Manager Service Zones</a></li>
                        
                    </ul>
                </li>
                <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)"aria-expanded="false"><i class="fa fa-pause"></i><span class="hide-menu">Bins </span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="#">Add Bins </a></li>
                        <li><a href="#">Manager Bins</a></li>
                        
                    </ul>
                </li>
                <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)"aria-expanded="false"><i class="fa fa-user"></i><span class="hide-menu">Customers </span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="#">Add Customers </a></li>
                        <li><a href="#">Manager Customers</a></li>
                        
                    </ul>
                </li>
                <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)"aria-expanded="false"><i class="fa fa-user"></i><span class="hide-menu">Drivers </span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="#">Add Drivers </a></li>
                        <li><a href="#">Manager Drivers</a></li>
                        
                    </ul>
                </li>
                <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)"aria-expanded="false"><i class="fa fa-user"></i><span class="hide-menu">Trucks </span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="#">Add Truck </a></li>
                        <li><a href="#">Manager Truck</a></li>
                        
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
