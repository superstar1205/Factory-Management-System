            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0 font-size-18">Inventory Detail</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="invoice-title mb-4" style="margin-top: 180px;">
                                            <h3 class="text-center">Gate Pass Authorization for Taking out Material</h3>
                                        </div>
                                        <hr>
                                        <div class="table-responsive">
                                            <table class="table table-nowrap">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">Order No</th>
                                                        <th class="text-center">Customer Name</th>
                                                        <th class="text-center">Item</th>
                                                        <th class="text-center">Quantity</th>
                                                        <th class="text-center">Date</th>
                                                        <th class="text-center">Time</th>
                                                        <th class="text-center">Gate Pass No</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td class="text-center"><?php echo $detail_data['order_no'];?></td>
                                                        <td class="text-center"><?php echo $detail_data['order_unit'];?></td>
                                                        <td class="text-center"><?php echo $detail_data['itemName'];?></td>
                                                        <td class="text-center"><?php echo $detail_data['order_amount'];?></td>
                                                        <td class="text-center"><?php echo date("Y-m-d");?></td>
                                                        <td class="text-center"><?php echo date("H:i:s");?></td>
                                                        <td class="text-center">GP<?php echo $detail_data['order_no'];?></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="d-print-none">
                                            <div class="float-right">
                                                <a href="javascript:window.print()" class="btn btn-success waves-effect waves-light mr-1" style="width: 100px;">
                                                    <i class="fa fa-print"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->

                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->