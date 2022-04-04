            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-10">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0 font-size-18">Dashboard</h4>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="text-right">
                                    <h4 class="mb-0" style="font-size: 14px!important;">Today is <?php echo date("Y-m-d");?></h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <?php 
                            if($userdata["isRole"] > 0){
                        ?>
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="card mini-stats-wid">
                                                <div class="card-body">
                                                    <div class="media">
                                                        <div class="media-body">
                                                            <a href="<?php echo base_url('employee');?>">
                                                                <p class="text-muted font-weight-medium">Employees</p>
                                                                <h4 class="mb-0"><?php echo $employeeCount;?></h4>
                                                            </a>
                                                        </div>

                                                        <div class="mini-stat-icon avatar-sm rounded-circle bg-primary align-self-center">
                                                            <span class="avatar-title">
                                                                <i class="bx bxs-user-detail font-size-24"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>                                    
                                        <div class="col-md-3">
                                            <div class="card mini-stats-wid">
                                                <div class="card-body">
                                                    <div class="media">
                                                        <div class="media-body">
                                                            <a href="<?php echo base_url('orders');?>">
                                                                <p class="text-muted font-weight-medium">Orders</p>
                                                                <h4 class="mb-0"><?php echo $ordersCount;?></h4>
                                                            </a>
                                                        </div>

                                                        <div class="avatar-sm rounded-circle bg-primary align-self-center mini-stat-icon">
                                                            <span class="avatar-title rounded-circle bg-primary">
                                                                <i class="bx bx-store font-size-24"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="card mini-stats-wid">
                                                <div class="card-body">
                                                    <div class="media">
                                                        <div class="media-body">
                                                            <a href="<?php echo base_url('process');?>">
                                                                <p class="text-muted font-weight-medium">Total Monthly Salary</p>
                                                                <h4 class="mb-0">Rs. <?php echo $totalSalary;?></h4>
                                                            </a>
                                                        </div>

                                                        <div class="avatar-sm rounded-circle bg-primary align-self-center mini-stat-icon">
                                                            <span class="avatar-title rounded-circle bg-primary">
                                                                <i class="bx bx-dollar font-size-24"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="card mini-stats-wid">
                                                <div class="card-body">
                                                    <div class="media">
                                                        <div class="media-body">
                                                            <a href="<?php echo base_url('income');?>">
                                                                <p class="text-muted font-weight-medium">Income</p>
                                                                <h4 class="mb-0">Rs. <?php echo $incomeMoney;?></h4>
                                                            </a>
                                                        </div>

                                                        <div class="avatar-sm rounded-circle bg-primary align-self-center mini-stat-icon">
                                                            <span class="avatar-title rounded-circle bg-primary">
                                                                <i class="bx bx-dollar font-size-24"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end row -->
                                </div>
                            </div>
                        <?php
                            }else{
                        ?>
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="card mini-stats-wid">
                                                <div class="card-body">
                                                    <div class="media">
                                                        <div class="media-body">
                                                            <a href="<?php echo base_url('employee');?>">
                                                                <p class="text-muted font-weight-medium">Employees</p>
                                                                <h4 class="mb-0"><?php echo $employeeCount;?></h4>
                                                            </a>
                                                        </div>

                                                        <div class="mini-stat-icon avatar-sm rounded-circle bg-primary align-self-center">
                                                            <span class="avatar-title">
                                                                <i class="bx bxs-user-detail font-size-24"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>                                    
                                        <div class="col-md-4">
                                            <div class="card mini-stats-wid">
                                                <div class="card-body">
                                                    <div class="media">
                                                        <div class="media-body">
                                                            <a href="<?php echo base_url('orders');?>">
                                                                <p class="text-muted font-weight-medium">Orders</p>
                                                                <h4 class="mb-0"><?php echo $ordersCount;?></h4>
                                                            </a>
                                                        </div>

                                                        <div class="avatar-sm rounded-circle bg-primary align-self-center mini-stat-icon">
                                                            <span class="avatar-title rounded-circle bg-primary">
                                                                <i class="bx bx-store font-size-24"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="card mini-stats-wid">
                                                <div class="card-body">
                                                    <div class="media">
                                                        <div class="media-body">
                                                            <a href="<?php echo base_url('process');?>">
                                                                <p class="text-muted font-weight-medium">Total Monthly Salary</p>
                                                                <h4 class="mb-0">Rs. <?php echo $totalSalary;?></h4>
                                                            </a>
                                                        </div>

                                                        <div class="avatar-sm rounded-circle bg-primary align-self-center mini-stat-icon">
                                                            <span class="avatar-title rounded-circle bg-primary">
                                                                <i class="bx bx-dollar font-size-24"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>                                    
                                    </div>
                                    <!-- end row -->
                                </div>
                            </div>
                        <?php
                            }
                        ?>
                        <!-- end row -->
                    </div>
                    <!-- container-fluid -->
                </div>
                <!-- End Page-content -->