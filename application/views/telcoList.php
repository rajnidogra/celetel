
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
                                                    <h4 class="card-title">Routing Group List</h4>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                            <form action="<?php echo base_url('telco/saveRoutingGroup');?>" method="POST">
                                                <div class="basic-form">
                                                        <div class="row">
                                                            <div class="mb-3 col-md-3">
                                                                <label class="form-label" for="group_id">Group Id</label>
                                                                <input type="text" class="form-control" name="group_id" id="group_id" required="required" value='<?php if(isset($contentData["group_id"])){echo $contentData["group_id"];}?>' >
                                                            </div>
                                                            <div class="mb-3 col-md-3">
                                                                <label class="form-label" for="routing_type">Routing Type</label>
                                                                <select class="form-control" name="routing_type" id="routing_type">
                                                                    <option value="Percentage" <?php if(isset($contentData["routing_type"]) && $contentData["routing_type"]=="Percentage"){echo "selected";}?>>Percentage</option>
                                                                    <option value="Header" <?php if(isset($contentData["routing_type"]) && $contentData["routing_type"]=="Header"){echo "selected";}?>>Header</option>
                                                                    <option value="Receiver" <?php if(isset($contentData["routing_type"]) && $contentData["routing_type"]=="Receiver"){echo "selected";}?>>Receiver</option>
                                                                </select>   
                                                            </div>
                                                            <div class="mb-3 col-md-3">
                                                                <label class="form-label" for="tps">TPS</label>
                                                                <input type="text" class="form-control" name="tps" id="tps" required="required" value='<?php if(isset($contentData["tps"])){echo $contentData["tps"];}?>'>   
                                                            </div>
                                                            <div class="mb-3 col-md-3">
                                                                <label class="control-label" for="identifier">Identifier</label>
                                                                <input type="text" class="form-control" name="identifier" id="identifier" required="required" value='<?php if(isset($contentData["identifier"])){echo $contentData["identifier"];}?>'>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="mb-3 col-md-3">
                                                                <label class="control-label" for="priority">Priority</label>
                                                                <input type="text" class="form-control" name="priority" id="priority" required="required" value='<?php if(isset($contentData["priority"])){echo $contentData["priority"];}?>'>
                                                            </div>
                                                            <div class="mb-3 col-md-3">
                                                                <label class="form-label" for="smsc_id">SMSC Id</label>
                                                                <select class="form-control" name="smsc_id" id="smsc_id" required="required">
                                                                    <option value="">Select SMSC</option>
                                                                    <?php 
                                                                    foreach ($smsc as $value) {?>
                                                                        <option value="<?php echo $value['smsc-id'];?>" <?php if(isset($contentData["smsc_id"]) && $contentData["smsc_id"]==$value['id']){ echo "selected";}?>><?php echo $value['smsc-id'];?></option>
                                                                    <?php }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="mb-3 col-md-3">
                                                                <input type="hidden" name="eid" id="eid" value='<?php if(isset($contentData["id"])){echo $contentData["id"];}?>'>
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
                                                                    <th>Group ID</th>
                                                                    <th>Routing Type</th>
                                                                    <th>TPS</th>
                                                                    <th>Identifier</th>
                                                                    <th>Priority</th>
                                                                    <th>SMSC ID</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                </tbody>
                                                                <tfoot>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>Group ID</th>
                                                                    <th>Routing Type</th>
                                                                    <th>TPS</th>
                                                                    <th>Identifier</th>
                                                                    <th>Priority</th>
                                                                    <th>SMSC ID</th>
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
                    url: "<?php echo site_url('telco/get_group_tables'); ?>",
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

        function getUserList(){
            let user_type = $("#user_type").val();
            $.ajax({  
                url: "<?php echo base_url("permissionuser/getUserByType") ?>",
                method:'POST',
                data:{user_type}
            }).done(function(data) { 
                $('#user_id').html(data);
            });
        }
	</script>
</body>
</html>