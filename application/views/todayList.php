
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

    <style type="text/css">
        ::-webkit-scrollbar {
          -webkit-appearance: none;
          width: 7px;
        }

        ::-webkit-scrollbar-thumb {
          border-radius: 4px;
          background-color: rgba(0, 0, 0, .5);
          box-shadow: 0 0 1px rgba(255, 255, 255, .5);
        }
    </style>
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
                                                    <h4 class="card-title">Daily SMS Data</h4>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                            <div class="basic-form">
                                                    <div class="row">
                                                        <div class="mb-2 col-md-2">
                                                            <label class="form-label">User Name</label>
                                                            <select class="form-control" name="user_chain" id="user_chain" required="required" onchange ="getAccountList()">
                                                                <option value="">Select User</option>
                                                                <?php foreach($userList as $user){
                                                                    echo '<option value="'.$user['user_chain'].'">'.$user['name'].'</option>';
                                                                }?>
                                                            </select>
                                                        </div>
                                                        <div class="mb-2 col-md-2">
                                                            <label class="form-label">Account</label>
                                                            <select class="form-control" name="account" id="account" required="required" onchange ="getSenderList()">
                                                                <option value="">Select Account</option>
                                                            </select>
                                                        </div>
                                                        <div class="mb-2 col-md-2">
                                                            <label class="form-label">Sender</label>
                                                            <select class="form-control" name="sender" id="sender" required="required">
                                                                <option value="">Select Sender</option>
                                                            </select>
                                                        </div>
                                                        <div class="mb-2 col-md-2">
                                                            <label class="form-label">Receiver</label>
                                                            <input type="text" class="form-control" name="receiver" id="receiver" required="required">
                                                        </div>
                                                        <div class="mb-2 col-md-2">
                                                            <label class="form-label">Date</label>
                                                            <input type="text" class="form-control mdatePicker" name="date" id="date">
                                                        </div>
                                                        <div class="row">
                                                            <div class="mb-3 col-md-3">
                                                                <button type="button" class="btn light btn-primary light" onclick="getdata();">Submit</button>
                                                            </div>
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
                                                                    <th>SQL ID</th>
                                                                    <th>Sender</th>
                                                                    <th>Receiver</th>
                                                                    <th>Account</th>
                                                                    <th>Submit Time</th>
                                                                    <th>Dlr Time</th>
                                                                    
                                                                   
                                                                    <th>Parts</th>
                                                                    <th>Entity Id</th>
                                                                    <th>Content Id</th>
                                                                    <th>Campaign</th>
                                                                    <th>Status</th>
                                                                    <th>Reason</th>
                                                                    <th>Encoding</th>
                                                                    <th>Content</th>
                                                                    <?php  if($this->session->userdata("isAdmin")){ ?>
                                                                            <th>Message Id</th>
                                                                            <th>SMSC</th>
                                                                    <?php    } ?>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                </tbody>
                                                                <tfoot>
                                                                <tr>
                                                                    <th>SQL ID</th>
                                                                    <th>Sender</th>
                                                                    <th>Receiver</th>
                                                                    <th>Account</th>
                                                                    <th>Submit Time</th>
                                                                    <th>Dlr Time</th>
                                                                   
                                                                    <th>Parts</th>
                                                                    <th>Entity Id</th>
                                                                    <th>Content Id</th>
                                                                    <th>Campaign</th>
                                                                    <th>Status</th>
                                                                    <th>Reason</th>
                                                                    <th>Encoding</th>
                                                                    <th>Content</th>
                                                                     <?php  if($this->session->userdata("isAdmin")){ ?>
                                                                            <th>Message Id</th>
                                                                            <th>SMSC</th>
                                                                    <?php    } ?>
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
            $('#date').val('<?php echo date('Y-m-d')?>');
            // $('#fromdate').val('<?php echo date('Y-m-d')?>');
            getdata();
        });
        function getdata(){
            let user_chain = $("#user_chain").val();
            let account = $("#account").val();
            let sender = $("#sender").val();
            let receiver = $("#receiver").val();
            let date = $("#date").val();
            $('#example').DataTable().destroy();
            $('#example').DataTable({
                "ajax": {
                    url : '<?php echo base_url("todaysearch/getList") ?>',
                    type : 'POST',
                    data:{user_chain,account,sender,receiver,date}
                },
                dom: 'lfBrtip',
                buttons: [
                    'copy', 'excel', 'pdf','print'
                ],
                "processing": true, 
                "scrollY": '800px',   
                "scrollX": true,
      
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
                "iDisplayLength": 25,
                "aLengthMenu": [[10, 25, 50, 100,500,-1], [10, 25, 50,100,500,"All"]]
            });
        }

        function getAccountList(){
        let user_chain = $("#user_chain").val();
        $.ajax({  
                url: "<?php echo base_url("todaysearch/getAccountList") ?>",
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