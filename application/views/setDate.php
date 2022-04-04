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
                                    <h4 class="mb-0 font-size-18">Date Setting</h4>
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
                                                        <label for="Date">Date :</label>
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" name="set_date" id="set_date" placeholder="mm/dd/yyyy" data-provide="datepicker" data-date-autoclose="true" required>
                                                            <div class="input-group-append">
                                                                <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                                            </div>
                                                        </div><!-- input-group -->
                                                    </div>

                                                    <div class="col-sm-12 text-center">
                                                        <button type="submit" name="saveBtn" value="ok" class="btn btn-primary mr-1 waves-effect waves-light">Save Changes</button>
                                                        <button type="button" class="btn btn-secondary waves-effect" onclick="hide_func();">Cancel</button>
                                                    </div>                                                    
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
                                        <?php echo form_open('', array('method' => 'post'));?>
                                            <input type="hidden" id="edit_id" name="edit_id" value="">
                                            <input type="hidden" id="job_id" name="job_id" value="">
                                            <div class="table-responsive">
                                                <table class="table table-centered table-nowrap">
                                                    <thead class="thead-light">
                                                        <tr>                                                            
                                                            <th class="text-center" style="width: 90%;">Date</th>                                                            
                                                            <th class="text-center" style="width: 10%;">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>                                                        
                                                        <tr>                                                           
                                                            <td class="text-center">
                                                                <?php echo $setdate_data['value'];?>
                                                            </td>
                                                            
                                                            <td class="text-center">
                                                                <button type="button" class="btn btn-primary" title="Edit" onclick="edit_func('<?php echo $setdate_data["id"]?>');">
                                                                    <i class="mdi mdi-pencil font-size-15"></i>
                                                                </button>                                                                
                                                            </td>
                                                        </tr>
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
                    function edit_func(edit_id){
                        $.ajax({
                            type: "POST",
                            url: "<?php echo base_url('SetDate/get_info');?>", 
                            data: { "edit_id": edit_id } 
                        }).done(function( msg ) { 
                            var json_obj = jQuery.parseJSON(msg); 
                            
                            $("#set_date").val(json_obj.value);                           
                            $("#new_pan").slideDown();
                        });
                    }  

                    function hide_func(){
                        $("#new_pan").slideUp();
                    }                    
                </script>