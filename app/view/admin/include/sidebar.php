<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">

            <li>
                <a href="<?php echo URLROOT; ?>/admin"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
            </li>
            <li>
                <a href="#"><i class="fa fa-user-secret" aria-hidden="true" style='font-size:20px'></i> Profesori<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="<?php echo URLROOT; ?>/profesori/insert"><i class="fa fa-user-plus" aria-hidden="true"></i> Unesi profesora</a>
                    </li>
                    <li>
                        <a href="<?php echo URLROOT; ?>/profesori/lista"><i class="fa fa-users" aria-hidden="true"></i> Lista profesora</a>
                    </li> 
                </ul>
                <!-- /.nav-second-level -->
            </li>
            <li>
                <a href="#"><i class="fa fa-graduation-cap" aria-hidden="true" style='font-size:20px'></i> Polaznici<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="<?php echo URLROOT; ?>/polaznici/insert"><i class="fa fa-user-plus" aria-hidden="true"></i> Unesi polaznika</a>
                    </li>
                    <li>
                        <a href="<?php echo URLROOT; ?>/polaznici/lista"><i class="fa fa-users" aria-hidden="true"></i> Lista polaznika</a>
                    </li>

                </ul>
                <!-- /.nav-second-level -->
            </li>
            <li>
                <a href="#"><i class="fa fa-university" aria-hidden="true" style='font-size:20px'></i> Kursevi<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="<?php echo URLROOT; ?>/kursevi/insert"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Unesi kurs</a>
                    </li>
                    <li>
                        <a href="<?php echo URLROOT; ?>/kursevi/lista"><i class="fa fa-th-list" aria-hidden="true"></i> Lista kurseva</a>
                    </li>

                </ul>
                <!-- /.nav-second-level -->
            </li> 
            <li>
                <a href="#"><i class="fa fa-file-text" aria-hidden="true" style='font-size:20px'></i> Sertifikati<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="<?php echo URLROOT; ?>/certificate/insert"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Unesi sertifikat</a>
                    </li>
                    <li>
                        <a href="<?php echo URLROOT; ?>/certificate/lista"><i class="fa fa-th-list" aria-hidden="true"></i> Lista polaznika i sertifikata</a>
                    </li>

                </ul>
                <!-- /.nav-second-level -->
            </li> 
            <li>
                <a href="#"><i class="fa fa-calendar" aria-hidden="true" style='font-size:20px'></i> Predavac - Kurs<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="<?php echo URLROOT; ?>/rasporedi/insert"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Povezi predavaca i kurs</a>
                    </li>
                    <li>
                        <a href="<?php echo URLROOT; ?>/rasporedi/lista"><i class="fa fa-th-list" aria-hidden="true"></i> Lista predavaca i kurseva</a>
                    </li>

                </ul>
                <!-- /.nav-second-level -->
            </li>
            
        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>
<!-- /.navbar-static-side -->
</nav> 