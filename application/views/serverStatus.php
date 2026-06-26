
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
                                                        <h4 class="card-title">Server Status List</h4>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <iframe frameborder="0" name="report" style ="height: 600px;overflow-y: scroll;width: 100%;" src="<?php echo SERVER_STATUS_URL(); ?>"></iframe>
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
//         $(document).ready(function() {
//             $('#todate').val('<?php echo date('Y-m-d')?>');
//             $('#fromdate').val('<?php echo date('Y-m-d')?>');
//             getdata();
//         });
//         function getdata(){
//             $('#example').DataTable().destroy();
//             $('#example').DataTable({
//             "ajax": {
//                 url : '<?php echo base_url("downloadcenter/get_tables") ?>',
//                 type : 'GET'
//             },
//             dom: 'lfBrtip',
//             buttons: [
//                 'copy', 'excel', 'pdf'
//             ],
//             "processing": true,          
//             "order": [ 0, "desc" ],          
//             "sPaginationType": "full_numbers",
//             "language": {
//                 "search": "_INPUT_", 
//                 "searchPlaceholder": "Search",
//                 "paginate": {
//                     "next": '<i class="fa fa-angle-right"></i>',
//                     "previous": '<i class="fa fa-angle-left"></i>',
//                     "first": '<i class="fa fa-angle-double-left"></i>',
//                     "last": '<i class="fa fa-angle-double-right"></i>'
//                 }
//             }, 
//             "iDisplayLength": 10,
//             "aLengthMenu": [[10, 25, 50, 100,500,-1], [10, 25, 50,100,500,"All"]]
//         });
//     }

// function getAccountUser(user_id){
//     $.ajax({  
//         url: '<?php echo base_url('downloadcenter/getAccountList');?>',
//         method:'post',
//         data:{user_id}
//     }).done(function(data) {
//         $('#account').html(data); 
//     });
// }
	</script>
</body>
</html>