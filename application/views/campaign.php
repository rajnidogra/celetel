
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
                                                    <h4 class="card-title">Campaign Registration</h4>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                            <form action="<?php echo base_url('campaign/saveCampaignData');?>" method="POST" enctype="multipart/form-data">
                                                <div class="basic-form">
                                                        <!-- <div class="row">
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
                                                        </div> -->
                                                        <div class="row">
                                                            <div class="mb-3 col-md-3">
                                                                <label class="form-label mb-10">Campaign Name</label>
                                                                <input type="text" class="form-control" name="campaign_name" id="campaign_name" value="<?php if(isset($contentData['campaign_name'])){echo $contentData['campaign_name'];}?>">
                                                            </div>
                                                            <div class="mb-3 col-md-3">
                                                                <label class="form-label mb-10">Account</label>
                                                                <select class="form-control" name="account" id="account">
                                                                    <option value="">Select Account</option>
                                                                    <?php foreach ($accountList as $value) {?>
                                                                        <option value="<?php echo $value["system_id"];?>" <?php if(isset($contentData["account"]) && $contentData["account"]==$value["system_id"]){echo "selected";}?>><?php echo $value["system_id"];?></option>
                                                                    <?php }?>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3 col-md-3">
                                                                <label class="form-label">Header</label>
                                                                <div class="input-group mb-15"> 
                                                                    <input type="text" id="header" class="form-control"  name="header" value="<?php if(isset($contentData["header"])){echo $contentData["header"];}?>">
                                                                    <span class="input-group-btn">
                                                                    <a class="btn  btn-danger modal-trigger"  type="button" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa fa-list"></i></a>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <div class="mb-3 col-md-3">
                                                                <label class="form-label">Tracking URL</label>
                                                                <select class="form-control" name="tracking_url" id="tracking_url" onchange="getAppendData()">
                                                                    <option value="">Select Tracking URL</option>
                                                                    <?php foreach ($urlList as $value) {?>
                                                                        <option value="<?php echo $value['id'];?>" <?php if(isset($contentData['tracking_url']) && $contentData['tracking_url']==$value['id']){echo 'selected';}?>><?php echo $value["title"];?></option>
                                                                    <?php }?>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3 col-md-3">
                                                                <label class="form-label" for="peid">PEID</label>
                                                                <input type="text" class="form-control" name="peid" id="peid" required="required" value="<?php if(isset($contentData['peid'])){echo $contentData['peid'];}?>">
                                                            </div>
                                                            <div class="mb-3 col-md-3">
                                                                <label class="form-label" for="contentid">Content Id</label>
                                                                <input type="text" class="form-control" name="contentid" id="contentid" value="<?php if(isset($contentData["template"])){echo $contentData["template"];}?>">
                                                            </div>
                                                            <div class="mb-3 col-md-3">
                                                                <label class="form-label">Template</label>
                                                                <textarea class="form-control" name="template" id="template" rows="5"><?php if(isset($contentData["message"])){echo $contentData["message"];}?></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="mb-3 col-md-3">
                                                                <input type="hidden" name="eid" value="<?php if(isset($contentData["id"])){echo $contentData["id"];}?>">
                                                                <input type="hidden" name="temp_id" id="temp_id">
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
                                                                    <th width="5%">ID</th>
                                                                    <th width="10%">Campaign Name</th>
                                                                    <th width="8%">Header</th>
                                                                    <th width="5%">PEID</th>
                                                                    <th width="10%">Template</th>
                                                                    <th width="25%">Message</th>
                                                                    <th width="5%">Account</th>
                                                                    <th width="15%">Tracking URL</th>
                                                                    <th width="10%">Created Date</th>
                                                                    <th width="5%">Action</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                </tbody>
                                                                <tfoot>
                                                                <tr>
                                                                    <th width="5%">ID</th>
                                                                    <th width="10%">Campaign Name</th>
                                                                    <th width="8%">Header</th>
                                                                    <th width="5%">PEID</th>
                                                                    <th width="10%">Template</th>
                                                                    <th width="25%">Message</th>
                                                                    <th width="5%">Account</th>
                                                                    <th width="15%">Tracking URL</th>
                                                                    <th width="10%">Created Date</th>
                                                                    <th width="5%">Action</th>
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
        function getAppendData(){
            var track_id = $("#tracking_url").val();
            var compose_sms = $("#template").val();
            $.ajax({  
                url: "<?php echo site_url('composesms/getTrackUrlSlug') ?>",
                method:'POST',
                data:{track_id}
            }).done(function(data) {  
                // alert(data);
                $("#template").val(compose_sms+" "+data);
                // $('#system_id').html(data);
            });
        }
        $(document).ready(function() {
            // $("#create_by_2").prop("checked", true);
            // <?php if(isset($contentData["id"])){?>
            // $("#create_by_1").prop("disabled", true);
            // <?php }?>
            // divHideShow(2);
            // $('#date').val('<?php echo date('Y-m-d')?>');
            // $('#fromdate').val('<?php echo date('Y-m-d')?>');
            getdata();
            getModalData();
        });
        function getdata(){
            $('#example').DataTable().destroy();
            $('#example').DataTable({
                "ajax": {
                    url: "<?php echo site_url('campaign/getList'); ?>",
                    type : 'GET',
                },
                dom: 'lfBrtip',
                buttons: [
                    'copy', 'excel', 'pdf','print'
                ],
                "processing": true,  
                scrollX: true,        
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
        function getModalData(){
            $('#modal2').DataTable().destroy();
            $('#modal2').DataTable({
            "ajax": {
                url : '<?php echo base_url("campaign/getTemplateList") ?>',
                type : 'GET'
                },
                dom: 'lfBrtip',
                buttons: [
                    'copy', 'excel', 'pdf','print'
                ],
                "processing": true,  
                scrollX: true,        
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

    function gettemplateValue(id,template,peid,content,header){
        $("#temp_id").val(id);
        $("#template").val(template);
        $("#peid").val(peid);
        $("#contentid").val(content);
        $("#header").val(header);
        // calculate();
    }
	</script>
</body>
</html>

<div class="modal fade" id="exampleModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Select Template</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-striped table-bordered" id="modal2">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Template Name</th>
                        <th scope="col">Header</th>
                        <th scope="col">Template</th>
                    </tr>
                    </thead>
                    <tbody id="bindData"></tbody>
            </table>
            </div>
            <div class="modal-footer">
                 <button type="button" class="btn btn-info" data-bs-dismiss="modal">Save changes</button>
                <!-- <button type="button" class="btn btn-primary light">Save changes</button> -->
            </div>
        </div>
    </div>
</div>