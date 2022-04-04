            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0 font-size-18">Orders</h4>
                                </div>
                            </div>
                        </div>

                        <?php echo $msg;?>

                        <div class="row" id="new_pan" style="display: none;">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-4">New Order</h4>
                                        <p class="card-title-desc">Fill all information below</p>
                                        <?php echo form_open('', array('method' => 'post'));?>
                                            <div data-repeater-list="outer-group" class="outer">
                                                <div data-repeater-item class="outer">
                                                    <div class="row">
                                                        <div class="form-group col-md-6">
                                                            <label for="Birthday">Due Date :</label>
                                                            <div class="input-group">
                                                                <input type="text" class="form-control" name="due_date" id="due_date" placeholder="mm/dd/yyyy" data-provide="datepicker" data-date-autoclose="true" required>
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                                                </div>
                                                            </div><!-- input-group -->
                                                        </div>
            
                                                        <div class="form-group col-md-6">
                                                            <label for="Email">Quantity :</label>
                                                            <input type="text" class="form-control" name="order_amount" id="order_amount" placeholder="Enter Order Quantity">
                                                        </div>

                                                        <div class="form-group col-md-6">
                                                            <label for="Address">Customer :</label>
                                                            <input type="text" class="form-control" name="order_unit" id="order_unit" placeholder="Enter Customer Name">
                                                        </div>

                                                        <div class="form-group col-md-6">
                                                            <label for="Phone">Item :</label>
                                                            <select class="form-control" name="order_item" id="order_item">
                                                                <option>Please select...</option>
                                                                <?php
                                                                    if(count($item_list) > 0){
                                                                        foreach($item_list as $key => $val){
                                                                ?>
                                                                    <option value="<?php echo $val['id'];?>"><?php echo $val['itemName'];?></option>
                                                                <?php
                                                                        }
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>

                                                        <div class="form-group col-md-6">
                                                            <label for="Email">Unit Price :</label>
                                                            <input type="text" class="form-control" name="unit_price" id="unit_price" placeholder="Enter Unit Price">
                                                        </div>
                                                    </div> 

                                                    <div class="col-sm-12 text-center">
                                                        <button type="submit" name="saveBtn" value="ok" class="btn btn-primary mr-1 waves-effect waves-light">Save Changes</button>
                                                        <button type="button" class="btn btn-secondary waves-effect" onclick="hide_func();">Cancel</button>
                                                    </div>
                                                    <input type="hidden" name="add_id" id="add_id" value="">
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
                                                    <?php echo form_open('', array('method' => 'post'));?>
                                                        <div class="position-relative">
                                                            <input type="text" name="srch_txt" class="form-control" value="<?php echo $srch_txt;?>" placeholder="Search by Customer Name">
                                                            <i class="bx bx-search-alt search-icon"></i>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="text-sm-right">
                                                    <button type="button" class="btn btn-success btn-rounded waves-effect waves-light mb-2 mr-2" onclick="show_func();"><i class="mdi mdi-plus mr-1"></i> Add New </button>
                                                </div>
                                            </div>
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
                                                                        <button type="button" class="btn btn-primary" title="Edit" onclick="edit_func('<?php echo $val["id"]?>');">
                                                                            <i class="mdi mdi-pencil font-size-15"></i>
                                                                        </button>
                                                                        <button type="button" class="btn btn-primary" title="Accessories" onclick="go_accessories_func('<?php echo $val["id"];?>');">
                                                                            <i class="mdi mdi-toolbox-outline font-size-15"></i>
                                                                        </button>
                                                                        <button type="button" class="btn btn-warning" title="Detail" onclick="detail_func('<?php echo $val["id"]?>', '<?php echo $val["item_id"]?>');">
                                                                            <i class="mdi mdi-eye font-size-15"></i>
                                                                        </button>
                                                                        <button type="submit" class="btn btn-success" name="completeBtn" value="ok" title="Complete" onclick="complete_func('<?php echo $val["id"]?>');">
                                                                            <i class="mdi mdi-check font-size-15"></i>
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
                    </div>
                </div>
                <!-- End Page-content -->
                <script>
                    function show_func(){
                        $("#due_date").val("");
                        $("#order_amount").val("");
                        $("#order_unit").val("");
                        $("#order_item").val("Please select...");
                        $("#unit_price").val("");
                        $("#add_id").val("");
                        $("#new_pan").slideDown();
                    }

                    function hide_func(){
                        $("#new_pan").slideUp();
                    }

                    function edit_func(edit_id){
                        $("#add_id").val(edit_id);
                        $.ajax({
                            type: "POST",
                            url: "<?php echo base_url('orders/get_info');?>", 
                            data: { "edit_id": edit_id } 
                        }).done(function( msg ) { 
                            var json_obj = jQuery.parseJSON(msg); 
                            
                            $("#due_date").val(json_obj.due_date);
                            $("#order_amount").val(json_obj.order_amount);
                            $("#order_unit").val(json_obj.order_unit);
                            $("#order_item").val(json_obj.order_item);
                            $("#unit_price").val(json_obj.unit_price);
                            $("#new_pan").slideDown();
                        });
                    }

                    function detail_func(order_id, item_id){
                        document.location.href = "<?php echo base_url('orders/detail?order_id=')?>"+order_id+'<?php echo "&item_id=";?>'+item_id;
                    }

                    function go_accessories_func(order_id){
                        document.location.href = "<?php echo base_url('orders/accessories?order_id=')?>"+order_id;
                    }

                    function complete_func(edit_id){
                        if(confirm("Are you sure?")){
                            $("#edit_id").val(edit_id);
                        }			
                    }

                    function del_func(edit_id){
                        if(confirm("Are you sure?")){
                            $("#edit_id").val(edit_id);
                        }			
                    }
                </script>