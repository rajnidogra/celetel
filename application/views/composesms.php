
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
        /*table {width:100%; table-layout: fixed;}
        table td {word-wrap:break-word;}*/
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
                                                    <h4 class="card-title">Compose SMS</h4>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                            <form action="<?php echo base_url('composesms/savecomposedata');?>" method="POST" enctype="multipart/form-data">
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
                                                                <label class="control-label mb-10">Campaign Name</label>
                                                                <div class="input-group mb-15"> 
                                                                    <input type="text" class="form-control" name="campaignName" id="campaignName" required="required">
                                                                    <span class="input-group-btn">
                                                                    <a class="btn  btn-danger modal-trigger"  type="button" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa fa-list"></i></a>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <div class="mb-3 col-md-3">
                                                                <label class="control-label mb-10">Header</label>
                                                                <input type="text" id="header" class="form-control"  name="header" required="required">
                                                            </div>
                                                            <div class="mb-3 col-md-3">
                                                                <label class="control-label mb-10">Tracking URL</label>
                                                                <select class="form-control" name="tracking_url" id="tracking_url" onchange="getAppendData()">
                                                                <option value="">Select Tracking URL</option>
                                                                <?php foreach ($urlList as $value) {?>
                                                                    <option value="<?php echo $value['id'];?>"><?php echo $value["title"];?></option>
                                                                <?php }?>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3 col-md-3">
                                                                <label class="control-label mb-10">Account</label>
                                                                <select class="form-control" name="account" id="account" required="required">
                                                                <option value="">Select Account</option>
                                                                <?php foreach ($accountList as $value) {?>
                                                                    <option value="<?php echo $value["system_id"];?>" <?php if(isset($contentData["account"]) && $contentData["account"]==$value["system_id"]){echo "selected";}?>><?php echo $value["system_id"];?></option>
                                                                <?php }?>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3 col-md-3">
                                                                <label class="control-label mb-10">PEID</label>
                                                                <input type="text" class="form-control" name="peid" id="peid" required="required">
                                                            </div>
                                                            <div class="mb-3 col-md-3">
                                                                <label class="control-label mb-10">Content Id</label>
                                                                <input type="text" class="form-control" name="contentid" id="contentid" required="required">  
                                                            </div>
                                                            <div class="mb-6 col-md-6">
                                                                <label class="control-label mb-10">Template</label>
                                                                <textarea  rows="2" class="form-control" name="template" id="template" onkeyup="calculate();" onkeydown="calculate();" required="required"></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="mb-3 col-md-3">
                                                                <table class="table-bordered" style="margin-top: 8%;width: 100%;">
                                                                    <thead>
                                                                        <tr>
                                                                            <th width="25%" class="bold">Segments</th>
                                                                            <th width="20%" class="bold">Length</th>
                                                                            <th width="30%" class="bold">Max Segment</th>
                                                                            <th width="25%" class="bold">Encoding</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    <tr>
                                                                        <td id="segments">1</td>
                                                                        <td id="msgLength">32</td>
                                                                        <td id="smsLength">160</td>
                                                                        <td id="encoding">GSM7</td>
                                                                    </tr></tbody>
                                                                </table>
                                                            </div>
                                                            <div class="mb-9 col-md-9">
                                                                <label class="form-label mb-10">Select Receiver</label>
                                                                <div class="radio-list row">
                                                                    <div class="radio-inline pl-0 col-3">
                                                                    <span class="radio radio-info">                           
                                                                        <input type="radio" name="type" id="radio_1" value="1" onclick="selectSource(this.value);">
                                                                        <label for="radio_1">Test campaign</label>
                                                                    </span>
                                                                    </div>
                                                                    <div class="radio-inline pl-0 col-3">
                                                                    <span class="radio radio-info">                           
                                                                        <input type="radio" name="type" id="radio_2" value="2" onclick="selectSource(this.value);">
                                                                        <label for="radio_2">Quick Campaign</label>
                                                                    </span>
                                                                    </div>
                                                                    <div class="radio-inline pl-0 col-3">
                                                                    <span class="radio radio-info">                           
                                                                        <input type="radio" name="type" id="radio_3" value="3" onclick="selectSource(this.value);" type="button" data-bs-toggle="modal" data-bs-target="#fileModal">
                                                                        <label for="radio_3">File upload</label>
                                                                    </span>
                                                                    </div>
                                                                    <div class="radio-inline pl-0 col-3">
                                                                    <span class="radio radio-info">                           
                                                                        <input type="radio" name="type" id="radio_4" value="4" onclick="selectSource(this.value);">
                                                                        <label for="radio_4">Address Book</label>
                                                                    </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="mb-3 col-md-3" id="msisdnDiv">
                                                                <label class="control-label mb-10">MSISDNs</label>
                                                                <textarea class="form-control" name="msisdn" id="msisdn" onblur="getCount()"></textarea>
                                                            </div>
                                                            <div class="mb-3 col-md-3" id="fileUploadDiv">
                                                            </div>
                                                            <div class="mb-3 col-md-3" id="addressBookDiv">
                                                                <button class="btn btn-success"  type="button" data-bs-toggle="modal" data-bs-target="#addressModal" onclick="getAddressBookDat();">Select From Address Book</button>
                                                            </div>
                                                            <div class="mb-3 col-md-3">
                                                                <label class="control-label mb-10">Schedule Date</label>
                                                                <input type='text' class="form-control mdatePicker" id='schedule_date' name="schedule_date" />
                                                                <input type='hidden' class="form-control" id='group_id' name="group_id" />
                                                            </div>
                                                            <div class="mb-3 col-md-3">
                                                                <label class="control-label mb-10">Schedule Time</label>
                                                                <input type='text' class="form-control clockpicker" id='schedule_time' name="schedule_time" value="<?php date_default_timezone_set("Asia/Calcutta"); echo date("H:i")?>" />
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="mb-3 col-md-3">
                                                                <table class="table table-striped table-bordered">
                                                                    <thead>
                                                                        <tr>
                                                                            <th width="60%">Total Contacts</th>
                                                                            <th width="40%" id="ContactCount">0</th>
                                                                        <tr>
                                                                    </thead>
                                                                </table>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="mb-3 col-md-3">
                                                                <a class="btn btn-primary" onclick="showSubmitBtn();" type="button" data-bs-toggle="modal" data-original-title="test" data-bs-target="#reviewModal">Review</a>
                                                                <button type="submit" id="submitbtn" style="display: none;" class="btn light btn-primary light">Submit</button>
                                                            </div>
                                                        </div>
                                                </div>
                                            </form>
									    </div>
                                                
												<div class="tab-content" id="myTabContent">
													<div class="tab-pane fade show active" id="Preview" role="tabpanel" aria-labelledby="home-tab">
                                                        <div class="card-header flex-wrap">
                                                            <div>
                                                                <h4 class="card-title">Schedule Campaign List</h4>
                                                            </div>
                                                        </div>
                                                        <div class="card-body pt-0">
                                                            <div class="table-responsive">
                                                                <table id="example" class="display table" style="min-width: 845px">
                                                                    <thead>
                                                                    <tr>
                                                                        <th>#</th>
                                                                        <th>Header</th>
                                                                        <th>PEID</th>
                                                                        <th>Content Id</th>
                                                                        <th>Original Url</th>
                                                                        <th>Campaign Name</th>
                                                                        <th>Compose SMS</th>
                                                                        <th>Schedule Date</th>
                                                                        <th>Action</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    </tbody>
                                                                    <tfoot>
                                                                    <tr>
                                                                        <th>#</th>
                                                                        <th>Header</th>
                                                                        <th>PEID</th>
                                                                        <th>Content Id</th>
                                                                        <th>Original Url</th>
                                                                        <th>Campaign Name</th>
                                                                        <th>Compose SMS</th>
                                                                        <th>Schedule Date</th>
                                                                        <th>Action</th>
                                                                    </tr>
                                                                    </tfoot>
                                                                </table>
                                                            </div>
                                                        </div>
													</div>
												</div>
												<div class="tab-content" id="myTabContent">
													<div class="tab-pane fade show active" id="Preview" role="tabpanel" aria-labelledby="home-tab">
                                                        <div class="card-header flex-wrap">
                                                            <div>
                                                                <h4 class="card-title">Running Campaign List</h4>
                                                            </div>
                                                        </div>
                                                        <div class="card-body pt-0">
                                                            <div class="row mb-3">
                                                                <div class="box-tools col-sm-3">
                                                                    <select type="text" name="running_user_id" id="running_user_id" class="form-control" onchange="getCampaignByChain()">
                                                                        <option value="">Select User Account</option>
                                                                        <?php foreach ($userAccountList as $type ) { ?>
                                                                            <option value="<?php echo $type['user']; ?>"><?php echo $type["system_id"]; ?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </div>
                                                                <div class="box-tools col-sm-3">
                                                                    <select class="form-control" style="width: 100%;" name="campaign" onchange ="getSearch()" id="campaign">
                                                                        <option value="">Select Campaign</option>
                                                                    </select>
                                                                </div>
                                                                <div class="box-tools col-sm-3">
                                                                    <input type="text" class="form-control mdatePicker" name="todate" id="todate" onchange ="getSearch()">
                                                                </div>
                                                                <div class="box-tools col-sm-3">
                                                                    <input type="text" class="form-control mdatePicker" name="fromdate" id="fromdate" onchange ="getSearch()">
                                                                </div>
                                                                
                                                            </div>
                                                            <div class="table-responsive">
                                                                <table id="example21" class="display table" style="min-width: 845px">
                                                                    <thead>
                                                                    <tr>
                                                                        <th>#</th>
                                                                        <th>Account</th>
                                                                        <th>Header</th>
                                                                        <th>Campaign</th>
                                                                        <th>Submit Date</th>
                                                                        <th>Count</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    </tbody>
                                                                    <tfoot>
                                                                    <tr>
                                                                        <th>#</th>
                                                                        <th>Account</th>
                                                                        <th>Header</th>
                                                                        <th>Campaign</th>
                                                                        <th>Submit Date</th>
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
        $(document).ready(function(e){
            $("#fupForm").on('submit', function(e){
                // alert("test");
                $('body').append('<div class="loader-wrapper"><div class="theme-loader"><div class="loader-p"></div></div></div>');
                $('#fileModal').modal('hide');
                e.preventDefault();
                // alert("test1"+'<?php echo node_url();?>'+'file/getFileData');
                $.ajax({
                    type: 'POST',
                    url: '<?php echo node_url();?>file/getFileData',
                    data: new FormData(this),
                    dataType: 'json',
                    contentType: false,
                    cache: false,
                    processData:false,
                    success: function(result){
                    $('.loader-wrapper').hide();
                        if(result && result.data && result.data.count){
                        $("#ContactCount").html(result.data.count);
                        $("#group_id").val(result.data.id);
                        alert("File have uploaded successfully.");
                        }else{
                        alert("Error occured while uploading the file. Please try after sometime!!!");
                        window.location.reload();
                        }
                    }
                });
            });
        });
        $(document).ready(function() {
            $('#todate').val('<?php echo date('Y-m-d')?>');
            $('#fromdate').val('<?php echo date('Y-m-d')?>');
            $('#schedule_date').val('<?php echo date('Y-m-d')?>');
            getSearch();
            getModalData();
            selectSource();
            calculate();
            scheduleData();
        });

        function scheduleData(){
            $('#example').DataTable().destroy();
            $('#example').DataTable({
                "ajax": {
                    url : '<?php echo base_url("composesms/get_table") ?>',
                    type : 'GET'
                },
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
        function getCount(){
            var msisdn = $('#msisdn').val();
            var split = msisdn.split("\r");
            var split = msisdn.split("\n");
            $("#ContactCount").html(split.length);
        }
        function getSearch(){
            var todate = $("#todate").val();
            var fromdate = $("#fromdate").val();
            var user_id = $("#running_user_id").val();
            var campaign = $("#campaign").val();
            $('#example21').DataTable().destroy();
            $('#example21').DataTable({
                "footerCallback": function (row, data, start, end, display) {
                    var api = this.api(),
                    data;

                    // Remove the formatting to get integer data for summation
                    var intVal = function (i) {
                    return typeof i === 'string' ?
                        i.replace(/[\₹,]/g, '') * 1 :
                        typeof i === 'number' ?
                        i : 0;
                    };
                    pageTotal = api.column(3, {
                    page: 'current'
                    }).data().reduce(function (a, b) {
                    return intVal(a) + intVal(b);
                    }, 0);

                    // Update footer
                    $(api.column(3).footer()).html(pageTotal
                    //  '₹ '+ pageTotal +' ( ₹ '+ total +' Total)'
                    );
                },
                "ajax": {
                    url: "<?php echo site_url('composesms/get_tables_campaign_running') ?>",
                    type: 'POST',
                    data: {
                    user_id,
                    campaign,
                    todate,
                    fromdate
                    }
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
        function getModalData(){
            $('#modal2').DataTable().destroy();
            $('#modal2').DataTable({
            "ajax": {
                url : '<?php echo base_url("composesms/getCampaignList") ?>',
                type : 'GET'
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

        function gettemplateValue(id,template,peid,content,header){
            $("#temp_id").val(id);
            $("#template").val(template);
            $("#peid").val(peid);
            $("#contentid").val(content);
            $("#header").val(header);
            // calculate();
        }
        function getCampaignByChain(){
            let user_id = $('#running_user_id').val();
            $.ajax({  
                url: "<?php echo site_url('summary/getCampaignByChain'); ?>",
                method:'POST',
                data:{user_id}
                }).done(function(data) { 
                $('#campaign').html(data);
                });
        }

        function showSubmitBtn(){
            $('#submitbtn').show();
            let header = $('#header').val();
            let peid = $('#peid').val();
            let template = $('#template').val();
            let tracking_url = $('#tracking_url').val();
            let account = $('#account').val();
            let campaign_name = $('#campaignName').val();
            let sec_date = $('#schedule_date').val();
            let sec_time = $('#schedule_time').val();
            // let sec_time = $('#sec_time').val();
            let msgLength = $('#msgLength').html();
            let segments = $('#segments').html();
            let smsLength = $('#smsLength').html();
            let encoding = $('#encoding').html();
            let count = $('#ContactCount').html();

            $('#reviewHeader').html(header);
            $('#reviewPeid').html(peid);
            $('#reviewTemplate').html(template);
            $('#reviewTrackUrl').html(tracking_url);
            $('#reviewAccount').html(account);
            $('#reviewCampName').html(campaign_name);
            $('#reviewDate').html(sec_date);
            $('#reviewTime').html(sec_time);
            // $('#reviewMssidnCount').html(sec_time);
            $('#reviewMsgLength').html(msgLength);
            $('#reviewSegments').html(segments);
            $('#reviewSmsLength').html(smsLength);
            $('#reviewEncoding').html(encoding);
            $('#reviewMssidnCount').html(count);

        }
        function showLoader(){
            $('body').append('<div class="loader-wrapper"><div class="theme-loader"><div class="loader-p"></div></div></div>');
        }
        function getAppendData(){
            var track_id = $("#tracking_url").val();
            var compose_sms = $("#template").val();
            $.ajax({  
                url: "<?php echo site_url('composesms/getTrackUrlSlug') ?>",
                method:'POST',
                data:{track_id}
            }).done(function(data) {  
                $("#template").val(compose_sms+" "+data);
            });
        }
        function getContactValue(id,ContactCount){
            $("#group_id").val(id);
            // $("#contactTitle").html(contactTitle);
            $("#ContactCount").html(ContactCount);
            // $("#contactRow").show();
        }

        function selectSource(value){
            $('#msisdnDiv').hide();
            $('#fileUploadDiv').hide();
            $('#addressBookDiv').hide();
            if(value==1 || value==2){
                $('#msisdnDiv').show();
                $('#fileUploadDiv').hide();
                $('#addressBookDiv').hide();
            }
            if(value==3){
                $('#msisdnDiv').hide();
                $('#fileUploadDiv').show();
                $('#addressBookDiv').hide();
            }
            if(value==4){
                $('#msisdnDiv').hide();
                $('#fileUploadDiv').hide();
                $('#addressBookDiv').show();
            }
        }
        function getCampaignValue(id,contentid,peid,message,header,campaign_name,account,tracking_url){
            let campaign_nam = `${campaign_name}_<?php date_default_timezone_set('Asia/Kolkata'); echo date("dmyHis");?>`
            $("#camp_id").val(id);
            $("#contentid").val(contentid);
            $("#peid").val(peid);
            $("#template").val(message);
            $("#header").val(header);
            $("#campaign_name").val(campaign_nam);
            $("#campaignName").val(campaign_nam);
            $("#account").val(account);
            $("#tracking_url").val(tracking_url);
            // alert(account+tracking_url);
            calculate();
        }
        function getAddressBookDat(){
            $.ajax({  
                url: "<?php echo site_url('composesms/getContactData') ?>",
                method:'GET',
                }).done(function(data) { 
                $("#addressBookData").html(data);
                });
        }
        function calculate() {
            var message = $('#template').val().trim();
            console.log('message', message);

            const stats = smsCount(message);
            console.log('import', stats);

            $('#encoding').text(stats.unicode ? 'Unicode' : 'GSM7');
            $('#segments').text(stats.segments);
            $('#msgLength').text(stats.length);
            $('#smsLength').text(stats.maxLength);
            $('#price').text((stats.segments*0.04).toFixed(2));
            
        }

            const extractGroup = (match, group) => {
            return group;
            };

            const getSegmentPrice = (pricing = {}, country, type = 'sms') => {
            return 0.04;
            };

            const GSM7 = '\\\n @£$¥èéùìòÇØøÅåΔ_ΦΓΛΩΠΨΣΘΞ^{}\[~]|€ÆæßÉ!"#¤%&\'()*+,-./0123456789:;<=>?¡ABCDEFGHIJKLMNOPQRSTUVWXYZÄÖÑÜ§¿abcdefghijklmnopqrstuvwxyzäöñüà';

            const smsCount = (message = '') => {

            const config = {
                lengths: {
                    ascii: [160, 306, 459, 612, 765, 918, 1071, 1224, 1377, 1530, 1683, 1836, 1989, 2142, 2295, 2448, 2601, 2754, 2907, 3060, 3213, 3366, 3519, 3672, 3825, 3978, 4131, 4284, 4437, 4590],
                    unicode: [70, 134, 201, 268, 335, 402, 469, 536, 603, 670, 737, 804, 871, 938, 1005, 1072, 1139, 1206, 1273, 1340, 1407, 1474, 1541, 1608, 1675, 1742, 1809, 1876, 1943, 2010],
                }
            };

            let cutStrLength = 0;

            var
                smsType,
                smsLength = 0,
                smsCount = -1,
                charsLeft = 0,
                text = message,
                isUnicode = false;

            const breakdown = [];

            for (var charPos = 0; charPos < text.length; charPos++) {
                const item = {
                    character: text[charPos],
                    encoding: 'GSM7',
                    cost: 1,
                }
                

                switch (text[charPos]) {
                case '\n':
                case '[':
                case ']':
                case '\\':
                case '^':
                case '{':
                case '}':
                case '|':
                case '€':
                case '~':
                    
                    smsLength += 2;
                    item.cost = 2;
                    break;

                default:
                    smsLength += 1;
                }

                if (GSM7.indexOf(text[charPos]) < 0) {
                    isUnicode = true;
                    item.encoding = 'Unicode';
                }

                breakdown.push(item);
            }

            if (isUnicode) smsType = config.lengths.unicode;
            else smsType = config.lengths.ascii;

            for (var sCount = 0; sCount < 30; sCount++) {

                cutStrLength = smsType[sCount];
                if (smsLength <= smsType[sCount]) {
                    smsCount = sCount + 1;
                    charsLeft = smsType[sCount] - smsLength;
                    break;
                }
            }

            return {
                segments: smsCount,
                unicode: isUnicode,
                charsLeft,
                length: smsLength,
                maxLength: smsType[smsCount - 1],
                breakdown: breakdown,
            };
            };
	</script>
</body>
</html>
<div class="modal fade" id="exampleModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Select Campaign</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <div class="modal-body">
                    <table class="table table-striped table-bordered" id="modal2">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Campaign</th>
                            <th scope="col">Header</th>
                            <th scope="col">Template</th>
                        </tr>

                    </thead>
                </table>
            </div>
            <div class="modal-footer">
                 <!-- <button type="button" class="btn btn-info" data-bs-dismiss="modal">Close</button> -->
                <button type="button" class="btn btn-primary light" data-bs-dismiss="modal">Save changes</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="addressModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Select Address Book</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <div class="modal-body">
                    <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Contact Book Name</th>
                        <th scope="col">Counts</th>
                        </tr>

                    </thead>
                    <tbody id="addressBookData">
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                 <button type="button" class="btn btn-info" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary light" data-bs-dismiss="modal">Save changes</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="fileModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Upload File</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <div class="modal-body">
                <form id="fupForm" enctype="multipart/form-data">
                    <div class="row g-3 mb-3">
                        <div class="col-md-12">
                        <label class="control-label mb-10">Select File</label>
                        <input type="file" class="form-control" name="file" id="file">
                        <div><a href="<?php echo base_url('uploads/compose_sms.xlsx');?>" class="samplebtn">Sample File</a></div>
                        </div>
                        <input type="hidden" name="user_id" id="user_id" value="<?php echo $this->session->userdata('userId');?>">
                        <input type="hidden" name="campaign_name" id="campaign_name">
                        <input type="hidden" name="isAddressbook" name="isAddressbook" value="0">
                    </div>
                    <button type="submit" class="btn btn-primary" >Save changes</button>
                </form>
            </div>
            <div class="modal-footer">
                 <button type="button" class="btn btn-info" data-bs-dismiss="modal">Close</button>
                <!-- <button type="button" class="btn btn-primary light">Save changes</button> -->
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="reviewModal">
    <div class="modal-dialog" style="min-width: 50%; !important;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Review Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <div class="modal-body">
            <table class="table table-striped table-bordered">
              <tr>
                <th scope="col">Header</th>
                <td id="reviewHeader" style="word-wrap: break-word !important;"></td>
              </tr>
              <tr>
                <th scope="col">PEID</th>
                <td id="reviewPeid" style="word-wrap: break-word !important;"></td>
              </tr>
              <tr>
                <th scope="col">Template</th>
                <td><textarea  id="reviewTemplate" readonly="readonly" rows="10" style="width: 100%;"> </textarea></td>
              </tr>
              <tr>
                <th scope="col">Tracking URL</th>
                <td><textarea  id="reviewTrackUrl" readonly="readonly" rows="3" style="width: 100%;"> </textarea></td>
              </tr>
              <tr>
                <th scope="col">Account</th>
                <td id="reviewAccount" style="word-wrap: break-word !important;"></td>
              </tr>
              <tr>
                <th scope="col">Campaign Name</th>
                <td id="reviewCampName" style="word-wrap: break-word !important;"></td>
              </tr>
              <tr>
                <th scope="col">Schedule Date</th>
                <td id="reviewDate"></td>
              </tr>
              <tr>
                <th scope="col">Schedule Time</th>
                <td id="reviewTime"></td>
              </tr>
              <tr>
                <th scope="col">MSISDN Count</th>
                <td id="reviewMssidnCount"></td>
              </tr>
              <tr>
                <th scope="col">Message Length</th>
                <td id="reviewMsgLength"></td>
              </tr>
              <tr>
                <th scope="col">Segments</th>
                <td id="reviewSegments"></td>
              </tr>
              <tr>
                <th scope="col">SMS Length</th>
                <td id="reviewSmsLength"></td>
              </tr>
              <tr>
                <th scope="col">Encoding</th>
                <td id="reviewEncoding"></td>
              </tr>
            </tbody>
          </table>
            </div>
            <div class="modal-footer">
                 <button type="button" class="btn btn-info" data-bs-dismiss="modal">Close</button>
                <!-- <button type="button" class="btn btn-primary light">Save changes</button> -->
            </div>
        </div>
    </div>
</div>