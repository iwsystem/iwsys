<!-- Navigation -->
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="">IW System</a>
    </div>
    <!-- /.navbar-header -->
    <ul class="nav navbar-top-links navbar-right">
        <!-- /.dropdown -->
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
                <li>
                    <a href="stf_user_profile.php"><i class="fa fa-user fa-fw"></i> User Profile</a>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="signon/logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                </li>
            </ul>
            <!-- /.dropdown-user -->
        </li>
        <!-- /.dropdown -->
    </ul>
    <!-- /.navbar-top-links -->
    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
            <br>
                <li class="divider"></li>
                <li>
                    <a href="stf_home.php"><i class="fa fa-home fa-fw"></i> Home</a>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-folder fa-fw"></i> Project <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="stf_project_mgt.php"><i class="fa fa-plus fa-fw"></i> Add Project</a>
                        </li>
                        <li>
                            <a href="stf_project_mgt.php"><i class="fa fa-table fa-fw"></i> Active Projects</a>
                        </li>
                        <li>
                            <a href="stf_project_mgt.php"><i class="fa fa-table fa-fw"></i> Inactive Projects</a>
                        </li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-cog fa-fw"></i> User Admin <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="stf_user_admin_new.php"><i class="fa fa-plus fa-fw"></i> Add User</a>
                        </li>
                        <li>
                            <a href="stf_user_admin_active.php"><i class="fa fa-table fa-fw"></i> Active Users</a>
                        </li>
                        <li>
                            <a href="stf_user_admin_inactive.php"><i class="fa fa-table fa-fw"></i> Inactive Users</a>
                        </li>
                        <li>
                            <a href="stf_user_admin_pending.php"><i class="fa fa-table fa-fw"></i> Pending Users</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- /.sidebar-collapse -->
    </div>
    <!-- /.navbar-static-side -->
</nav>
<!-- /Navigation -->