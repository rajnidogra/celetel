
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
                                                    <h4 class="card-title">SMSC List</h4>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <form action="<?php echo base_url('smsc/savekernelsmsc');?>" method="POST">
                                                    <div class="basic-form">
                                                            <div class="row">
                                                                <div class="mb-3 col-md-3">
                                                                    <label class="form-label">Instances</label>
                                                                    <input type="text" class="form-control" name="instances" id="instances" required="required" value='<?php if(isset($contentData["instances"])){echo $contentData["instances"];}else {echo "1";}?>'>
                                                                </div>
                                                                <div class="mb-3 col-md-3">
                                                                    <label class="form-label">SMSC ID</label>
                                                                    <input type="text" class="form-control" name="smsc_id" id="smsc_id" required="required" value='<?php if(isset($contentData["smsc-id"])){echo $contentData["smsc-id"];}?>'>
                                                                    <input type="hidden" class="form-control" name="smsc_id_old" id="smsc_id_old" required="required" value='<?php if(isset($contentData["smsc-id"])){echo $contentData["smsc-id"];}?>'>
                                                                </div>
                                                                <div class="mb-3 col-md-3">
                                                                    <label class="form-label">alt-charset</label>
                                                                    <select class="form-control" name="alt_charset" id="alt_charset">
                                                                        <option value="UTF-8" <?php if(isset($contentData["alt-charset"]) && $contentData["alt-charset"]=="UTF-8"){echo "selected";}?>>UTF-8</option>
                                                                        <option value="GSM-7" <?php if(isset($contentData["alt-charset"]) && $contentData["alt-charset"]=="GSM-7"){echo "selected";}?>>GSM-7</option>
                                                                        <option value="ASCII" <?php if(isset($contentData["alt-charset"]) && $contentData["alt-charset"]=="ASCII"){echo "selected";}?>>ASCII</option>
                                                                        <option value="DEFAULT" <?php if(isset($contentData["alt-charset"]) && $contentData["alt-charset"]=="DEFAULT"){echo "selected";}?>>DEFAULT</option>
                                                                    </select>
                                                                </div>
                                                                <div class="mb-3 col-md-3">
                                                                    <label class="form-label">Host</label>
                                                                    <input type="text" class="form-control" name="host" id="host" required="required" value='<?php if(isset($contentData["host"])){echo $contentData["host"];}?>'>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="mb-3 col-md-3">
                                                                    <label class="form-label">Port</label>
                                                                    <input type="text" class="form-control" name="port" id="port" required="required" value='<?php if(isset($contentData["port"])){echo $contentData["port"];}?>'>
                                                                </div>
                                                                <div class="mb-3 col-md-3">
                                                                    <label class="form-label">smsc-username</label>
                                                                    <input type="text" class="form-control" name="smsc_username" id="smsc_username" required="required" value='<?php if(isset($contentData["smsc-username"])){echo $contentData["smsc-username"];}?>'>
                                                                </div>
                                                                <div class="mb-3 col-md-3">
                                                                    <label class="form-label">smsc-password</label>
                                                                    <input type="text" class="form-control" name="smsc_password" id="smsc_password" required="required" value='<?php if(isset($contentData["smsc-password"])){echo $contentData["smsc-password"];}?>'>
                                                                </div>
                                                                <div class="mb-3 col-md-3">
                                                                    <label class="form-label">System-Type</label>
                                                                    <input type="text" class="form-control" name="system_type" id="system_type" required="required" value='<?php if(isset($contentData["system-type"])){echo $contentData["system-type"];}else {echo "SMPP";}?>'>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="mb-3 col-md-3">
                                                                    <label class="form-label">source-addr-ton</label>
                                                                    <input type="text" class="form-control" name="source_addr_ton" id="source_addr_ton" required="required" value='<?php if(isset($contentData["source-addr-ton"])){echo $contentData["source-addr-ton"];}else {echo "1";}?>'>
                                                                </div>
                                                                <div class="mb-3 col-md-3">
                                                                    <label class="form-label">source-addr-npi</label>
                                                                    <input type="text" class="form-control" name="source_addr_npi" id="source_addr_npi" required="required" value='<?php if(isset($contentData["source-addr-npi"])){echo $contentData["source-addr-npi"];}else {echo "1";}?>'>
                                                                </div>
                                                                <div class="mb-3 col-md-3">
                                                                    <label class="form-label">throughput</label>
                                                                    <input type="text" class="form-control" name="throughput" id="throughput" required="required" value='<?php if(isset($contentData["throughput"])){echo $contentData["throughput"];}else {echo "1";}?>'>
                                                                </div>
                                                                <div class="mb-3 col-md-3">
                                                                    <label class="form-label">transceiver-mode</label>
                                                                    <select class="form-control" name="transceiver_mode" id="transceiver_mode">
                                                                        <option value="TRX" <?php if(isset($contentData["transceiver-mode"]) && $contentData["transceiver-mode"]=="TRX"){echo "selected";}?>>TRX</option>
                                                                        <option value="TX" <?php if(isset($contentData["transceiver-mode"]) && $contentData["transceiver-mode"]=="TX"){echo "selected";}?>>TX</option>
                                                                        <option value="RX" <?php if(isset($contentData["transceiver-mode"]) && $contentData["transceiver-mode"]=="RX"){echo "selected";}?>>RX</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="mb-3 col-md-3">
                                                                    <label class="form-label">dest-addr-ton</label>
                                                                    <input type="text" class="form-control" name="dest_addr_ton" id="dest_addr_ton" required="required" value='<?php if(isset($contentData["dest-addr-ton"])){echo $contentData["dest-addr-ton"];}else {echo "1";}?>'>
                                                                </div>
                                                                </div>
                                                                <div class="mb-3 col-md-3">
                                                                    <label class="form-label">dest-addr-npi</label>
                                                                    <input type="text" class="form-control" name="dest_addr_npi" id="dest_addr_npi" required="required" value='<?php if(isset($contentData["dest-addr-npi"])){echo $contentData["dest-addr-npi"];}else {echo "1";}?>'>
                                                                </div>
                                                                <div class="mb-3 col-md-3">
                                                                    <label class="form-label">smsc-type</label>
                                                                    <select class="form-control" name="smsc_type" id="smsc_type">
                                                                        <option value="DF" <?php if(isset($contentData["smsc-type"]) && $contentData["smsc-type"]=="DF"){echo "selected";}?>>DF</option>
                                                                        <option value="AF" <?php if(isset($contentData["smsc-type"]) && $contentData["smsc-type"]=="AF"){echo "selected";}?>>AF</option>
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
												<div class="tab-content" id="myTabContent">
													<div class="tab-pane fade show active" id="Preview" role="tabpanel" aria-labelledby="home-tab">
													 <div class="card-body pt-0">
														<div class="table-responsive">
															<table id="example" class="display table" style="min-width: 845px">
																<thead>
                                                                <tr>
                                                                    <th>smsc-id</th>
                                                                    <th>alt-charset</th>
                                                                    <th>transceiver-mode</th>
                                                                    <th>host</th>
                                                                    <th>port</th>
                                                                    <th>smsc-username</th>
                                                                    <th>smsc-password</th>
                                                                    <th>system-type</th>
                                                                    <th>source-addr-ton</th>
                                                                    <th>source-addr-npi</th>
                                                                    <th>dest-addr-ton</th>
                                                                    <th>dest-addr-npi</th>
                                                                    <th>throughput</th>
                                                                    <th>instances</th>
                                                                    <th>Action</th>
                                                                    <th>smsc-type</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                </tbody>
                                                                <tfoot>
                                                                <tr>
                                                                    <th>smsc-id</th>
                                                                    <th>alt-charset</th>
                                                                    <th>transceiver-mode</th>
                                                                    <th>host</th>
                                                                    <th>port</th>
                                                                    <th>smsc-username</th>
                                                                    <th>smsc-password</th>
                                                                    <th>system-type</th>
                                                                    <th>source-addr-ton</th>
                                                                    <th>source-addr-npi</th>
                                                                    <th>dest-addr-ton</th>
                                                                    <th>dest-addr-npi</th>
                                                                    <th>throughput</th>
                                                                    <th>instances</th>
                                                                    <th>Action</th>
                                                                    <th>smsc-type</th>
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
            let user_type = $("#user_type").val();
	  	    let user_id = $("#user_id").val();
            $('#example').DataTable().destroy();
            $('#example').DataTable({
                "ajax": {
                    url: "<?php echo site_url('smsc/get_tables_smsckernel'); ?>",
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

	</script>
</body>
</html>
