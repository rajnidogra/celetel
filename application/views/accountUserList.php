
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
                                                    <h4 class="card-title">Account Users List</h4>
                                                </div>
                                                <?php if(!empty($this->session->flashdata('successData'))){?>
                                                <div class="alert alert-success dark" role="alert">
                                                    <textarea id="select_txt" style="display: none;">
                                                    <?php foreach ($this->session->flashdata('successData') as $key => $value) {?>
                                                        <?php echo $key;?>:<?php echo $value;?>
                                                    <?php }?>

                                                    </textarea>
                                                    <table>
                                                    <?php foreach ($this->session->flashdata('successData') as $key => $value) {?>
                                                        <tr>
                                                        <td><?php echo $key;?></td>
                                                        <td><?php echo $value;?></td>
                                                        </tr>
                                                    <?php }?>
                                                    </table>
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="copy_data()">
                                                    <i class="fa fa-clipboard" aria-hidden="true"></i>
                                                    </button>
                                                    </div>
                                                <?php }?>
                                            </div>
                                            <div class="card-body">
                                            <form action="<?php echo base_url('accountuser/saveUserDetails');?>" method="POST" enctype="multipart/form-data">
                                                <div class="basic-form">
                                                        <div class="row">
                                                            <div class="mb-3 col-md-3">
                                                                <label class="form-label" for="user_id">Select Enterprise User</label>
                                                                <select class="form-control" id="user_id" name="user_id" required="required">
                                                                    <option value="">Select User</option>
                                                                    <?php foreach ($userList as $type ) { ?>
                                                                        <option value="<?php echo $type['id']; ?>" <?php if(isset($contentData["user_id"]) && $contentData["user_id"]==$type['id']){echo "selected";}?>><?php echo $type["name"]; ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3 col-md-3">
                                                                <label class="form-label" for="department_name">Department Name</label>
                                                                <input type="text" class="form-control" name="department_name" id="department_name" required="required" value='<?php if(isset($contentData["department_name"])){echo $contentData["department_name"];}?>'>
                                                            </div>
                                                            <div class="mb-3 col-md-3">
                                                                <label class="form-label" for="system_id">Account</label>
                                                                <input type="text" class="form-control" name="system_id" id="system_id" required="required" value='<?php if(isset($contentData["system_id"])){echo $contentData["system_id"];}?>' onkeyup="chkExist('system_id',this.value);" onkeydown="chkExist('system_id',this.value);">
                                                                <div id="msg_system_id"></div>
                                                            </div>
                                                            <div class="mb-3 col-md-3">
                                                                <label class="form-label" for="password">Password</label>
                                                                <input type="password" placeholder="Password" class="form-control" id="password" name="password">
                                                                <input type="hidden" name="oldPassword" id="oldPassword" value='<?php if(isset($contentData["password"])){echo $contentData["password"];}?>'>
                                                            </div>
                                                            <div class="mb-3 col-md-3">
                                                                <label class="form-label" for="route">Route</label>
                                                                <select class="form-control" id="route" name="route" required="required">
                                                                    <option value="">Select Route</option>
                                                                    <?php foreach($routeList as $route){ ?>
                                                                    <option value="<?php echo $route["group_id"];?>" <?php if(isset($contentData["route"]) && $contentData["route"]==$route["group_id"]){echo "selected";}?>><?php echo $route["group_id"];?></option>
                                                                    <?php }?>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3 col-md-3">
                                                                <label class="form-label" for="channel">Account Type</label>
                                                                <div class="radio-list row">
                                                                    <div class="radio-inline pl-0 col-4">
                                                                    <span class="radio radio-info">                           
                                                                        <input id="radioinline1" type="radio" name="channel" value="SMPP" onclick="selectOpt(this.value);" <?php if(isset($contentData["channel"]) && $contentData["channel"]=="SMPP"){echo "checked";}?>>
                                                                        <label for="radioinline1">SMPP</label>
                                                                    </span>
                                                                    </div>
                                                                    <div class="radio-inline pl-0 col-4">
                                                                    <span class="radio radio-info">                           
                                                                        <input id="radioinline2" type="radio" name="channel" value="WEBPANEL" onclick="selectOpt(this.value);" <?php if(isset($contentData["channel"]) && $contentData["channel"]=="WEBPANEL"){echo "checked";}?>>
                                                                        <label for="radioinline2">WEB</label>
                                                                    </span>
                                                                    </div>
                                                                    <div class="radio-inline pl-0 col-4">
                                                                    <span class="radio radio-info">                           
                                                                        <input id="radioinline3" type="radio" name="channel" value="HTTP" onclick="selectOpt(this.value);" <?php if(isset($contentData["channel"]) && $contentData["channel"]=="HTTP"){echo "checked";}?>>
                                                                        <label for="radioinline3">HTTP</label>
                                                                    </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="mb-3 col-md-3">
                                                                <label class="form-label" for="password">Session(TX/RX/TRX)</label>
                                                                <input type="text" class="form-control" id="max_binds" required="required" name="max_binds" value="<?php if(isset($contentData["max_binds"])){echo $contentData["max_binds"];}else{ echo "10";}?>">
                                                            </div>
                                                            <div class="mb-3 col-md-3">
                                                                <label class="form-label" for="password">TPS</label>
                                                                <input type="text" class="form-control" id="throughput" required="required" name="throughput" value="<?php if(isset($contentData["throughput"])){echo $contentData["throughput"];}else{ echo "500";}?>">
                                                                </div>
                                                        </div>
                                                        <div class="row allowipDiv">
                                                            <div class="mb-3 col-md-3">
                                                                <label class="form-label" for="connect_allow_ip">Allow IP</label>
                                                                <input type="text" class="form-control" id="connect_allow_ip" name="connect_allow_ip" value="<?php if(isset($contentData["connect_allow_ip"])){echo $contentData["connect_allow_ip"];}?>">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="mb-3 col-md-3">
                                                                <label class="form-label" for="dlt">DLT Type</label>
                                                                <select class="form-control" id="dlt" name="dlt">
                                                                    <option value="">Select DLT Type</option>
                                                                    <option value="0" <?php if(isset($contentData["dlt"]) && $contentData["dlt"]=="0"){echo "selected";}?>>Default</option>
                                                                    <option value="-1" <?php if(isset($contentData["dlt"]) && $contentData["dlt"]=="-1"){echo "selected";}?>>Whitelisted</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="row callbackDiv">
                                                            <div class="mb-3 col-md-3">
                                                                <label class="form-label" for="callback_method">Callback Method</label>
                                                                <select class="form-control" id="callback_method" name="callback_method" onchange="selectCallback(this.value)">
                                                                <option value="">Select Callback Method</option>
                                                                <option value="GET" <?php if(isset($contentData["callback_method"]) && $contentData["callback_method"]=="GET"){echo "selected";}?>>GET</option>
                                                                <option value="POST" <?php if(isset($contentData["callback_method"]) && $contentData["callback_method"]=="POST"){echo "selected";}?>>POST</option>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3 col-md-3">
                                                                <label class="form-label" for="callback_url">Callback URL</label>
                                                                <input type="text" class="form-control" id="callback_url" name="callback_url"  value="<?php if(isset($contentData["callback_url"])){echo $contentData["callback_url"];}?>">
                                                            </div>
                                                            <div class="mb-3 col-md-3 callbackBodyDiv">
                                                                <label class="form-label" for="callback_body">Callback Body</label>
                                                                <input type="text" class="form-control" id="callback_body" name="callback_body"  value="<?php if(isset($contentData["callback_body"])){echo $contentData["callback_body"];}?>">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="mb-3 col-md-3">
                                                                <label class="form-label" for="default_cost">Cost</label>
                                                                <input type="text" class="form-control" id="default_cost" name="default_cost"  value="<?php if(isset($contentData["default_cost"])){echo $contentData["default_cost"];}?>" required="required">
                                                            </div>
                                                            <div class="mb-3 col-md-3">
                                                                <label class="form-label" for="dlt_cost">DLT Cost</label>
                                                                <input type="text" class="form-control" id="dlt_cost" name="dlt_cost" value="<?php if(isset($contentData["dlt_cost"])){echo $contentData["dlt_cost"];}?>" required="required">
                                                            </div>
                                                            <div class="mb-3 col-md-3">
                                                                <label class="form-label" for="refund_amount">Refund</label>
                                                                <input type="text" class="form-control" id="refund_amount" name="refund_amount" value="<?php if(isset($contentData["refund_amount"])){echo $contentData["refund_amount"];}?>" required="required">
                                                            </div>
                                                            <div class="mb-3 col-md-3">
                                                                <label class="form-label" for="sender_type">Service Type</label>
                                                                <select class="form-control" id="sender_type" name="sender_type">
                                                                <option value="">Select Service Type</option>
                                                                <option value="TRANS" <?php if(isset($contentData["sender_type"]) && $contentData["sender_type"]=="TRANS"){echo "selected";}?>>Transactional</option>
                                                                <option value="PROMO" <?php if(isset($contentData["sender_type"]) && $contentData["sender_type"]=="PROMO"){echo "selected";}?>>Promotioanal</option>
                                                                <option value="ANY" <?php if(isset($contentData["sender_type"]) && $contentData["sender_type"]=="ANY"){echo "selected";}?>>Any</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <?php 
                                                            if(isset($contentData['spam'])){
                                                                $explo = mb_str_split($contentData['spam']);
                                                                // print_r($explo);
                                                                $spam0 = $explo[0];
                                                                $spam1 = $explo[1];
                                                                $receiver0 = $explo[2];
                                                                $receiver1 = $explo[3];
                                                                $sender0 = $explo[4];
                                                                $sender1 = $explo[5];
                                                                $content0 = $explo[6];
                                                                $content1 = $explo[7];
                                                            }
                                                        ?>
                                                        <div class="row">
                                                            <div class="mb-3 col-md-3">
                                                                <label class="form-label" for="spam">Spam</label>
                                                                <div class="form-group m-checkbox-inline mb-0 letter-spacing row">
                                                                <div class="checkbox checkbox-dark col-4">
                                                                    <input id="spam1" type="checkbox" name="spam[0]" value="1" <?php if(isset($spam0) && $spam0==1){echo "checked";}?>>
                                                                    <label for="spam1">Global</label>
                                                                </div>
                                                                <div class="checkbox checkbox-dark col-4">
                                                                    <input id="spam2" type="checkbox" name="spam[1]" value="1" <?php if(isset($spam1) && $spam1==1){echo "checked";}?>>
                                                                    <label for="spam2">User</label>
                                                                </div>
                                                                </div>
                                                            </div>
                                                            <div class="mb-3 col-md-3">
                                                                <label class="form-label" for="receiver">Receiver</label>
                                                                <div class="form-group m-checkbox-inline mb-0 letter-spacing row">
                                                                <div class="checkbox checkbox-dark col-4">
                                                                    <input id="receiver1" type="checkbox" name="receiver[0]" value="1" <?php if(isset($receiver0) && $receiver0==1){echo "checked";}?>>
                                                                    <label for="receiver1">Global</label>
                                                                </div>
                                                                <div class="checkbox checkbox-dark col-4">
                                                                    <input id="receiver2" type="checkbox" name="receiver[1]" value="1" <?php if(isset($receiver1) && $receiver1==1){echo "checked";}?>>
                                                                    <label for="receiver2">User</label>
                                                                </div>
                                                                </div>
                                                            </div>
                                                            <div class="mb-3 col-md-3">
                                                                <label class="form-label" for="sender">Sender Id</label>
                                                                <div class="form-group m-checkbox-inline mb-0 letter-spacing row">
                                                                <div class="checkbox checkbox-dark col-4">
                                                                    <input id="sender1" type="checkbox" name="sender[0]" value="1" <?php if(isset($sender0) && $sender0==1){echo "checked";}?>>
                                                                    <label for="sender1">Global</label>
                                                                </div>
                                                                <div class="checkbox checkbox-dark col-4">
                                                                    <input id="sender2" type="checkbox" name="sender[1]" value="1" <?php if(isset($sender1) && $sender1==1){echo "checked";}?>>
                                                                    <label for="sender2">User</label>
                                                                </div>
                                                                </div>
                                                            </div>
                                                            <div class="mb-3 col-md-3">
                                                                <label class="form-label" for="content">Content Id</label>
                                                                <div class="form-group m-checkbox-inline mb-0 letter-spacing row">
                                                                <div class="checkbox checkbox-dark col-4">
                                                                    <input id="content1" type="checkbox" name="content[0]" value="1" <?php if(isset($content0) && $content0==1){echo "checked";}?>>
                                                                    <label for="content1">Global</label>
                                                                </div>
                                                                <div class="checkbox checkbox-dark col-4">
                                                                    <input id="content2" type="checkbox" name="content[1]" value="1" <?php if(isset($content1) && $content1==1){echo "checked";}?>>
                                                                    <label for="content2">User</label>
                                                                </div>
                                                                </div>
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
                                                                    <th>#</th>
                                                                    <th>Department Name</th>
                                                                    <th>System ID</th>
                                                                    <th>Parent</th>
                                                                    <th>Route</th>
                                                                    <th>Account Type</th>
                                                                    <th>Sessions</th>
                                                                    <th>TPS</th>
                                                                    <th>Allowed IP</th>
                                                                    <th>DLT</th>
                                                                    <th>Cost</th>
                                                                    <th>DLT Cost</th>
                                                                    <th>Refund</th>
                                                                    <th>Service Type</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                </tbody>
                                                                <tfoot>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>Department Name</th>
                                                                    <th>System ID</th>
                                                                    <th>Parent</th>
                                                                    <th>Route</th>
                                                                    <th>Account Type</th>
                                                                    <th>Sessions</th>
                                                                    <th>TPS</th>
                                                                    <th>Allowed IP</th>
                                                                    <th>DLT</th>
                                                                    <th>Cost</th>
                                                                    <th>DLT Cost</th>
                                                                    <th>Refund</th>
                                                                    <th>Service Type</th>
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
        function chkExist(key,value){
            if(value.length>3){
            $.ajax({  
                url: "<?php echo site_url("accountuser/chkExist") ?>",
                method:'POST',
                data:{key,value}
                }).done(function(data) { 
                $('#msg_'+key).html(data);
                });
            }else{
            $('#msg_'+key).html('<div class="txt-danger">Please enter valid '+key+'!!!</div>');
            }

        }
        function selectCallback(value){
            if(value == "POST"){
                $(".callbackBodyDiv").show();
            }else if(value == "GET"){
                $(".callbackBodyDiv").hide();
            }else{
                $(".callbackBodyDiv").hide();
            }
        }
        function selectOpt(channel){
            if(channel == "HTTP"){
                $(".callbackDiv").show();
                $(".allowipDiv").hide();
            }else if(channel == "SMPP"){
                $(".callbackDiv").hide();
                $(".allowipDiv").show();
            }else if(channel == "WEBPANEL"){
                $(".callbackDiv").hide();
                $(".allowipDiv").hide();
            }else{
                // $(".websiteDetails").hide();
                $(".allowipDiv").hide();
            }

        }
        $(document).ready(function() { 
            selectOpt(<?php if(isset($contentData["channel"])){echo $contentData["channel"];}else{echo "";}?>);
            selectCallback(<?php if(isset($contentData["callback_method"])){echo $contentData["callback_method"];}else{echo "";}?>);
            getdata(); 
        });
        function getdata(){
            $('#example').DataTable().destroy();
            $('#example').DataTable({
                "ajax": {
                    url: "<?php echo site_url('accountuser/get_tables'); ?>",
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
        function copy_data() {
            var copyText = document.getElementById("select_txt");
            var textArea = document.createElement("textarea");
            textArea.value = copyText.value;
            document.body.appendChild(textArea);
            textArea.focus();
            textArea.select();

            try {
                var successful = document.execCommand('copy');
                var msg = successful ? 'successful' : 'unsuccessful';
                //console.log('Copying text command was ' + msg);
            } catch (err) {
                console.log('Oops, unable to copy',err);
            }

            document.body.removeChild(textArea);

        }
	</script>
</body>
</html>
