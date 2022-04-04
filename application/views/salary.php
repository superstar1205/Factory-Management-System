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
                                    <h4 class="mb-0 font-size-18">Monthly Salary</h4>
                                </div>
                            </div>
                        </div>

                        <!-- end page title -->
                        <?php echo form_open('salary/'.$id, array('method' => 'post'));?>
                            <div class="row">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <div class="form-group col-md-5">
                                        <select class="form-control" name="srch_year">
                                            <option></option>
                                            <?php
                                                for($i = 2018; $i <= 2030; $i++){
                                            ?>
                                                <option value="<?php echo $i;?>" <?php if($i == $srch_year){ ?> selected="selected" <?php } ?>><?php echo $i;?></option>
                                            <?php
                                                }
                                            ?>
                                        </select>
                                      
                                    </div>
                                    <div class="form-group col-md-5">
                                        <select class="form-control" name="srch_month" id="srch_month">
                                            <option></option>
                                            <?php
                                                $month_arr = array(
                                                    'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'
                                                );
                                                for($i = 1; $i <= 12; $i++){
                                            ?>
                                                <option value="<?php echo $i;?>" <?php if($i == $srch_month){ ?> selected="selected" <?php } ?>><?php echo $month_arr[$i-1];?></option>
                                            <?php
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <button class="btn btn-primary" name="srch_btn" value="ok">Search</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <?php echo $msg;?>
                        
                        <div class="row">
                            <div class="col-12 total" id="total">
                                <div class="card ">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="card " id="">
                                                    <div class="card-body">
                                                        <br><br><br><br>
                                                        <h3 class="text-center">Monthly Salary Information</h3>
                                                        <h4 class="text-center"><?php echo $employee_name;?></h4>
                                                        <div class="invoice-title mb-2" style="margin-top: 140px;">
                                                            <div class="row">
                                                                <div class="form-group col-md-4 text-center">
                                                                    <label for="Total Amount">Total Payment : Rs.<?php echo $total_amount;?></label>
                                                                </div>
                                                                <div class="form-group col-md-4 text-center">
                                                                    <label for="Total Amount">Paid Payment : Rs.<?php echo $paid_amount;?></label>
                                                                </div>
                                                                <div class="form-group col-md-4 text-center">
                                                                    <label for="Total Amount">Unpaid Payment : Rs.<?php echo $unpaid_amount;?></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php echo form_open('salary/'.$id, array('id' => 'sal_form', 'method' => 'post'));?>
                                                            <input type="hidden" id="edit_id" name="edit_id" value="">
                                                            <div class="table-responsive">
                                                                <table class="table table-nowrap">
                                                                    <thead>
                                                                        <tr>
                                                                            <th style="width: 5%;" class="text-center">No.</th>
                                                                            <th class="text-center">Customer Name</th>
                                                                            <th class="text-center">Job Name</th>
                                                                            <th class="text-center">Completed Pieces</th>
                                                                            <th class="text-center">Order Payment</th>
                                                                            <th style="width: 10%;" class="text-center">Status</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?php 
                                                                            if(count($salary_list) > 0){
                                                                                foreach($salary_list as $key => $val){
                                                                        ?>
                                                                            <tr>
                                                                                <td class="text-center">
                                                                                    <?php echo $key+1;?>
                                                                                </td>
                                                                                <td class="text-center">
                                                                                    <?php echo $val['customer_name'];?>
                                                                                </td>
                                                                                <td class="text-center">
                                                                                    <?php echo $val['job_name'];?>
                                                                                </td>
                                                                                <td class="text-center">
                                                                                    <?php echo $val['completed_piece'];?>
                                                                                </td>
                                                                                <td class="text-center">
                                                                                    Rs.<?php echo $val['order_payment'];?>
                                                                                </td>
                                                                                <td class="text-center">
                                                                                    <select class="form-control" name="state<?php echo $val['id'];?>" onchange="sel_state('<?php echo $val['id'];?>')">                                                                                       
                                                                                        <option value="1" <?php if($val['status'] == 1){ ?> selected="selected" <?php } ?>>Paid</option> 
                                                                                        <option value="0" <?php if($val['status'] == 0){ ?> selected="selected" <?php } ?>>Unpaid</option> 
                                                                                    </select>
                                                                                </td>
                                                                            </tr>
                                                                        <?php
                                                                                }
                                                                            }else{
                                                                        ?>
                                                                        <tr>
                                                                            <td colspan="6" class="border-0 text-center">No Data</td>                                                                            
                                                                        </tr>
                                                                        <?php
                                                                            }
                                                                        ?>
                                                                        <tr>
                                                                            <td colspan="5" class="border-0 text-right">Paid Amount</td>
                                                                            <td class="border-0 text-right">Rs.<?php echo $paid_amount;?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td colspan="5" class="border-0 text-right">Unpaid Amount</td>
                                                                            <td class="border-0 text-right">Rs.<?php echo $unpaid_amount;?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td colspan="5" class="border-0 text-right">
                                                                                <strong>Total Amount</strong>
                                                                            </td>
                                                                            <td class="border-0 text-right">
                                                                                <h4 class="m-0">Rs.<?php echo $total_amount;?></h4>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </form>
                                                        </div>
                                                        <div class="d-print-none">
                                                            <div class="float-right">
                                                            <button class="btn btn-warning" name="srch_btn" value="ok" onclick="display()">View Total</button>
                                                                <a href="javascript:window.print()" class="btn btn-success waves-effect waves-light mr-1" style="width: 100px;" title="Print"><i class="fa fa-print"></i></a>
                                                                <a href="<?php echo base_url('employee');?>" class="btn btn-primary w-md waves-effect waves-light">Back</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end row -->
                                    </div>
                                </div>
                                <div class="col-12 rest" id="rest" style="display: none;">
                                    <div class="card" >
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="card " id="">
                                                        <div class="card-body">
                                                        <br><br><br><br>
                                                                <h2 class="text-center">Senuli Fashion</h2>
                                                                <h3 class="text-center">Monthly Salary Information</h3>
                                                                <h4 class="text-center"><?php echo $employee_name;?></h4>
                                                                <div class="invoice-title mb-2" style="margin-top: 140px;">
                                                                    <div class="row">
                                                                        <div class="form-group col-md-6 text-center">
                                                                            <label for="Total Amount">Month : <?php echo $srch_month;?></label>
                                                                        </div>
                                                                        <div class="form-group col-md-6 text-center">
                                                                            <label for="Total Amount">Date : <?php echo date('Y-m-d');?></label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="table-responsive">
                                                                    <table class="table table-nowrap">
                                                                        <thead>
                                                                            <tr>
                                                                                <th style="width: 15%;" class="text-center">No.</th>
                                                                                <th style="width: 35%;" class="text-center">Customer Name</th>
                                                                                <th style="width: 25%;" class="text-center">Completed Pieces</th>
                                                                                <th style="width: 25%;" class="text-center">Order Payment</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <?php 
                                                                                if(count($cpop_list) > 0){
                                                                                    foreach($cpop_list as $key => $val){
                                                                            ?>
                                                                                <tr>
                                                                                    <td class="text-center">
                                                                                        <?php echo $key+1;?>
                                                                                    </td>
                                                                                    <td class="text-center">
                                                                                        <?php echo $val['customer_name'];?>
                                                                                    </td>
                                                                                    <td class="text-center">
                                                                                        <?php echo $val['cp'];?>
                                                                                    </td>
                                                                                    <td class="text-center">
                                                                                        Rs.<?php echo $val['op'];?>
                                                                                    </td>
                                                                                </tr>
                                                                            <?php
                                                                                    }
                                                                                }else{
                                                                            ?>
                                                                            <tr>
                                                                                <td colspan="6" class="border-0 text-center">No Data</td>                                                                            
                                                                            </tr>
                                                                            <?php
                                                                                }
                                                                            ?>
                                                                            <tr>
                                                                                <td colspan="5" class="border-0 text-right">Paid Amount</td>
                                                                                <td class="border-0 text-right">Rs.<?php echo $paid_amount;?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td colspan="5" class="border-0 text-right">Unpaid Amount</td>
                                                                                <td class="border-0 text-right">Rs.<?php echo $unpaid_amount;?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td colspan="5" class="border-0 text-right">
                                                                                    <strong>Total Amount</strong>
                                                                                </td>
                                                                                <td class="border-0 text-right">
                                                                                    <h4 class="m-0">Rs.<?php echo $total_amount;?></h4>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            
                                                            </div>
                                                            <div class="d-print-none">
                                                                <div class="float-right">
                                                                    <a href="javascript:window.print()" class="btn btn-success waves-effect waves-light mr-1" style="width: 100px;" title="Print"><i class="fa fa-print"></i></a>
                                                                    <a href="<?php echo base_url('employee');?>" class="btn btn-primary w-md waves-effect waves-light">Back</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>                                      
                            </div>
                        </div>
                    </div>
                </div>

                <script>
                    
                    function sel_state(id){
                        if(confirm("Are you sure?")){
                            $("#edit_id").val(id);
                            $("#sal_form").submit();
                        }
                    }
                    function display(){
                        $("#rest").css('display', 'block');
                        $("#total").css('display','none');
                    }
                </script>