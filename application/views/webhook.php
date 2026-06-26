
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
                                                    <h4 class="card-title">DLR Webhook</h4>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                            <form action="<?php echo base_url('dlrwebhook/save');?>" method="POST" enctype="multipart/form-data">
                                                <div class="basic-form">
                                                        <div class="row">
                                                            <div class="mb-3 col-md-3">
                                                                <label class="form-label" for="user_id">Select User</label>
                                                                <select class="form-control" id="user_id" name="user_id" onchange ="getAccountUser(this.value);">
                                                                    <option value="">Select User</option>
                                                                    <?php foreach ($userList as $type ) { ?>
                                                                        <option value="<?php echo $type['id']; ?>" <?php if(isset($contentData["user_id"]) && $contentData["user_id"]==$type['id']){echo "selected";}?>><?php echo $type["name"]; ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3 col-md-3">
                                                                <label class="form-label" for="user_account_id">Select Account</label>
                                                                <select class="form-control" id="user_account_id" name="user_account_id">
                                                                    <option value="">Select Account User</option>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3 col-md-3">
                                                                <label class="form-label" for="method">Method</label>
                                                                <select class="form-control" id="method" name="method" onchange="selectCallback(this.value)">
                                                                    <!-- <option value="">Select Method</option> -->
                                                                    <?php foreach ($methodList as $type ) { ?>
                                                                        <option value="<?php echo $type['id']; ?>" <?php if(isset($contentData["method"]) && $contentData["method"]==$type['id']){echo "selected";}?>><?php echo $type["value"]; ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3 col-md-3">
                                                                <label class="form-label" for="url">Url</label>
                                                                <input type="text" class="form-control" name="url" id="url" required="required" value='<?php if(isset($contentData["url"])){echo $contentData["url"];}?>'>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <div class="mb-6 col-md-6" id="callbackBodyDiv">
                                                                <label class="form-label" for="body">Body</label>
                                                                <textarea class="form-control" name="body" id="body" required="required"><?php if(isset($contentData["body"])){echo $contentData["body"];}?></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <div class="mb-6 col-md-6">
                                                                <a href="javascript:;" class="btn btn-outline-primary btn-xs mb-1" onclick="updateData('#sender#');">APARTY</a>
                                                                <a href="javascript:;" class="btn btn-outline-info btn-xs mb-1" onclick="updateData('#receiver#');">MSISDN</a>
                                                                <a href="javascript:;" class="btn btn-outline-primary btn-xs mb-1" onclick="updateData('#httpid#');">TRANS id</a>
                                                                <a href="javascript:;" class="btn btn-outline-danger btn-xs mb-1" onclick="updateData('#status#');">DLR STATUS</a>
                                                                <a href="javascript:;" class="btn btn-outline-danger btn-xs mb-1" onclick="updateData('#dlr_time#');">DLR TIME</a>
                                                                <a href="javascript:;" class="btn btn-outline-success btn-xs mb-1" onclick="updateData('#reason#');">DLR ERR CODE</a>
                                                                <a href="javascript:;" class="btn btn-outline-warning btn-xs mb-1" onclick="updateData('#content#');">TEXT</a>
                                                                <a href="javascript:;" class="btn btn-outline-danger btn-xs mb-1" onclick="updateData('#submit_time');">SUBMIT_TIME</a>
                                                                <a href="javascript:;" class="btn btn-outline-danger btn-xs mb-1" onclick="updateData('#parts#');">PDU</a>
                                                                <a href="javascript:;" class="btn btn-outline-warning btn-xs mb-1" onclick="updateData('#correlationid');">CORREL_ID</a>
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
                                                                    <th>User Name</th>
                                                                    <th>Account User Name</th>
                                                                    <th>Method</th>
                                                                    <th>Url</th>
                                                                    <th>Body</th>
                                                                    <th>Status</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                </tbody>
                                                                <tfoot>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>User Name</th>
                                                                    <th>Account User Name</th>
                                                                    <th>Method</th>
                                                                    <th>Url</th>
                                                                    <th>Body</th>
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
        function updateData(val){
            let method = $('#method').val();
            // alert(method);
            if(method=='1'){
            let data = $('#url').val();
            var curPos = document.getElementById("url").selectionStart;
            // $('#url').val(data+val);
            $("#url").val(data.slice(0, curPos) + val + data.slice(curPos)); 
            }else if(method=='2'){
            let data = $('#body').val();
            // $('#body').val(data+val);
            var curPos = document.getElementById("body").selectionStart;
            $("#body").val(data.slice(0, curPos) + val + data.slice(curPos)); 
            }
        }

        function selectCallback(value){
            if(value == "2"){
                $("#callbackBodyDiv").show();
            }else if(value == "1"){
                $("#callbackBodyDiv").hide();
            }else{
                $("#callbackBodyDiv").hide();
            }
        }
        function getAccountUser(user_id){
            $.ajax({  
                    url: '<?php echo base_url('dlrwebhook/getAccountList');?>',
                    method:'post',
                    data:{user_id}
                }).done(function(data) {
                $('#user_account_id').html(data); 
                <?php if(isset($contentData["user_account_id"])){?>
                    $('#user_account_id').val('<?php echo $contentData["user_account_id"];?>'); 
                <?php }?>
                });
        }
        $(document).ready(function() {
            selectCallback('<?php if(isset($contentData["method"])){echo $contentData["method"];}?>');
            <?php if(isset($contentData["user_account_id"])){?>
            getAccountUser('<?php echo $contentData["user_id"];?>');
            <?php }?>
            getdata();
        });
        function getdata(){
            $('#example').DataTable().destroy();
            $('#example').DataTable({
                "ajax": {
                    url: "<?php echo site_url('dlrwebhook/get_tables'); ?>",
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