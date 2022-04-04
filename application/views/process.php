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
                                    <h4 class="mb-0 font-size-18">Process</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <?php echo $msg;?>

                        <div class="row" id="new_pan" style="display: none;">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-4">New Process</h4>
                                        <p class="card-title-desc">Fill all information below</p>
                                        <?php echo form_open('', array('method' => 'post'));?>
                                            <div data-repeater-list="outer-group" class="outer">
                                                <div data-repeater-item class="outer">
                                                    <div class="form-group">
                                                        <label for="Status">Order No :</label>
                                                        <select class="form-control" name="order_no" id="order_no" onchange="sel_order_func();">
                                                            <option>Please select...</option>
                                                            <?php
                                                                if(count($orderNo_list) > 0){
                                                                    foreach($orderNo_list as $key => $val){
                                                            ?>
                                                                    <option value="<?php echo $val['id'];?>"><?php echo $val['order_no'];?></option>
                                                            <?php
                                                                    }
                                                                }
                                                            ?>
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="Name">Customer :</label>
                                                        <input type="text" class="form-control" name="customer" id="customer" placeholder="Enter Customer Name" required>
                                                    </div> 

                                                    <div class="form-group">
                                                        <label for="Status">Employee :</label>
                                                        <select class="form-control" name="employee" id="employee">
                                                            <option>Please select...</option> 
                                                            <?php 
                                                                if(count($employee_list) > 0){
                                                                    foreach($employee_list as $key => $val){
                                                            ?>
                                                                    <option value="<?php echo $val['id'];?>"><?php echo $val['name'];?></option>  
                                                            <?php
                                                                    }
                                                                }
                                                            ?>
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="Job">Job :</label>
                                                        <select class="form-control" name="job" id="job"  onchange="sel_job_func();">
                                                            <option>Please select...</option>
                                                        </select>
                                                    </div>
                                                    
                                                    <div class="form-group">
                                                        <div class="table-responsive">
                                                            <table class="table table-centered table-nowrap tcp_tbl" id="tcp_tbl"></table>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="Date">Date :</label>
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" name="dailydate" id="dailydate" placeholder="mm/dd/yyyy" data-provide="datepicker" data-date-autoclose="true" required>
                                                            <div class="input-group-append">
                                                                <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                                            </div>
                                                        </div><!-- input-group -->
                                                    </div>

                                                    <div class="row">
                                                        <div class="form-group col-md-6">
                                                            <label for="Name">Daily Target :</label>
                                                            <input type="text" class="form-control" name="target" id="target" placeholder="Enter Daily Target" required>
                                                        </div> 

                                                        <div class="form-group col-md-6">
                                                            <label for="Name">Completed Pieces :</label>
                                                            <input type="text" class="form-control" name="completed_piece" id="completed_piece" placeholder="Enter Completed Pieces">
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
                                            </div><!-- end col-->
                                        </div>

                                        <?php echo form_open('', array('method' => 'post'));?>
                                            <input type="hidden" id="edit_id" name="edit_id" value="">
                                            <input type="hidden" id="job_id" name="job_id" value="">
                                            <div class="table-responsive">
                                                <table class="table table-centered table-nowrap">
                                                    <thead class="thead-light">
                                                        <tr>
                                                            <th class="text-center" style="width: 5%;"># </th>
                                                            <th class="text-center" style="width: 10%;">Order No</th>
                                                            <th class="text-center" style="width: 10%;">Customer Name</th>                                                            
                                                            <th class="text-center" style="width: 10%;">Employee Name</th>
                                                            <th class="text-center" style="width: 10%;">Job</th>
                                                            <th class="text-center" style="width: 10%;">Date</th>
                                                            <th class="text-center" style="width: 10%;">Daily Target</th>
                                                            <th class="text-center" style="width: 10%;">Completed Pieces</th>
                                                            <th class="text-center" style="width: 10%;">Salary</th>
                                                            <th class="text-center" style="width: 10%;">Created Date</th>
                                                            <th class="text-center" style="width: 10%;">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php 
                                                            if(count($process_list) > 0){
                                                                foreach($process_list as $key => $val){
                                                        ?>
                                                            <tr>
                                                                <td class="text-center">
                                                                    <?php echo $key+1;?>
                                                                </td>
                                                                <td class="text-center">
                                                                    <?php echo $val['order_no'];?>
                                                                </td>
                                                                <td class="text-center">
                                                                    <?php echo $val['customer'];?>
                                                                </td>
                                                                <td class="text-center">
                                                                    <?php echo $val['name'];?>
                                                                </td>
                                                                <td class="text-center">
                                                                    <?php echo $val['job'];?>
                                                                </td>
                                                                <td class="text-center">
                                                                    <?php                                                                         
                                                                        echo $val['work_year']."-".$val['work_month']."-".$val['work_day'];
                                                                    ;?>
                                                                </td>
                                                                <td class="text-center">
                                                                    <?php echo $val['target'];?>
                                                                </td>
                                                                <td class="text-center">
                                                                    <?php echo $val['completed_piece'];?>
                                                                </td>
                                                                <td class="text-center">
                                                                    Rs.<?php echo $val['salary'];?>
                                                                </td>
                                                                <td class="text-center">
                                                                    <?php echo $val['created_at'];?>
                                                                </td>
                                                                <td class="text-center">
                                                                    <button type="button" class="btn btn-primary" title="Edit" onclick="edit_func('<?php echo $val["id"]?>');">
                                                                        <i class="mdi mdi-pencil font-size-15"></i>
                                                                    </button>
                                                                    <button type="submit" class="btn btn-danger" name="delBtn" value="ok" title="Delete" onclick="del_func('<?php echo $val["id"]?>', '<?php echo $val["job_id"]?>');">
                                                                        <i class="mdi mdi-close font-size-15"></i>
                                                                    </button>
                                                                </td>
                                                            </tr>
                                                        <?php
                                                                }
                                                            }else{
                                                        ?>
                                                            <tr>
                                                                <td colspan="10" class="text-center"> No Data </td>
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
                    function show_func(){
                        $("#order_no").val("Please select...");
                        $("#customer").val("");
                        $("#employee").val("Please select...");
                        $("#job").val("Please select...");
                        $("#dailydate").val('<?php echo $date_info["value"];?>');
                        $("#completed_piece").val("");
                        $("#target").val("");
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
                            url: "<?php echo base_url('Process/get_info');?>", 
                            data: { "edit_id": edit_id }
                        }).done(function( msg ) { 
                            var json_obj = jQuery.parseJSON(msg); 
                            
                            $("#order_no").val(json_obj.order_id);
                            $("#customer").val(json_obj.customer);
                            $("#employee").val(json_obj.employee_id);

                            var shtml = "";                            
                            shtml += '<option value="'+json_obj.job_id+'">'+json_obj.job_name+'</option>';                            

                            $("#job").html(shtml);

                            $("#completed_piece").val(json_obj.completed_piece);
                            $("#dailydate").val(json_obj.work_month + "/" + json_obj.work_day + "/" + json_obj.work_year);
                            $("#target").val(json_obj.target);
                            $("#new_pan").slideDown();
                        });
                    }  

                    function sel_order_func(){
                        $.ajax({
                            type: "POST",
                            url: "<?php echo base_url('Process/get_order_info');?>", 
                            data: { "order_id": $("#order_no").val() }
                        }).done(function( msg ) { 
                            var json_obj = jQuery.parseJSON(msg);

                            $("#customer").val(json_obj[0].order_unit);

                            var shtml = "<option>Please select...</option>";
                            for(var i=0; i<json_obj.length; i++){
                                shtml += '<option value="'+json_obj[i].job_id+'">'+json_obj[i].job_name+'</option>';
                            }

                            $("#job").html(shtml);
                            var thtml = "";
                            $("#tcp_tbl").html(thtml);
                            $("#new_pan").slideDown();
                        });
                    }

                    function sel_job_func(){
                        if($("#order_no").val()!="Please select..."&&$("#job").val()!="Please select..."){
                            var thtml = "";
                            $("#tcp_tbl").html(thtml);
                            var order_no = $("#order_no option:selected").text();
                            var job_name = $("#job option:selected").text();
                            $.ajax({
                                type: "POST",
                                url: "<?php echo base_url('Process/get_tcp_info');?>", 
                                data: { "order_no": order_no, "job_name": job_name }
                            }).done(function( msg ) { 
                                var json_obj = jQuery.parseJSON(msg);

                                var shtml = "";
                                shtml += '<thead class="thead-light"><tr><th class="text-center" style="width: 15%;">No</th><th class="text-center" style="width: 40%;">Employee</th><th class="text-center" style="width: 45%;">complate Quantity</th></tr></thead><tbody>';

                                for(i in json_obj) {
                                    shtml += `<tr>`;
                                    shtml += `<td class="text-center">${Number(i)+1}</td>`;
                                    shtml += `<td class="text-center">${json_obj[i].e_name}</td>`;
                                    shtml += `<td class="text-center">${json_obj[i].t_cp}</td>`;
                                    shtml += `</tr>`;
                                }
                             
                                shtml +='</tbody>';

                                console.log(shtml);

                                $("#tcp_tbl").html(shtml);
                                $("#new_pan").slideDown();
                            });
                        }
                    }

                    function del_func(edit_id, job_id){
                        if(confirm("Are you sure?")){
                            $("#edit_id").val(edit_id);
                            $("#job_id").val(job_id);
                        }			
                    }
                </script>