
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
	<?php $this->load->view('title');?>
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests" />
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
                                                    <h4 class="card-title">Address Book List</h4>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                            <form action="<?php echo base_url('usergroup/saveContactData');?>" enctype="multipart/form-data" method="POST" id="fupForm">
                                                <div class="basic-form">
                                                        <div class="row">
                                                            <div class="mb-3 col-md-3">
                                                                <label class="form-label">Group Name</label>
                                                                <select class="form-control" id="groupid" required="required" name="groupid" onchange="onSelect(this.value)">
                                                                    <option selected="selected" value="">Select Group Name</option>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3 col-md-3" id="groupNameDiv" style="display: none;">
                                                                <label class="form-label">Group Name</label>
                                                                <input type="text" class="form-control" id="campaign_name" name="campaign_name">
                                                            </div>
                                                            <div class="mb-3 col-md-3">
                                                                <label class="form-label">Contacts File</label>
                                                                <input type="file" class="form-control" id="file" required="required" name="file">
                                                                <input type="hidden" name="user_id" name="user_id" value="<?php echo $this->session->userdata('userId');?>">
                      								            <input type="hidden" name="isAddressbook" name="isAddressbook" value="1">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="mb-3 col-md-3">
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
                                                                    <th>Group Name</th>
                                                                    <th>Contact Count</th>
                                                                    <th>Created Date</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                </tbody>
                                                                <tfoot>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>Group Name</th>
                                                                    <th>Contact Count</th>
                                                                    <th>Created Date</th>
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
        // $(document).ready(function() {
            // $('#todate').val('<?php //echo date('Y-m-d')?>');
            // $('#fromdate').val('<?php //echo date('Y-m-d')?>');
            
        // });

        $(document).ready(function(e){
            $("#fupForm").on('submit', function(e){
                $('body').append('<div class="preloader-it"><div class="la-anim-1"></div></div>');
                $('.preloader-it').show();
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: '<?php echo node_url();?>file/getFileData',
                    data: new FormData(this),
                    dataType: 'json',
                    contentType: false,
                    cache: false,
                    processData:false,
                    success: function(result){
                        $('.preloader-it').hide();
                        // alert(result);
                        window.location.reload();
                    }
                });
            });
            getdata();
            getGroupList();
        });
        function getdata(){
            // let user_type = $("#user_type").val();
	  	    // let user_id = $("#user_id").val();
            $('#example').DataTable().destroy();
            $('#example').DataTable({
                "ajax": {
                    url: "<?php echo site_url('usergroup/get_group_tables'); ?>",
                    type : 'GET',
                },
                dom: 'lfBrtip',
                buttons: [
                    'copy', 'excel', 'pdf','print'
                ],
                "processing": true,          
                "order": [ 0, "desc" ],          
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

        function getGroupList(){
            $.ajax({  
                    url: "<?php echo site_url("usergroup/getGroupList") ?>",
                    method:'GET',
                }).done(function(data) { 
                    $('#groupid').html(data);
                });
            }

            function onSelect(value){
            if(value!=0){
                $('#groupNameDiv').hide();
            }else{
                $('#groupNameDiv').show();
            }
            }
	</script>
</body>
</html>