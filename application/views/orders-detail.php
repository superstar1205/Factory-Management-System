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
                                    <h4 class="mb-0 font-size-18">Orders Detail</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <?php echo $msg;?>

                        <div class="row" id="new_pan" style="display: none;">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-4">Detail( Order No: <?php echo $order_no;?> )</h4>
                                        <p class="card-title-desc">Fill all information below</p>
                                        <?php echo form_open('orders/detail?order_id='.$order_id.'&item_id='.$item_id, array('method' => 'post'));?>
                                            <div data-repeater-list="outer-group" class="outer">
                                                <div data-repeater-item class="outer">
                                                    <div class="row">
                                                        <div class="form-group col-md-6">
                                                            <label for="Phone">Job :</label>
                                                            <select class="form-control" name="job" id="job">
                                                                <option>Please select...</option>
                                                                <?php
                                                                    if(count($job_list) > 0){
                                                                        if(count($orders_list) > 0) {
                                                                            foreach($job_list as $key => $val) {
                                                                                $flag = 0;
                                                                                foreach($orders_list as $key1 => $val1) {
                                                                                    if($val['job'] == $val1['job']) {
                                                                                        $flag = 1;
                                                                                        break;
                                                                                    }
                                                                                }
                                                                                if($flag == 1) {
                                                                                    continue;
                                                                                } else { ?>
                                                                                    <option value="<?php echo $val['id'];?>"><?php echo $val['job'];?></option>
                                                                                <?php
                                                                                }
                                                                            }
                                                                        } else {
                                                                            foreach($job_list as $key => $val){ ?>
                                                                                <option value="<?php echo $val['id'];?>"><?php echo $val['job'];?></option>
                                                                    <?php   
                                                                            }
                                                                        }
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>   

                                                        <div class="form-group col-md-6">
                                                            <label for="Email">Cost :</label>
                                                            <input type="text" class="form-control" name="cost" id="cost" placeholder="Enter Cost">
                                                        </div>                                                     
            
                                                        <div class="form-group col-md-6">
                                                            <label for="Email">Required Quantity :</label>
                                                            <input type="text" class="form-control" name="required_quantity" id="required_quantity" placeholder="Enter Required Quantity">
                                                        </div>

                                                        <div class="form-group col-md-6">
                                                            <label for="Email">Completed Quantity :</label>
                                                            <input type="text" class="form-control" name="completed_quantity" id="completed_quantity" placeholder="Enter Completed Quantity">
                                                        </div> 
                                                    </div> 

                                                    <div class="col-sm-12 text-center">
                                                        <button name="saveBtn" value="ok" class="btn btn-primary mr-1 waves-effect waves-light" onclick="return add_func();">Save Changes</button>
                                                        <button type="button" class="btn btn-secondary waves-effect" onclick="hide_func();">Cancel</button>
                                                    </div>
                                                    <input type="hidden" name="add_id" id="add_id" value="">
                                                    <input type="hidden" name="order_no" id="order_no" value="">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row mb-2">
                                            <div class="col-sm-4">
                                                <div class="search-box mr-2 mb-2 d-inline-block">
                                                    <p>Order No: <?php echo $order_no;?></p>
                                                </div>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="text-sm-right">
                                                    <button type="button" class="btn btn-success btn-rounded waves-effect waves-light mb-2 mr-2" onclick="show_func();"><i class="mdi mdi-plus mr-1"></i> Add New </button>
                                                </div>
                                            </div><!-- end col-->
                                        </div>
                
                                        <?php echo form_open('orders/detail?order_id='.$order_id.'&item_id='.$item_id, array('method' => 'post'));?>
                                            <input type="hidden" id="edit_id" name="edit_id" value="">
                                            <div class="table-responsive">
                                                <table class="table table-centered table-nowrap">
                                                    <thead class="thead-light">
                                                        <tr>
                                                            <th class="text-center" style="width: 5%;"> #</th>
                                                            <th class="text-center">Job</th>
                                                            <th class="text-center">Cost</th>
                                                            <th class="text-center">Required Quantity</th>
                                                            <th class="text-center">Completed Quantity</th>
                                                            <th class="text-center">Remaining Quantity</th>
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
                                                                    <td class="text-center"><?php echo $val['job'];?> </td>
                                                                    <td class="text-center"><?php echo $val['cost'];?> </td>
                                                                    <td class="text-center">
                                                                        <?php echo $val['required_quantity'];?>
                                                                    </td>
                                                                    <td class="text-center">
                                                                        <?php echo $val['completed_quantity'];?>
                                                                    </td>
                                                                    <td class="text-center">
                                                                        <?php 
                                                                            $remaining_quantity = (int)$val['required_quantity'] - (int)$val['completed_quantity'];
                                                                            echo $remaining_quantity;
                                                                        ?>
                                                                    </td>
                                                                    <td class="text-center">
                                                                        <?php echo $val['created_at'];?>
                                                                    </td>                                                                    
                                                                    <td class="text-center">
                                                                        <button type="button" class="btn btn-primary" title="Edit" onclick="edit_func('<?php echo $val["id"]?>');">
                                                                            <i class="mdi mdi-pencil font-size-15"></i>
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
                                                                <td colspan="8" class="text-center">No Data </td>
                                                            </tr>
                                                        <?php
                                                            }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </form>                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->
                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->

                <script>
                    function show_func(){                        
                        $("#job").val("Please select...");
                        $("#cost").val("");
                        $("#required_quantity").val("");
                        $("#completed_quantity").val("");
                        $("#add_id").val("");
                        $("#order_no").val('<?php echo $order_no;?>');
                        $("#new_pan").slideDown();
                    }

                    function hide_func(){
                        $("#new_pan").slideUp();
                    }

                    function add_func(){
                        var required_quantity = document.getElementById('required_quantity');
                        if(required_quantity.value ==""){
                            alert("Enter Required Quantity");
                            required_quantity.focus();
                            return false;
                        }

                        var completed_quantity = document.getElementById('completed_quantity');
                        if(completed_quantity.value ==""){
                            alert("Enter Completed Quantity");
                            completed_quantity.focus();
                            return false;
                        }

                        if(required_quantity.value < completed_quantity.value){
                            alert("Completed Quantity is incorrect");
                            completed_quantity.focus();
                            return false;
                        }

                        return true;
                    }

                    function edit_func(edit_id){
                        $("#add_id").val(edit_id);
                        $.ajax({
                            type: "POST",
                            url: "<?php echo base_url('orders/get_detail_info');?>", 
                            data: { "edit_id": edit_id } 
                        }).done(function( msg ) { 
                            var json_obj = jQuery.parseJSON(msg); 
                            
                            $("#job").val(json_obj.job_id);
                            $("#cost").val(json_obj.cost);
                            $("#required_quantity").val(json_obj.required_quantity);
                            $("#completed_quantity").val(json_obj.completed_quantity);
                            $("#new_pan").slideDown();
                        });
                    }

                    function del_func(edit_id){
                        if(confirm("Are you sure?")){
                            $("#edit_id").val(edit_id);
                        }			
                    }
                </script>