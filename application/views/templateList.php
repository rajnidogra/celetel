
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
                                                    <h4 class="card-title">Template Registration</h4>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                            <form action="<?php echo base_url('template/savetemplatedata');?>" method="POST" enctype="multipart/form-data">
                                                <div class="basic-form">
                                                        <div class="row">
                                                            <div class="mb-3 col-md-3">
                                                                <label class="form-label mb-10">Create Via</label>
                                                                <div class="radio-list row">
                                                                    <div class="radio-inline pl-0 col-4">
                                                                    <span class="radio radio-info">                           
                                                                        <input type="radio" name="type" id="create_by_1" value="1" onclick="divHideShow(this.value);" data-bs-original-title="" title="">
                                                                        <label for="create_by_1">File</label>
                                                                    </span>
                                                                    </div>
                                                                    <div class="radio-inline pl-0 col-4">
                                                                    <span class="radio radio-info">                           
                                                                        <input type="radio" name="type" id="create_by_2" value="2" onclick="divHideShow(this.value);" data-bs-original-title="" title="">
                                                                        <label for="create_by_2">Manual</label>
                                                                    </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row manualDiv">
                                                            <div class="mb-3 col-md-3">
                                                                <label class="form-label mb-10" for="header">Template name</label>
                                                                <input type="text" class="form-control" name="template_name" id="template_name" required="required" value="<?php if(isset($contentData['template_name'])){echo $contentData['template_name'];}?>">
                                                            </div>
                                                            <div class="mb-3 col-md-3">
                                                                <label class="form-label mb-10" for="header">Header</label>
                                                                <input type="text" class="form-control" name="header" id="header" required="required" value="<?php if(isset($contentData['header'])){echo $contentData['header'];}?>">
                                                            </div>
                                                            <div class="mb-3 col-md-3">
                                                                <label class="form-label" for="peid">PEID</label>
                                                                <input type="text" class="form-control" name="peid" id="peid" required="required" value="<?php if(isset($contentData['peid'])){echo $contentData['peid'];}?>">
                                                            </div>
                                                            <div class="mb-3 col-md-3">
                                                                <label class="form-label" for="contentid">Content Id</label>
                                                                <input type="text" class="form-control" name="contentid" id="contentid" required="required" value="<?php if(isset($contentData['contentid'])){echo $contentData['contentid'];}?>">
                                                            </div>
                                                        </div>
                                                        <div class="row manualDiv">
                                                            <div class="mb-3 col-md-3">
                                                                <label class="form-label" for="template">Template</label>
                                                                <!-- <input type="text" class="form-control" name="template" id="template" required="required" value="<?php if(isset($contentData['template'])){echo $contentData['template'];}?>"> -->
                                                                <textarea class="form-control" name="template" id="template" required="required"><?php if(isset($contentData['template'])){echo $contentData['template'];}?></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="row" id="fileDiv">
                                                            <div class="mb-3 col-md-3">
                                                                <label class="form-label">File</label>
                                                                <input type="file" class="form-control" name="image" id="image">
                                                                <a href="<?php echo base_url('uploads/template.csv')?>">Sample CSV</a></br>
                                                                <span style="color:red">Note: Please use Header Line Also.</span>
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
                                                                    <th>Id</th>
                                                                    <th>Template Name</th>
                                                                    <th>Header</th>
                                                                    <th>Peid</th>
                                                                    <th>Content Id</th>
                                                                    <th>Template</th>
                                                                    <th>Creation Time</th>
                                                                    <th>Status</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                </tbody>
                                                                <tfoot>
                                                                <tr>
                                                                    <th>Id</th>
                                                                    <th>Template Name</th>
                                                                    <th>Header</th>
                                                                    <th>Peid</th>
                                                                    <th>Content Id</th>
                                                                    <th>Template</th>
                                                                    <th>Creation Time</th>
                                                                    <th>Status</th>
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
            $('#example').DataTable().destroy();
            $('#example').DataTable({
                "ajax": {
                    url: "<?php echo site_url('template/getList'); ?>",
                    type : 'GET',
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

	</script>
</body>
</html>