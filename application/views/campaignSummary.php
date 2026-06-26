
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
	<?php $this->load->view('title');?>

	<link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet">
    <?php setting_css(TABLE_CSS);?>
    <!-- <link href="<?php echo base_url("assets/");?>vendor/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    <link href="<?php echo base_url("assets/");?>vendor/clockpicker/css/bootstrap-clockpicker.min.css" rel="stylesheet">
    <link href="<?php echo base_url("assets/");?>vendor/jquery-asColorPicker/css/asColorPicker.min.css" rel="stylesheet">
    <link href="<?php echo base_url("assets/");?>vendor/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url("assets/");?>vendor/pickadate/themes/default.css">
    <link rel="stylesheet" href="<?php echo base_url("assets/");?>vendor/pickadate/themes/default.date.css"> -->
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
                                                    <h4 class="card-title">Campaign Summary</h4>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                            <div class="basic-form">
                                                    <div class="row">
                                                        <div class="mb-3 col-md-3">
                                                        <select class="form-control" style="width: 100%;" name="campaign" onchange ="getdata()" id="campaign">
                                                            <option value="">Select Campaign</option>
                                                        </select>
                                                        </div>
                                                        <div class="mb-3 col-md-3">
                                                        <select type="text" name="user_id" id="user_id" class="form-control" onchange="getCampaignByChain()">
                                                            <option value="">Select User Type</option>
                                                            <?php foreach ($accountList as $type ) { ?>
                                                                <option value="<?php echo $type['user']; ?>"><?php echo $type["system_id"]; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                        </div>
                                                        <div class="mb-3 col-md-3">
                                                            <input type="text" class="form-control mdatePicker" name="fromdate" id="fromdate" onchange ="getdata()">
                                                        </div>
                                                        <div class="mb-3 col-md-3">
                                                            <input type="text" class="form-control mdatePicker" name="todate" id="todate" onchange ="getdata()">
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
                                                                    <th>Submit Date</th>
                                                                    <th>Account</th>
                                                                    <th>Campaign</th>
                                                                    <th>Delivery %</th>
                                                                    <th>Submit Count</th>
                                                                    <th>Delivery</th>
                                                                    <th>Failed</th>
                                                                    <th>Pending</th>
                                                                    <th>Nack</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    </tbody>
                                                                    <tfoot>
                                                                    <tr>
                                                                    <th colspan="4" style="text-align: center">Total</th>
                                                                    <th>Submit Count</th>
                                                                    <th>Delivery</th>
                                                                    <th>Failed</th>
                                                                    <th>Pending</th>
                                                                    <th>Nack</th>
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

    <!-- <script src="<?php echo base_url("assets/");?>vendor/moment/moment.min.js"></script>
    <script src="<?php echo base_url("assets/");?>vendor/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script src="<?php echo base_url("assets/");?>vendor/clockpicker/js/bootstrap-clockpicker.min.js"></script>
    <script src="<?php echo base_url("assets/");?>vendor/jquery-asColor/jquery-asColor.min.js"></script>
    <script src="<?php echo base_url("assets/");?>vendor/jquery-asGradient/jquery-asGradient.min.js"></script>
    <script src="<?php echo base_url("assets/");?>vendor/jquery-asColorPicker/js/jquery-asColorPicker.min.js"></script>
    <script src="<?php echo base_url("assets/");?>vendor/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>
    <script src="<?php echo base_url("assets/");?>vendor/pickadate/picker.js"></script>
    <script src="<?php echo base_url("assets/");?>vendor/pickadate/picker.time.js"></script>
    <script src="<?php echo base_url("assets/");?>vendor/pickadate/picker.date.js"></script>
    <script src="<?php echo base_url("assets/");?>js/plugins-init/bs-daterange-picker-init.js"></script>
    <script src="<?php echo base_url("assets/");?>js/plugins-init/clock-picker-init.js"></script>
    <script src="<?php echo base_url("assets/");?>js/plugins-init/jquery-asColorPicker.init.js"></script>
    <script src="<?php echo base_url("assets/");?>js/plugins-init/material-date-picker-init.js"></script>
    <script src="<?php echo base_url("assets/");?>js/plugins-init/pickadate-init.js"></script> -->
	<!-- <script src="./vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script> -->
    <!-- <script src="./js/custom.js"></script> -->
	<!-- <script src="./js/deznav-init.js"></script>
	<script src="./js/demo.js"></script> -->
    <script src="<?php echo base_url("assets/");?>js/styleSwitcher.js"></script>



   <!-- <script src="./vendor/global/global.min.js"></script> -->
    <script src="./vendor/chart.js/Chart.bundle.min.js"></script>
	<!-- Apex Chart -->
	<script src="./vendor/apexchart/apexchart.js"></script>
	<!-- code-highlight -->
	<script src="./js/highlight.min.js"></script>
	<script>
    // hljs.highlightAll();
    // hljs.configure({ ignoreUnescapedHTML: true })
	</script>
	<script>
        $(document).ready(function() {
            
            $('#todate').val('<?php echo date('Y-m-d')?>');
            $('#fromdate').val('<?php echo date('Y-m-d')?>');
            getdata();
        });
        function getdata(){
            let user_id = $('#user_id').val();
            let campaign = $('#campaign').val();
            let todate = $('#todate').val();
            let fromdate = $('#fromdate').val();
            $('#example').DataTable().destroy();
            $('#example').DataTable({
                "footerCallback": function (row, data, start, end, display) {
                var api = this.api(),data;
                var intVal = function (i) {
                    return typeof i === 'string' ? i.replace(/[\₹,]/g, '') * 1 : typeof i === 'number' ? i : 0;
                };
                pageTotal = api.column(3, { page: 'current' }).data().reduce(function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0);
                $(api.column(3).footer()).html(pageTotal);
                pageTotal = api.column(4, { page: 'current' }).data().reduce(function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0);
                $(api.column(4).footer()).html(pageTotal);
                
                pageTotal = api.column(5, { page: 'current' }).data().reduce(function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0);
                $(api.column(5).footer()).html(pageTotal);
                
                pageTotal = api.column(6, { page: 'current' }).data().reduce(function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0);
                $(api.column(6).footer()).html(pageTotal);
                
                pageTotal = api.column(7, { page: 'current' }).data().reduce(function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0);
                $(api.column(7).footer()).html(pageTotal);
            },
                "ajax": {
                    url: "<?php echo site_url('summary/campaign_summary_data'); ?>",
                    type: 'POST',
                    data: { todate, fromdate, user_id, campaign }
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

        function getCampaignByChain(){
            // getSearch();
            let user_id = $('#user_id').val();
            $.ajax({  
                url: "<?php echo site_url('summary/getCampaignByChain'); ?>",
                method:'POST',
                data:{user_id}
                }).done(function(data) { 
                $('#campaign').html(data);
                });
        }
	</script>
</body>
</html>