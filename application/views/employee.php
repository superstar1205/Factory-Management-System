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
                                    <h4 class="mb-0 font-size-18">Employees</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <?php echo $msg;?>

                        <div class="row" id="new_pan" style="display: none;">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-4">New Employee</h4>
                                        <p class="card-title-desc">Fill all information below</p>
                                        <?php echo form_open('', array('method' => 'post'));?>
                                            <div data-repeater-list="outer-group" class="outer">
                                                <div data-repeater-item class="outer">
                                                    <div class="row">
                                                        <div class="form-group col-md-12">
                                                            <label for="Name">Name :</label>
                                                            <input type="text" class="form-control" name="name" id="name" placeholder="Enter Name" required>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-md-4">
                                                            <label for="Birthday">Year:</label>
                                                            <div class="input-group">
                                                                <select class="form-control" name="birth_year" id="birth_year">
                                                                    <option>Please select...</option>
                                                                    <?php 
                                                                        for($i = 1970; $i <= 2020; $i++){
                                                                    ?>
                                                                        <option value="<?php echo $i;?>"><?php echo $i;?></option>
                                                                    <?php
                                                                        }
                                                                    ?>
                                                                </select>
                                                            </div><!-- input-group -->
                                                        </div>
                                                        <div class="form-group col-md-4">
                                                            <label for="Birthday">Month:</label>
                                                            <div class="input-group">
                                                                <select class="form-control" name="birth_month" id="birth_month">
                                                                    <option>Please select...</option>
                                                                    <?php 
                                                                        for($i = 1; $i <= 12; $i++){
                                                                    ?>
                                                                        <option value="<?php if($i < 10){echo "0".$i;}else{echo $i;}?>"><?php if($i < 10){echo "0".$i;}else{echo $i;}?></option>
                                                                    <?php
                                                                        }
                                                                    ?>                                                                    
                                                                </select>
                                                            </div><!-- input-group -->
                                                        </div>
                                                        <div class="form-group col-md-4">
                                                            <label for="Birthday">Day:</label>
                                                            <div class="input-group">
                                                                <select class="form-control" name="birth_day" id="birth_day">
                                                                    <option>Please select...</option>
                                                                    <?php 
                                                                        for($i = 1; $i <= 31; $i++){
                                                                    ?>
                                                                        <option value="<?php if($i < 10){echo "0".$i;}else{echo $i;}?>"><?php if($i < 10){echo "0".$i;}else{echo $i;}?></option>
                                                                    <?php
                                                                        }
                                                                    ?>   
                                                                </select>
                                                            </div><!-- input-group -->
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-md-6">
                                                            <label for="Phone">Phone no :</label>
                                                            <input type="text" class="form-control" name="phone" id="phone" placeholder="Enter Pnone Number">
                                                        </div>
            
                                                        <div class="form-group col-md-6">
                                                            <label for="Email">Email :</label>
                                                            <input type="email" class="form-control" name="email" id="email" placeholder="Enter Email">
                                                        </div>

                                                        <div class="form-group col-md-6">
                                                            <label for="Address">Address :</label>
                                                            <input type="text" class="form-control" name="address" id="address" placeholder="Enter Address">
                                                        </div>

                                                        <div class="form-group col-md-6">
                                                            <label for="Status">Status :</label>
                                                            <select class="form-control" name="status" id="state">                                                                
                                                                <option value="0">Active</option>
                                                                <option value="1">Deactive</option>
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
                                                    <?php echo form_open('', array('method' => 'post'));?>
                                                        <div class="position-relative">
                                                            <input type="text" name="srch_txt" class="form-control" value="<?php echo $srch_txt;?>" placeholder="Search by Name">
                                                            <i class="bx bx-search-alt search-icon"></i>
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
                                                            <th class="text-center" style="width: 10%;">Name</th>
                                                            <th class="text-center" style="width: 10%;">Birthday</th>
                                                            <th class="text-center" style="width: 10%;">Address</th>
                                                            <th class="text-center" style="width: 10%;">Email</th>
                                                            <th class="text-center" style="width: 10%;">Phone No</th>
                                                            <th class="text-center" style="width: 10%;">Status</th>
                                                            <th class="text-center" style="width: 10%;">Created Date</th>
                                                            <th class="text-center" style="width: 10%;">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php 
                                                            if(count($employee_list) > 0){
                                                                foreach($employee_list as $key => $val){
                                                        ?>
                                                            <tr>
                                                                <td class="text-center">
                                                                    <?php echo $key+1;?>
                                                                </td>
                                                                <td class="text-center">
                                                                    <?php echo $val['name'];?>
                                                                </td>
                                                                <td class="text-center">
                                                                    <?php echo $val['birth_year']."-".$val['birth_month']."-".$val['birth_day'];?>
                                                                </td>
                                                                <td class="text-center">
                                                                    <?php echo $val['address'];?>
                                                                </td>
                                                                <td class="text-center">
                                                                    <?php echo $val['email'];?>
                                                                </td>
                                                                <td class="text-center">
                                                                    <?php echo $val['phone'];?>
                                                                </td>
                                                                <td class="text-center">
                                                                    <?php 
                                                                        if($val['status'] == "0"){
                                                                            echo "Active";
                                                                        }else{
                                                                            echo "Deactive";
                                                                        }
                                                                    ?>
                                                                </td>
                                                                <td class="text-center">
                                                                    <?php echo $val['created_at'];?>
                                                                </td>
                                                                <td class="text-center">
                                                                    <button type="button" class="btn btn-warning" title="See" onclick="go_func('<?php echo $val["id"]?>');">
                                                                        <i class="mdi mdi-eye font-size-15"></i>
                                                                    </button>
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
                
                <script>
                    function show_func(){
                        $("#name").val("");
                        $("#birth_year").val("Please select...");
                        $("#birth_month").val("Please select...");
                        $("#birth_day").val("Please select...");
                        $("#phone").val("");
                        $("#email").val("");
                        $("#address").val("");
                        $("#status").val("Please select...");                        
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
                            url: "<?php echo base_url('employee/get_info');?>", 
                            data: { "edit_id": edit_id } 
                        }).done(function( msg ) { 
                            var json_obj = jQuery.parseJSON(msg); 
                            
                            $("#name").val(json_obj.name);
                            $("#birth_year").val(json_obj.birth_year);
                            $("#birth_month").val(json_obj.birth_month);
                            $("#birth_day").val(json_obj.birth_day);
                            $("#phone").val(json_obj.phone);
                            $("#email").val(json_obj.email);
                            $("#address").val(json_obj.address);
                            $("#state").val(json_obj.status);                            
                            $("#new_pan").slideDown();
                        });
                    }

                    function del_func(edit_id){
                        if(confirm("Are you sure?")){
                            $("#edit_id").val(edit_id);
                        }			
                    }

                    function go_func(edit_id){
                        document.location.href = '<?php echo base_url();?>salary/'+edit_id;
                    }
                </script>