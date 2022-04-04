            <!-- ========== Left Sidebar Start ========== -->
            <div class="vertical-menu">

                <div data-simplebar class="h-100">

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">
                        <!-- Left Menu Start -->
                        <ul class="metismenu list-unstyled" id="side-menu">
                            <li class="menu-title">Menu</li>

                            <li>
                                <a href="<?php echo base_url('Home');?>" class="waves-effect">
                                    <i class="bx bx-home-circle"></i>
                                    <span>Dashboard</span>
                                </a>
                            </li>
                            
                            <li>
                                <a href="<?php echo base_url('employee');?>" class="">
                                    <i class="bx bxs-user-detail"></i>
                                    <span>Employees</span>
                                </a>
                            </li>  

                            <?php 
                                if($userdata["isRole"] > 0){
                            ?>
                                <li>
                                    <a href="<?php echo base_url('orders');?>">
                                        <i class="bx bx-store"></i>
                                        <span>Orders</span>
                                    </a>
                                </li>
                            <?php
                                }
                            ?>                            

                            <li>
                                <a href="<?php echo base_url('process');?>" class="">
                                    <i class="bx bx-task"></i>
                                    <span>Process</span>
                                </a>
                            </li>
                            
                            <?php 
                                if($userdata["isRole"] > 0){
                            ?>
                                <li>
                                    <a href="<?php echo base_url('income');?>" class="">
                                        <i class="bx bx-dollar"></i>
                                        <span>Income</span>
                                    </a>
                                </li>
                            <?php
                                }
                            ?>

                            <li>
                                <a href="<?php echo base_url('inventory');?>" class="">
                                    <i class="bx bx-receipt"></i>
                                    <span>Inventory</span>
                                </a>
                            </li>

                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="bx bx-cog"></i>
                                    <span>Settings</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li>
                                        <a href="<?php echo base_url('items');?>">Item</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url('jobs');?>">Job</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url('setDate');?>">Date Setting</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <!-- Sidebar -->
                </div>
            </div>
            <!-- Left Sidebar End -->