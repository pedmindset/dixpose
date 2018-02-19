<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- User Profile-->
        <div class="user-profile">
            <div class="user-pro-body">
                <div><img src="images/users/2.jpg" alt="user-img" class="img-circle"></div>
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
                <li><a class="waves-effect waves-dark" href="#" aria-expanded="false"><i class="fa fa-circle-o text-info"></i>Dashboard </a></li>
                <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)"aria-expanded="false"><i class="icon-speedometer"></i><span class="hide-menu">Manage Customers </span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="#">Add Customers </a></li>
                        <li><a href="#">Manager Customers</a></li>
                        
                    </ul>
                </li>
                <li class="nav-small-cap">--- SUPPORT</li>
                <li> <a class="waves-effect waves-dark" href="{{ url('/logout') }}" aria-expanded="true"><i class="fa fa-circle-o text-success"></i><span class="hide-menu">Log Out</span></a></li>
                <li> <a class="waves-effect waves-dark" href="#" aria-expanded="false"><i class="fa fa-circle-o text-info"></i><span class="hide-menu">FAQ</span></a></li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
