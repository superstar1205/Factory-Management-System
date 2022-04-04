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
                                    <h4 class="mb-0 font-size-18">Monthly Income</h4>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="text-right">
                                    <h4 class="mb-0" style="font-size: 14px!important;">Today is <?php echo date("Y-m-d");?></h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                        
                        <div class="row my-2">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <canvas id="chLine" height="100"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php echo $msg;?>

                        <div class="row" id="new_pan" style="display: none;">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-4">New Income</h4>
                                        <p class="card-title-desc">Fill all information below</p>
                                        <?php echo form_open('', array('method' => 'post'));?>
                                            <div data-repeater-list="outer-group" class="outer">
                                                <div data-repeater-item class="outer">
                                                    <div class="row">
                                                        <div class="form-group col-md-6">
                                                            <label for="Year">Year :</label>
                                                            <select class="form-control" name="income_year" id="income_year">
                                                                <option></option>
                                                                <?php
                                                                    for($i= 2020 ; $i <= 2030; $i++){
                                                                ?>
                                                                    <option value="<?php echo $i;?>"><?php echo $i;?></option>
                                                                <?php
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="Month">Month :</label>
                                                            <select class="form-control" name="income_month" id="income_month">
                                                                <option></option>
                                                                <?php
                                                                    for($i= 1 ; $i <= 12; $i++){
                                                                ?>
                                                                    <option value="<?php echo $i;?>"><?php echo $i;?></option>
                                                                <?php
                                                                    }
                                                                ?>
                                                            </select>
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
                                                    <?php echo form_open('', array('id' => 'srch_form', 'method' => 'post'));?>
                                                        <div class="position-relative">
                                                            <select class="form-control" name="srch_year" id="srch_year" onchange="srch_func();">
                                                                <option></option>
                                                                <?php
                                                                    for($i= 2020 ; $i <= 2030; $i++){
                                                                ?>
                                                                    <option value="<?php echo $i;?>" <?php if($i == $srch_year){ ?> selected="selected" <?php } ?>><?php echo $i;?></option>
                                                                <?php
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="text-sm-right">
                                                    <button type="button" class="btn btn-success btn-rounded waves-effect waves-light mb-2 mr-2" onclick="show_func();"><i class="mdi mdi-plus mr-1"></i> Add New </button>
                                                </div>
                                            </div><!-- end col-->
                                        </div>

                                        <?php echo form_open('', array('method' => 'post'));?>
                                            <input type="hidden" id="edit_id" name="edit_id" value="">
                                            <div class="table-responsive">
                                                <table class="table table-centered table-nowrap">
                                                    <thead class="thead-light">
                                                        <tr>
                                                            <th class="text-center" style="width: 5%;"># </th>
                                                            <th class="text-center" style="width: 10%;">Year</th>
                                                            <th class="text-center" style="width: 10%;">Month</th>                                                            
                                                            <th class="text-center" style="width: 15%;">Total Order Income</th>
                                                            <th class="text-center" style="width: 15%;">Total Employee Salary</th>
                                                            <th class="text-center" style="width: 15%;">Total Accessory Cost</th>
                                                            <th class="text-center" style="width: 10%;">Income</th>
                                                            <th class="text-center" style="width: 10%;">Created Date</th>
                                                            <th class="text-center" style="width: 10%;">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php 
                                                            if(count($income_list) > 0){
                                                                foreach($income_list as $key => $val){
                                                        ?>
                                                            <tr>
                                                                <td class="text-center">
                                                                    <?php echo $key+1;?>
                                                                </td>
                                                                <td class="text-center">
                                                                    <?php echo $val['income_year'];?>
                                                                </td>
                                                                <td class="text-center">
                                                                    <?php echo $val['income_month'];?>
                                                                </td>
                                                                <td class="text-center">
                                                                    Rs.<?php echo $val['order_income'];?>
                                                                </td>
                                                                <td class="text-center">
                                                                    Rs.<?php echo $val['employee_salary'];?>
                                                                </td>
                                                                <td class="text-center">
                                                                    Rs.<?php echo $val['accessory_cost'];?>
                                                                </td>
                                                                <td class="text-center">
                                                                    Rs.<?php echo $val['income_value'];?>
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
                                                                <td colspan="9" class="text-center"> No Data </td>
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

                <script src="<?php echo base_url('assets/js/chart.min.js');?>"></script>

                <script>
                    // chart colors
                    var colors = ['#007bff'];

                    /* large line chart */
                    var chLine = document.getElementById("chLine");
                    var chartData = {
                        labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
                        datasets: [{
                            data: [
                                <?php 
                                    $flag = false;
                                    for($i = 0; $i <= 12; $i++){ 
                                        $temp = -1;
                                        for($j = 0; $j < count($graphic_list); $j ++){
                                            if($graphic_list[$j]["income_month"] == $i+1){
                                                $temp = 0;
                                                if($flag) echo ",".$graphic_list[$j]["income_value"];
                                                else echo $graphic_list[$j]["income_value"];
                                                $flag = true;
                                            }
                                        }
                                        if($temp == -1) 
                                            if($flag) echo ",0";
                                            else echo "0";
                                            $flag = true;
                                    }
                                ?>
                            ],
                            backgroundColor: 'transparent',
                            borderColor: colors[0],
                            borderWidth: 4,
                            pointBackgroundColor: colors[0]
                        }]
                    };

                    if (chLine) {
                        new Chart(chLine, {
                            type: 'line',
                            data: chartData,
                            options: {
                                scales: {
                                    yAxes: [{
                                        ticks: {
                                            beginAtZero: false
                                        }
                                    }]
                                },
                                legend: {
                                    display: false
                                }
                            }
                        });
                    }

                    function show_func(){
                        $("#income_year").val("");
                        $("#income_month").val("");
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
                            url: "<?php echo base_url('income/get_info');?>", 
                            data: { "edit_id": edit_id } 
                        }).done(function( msg ) { 
                            var json_obj = jQuery.parseJSON(msg); 
                            
                            $("#income_year").val(json_obj.income_year);
                            $("#income_month").val(json_obj.income_month);
                            $("#new_pan").slideDown();
                        });
                    }

                    function del_func(edit_id){
                        if(confirm("Are you sure?")){
                            $("#edit_id").val(edit_id);
                        }			
                    }

                    function srch_func(){
                        $("#srch_form").submit();
                    }
                </script>