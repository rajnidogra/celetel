
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
	<?php $this->load->view('title');?>

	<link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet">
    <?php setting_css(TABLE_CSS);?>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

</head>

<body>

    <!--*******************
        Preloader start
    ********************-->
    <?php $this->load->view("preloader"); ?>
    <!--*******************
        Preloader end
    ********************-->


    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        <?php $this->load->view("navheader"); ?>
        <!--**********************************
            Nav header end
        ***********************************-->
		
        <!--**********************************
            Header start
        ***********************************-->
        <?php $this->load->view("header"); ?>
                    
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
		<?php $this->load->view("menu"); ?>
        <!--**********************************
            Sidebar end
        ***********************************-->

        <!--**********************************
            Content body start
        ***********************************-->
		<div class="outer-body">
			<div class="inner-body">
				<div class="content-body">
					<!-- container starts -->
					<div class="container-fluid">
						<!-- row -->
						<div class="element-area">
							<div class="demo-view">
								<div class="container-fluid pt-0 ps-0 pe-lg-4 pe-0">
									<div class="row">
										<!-- Column starts -->
										<div class="col-xl-12">
											<div class="card dz-card" id="accordion-one">
                                            <div class="card-header flex-wrap">
                                                <div>
                                                    <h4 class="card-title">Users List</h4>
                                                </div>
                                                
                                            </div>
                                            <div class="card-body">
                                                <form action="<?php echo base_url('registration/saveUserDetails');?>" method="POST" enctype="multipart/form-data">
                                                    <div class="basic-form">
                                                            <div class="row">
                                                                <div class="mb-3 col-md-3">
                                                                    <label class="control-label mb-10" for="usertype">User Type</label>
                                                                    <select class="form-control" id="usertype" name="usertype" onchange="selectOpt();" required="required">
                                                                        <option value="">Select User Type</option>
                                                                        <?php foreach ($userType as $type ) { ?>
                                                                            <option value="<?php echo $type['id']; ?>" <?php if(isset($contentData["user_type"]) && $contentData["user_type"]==$type['id']){echo "selected";}?>><?php echo $type["name"]; ?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </div>
                                                                <div class="mb-3 col-md-3">
                                                                    <label class="control-label mb-10" for="name">Name</label>
                                                                    <input type="text" placeholder="Name" class="form-control" id="name" name="name" required="required" value='<?php if(isset($contentData["name"])){echo $contentData["name"];}?>'>
                                                                </div>
                                                                <div class="mb-3 col-md-3">
                                                                    <label class="control-label mb-10" for="username">User Name</label>
                                                                    <input type="text" placeholder="User Name" class="form-control" required="required" id="username" name="username" required="required" onkeyup="chkExist('username',this.value);" onkeydown="chkExist('username',this.value);" value='<?php if(isset($contentData["username"])){echo $contentData["username"];}?>'>
                                                                    <div id="msg_username"></div>
                                                                </div>
                                                                <div class="mb-3 col-md-3">
                                                                    <label class="control-label mb-10" for="password">Password</label>
                                                                    <input type="password" placeholder="Password" class="form-control" id="password" name="password" required="required">
                                                                    <input type="hidden" name="password_old" id="password_old" value='<?php if(isset($contentData["password"])){echo $contentData["password"];}?>'>
                                                                </div>
                                                                <div class="mb-3 col-md-3">
                                                                    <label class="control-label mb-10" for="email">Email ID</label>
                                                                    <input type="text" placeholder="Email Id" class="form-control" id="email" required="required" name="email" required="required" onkeyup="chkExist('email',this.value);" onkeydown ="chkExist('email',this.value);" value='<?php if(isset($contentData["email"])){echo $contentData["email"];}?>'>
                                                                    <div id="msg_email"></div>
                                                                </div>
                                                                <div class="mb-3 col-md-3">
                                                                    <label class="control-label mb-10" for="mobile">Contact Number</label>
                                                                    <input type="text" placeholder="Contact Number" class="form-control" required="required" id="mobile" name="mobile" required="required" onkeyup ="chkExist('mobile',this.value);" onkeydown ="chkExist('mobile',this.value);" value='<?php if(isset($contentData["mobile"])){echo $contentData["mobile"];}?>'>
                                                                    <div id="msg_mobile"></div>
                                                                </div>
                                                                <div class="mb-3 col-md-3">
                                                                    <label class="control-label mb-10" for="allow_ip">Allow IP</label>
                                                                    <input type="text" placeholder="Allow IP" class="form-control" id="allow_ip" name="allow_ip" value='<?php if(isset($contentData["allow_ip"])){echo $contentData["allow_ip"];}?>'>
                                                                </div>
                                                                <div class="mb-3 col-md-3">
                                                                    <label class="control-label mb-10" for="account_validity">Account Validity</label>
                                                                    <input type="text" placeholder="Account Validity" class="form-control mdatePickerFuture" required="required" id="account_validity" name="account_validity">
                                                                </div>
							    </div>
                          <div class="row">
                            <div class="mb-3 col-md-3">
                              <label class="control-label mb-10" for="threshold">Threshold</label>
                              <input type="text" placeholder="Threshold" class="form-control" required="required" id="threshold" name="threshold">
                            </div>

                                                            <div class="row billingDetails">
                                                                <div class="mb-3 col-md-3">
                                                                    <label class="control-label mb-10" for="billing_cycle">Billing Cycle</label>
                                                                    <select class="form-control" id="billing_cycle" name="billing_cycle" required="required">
                                                                    <option value="">Select Billing Cycle</option>
                                                                    <?php foreach($billingCycle as $type){?>
                                                                        <option value="<?php echo $type['id'];?>" <?php if(isset($contentData["billing_cycle"]) && $contentData["billing_cycle"]==$type['id']){echo "selected";}?>><?php echo $type["value"];?></option>
                                                                    <?php }?>
                                                                    </select>
                                                                </div>
                                                                <div class="mb-3 col-md-3">
                                                                    <label class="control-label mb-10" for="billing_type">Billing Type</label>
                                                                    <select class="custom-select form-control" id="billing_type" name="billing_type" required="required">
                                                                        <option value="">Select Billing Type</option>
                                                                        <?php foreach($billingType as $type){?>
                                                                            <option value="<?php echo $type['id'];?>" <?php if(isset($contentData["billing_type"]) && $contentData["billing_type"]==$type['id']){echo "selected";}?>><?php echo $type["value"];?></option>
                                                                        <?php }?>
                                                                    </select>
                                                                </div>
							    </div>
                                                            <div class="row documentDetails">
                                                                <div class="mb-3 col-md-3">
                                                                    <label class="control-label mb-10" for="pan_no">PAN Number</label>
                                                                    <input type="text" placeholder="PAN Number" class="form-control" id="pan_no" name="pan_no" value='<?php if(isset($contentDataDoc["pan_no"])){echo $contentDataDoc["pan_no"];}?>'>
                                                                </div>
                                                                <div class="mb-3 col-md-3">
                                                                    <label class="control-label mb-10" for="pan_file">Upload PAN</label>
                                                                    <input type="file" class="form-control" id="pan_file" name="pan_file">
                                                                    <input type="hidden" name="pan_file_old" id="pan_file_old" value='<?php if(isset($contentDataDoc["pan_file"])){echo $contentDataDoc["pan_file"];}?>'>
                                                                </div>
                                                                <div class="mb-3 col-md-3">
                                                                    <label class="control-label mb-10" for="aadhar_no">Aadhar Number</label>
                                                                    <input type="text" placeholder="Aadhar Number" class="form-control" id="aadhar_no" name="aadhar_no" value='<?php if(isset($contentDataDoc["aadhar_no"])){echo $contentDataDoc["aadhar_no"];}?>'>
                                                                </div>
                                                                <div class="mb-3 col-md-3">
                                                                    <label class="control-label mb-10" for="aadhar_file">Upload Aadhar</label>
                                                                    <input type="file" class="form-control" id="aadhar_file" name="aadhar_file">
                                                                    <input type="hidden" name="aadhar_file_old" id="aadhar_file_old" value='<?php if(isset($contentDataDoc["aadhar_file"])){echo $contentDataDoc["aadhar_file"];}?>'>
                                                                </div>
                                                                <div class="mb-3 col-md-3">
                                                                    <label class="control-label mb-10" for="aadhar_no">GST Number</label>
                                                                    <input type="text" placeholder="GST Number" class="form-control" id="gst_no" name="gst_no" value='<?php if(isset($contentDataDoc["gst_no"])){echo $contentDataDoc["gst_no"];}?>'>
                                                                </div>
                                                                <div class="mb-3 col-md-3">
                                                                    <label class="control-label mb-10" for="gst_file">Upload GST</label>
                                                                    <input type="file" class="form-control" id="gst_file" name="gst_file">
                                                                    <input type="hidden" name="gst_file_old" id="gst_file_old" value='<?php if(isset($contentDataDoc["gst_file"])){echo $contentDataDoc["gst_file"];}?>'>
                                                                </div>
                                                            </div>
                                                            <div class="row websiteDetails">
                                                                <div class="mb-3 col-md-3">
                                                                    <label class="control-label mb-10" for="pan_no">Domain Name</label>
                                                                    <input type="text" placeholder="Domain Name" class="form-control" id="domain_name" name="domain_name" value='<?php if(isset($contentDataDoc["domain_name"])){echo $contentDataDoc["domain_name"];}?>'>
                                                                </div>
                                                                <div class="mb-3 col-md-3">
                                                                    <label class="control-label mb-10" for="pan_no">Company Name</label>
                                                                    <input type="text" placeholder="Company Name" class="form-control" id="company_name" name="company_name" value='<?php if(isset($contentDataDoc["company_name"])){echo $contentDataDoc["company_name"];}?>'>
                                                                </div>
                                                                <div class="mb-3 col-md-3">
                                                                    <label class="control-label mb-10" for="pan_no">Upload Logo</label>
                                                                    <input type="file" class="form-control" id="upload_logo" name="upload_logo">
                                                                    <input type="hidden" name="upload_logo_old" id="upload_logo_old" value='<?php if(isset($contentDataDoc["upload_logo"])){echo $contentDataDoc["upload_logo"];}?>'>
                                                                </div>
                                                                <div class="mb-3 col-md-3">
                                                                    <label class="control-label mb-10" for="pan_no">Upload Favicon</label>
                                                                    <input type="file" class="form-control" id="upload_favicon" name="upload_favicon">
                                                                    <input type="hidden" name="upload_favicon_old" id="upload_favicon_old" value='<?php if(isset($contentDataDoc["upload_favicon"])){echo $contentDataDoc["upload_favicon"];}?>'>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="mb-3 col-md-3">
                                                                    <input type="hidden" name="eid" value="<?php if(isset($contentData["id"])){echo $contentData["id"];}?>">
                                                                    <button type="submit" class="btn light btn-primary light">Submit</button>
                                                                </div>
                                                            </div>
                                                    </div>
                                                </form>
                                            </div> 
												<div class="tab-content" id="myTabContent">
													<div class="tab-pane fade show active" id="Preview" role="tabpanel" aria-labelledby="home-tab">
													 <div class="card-body pt-0">
                                                        <div class="row mb-3">
                                                            <div class="box-tools col-sm-3">
                                                                <select type="text" name="usertypeSearch" id="usertypeSearch" class="form-control" onchange="getdata()">
                                                                <option value="">Select User Type</option>
                                                                <?php foreach ($userType as $type ) { ?>
                                                                    <option value="<?php echo $type['id']; ?>"><?php echo $type["name"]; ?></option>
                                                                <?php } ?>
                                                                </select>
                                                            </div>
                                                        </div>
														<div class="table-responsive">
															<table id="example" class="display table" style="min-width: 845px">
																<thead>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>Name</th>
                                                                    <th>User Name</th>
                                                                    <th>Email</th>
                                                                    <th>Mobile</th>
                                                                    <th>Balance</th>
                                                                    <th>Account Validity</th>
                                                                    <th>Status</th>
								    <th>Parent</th>
                                                                    <th>Threshold</th>      
                                                                    <th>Actions</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                </tbody>
                                                                <tfoot>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>Name</th>
                                                                    <th>User Name</th>
                                                                    <th>Email</th>
                                                                    <th>Mobile</th>
                                                                    <th>Balance</th>
                                                                    <th>Account Validity</th>
                                                                    <th>Status</th>
								    <th>Parent</th>
                                                                    <th>Threshold</th>
                                                                    <th>Actions</th>
                                                                </tr>
																</tfoot>
															</table>
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
		</div>
        <!--**********************************
                Content body end
            ***********************************-->


        <!--**********************************
            Footer start
        ***********************************-->
         <?php $this->load->view('footer');?>
        <!--**********************************
            Footer end
        ***********************************-->

        <!--**********************************
           Support ticket button start
        ***********************************-->

        <!--**********************************
           Support ticket button end
        ***********************************-->

        
    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->

    <?php setting_js(TABLE_JS);?>
	<script>
         function getUserChain(userChain){
            $.ajax({  
                url: "<?php echo site_url("registration/getUserChain") ?>",
                method:'POST',
                data:{userChain}
            }).done(function(data) { 
                $('#chainhtml').html(data);
            });
        }

        function chkExist(key,value){
            if(value.length>3){
            $.ajax({  
                url: "<?php echo site_url("registration/chkExist") ?>",
                method:'POST',
                data:{key,value}
                }).done(function(data) { 
                // $('#sender_id').html(data);
                // alert(data);
                $('#msg_'+key).html(data);
                });
            }else{
            $('#msg_'+key).html('<div class="txt-danger">Please enter valid '+key+'!!!</div>');
            }
        }
        $(document).ready(function() {
            $('#account_validity').val('<?php if(isset($contentData) && $contentData['account_validity']){echo date('Y-m-d',strtotime($contentData['account_validity']));}else{echo date('Y-m-d');}?>');
            selectOpt();
            getdata();
        });
        function selectOpt(){
            var usertype = $("#usertype").val();
            if(usertype == 2){
                // $("#enterpriseDetails").hide();
                $(".billingDetails").show();
                $(".documentDetails").show();
                $(".websiteDetails").hide();
            }
            if(usertype == 3 || usertype == 4){
                // $("#enterpriseDetails").show();
                $(".billingDetails").show();
                $(".documentDetails").show();
                $(".websiteDetails").show();
            }
            if(usertype == 5 || usertype == 6 || usertype == 7 || usertype == 8){
                $(".billingDetails").hide();
                $(".documentDetails").hide();
                // $("#enterpriseDetails").show();
                $(".websiteDetails").hide();
            }
            if(usertype==""){
                $(".billingDetails").hide();
                $(".documentDetails").hide();
                // $("#enterpriseDetails").hide();
                $(".websiteDetails").hide();
            }
        }
        function getdata(){
            let usertype = $("#usertypeSearch").val();
            $('#example').DataTable().destroy();
            $('#example').DataTable({
                "ajax": {
                    url: "<?php echo site_url('registration/getUsers'); ?>",
                    type : 'POST',
                    data: {usertype}
                },
                dom: 'lfBrtip',
                buttons: [
                    'copy', 'excel', 'pdf','print'
                ],
                "processing": true,          
                "order": [ 0, "asc" ],          
                "sPaginationType": "full_numbers",
                "language": {
                    "search": "_INPUT_", 
                    "searchPlaceholder": "Search",
                    "paginate": {
                        "next": '<i class="fa fa-angle-right"></i>',
                        "previous": '<i class="fa fa-angle-left"></i>',
                        "first": '<i class="fa fa-angle-double-left"></i>',
                        "last": '<i class="fa fa-angle-double-right"></i>'
                    }
                }, 
                "iDisplayLength": 10,
                "aLengthMenu": [[10, 25, 50, 100,500,-1], [10, 25, 50,100,500,"All"]]
            });
        }
        // function getdata(){
        //     $('#modal2').DataTable().destroy();
        //     $('#modal2').DataTable({
        //     "ajax": {
        //         url : '<?php echo base_url("campaign/getTemplateList") ?>',
        //         type : 'GET'
        //         },
        //         dom: 'lfBrtip',
        //         buttons: [
        //             'copy', 'excel', 'pdf','print'
        //         ],
        //         "processing": true,          
        //         "order": [ 0, "asc" ],          
        //         "sPaginationType": "full_numbers",
        //         "language": {
        //             "search": "_INPUT_", 
        //             "searchPlaceholder": "Search",
        //             "paginate": {
        //                 "next": '<i class="fa fa-angle-right"></i>',
        //                 "previous": '<i class="fa fa-angle-left"></i>',
        //                 "first": '<i class="fa fa-angle-double-left"></i>',
        //                 "last": '<i class="fa fa-angle-double-right"></i>'
        //             }
        //         }, 
        //         "iDisplayLength": 10,
        //         "aLengthMenu": [[10, 25, 50, 100,500,-1], [10, 25, 50,100,500,"All"]]
        //     });
        // }

    // function gettemplateValue(id,template,peid,content,header){
    //     $("#temp_id").val(id);
    //     $("#template").val(template);
    //     $("#peid").val(peid);
    //     $("#contentid").val(content);
    //     $("#header").val(header);
    //     // calculate();
    // }
	</script>
</body>
</html>

<div class="modal fade" id="exampleModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">User Chain</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-striped table-bordered" id="modal2">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">User Role</th>
                    </tr>
                    </thead>
                    <tbody id="chainhtml"></tbody>
            </table>
            </div>
            <div class="modal-footer">
                 <button type="button" class="btn btn-info" data-bs-dismiss="modal">Close</button>
                <!-- <button type="button" class="btn btn-primary light">Save changes</button> -->
            </div>
        </div>
    </div>
</div>
