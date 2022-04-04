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
                                    <h4 class="mb-0 font-size-18">Jobs</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <?php echo $msg;?>

                        <div class="row" id="new_pan" style="display: none;">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
        
                                        <h4 class="card-title">New Job</h4>
                                        <p class="card-title-desc">Fill all information below</p>
        
                                        <?php echo form_open('', array('class' => 'outer-repeater', 'method' => 'post'));?>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label for="metatitle">Job Name</label>
                                                        <input name="jobs" id="jobs" type="text" class="form-control" placeholder="Enter Job Name" required>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label for="Status">Item :</label>
                                                        <select class="form-control" name="item" id="item">
                                                            <option>Please select...</option>
                                                            <?php
                                                                if(count($select_items_list)> 0){
                                                                    foreach($select_items_list as $key => $val){
                                                            ?>
                                                                <option value="<?php echo $val['id'];?>"><?php echo $val['itemName'];?></option>
                                                            <?php
                                                                    }
                                                                }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-12 text-center">
                                                <button type="submit" name="saveBtn" value="ok" class="btn btn-primary mr-1 waves-effect waves-light">Save Changes</button>
                                                <button type="button" class="btn btn-secondary waves-effect" onclick="hide_func();">Cancel</button>
                                            </div>
                                            <input type="hidden" name="add_id" id="add_id" value="">
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
                                                            <input type="text" name="srch_txt" class="form-control" value="<?php echo $srch_txt;?>" placeholder="Search by Job">
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
                                                            <th class="text-center" style="width: 35%;">Jobs</th>                                                           
                                                            <th class="text-center" style="width: 20%;">Item</th>
                                                            <th class="text-center" style="width: 15%">Created Date</th>
                                                            <th class="text-center" style="width: 10%;">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php 
                                                            if(count($jobs_list) > 0){
                                                                foreach($jobs_list as $key => $val){
                                                        ?>
                                                            <tr>
                                                                <td class="text-center">
                                                                    <?php echo $key+1;?>
                                                                </td>
                                                                <td class="text-center">
                                                                    <?php echo $val['job'];?>
                                                                </td>                                                                
                                                                <td class="text-center">
                                                                    <?php echo $val['itemName'];?>
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
                                                                <td colspan="5" class="text-center"> No Data </td>
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
                        $("#item").val("Please select...");
                        $("#jobs").val("");                       
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
                            url: "<?php echo base_url('items/get_jobs_info');?>", 
                            data: { "edit_id": edit_id } 
                        }).done(function( msg ) { 
                            var json_obj = jQuery.parseJSON(msg); 
                            
                            $("#item").val(json_obj.item_id);
                            $("#jobs").val(json_obj.job);                            
                            $("#new_pan").slideDown();
                        });
                    }

                    function del_func(edit_id){
                        if(confirm("Are you sure?")){
                            $("#edit_id").val(edit_id);
                        }			
                    }
                </script>