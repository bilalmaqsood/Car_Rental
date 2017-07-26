<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse slimscrollsidebar">
        <ul class="nav" id="side-menu">
            <li class="sidebar-search hidden-sm hidden-md hidden-lg">
                <!-- input-group -->
                <div class="input-group custom-search-form">
                    <input type="text" class="form-control" placeholder="Search...">
                    <div class="input-group-btn">
                        <button class="btn btn-default" type="button"> <i class="fa fa-search"></i> </button>
                    </div>
                </div>
                <!-- /input-group -->
            </li>
            <li class="user-pro">
                <a href="javascript:void(0);" class="waves-effect">
                    <img src="{{ Auth::user()->avatar ?: '/images/avatar-default.png' }}" alt="user-img" class="img-circle">
                    <span class="hide-menu">{{ Auth::user()->name }}<span class="fa arrow"></span></span>
                </a>
                <ul class="nav nav-second-level">
                    <li><a href="javascript:void(0);"><i class="ti-user"></i> My Profile</a></li>
                    <li><a href="{{ route('logout') }}"><i class="fa fa-power-off"></i> Logout</a></li>
                </ul>
            </li>
            <li class="nav-small-cap m-t-10">--- Main Menu</li>
            <li>
                <a href="{{ route('admin') }}" class="waves-effect">
                    <i class="linea-icon linea-basic fa-fw" data-icon="v"></i> <span class="hide-menu"> Dashboard </span>
                </a>
            </li>
            <li class="nav-small-cap">--- Support</li>
            <li><a href="{{ route('logout') }}" class="waves-effect"><i class="icon-logout fa-fw"></i> <span class="hide-menu">Log out</span></a></li>
            <li class="hide-menu">
                <a href="javascript:void(0);"> <span>Progress Report</span>
                    <div class="progress">
                        <div class="progress-bar progress-bar-info" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 85%" role="progressbar"> <span class="sr-only">85% Complete (success)</span> </div>
                    </div> <span>Leads Report</span>
                    <div class="progress">
                        <div class="progress-bar progress-bar-danger" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 85%" role="progressbar"> <span class="sr-only">85% Complete (success)</span> </div>
                    </div>
                </a>
            </li>
        </ul>
    </div>
</div>