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
                                    <h4 class="mb-0 font-size-18">Inventory</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <?php echo $msg;?>

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="col-sm-4">
                                            <div class="search-box mr-2 mb-2 d-inline-block">
                                                <?php echo form_open('', array('method' => 'post'));?>
                                                    <div class="position-relative">
                                                        <input type="text" name="srch_txt" class="form-control" value="<?php echo $srch_txt;?>" placeholder="Search by Order No">
                                                        <i class="bx bx-search-alt search-icon"></i>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <?php echo form_open('', array('method' => 'post'));?>
                                            <input type="hidden" id="edit_id" name="edit_id" value="">
                                            <div class="table-responsive">
                                                <table class="table table-centered table-nowrap">
                                                    <thead class="thead-light">
                                                        <tr>
                                                            <th class="text-center" style="width: 5%;"> #</th>
                                                            <th class="text-center">Order No</th>
                                                            <th class="text-center">Item</th>
                                                            <th class="text-center">Quantity</th>
                                                            <th class="text-center">Customer</th>
                                                            <th class="text-center">Due Date</th>
                                                            <th class="text-center">Unit Price</th>
                                                            <th class="text-center">Order Income</th>
                                                            <th class="text-center">Created Date</th>
                                                            <th class="text-center">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php 
                                                            if(count($orders_list) > 0){
                                                                foreach($orders_list as $key => $val){
                                                        ?>
                                                                <tr>
                                                                    <td class="text-center">
                                                                        <?php echo $key+1;?>
                                                                    </td>
                                                                    <td class="text-center"><?php echo $val['order_no'];?> </td>
                                                                    <td class="text-center"><?php echo $val['itemName'];?></td>
                                                                    <td class="text-center">
                                                                        <?php echo $val['order_amount'];?>
                                                                    </td>
                                                                    <td class="text-center">
                                                                        <?php echo $val['order_unit'];?>
                                                                    </td>
                                                                    <td class="text-center">
                                                                        <?php 
                                                                            echo $val['due_year']."-".$val['due_month']."-".$val['due_day'];
                                                                        ?>
                                                                    </td>
                                                                    <td class="text-center">
                                                                        Rs.<?php echo $val['unit_price'];?>
                                                                    </td>
                                                                    <td class="text-center">
                                                                        Rs.<?php echo $val['order_income'];?>
                                                                    </td>
                                                                    <td class="text-center">
                                                                        <?php echo $val['created_at'];?>
                                                                    </td>
                                                                    <td class="text-center">
                                                                        <button type="button" class="btn btn-primary" name="delBtn" value="ok" title="Detail" onclick="detail_func('<?php echo $val["id"]?>');">
                                                                            <i class="mdi mdi-eye font-size-15"></i>
                                                                        </button>
                                                                        <button type="submit" class="btn btn-danger" name="delBtn" value="ok" title="Delete" onclick="del_func('<?php echo $val["id"]?>');">
                                                                            <i class="mdi mdi-close font-size-15"></i>
                                                                        </button>
                                                                    </td>
                                                                </tr>
                                                        <?php
                                                                }
                                                            }else{
                                                        ?>
                                                            <tr>
                                                                <td colspan="10" class="text-center">No Data </td>
                                                            </tr>
                                                        <?php
                                                            }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </form>
                                        <?php echo($pagination); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->
                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->

                <script>
                    function detail_func(edit_id){
                        document.location.href = "<?php echo base_url('inventory/detail?id=')?>"+edit_id;
                    }

                    function del_func(edit_id){
                        if(confirm("Are you sure?")){
                            $("#edit_id").val(edit_id);
                        }			
                    }
                </script>