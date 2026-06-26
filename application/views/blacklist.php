
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
                                                    <h4 class="card-title">Blacklist</h4>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <form  action="<?php echo base_url('blacklist/saveDetails');?>" method="POST" enctype="multipart/form-data">
                                                    <div class="basic-form">
                                                                <div class="row">
                                                                    <div class="mb-12 col-md-12">
                                                                        <label class="form-label">Type</label>
                                                                        <div class="radio-list row">
                                                                            <div class="radio-inline pl-0 col-1">
                                                                                <span class="radio radio-info">                           
                                                                                <input type="radio" name="type" id="radio_2" value="2" onclick="getData()">
                                                                                <label for="radio_2">Sender</label>
                                                                                </span>
                                                                            </div>
                                                                            <div class="radio-inline pl-0 col-1">
                                                                                <span class="radio radio-info">                           
                                                                                <input type="radio" name="type" id="radio_3" value="3" onclick="getData()">
                                                                                <label for="radio_3">Receiver</label>
                                                                                </span>
                                                                            </div>
                                                                            <div class="radio-inline pl-0 col-1">
                                                                                <span class="radio radio-info">                           
                                                                                <input type="radio" name="type" id="radio_4" value="4" onclick="getData()">
                                                                                <label for="radio_4">Spam</label>
                                                                                </span>
                                                                            </div>
                                                                            <div class="radio-inline pl-0 col-2">
                                                                                <span class="radio radio-info">                           
                                                                                <input type="radio" name="type" id="radio_1" value="1" onclick="getData()">
                                                                                <label for="radio_1">Content Id</label>
                                                                                </span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                <div class="mb-3 col-md-3">
                                                                    <label class="form-label" for="user_chain">User</label>
                                                                    <select class="form-control" id="user_chain" name="user_chain" required="" onchange ="getAccountList()">
                                                                        <option value="0">Select User</option>
                                                                        <?php foreach($userlist as $user){
                                                                        echo '<option value="'.$user['user_chain'].'">'.ucfirst(strtolower($user['name'])).' ('.$user['email'].')</option>';
                                                                        }?>
                                                                    </select>
                                                                </div>
                                                                <div class="mb-3 col-md-3">
                                                                    <label class="form-label" for="account">Select Account</label>
                                                                    <select class="form-control" id="account" name="account" required="">
                                                                        <?php if($this->session->userdata('isAdmin')==1){?>
                                                                        <option value="ALL">ALL</option>
                                                                        <?php }else{?>
                                                                        <option value="">Select Account</option>
                                                                        <?php }?>
                                                                    </select>
                                                                </div>
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
                                                                    <span class="help-block"><a href="<?php echo base_url('uploads/blacklist_temp.csv');?>" style="color: #ee1212 !important;">Download Sample File</a></span>
                                                                </div>
                                                                <div class="mb-3 col-md-3 manualDiv">
                                                                    <label class="form-label" for="keyword">Text</label>
                                                                    <input class="form-control" id="keyword" name="keyword" required="" type="text">
                                                                </div>
                                                                <div class="row">
                                                                    <div class="mb-3 col-md-3">
                                                                        <button type="submit" class="btn light btn-primary light">Submit</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                    </div>
                                                </form>
									    </div>
												<div class="tab-content" id="myTabContent">
													<div class="tab-pane fade show active" id="Preview" role="tabpanel" aria-labelledby="home-tab">
													 <div class="card-body pt-0">
                                                        <div class="row">
                                                            <div class="mb-3 col-md-3">
                                                                <label class="form-label" for="user_id">Select User</label>
                                                                <select type="text" name="userSearch" id="userSearch" class="form-control" onchange="getdata()">
                                                                    <option value="">Select User</option>
                                                                    <?php foreach ($userList as $type ) { ?>
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
                                                                    <th>Account</th>
                                                                    <th>Text</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                </tbody>
                                                                <tfoot>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>Account</th>
                                                                    <th>Text</th>
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
                    url : '<?php echo base_url("blacklist/getList") ?>',
                    type : 'POST',
                    data: {type:$("input[name='type']:checked").val()}
                    
                },
                dom: 'lfBrtip',
                buttons: [
                    // 'copy', 'excel', 'pdf'
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

        function getAccountList(){
            let user_chain = $("#user_chain").val();
            $.ajax({  
                    url: "<?php echo base_url("blacklist/getAccountList") ?>",
                    method:'POST',
                    data:{user_chain}
                }).done(function(data) { 
                    $('#account').html(data);
                });
            }
        function getSenderList(){
        let user_chain = $("#user_chain").val();
        let account = $("#account").val();
        $.ajax({  
                url: "<?php echo base_url("todaysearch/getSenderList") ?>",
                method:'POST',
                data:{user_chain,account}
            }).done(function(data) { 
                $('#sender').html(data);
            });
        }
	</script>
</body>
</html>