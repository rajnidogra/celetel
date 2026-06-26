
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
                                                    <h4 class="card-title">Permission User Types</h4>
                                                </div>
                                            </div>
                                                <form action="<?php echo base_url('permission/saveData');?>" method="POST">
                                                    <div class="card-body">
                                                        <div class="basic-form">
                                                                <div class="row">
                                                                    <div class="mb-3 col-md-3">
                                                                    <select class="form-control" id="user_id" name="user_id" onchange="getdata()">
                                                                        <option value="">Select User Type</option>
                                                                        <?php foreach ($userTypes->result_array() as $type ) { ?>
                                                                            <option value="<?php echo $type['id']; ?>"><?php echo $type["name"]; ?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                    </div>
                                                                    <!-- <div class="mb-3 col-md-3">
                                                                    <select class="form-control" id="user_id" name="user_id" onchange="getPermission()">
                                                                        <option value="">Select User</option>
                                                                    </select>
                                                                    </div> -->
                                                                </div>
                                                                <div class="row">
                                                                    <div class="mb-3 col-md-3">
                                                                        <button type="submit" class="btn light btn-primary light">Update Permission</button>
                                                                    </div>
                                                                </div>
                                                        </div>
        									        </div>
    												<div class="tab-content" id="myTabContent">
    													<div class="tab-pane fade show active" id="Preview" role="tabpanel" aria-labelledby="home-tab">
    													 <div class="card-body pt-0">
    														<div class="table-responsive">
    															<table id="example" class="display table" style="min-width: 845px">
    																<thead>
                                                                    <tr>
                                                                        <th>#</th>
                                                                        <th>Menu Name</th>
                                                                        <th>View</th>
                                                                        <th>Add/Edit</th>
                                                                        <th>Delete</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    </tbody>
                                                                    <tfoot>
                                                                    <tr>
                                                                        <th>#</th>
                                                                        <th>Menu Name</th>
                                                                        <th>View</th>
                                                                        <th>Add/Edit</th>
                                                                        <th>Delete</th>
                                                                    </tr>
    																</tfoot>
    															</table>
    														</div>
    													</div>
    													</div>
    												</div>
                                                </form>
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
	  	    let user_id = $("#user_id").val();
            $('#example').DataTable().destroy();
            $('#example').DataTable({
                "ajax": {
                    url: "<?php echo site_url('permission/get_tables'); ?>",
                    type : 'POST',
	                data: { user_id },
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
                "iDisplayLength": 50,
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