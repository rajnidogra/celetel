
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
                                                    <h4 class="card-title">Telco Mapping</h4>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                            <form action="<?php echo base_url('telcomapping/saveDetails');?>" method="POST">
                                                <div class="basic-form">
                                                        <div class="row">
                                                            <div class="mb-3 col-md-3">
                                                                <label class="form-label" for="sms_type">Original Route</label>
                                                                <select class="form-control" id="original_route" name="original_route" required="">
                                                                    <option value="">Select Route</option>
                                                                    <?php foreach($routeList as $value){
                                                                    echo '<option value="'.$value['route'].'">'.$value['route'].'</option>';
                                                                    }?>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3 col-md-3">
                                                                <label class="form-label" for="replaced_route">Replaced Route</label>
                                                                <select class="form-control" id="replaced_route" name="replaced_route" required="">
                                                                    <option value="">Select Route</option>
                                                                    <?php foreach ($groupList as $value) {
                                                                    echo '<option value="'.$value['group_id'].'">'.$value['group_id'].'</option>';
                                                                    } ?>
                                                                </select>
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
                                                                    <th>Route</th>
                                                                    <th>Count</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                </tbody>
                                                                <tfoot>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>Route</th>
                                                                    <th>Count</th>
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
        $(document).ready(function() {
            // $('#todate').val('<?php echo date('Y-m-d')?>');
            // $('#fromdate').val('<?php echo date('Y-m-d')?>');
            getdata();
        });
        function getdata(){
            // let user_type = $("#user_type").val();
	  	    // let user_id = $("#user_id").val();
            $('#example').DataTable().destroy();
            $('#example').DataTable({
                "ajax": {
                    url: "<?php echo site_url('telcomapping/get_tables'); ?>",
                    type : 'GET',
	                // data: { user_id, user_type },
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

        function getRoute(route){
            $.ajax({  
                    url: '<?php echo base_url("telcomapping/getRoute");?>',
                    method:'post',
                    data:{
                    route:route
                    }
                }).done(function(data) {
                    // alert(data);
                    $('#modelData').html(data); 
                });
        }

        function changeRoute(id,system_id){
            let route= $('#rute'+id).val();
            $.ajax({  
                url: '<?php echo base_url("telcomapping/changeRoute");?>',
                method:'post',
                data:{
                    system_id,route
                }
            }).done(function(data) {
            // window.location.reload();
            });
        }

            function refreshPage() {window.location.reload();}
	</script>
</body>
</html>

<div class="modal fade" id="exampleModal1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Route Mapping</h5>
                <button type="button" class="btn btn-danger light" data-bs-dismiss="modal" onclick="refreshPage()">Save Changes</button>
            </div>
            <div class="modal-body">
                <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>System_id</th>
                        <th>Route</th>
                    </tr>
                    </thead>
                    <tbody id="modelData"></tbody>
            </table>
            </div>
            <div class="modal-footer">
                <!-- <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Close</button> -->
                <!-- <button type="button" class="btn btn-primary light">Save changes</button> -->
            </div>
        </div>
    </div>
</div>