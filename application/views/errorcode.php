
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
                                                    <h4 class="card-title">Error Codes List</h4>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <form  action="<?php echo base_url('errorcode/saveDetails');?>" method="POST" enctype="multipart/form-data">
                                                    <div class="basic-form">
                                                        <div class="row">
                                                            <div class="mb-3 col-md-3">
                                                                <label class="form-label" for="user_id">Select User</label>
                                                                <select class="form-control" id="user_id" name="user_id" onchange ="getAccountUser(this.value);">
                                                                    <option value="">Select User</option>
                                                                    <?php foreach ($userList as $type ) { ?>
                                                                        <option value="<?php echo $type['user_chain']; ?>" <?php if(isset($contentData["user_id"]) && $contentData["user_id"]==$type['id']){echo "selected";}?>><?php echo $type["name"]; ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3 col-md-3">
                                                                <label class="form-label" for="user_account_id">Select Account</label>
                                                                <select class="form-control" id="user_account_id" name="user_account_id">
                                                                        <option value="">Select Account</option>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3 col-md-3">
                                                                <label class="form-label" for="smsc_id">Select SMSC</label>
                                                                <select class="form-control" id="smsc_id" name="smsc_id" required="">
                                                                    <option value="">Select SMSC</option>
                                                                    <option value="0">ALL</option>
                                                                    <?php foreach($smsclist as $user){ ?>
                                                                    <option value="<?php echo $user['smsc-id'];?>" <?php if(isset($contentData["smsc_id"]) && $contentData["smsc_id"]==$user['smsc-id']){echo "selected";}?>><?php echo $user['smsc-id'];?></option>';
                                                                <?php }?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="mb-3 col-md-3">
                                                                <label class="form-label mb-10">Create Via</label>
                                                                <div class="radio-list row">
                                                                    <div class="radio-inline pl-0 col-4">
                                                                    <span class="radio radio-info">                           
                                                                        <input type="radio" name="create_by" id="create_by_1" value="1" onclick="divHideShow(this.value);" data-bs-original-title="" title="">
                                                                        <label for="create_by_1">File</label>
                                                                    </span>
                                                                    </div>
                                                                    <div class="radio-inline pl-0 col-4">
                                                                    <span class="radio radio-info">                           
                                                                        <input type="radio" name="create_by" id="create_by_2" value="2" onclick="divHideShow(this.value);" data-bs-original-title="" title="">
                                                                        <label for="create_by_2">Manual</label>
                                                                    </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="mb-3 col-md-3" id="fileDiv">
                                                                <label class="form-label" for="file">File</label>
                                                                <input class="form-control" id="file" name="file" required="" type="file">
                                                                <span class="help-block"><a href="<?php echo base_url('uploads/error_code.csv');?>" style="color: #ee1212 !important;">Download Sample File</a></span>
                                                            </div>
                                                            <div class="mb-3 col-md-3 manualDiv">
                                                                <label class="control-label mb-10" for="original_code">Original Code</label>
                                                                <input type="text" class="form-control" name="original_code" id="original_code" value='<?php if(isset($contentData["original_code"])){echo $contentData["original_code"];}?>'>
                                                            </div>
                                                            <div class="mb-3 col-md-3 manualDiv">
                                                                <label class="control-label mb-10" for="replace_code">Replaced Code</label>
                                                                <input type="text" class="form-control" name="replace_code" id="replace_code" value='<?php if(isset($contentData["replace_code"])){echo $contentData["replace_code"];}?>'>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <div class="mb-9 col-md-9">
                                                                <label class="form-label" for="description">Description</label>
                                                                <input type="text" class="form-control" name="description" id="description">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="mb-3 col-md-3">
                                                                <input type="hidden" name="pid" id="eid" value="<?php if(isset($contentData["id"])){echo $contentData["id"];}?>">
                                                                <button type="submit" class="btn light btn-primary light">Submit</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
									        </div>
												<div class="tab-content" id="myTabContent">
													<div class="tab-pane fade show active" id="Preview" role="tabpanel" aria-labelledby="home-tab">
													 <div class="card-body pt-0">
														<div class="table-responsive">
															<table id="example" class="display table" style="min-width: 845px">
																<thead>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>SMSC</th>
                                                                    <th>Original Code</th>
                                                                    <th>Replaced Code</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                </tbody>
                                                                <tfoot>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>SMSC</th>
                                                                    <th>Original Code</th>
                                                                    <th>Replaced Code</th>
                                                                    <th>Action</th>
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
        function divHideShow(value){
            if(value==1){
            $('#fileDiv').show();
            $('.manualDiv').hide();
            }else if(value==2){
            $('.manualDiv').show();
            $('#fileDiv').hide();
            }else{
            $('.manualDiv').hide();
            $('#fileDiv').hide();
            }
        }
        $(document).ready(function() {
            $("#create_by_2").prop("checked", true);
            <?php if(isset($contentData["id"])){?>
            $("#create_by_1").prop("disabled", true);
            <?php }?>
            divHideShow(2);
            // $('#date').val('<?php echo date('Y-m-d')?>');
            // $('#fromdate').val('<?php echo date('Y-m-d')?>');
            getdata();
        });
        function getdata(){
            // let userSearch = $("#userSearch").val();
            $('#example').DataTable().destroy();
            $('#example').DataTable({
                "ajax": {
                    url : '<?php echo base_url("errorcode/getList") ?>',
                    type : 'GET',
                    // data: {type:$("input[name='type']:checked").val()}
                    
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

        function getAccountUser(user_id){
            $.ajax({  
                    url: '<?php echo base_url('dlrrepush/getAccountList');?>',
                    method:'post',
                    data:{user_id}
                }).done(function(data) {
                $('#user_account_id').html(data); 
                });
        }
	</script>
</body>
</html>