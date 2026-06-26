<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
	 <!-- Meta -->
     <meta charset="utf-8">
	<?php $this->load->view('title');?>
	<?php setting_css(DASHBOARD_CSS);?>
	<!-- <link href="assets/vendor/swiper/css/swiper-bundle.min.css" rel="stylesheet" type="text/css"/>	
	<link href="assets/cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.6.4/nouislider.min.css" rel="stylesheet" type="text/css"/>	
	<link href="assets/vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>	
	<link href="assets/vendor/jvmap/jquery-jvectormap.css" rel="stylesheet" type="text/css"/>	
	<link href="assets/cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css"/>	
	<link href="assets/vendor/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css"/>	
	<link href="assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet" type="text/css"/>	
	<link href="assets/css/style.css" rel="stylesheet" type="text/css"/>	 -->
</head>
<body data-typography="poppins" data-theme-version="light" data-layout="vertical" data-nav-headerbg="black" data-headerbg="color_1">

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
	***********************************-->		<!--**********************************
		Chat box start
	***********************************-->
	<?php
	//$this->load->view('chatbox');
	?>
	<!--**********************************
		Chat box End
	***********************************-->        <!--**********************************
		Header start
	***********************************-->
	<?php $this->load->view("header"); ?>
	<!--**********************************
		Header end 
	***********************************-->        <!--**********************************
		Sidebar start
	***********************************-->
	<?php $this->load->view("menu"); ?>

	<!--**********************************
		Sidebar end
	***********************************-->        <!--**********************************
		Content body start
	***********************************-->
<div class="outer-body">
	<div class="inner-body">
		<div class="content-body">
			<div class="container-fluid">
				<h3 class="head-title">Dashboard</h3>
				<div class="row">
					<div class="col-xl-12 box-warpper">
						<div class="row">
							<div class="col-xl-12">
								<div class="row">
									<div class="col-sm-3">
										<div class="card bg-primary-light">
											<div class="card-body depostit-card">
												<div class="depostit-card-media d-flex justify-content-between">
													<div>
														<h6 class="font-w400 mb-0">Today Submit</h6>
														<h3><?php echo $dailySMS["submit_count"];?></h3>
													</div>
													<!-- <div class="icon-box">
														<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
															<g clip-path="url(#clip0_71_124)">
															<path opacity="0.3" fill-rule="evenodd" clip-rule="evenodd" d="M8 3V3.5C8 4.32843 8.67157 5 9.5 5H14.5C15.3284 5 16 4.32843 16 3.5V3H18C19.1046 3 20 3.89543 20 5V21C20 22.1046 19.1046 23 18 23H6C4.89543 23 4 22.1046 4 21V5C4 3.89543 4.89543 3 6 3H8Z" fill="#252525"/>
															<path fill-rule="evenodd" clip-rule="evenodd" d="M10.875 15.75C10.6354 15.75 10.3958 15.6542 10.2042 15.4625L8.2875 13.5458C7.90417 13.1625 7.90417 12.5875 8.2875 12.2042C8.67083 11.8208 9.29375 11.8208 9.62917 12.2042L10.875 13.45L14.0375 10.2875C14.4208 9.90417 14.9958 9.90417 15.3792 10.2875C15.7625 10.6708 15.7625 11.2458 15.3792 11.6292L11.5458 15.4625C11.3542 15.6542 11.1146 15.75 10.875 15.75Z" fill="#252525"/>
															<path fill-rule="evenodd" clip-rule="evenodd" d="M11 2C11 1.44772 11.4477 1 12 1C12.5523 1 13 1.44772 13 2H14.5C14.7761 2 15 2.22386 15 2.5V3.5C15 3.77614 14.7761 4 14.5 4H9.5C9.22386 4 9 3.77614 9 3.5V2.5C9 2.22386 9.22386 2 9.5 2H11Z" fill="#252525"/>
															</g>
															<defs>
															<clipPath id="clip0_71_124">
															<rect width="24" height="24" fill="white"/>
															</clipPath>
															</defs>
														</svg>
													</div> -->
												</div>
												<!-- <div class="progress-box mt-0 custome-progress">
													<div class="d-flex justify-content-between">
														<p class="">Complete Task</p>
													</div>
													<div class="progress">
														<div class="progress-bar bg-white" style="width:60%; height:12px; border-radius:8px;" role="progressbar"></div>
													</div>
												</div> -->
											</div>
										</div>
									</div>
									<div class="col-sm-3">
										<div class="card same-card-chart bg-danger-light diposit-bg">
											<div class="card-body depostit-card p-0">
												<div class="depostit-card-media d-flex justify-content-between pb-0">
													<div>
														<h6 class="mb-0 font-w400">Today Delivered</h6>
														<h3><?php echo $dailySMS["status_delivered"];?></h3>
													</div>
													<!-- <div class="icon-box rounded-circle">
														<svg width="15" height="15" viewBox="0 0 12 20" fill="none" xmlns="http://www.w3.org/2000/svg">
															<path d="M11.4642 13.7074C11.4759 12.1252 10.8504 10.8738 9.60279 9.99009C8.6392 9.30968 7.46984 8.95476 6.33882 8.6137C3.98274 7.89943 3.29927 7.52321 3.29927 6.3965C3.29927 5.14147 4.93028 4.69493 6.32655 4.69493C7.34341 4.69493 8.51331 5.01109 9.23985 5.47964L10.6802 3.24887C9.73069 2.6333 8.43112 2.21342 7.14783 2.0831V0H4.49076V2.22918C2.12884 2.74876 0.640949 4.29246 0.640949 6.3965C0.640949 7.87005 1.25327 9.03865 2.45745 9.86289C3.37331 10.4921 4.49028 10.83 5.56927 11.1572C7.88027 11.8557 8.81873 12.2813 8.80805 13.691L8.80799 13.7014C8.80799 14.8845 7.24005 15.3051 5.89676 15.3051C4.62786 15.3051 3.248 14.749 2.46582 13.9222L0.535522 15.7481C1.52607 16.7957 2.96523 17.5364 4.4907 17.8267V20.0001H7.14783V17.8735C9.7724 17.4978 11.4616 15.9177 11.4642 13.7074Z" fill="#111828"/>
														</svg>
													</div> -->
												</div>
												<!-- <div id="NewExperience"></div> -->
											</div>
										</div>
									</div>
									<div class="col-sm-3">
										<div class="card bg-warning-light">
											<div class="card-header border-0 flex-wrap">
												<div class="revenue-date">
													<h6 class="mb-0 font-w400">Today Failed</h6>
													<h4 class=""><?php echo $dailySMS["status_failed"];?></h4>
												</div>
												<!-- <div class="avatar-list avatar-list-stacked me-2">
													<img src="assets/images/contacts/pic555.jpg" class="avatar avatar-md rounded-circle" alt="">
													<img src="assets/images/contacts/pic666.jpg" class="avatar avatar-md rounded-circle" alt="">
													<a href="app_profile_2.html"><span class="avatar avatar-md rounded-circle bg-white">25+</span></a>
												</div> -->
											</div>
											<!-- <div class="card-body pb-0 pt-0 custome-tooltip d-flex align-items-center">
												<div id="chartBar" class="chartBar"></div>
												<div class="grouth">
													<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
														<circle cx="10" cy="10" r="10" fill="white"/>
														<g clip-path="url(#clip0_3_443)">
														<path opacity="0.3" d="M13.0641 7.54535C13.3245 7.285 13.3245 6.86289 13.0641 6.60254C12.8038 6.34219 12.3817 6.34219 12.1213 6.60254L6.46445 12.2594C6.2041 12.5197 6.2041 12.9419 6.46445 13.2022C6.7248 13.4626 7.14691 13.4626 7.40726 13.2022L13.0641 7.54535Z" fill="black"/>
														<path d="M7.40729 7.26921C7.0391 7.26921 6.74062 6.97073 6.74062 6.60254C6.74062 6.23435 7.0391 5.93587 7.40729 5.93587H13.0641C13.4211 5.93587 13.7147 6.21699 13.7302 6.57358L13.9659 11.9947C13.9819 12.3626 13.6966 12.6737 13.3288 12.6897C12.961 12.7057 12.6498 12.4205 12.6338 12.0526L12.4258 7.26921H7.40729Z" fill="black"/>
														</g>
														<defs>
														<clipPath id="clip0_3_444">
														<rect width="16" height="16" fill="white" transform="matrix(-1 0 0 -1 18 18)"/>
														</clipPath>
														</defs>
													</svg>
													<span class="d-block font-w600 text-black mt-1">45%</span>
												</div>
											</div> -->
										</div>
									</div>
									<div class="col-sm-3">
										<div class="card bg-info-light">
											<div class="card-header border-0 flex-wrap">
												<div class="revenue-date">
													<h6 class="mb-0 font-w400">Total SystemID</h6>
													<h4 class=""><?php echo $totalCountUser;?></h4>
												</div>
												<!-- <a href="#" class="diposit-bg" data-bs-toggle="modal" data-bs-target="#exampleModal">
													<div class="icon-box  rounded-circle">
														<svg width="14" height="15" viewBox="0 0 14 15" fill="none" xmlns="http://www.w3.org/2000/svg">
															<path fill-rule="evenodd" clip-rule="evenodd" d="M5.83333 6.08333V1.41667C5.83333 0.772334 6.35567 0.25 7 0.25C7.64433 0.25 8.16667 0.772334 8.16667 1.41667V6.08333H12.8333C13.4777 6.08333 14 6.60567 14 7.25C14 7.89433 13.4777 8.41667 12.8333 8.41667H8.16667V13.0833C8.16667 13.7277 7.64433 14.25 7 14.25C6.35567 14.25 5.83333 13.7277 5.83333 13.0833V8.41667H1.16667C0.522334 8.41667 0 7.89433 0 7.25C0 6.60567 0.522334 6.08333 1.16667 6.08333H5.83333Z" fill="#222B40"/>
														</svg>
													</div>
												</a> -->
											</div>
											<!-- <div class="card-body pb-0 pt-0 custome-tooltip d-flex align-items-center">
												<div id="expensesChart" class="chartBar"></div>
												<div class="grouth"> 
													<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
														<circle cx="10" cy="10" r="10" fill="white"/>
														<g clip-path="url(#clip0_3_443)">
														<path opacity="0.3" d="M13.0641 7.54535C13.3245 7.285 13.3245 6.86289 13.0641 6.60254C12.8038 6.34219 12.3817 6.34219 12.1213 6.60254L6.46445 12.2594C6.2041 12.5197 6.2041 12.9419 6.46445 13.2022C6.7248 13.4626 7.14691 13.4626 7.40726 13.2022L13.0641 7.54535Z" fill="black"/>
														<path d="M7.40729 7.26921C7.0391 7.26921 6.74062 6.97073 6.74062 6.60254C6.74062 6.23435 7.0391 5.93587 7.40729 5.93587H13.0641C13.4211 5.93587 13.7147 6.21699 13.7302 6.57358L13.9659 11.9947C13.9819 12.3626 13.6966 12.6737 13.3288 12.6897C12.961 12.7057 12.6498 12.4205 12.6338 12.0526L12.4258 7.26921H7.40729Z" fill="black"/>
														</g>
														<defs>
														<clipPath id="clip0_3_443">
														<rect width="16" height="16" fill="white" transform="matrix(-1 0 0 -1 18 18)"/>
														</clipPath>
														</defs>
													</svg>
													<span class="d-block font-w600 text-black mt-1">45%</span>
												</div>
											</div> -->
										</div>
									</div>
								</div>
							</div>
							<!-- <div class="col-xl-6">
								<div class="card overflow-hidden">
									<div class="card-header border-0 pb-0 flex-wrap">
										<h4 class="card-title mb-0">Projects Overview</h4>
										<ul class="nav nav-pills mix-chart-tab" id="pills-tab" role="tablist">
											<li class="nav-item" role="presentation">
											<button class="nav-link active" data-series="week" id="pills-week-tab" data-bs-toggle="pill" data-bs-target="#pills-week" type="button" role="tab"  aria-selected="true">Week</button>
											</li>
											<li class="nav-item" role="presentation">
											<button class="nav-link" data-series="month" id="pills-month-tab" data-bs-toggle="pill" data-bs-target="#pills-month" type="button" role="tab"  aria-selected="false">Month</button>
											</li>
											<li class="nav-item" role="presentation">
											<button class="nav-link" data-series="year" id="pills-year-tab" data-bs-toggle="pill" data-bs-target="#pills-year" type="button" role="tab"  aria-selected="false">Year</button>
											</li>
											<li class="nav-item" role="presentation">
											<button class="nav-link" data-series="all" id="pills-all-tab" data-bs-toggle="pill" data-bs-target="#pills-all" type="button" role="tab" aria-selected="false">All</button>
											</li>
										</ul>
									</div>
									<div class="card-body custome-tooltip p-0">
										<div id="overiewChart"></div>
									</div>
								</div>
							</div> -->
							<!-- <div class="col-xl-3 col-md-12">
								<div class="card">
									<div class="card-header">
										<h4 class="card-title">User Profile </h4>
										<div class="dropdown custom-dropdown mb-0">
											<div class="btn sharp btn-primary light tp-btn" data-bs-toggle="dropdown">
												<svg width="6" height="15" viewBox="0 0 6 20" fill="none" xmlns="http://www.w3.org/2000/svg">
												<path d="M5.19995 10.001C5.19995 9.71197 5.14302 9.42576 5.03241 9.15872C4.9218 8.89169 4.75967 8.64905 4.55529 8.44467C4.35091 8.24029 4.10828 8.07816 3.84124 7.96755C3.5742 7.85694 3.28799 7.80001 2.99895 7.80001C2.70991 7.80001 2.4237 7.85694 2.15667 7.96755C1.88963 8.07816 1.64699 8.24029 1.44261 8.44467C1.23823 8.64905 1.0761 8.89169 0.965493 9.15872C0.854882 9.42576 0.797952 9.71197 0.797952 10.001C0.798085 10.5848 1.0301 11.1445 1.44296 11.5572C1.85582 11.9699 2.41571 12.2016 2.99945 12.2015C3.58319 12.2014 4.14297 11.9694 4.55565 11.5565C4.96832 11.1436 5.20008 10.5838 5.19995 10L5.19995 10.001ZM5.19995 3.00101C5.19995 2.71197 5.14302 2.42576 5.03241 2.15872C4.9218 1.89169 4.75967 1.64905 4.55529 1.44467C4.35091 1.24029 4.10828 1.07816 3.84124 0.967552C3.5742 0.856941 3.28799 0.800011 2.99895 0.800011C2.70991 0.800011 2.4237 0.856941 2.15667 0.967552C1.88963 1.07816 1.64699 1.24029 1.44261 1.44467C1.23823 1.64905 1.0761 1.89169 0.965493 2.15872C0.854883 2.42576 0.797953 2.71197 0.797953 3.00101C0.798085 3.58475 1.0301 4.14453 1.44296 4.55721C1.85582 4.96988 2.41571 5.20164 2.99945 5.20151C3.58319 5.20138 4.14297 4.96936 4.55565 4.5565C4.96832 4.14364 5.20008 3.58375 5.19995 3.00001L5.19995 3.00101ZM5.19995 17.001C5.19995 16.712 5.14302 16.4258 5.03241 16.1587C4.9218 15.8917 4.75967 15.6491 4.55529 15.4447C4.35091 15.2403 4.10828 15.0782 3.84124 14.9676C3.5742 14.8569 3.28799 14.8 2.99895 14.8C2.70991 14.8 2.4237 14.8569 2.15666 14.9676C1.88963 15.0782 1.64699 15.2403 1.44261 15.4447C1.23823 15.6491 1.0761 15.8917 0.965493 16.1587C0.854882 16.4258 0.797952 16.712 0.797952 17.001C0.798084 17.5848 1.0301 18.1445 1.44296 18.5572C1.85582 18.9699 2.41571 19.2016 2.99945 19.2015C3.58319 19.2014 4.14297 18.9694 4.55565 18.5565C4.96832 18.1436 5.20008 17.5838 5.19995 17L5.19995 17.001Z" fill="#000000"/>
												</svg>
											</div>
											<div class="dropdown-menu dropdown-menu-end">
												<a class="dropdown-item" href="javascript:void(0);">Option 1</a>
												<a class="dropdown-item" href="javascript:void(0);">Option 2</a>
												<a class="dropdown-item" href="javascript:void(0);">Option 3</a>
											</div>
										</div>
									</div>
									<div class="card-body">
										<div id="projectChart" class="project-chart"></div>
										<div class="project-date">
											<div class="project-media">
												<p class="mb-0">
													<svg class="me-2" width="17" height="18" viewBox="0 0 17 18" fill="none" xmlns="http://www.w3.org/2000/svg">
														<rect x="1.5" y="1.9248" width="14" height="14" rx="7" fill="white" stroke="var(--primary-light)" stroke-width="3"/>
													</svg>
													Male
												</p>
												<span>50%</span>
											</div>	
											<div class="project-media">
												<p class="mb-0">
													<svg class="me-2" width="17" height="18" viewBox="0 0 17 18" fill="none" xmlns="http://www.w3.org/2000/svg">
														<rect x="1.5" y="1.9248" width="14" height="14" rx="7" fill="white" stroke="#F4CF0C" stroke-width="3"/>
													</svg>
													Female
												</p>
												<span>20%</span>
											</div>
											<div class="project-media">
												<p class="mb-0">
													<svg class="me-2" width="17" height="18" viewBox="0 0 17 18" fill="none" xmlns="http://www.w3.org/2000/svg">
														<rect x="1.5" y="1.9248" width="14" height="14" rx="7" fill="white" stroke="#FF7C7C" stroke-width="3"/>
													</svg>
													Other
												</p>
												<span>30%</span>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-xl-9 col-md-12">
								<div class="card overflow-hidden mandal-map">
									<div class="card-header">
										<h4 class="card-title">Active users</h4>
									</div>
									<div class="card-body pt-0  ps-2">
										<div class="row">
											<div class="col-xl-8 active-map-main col-sm-7">
												<div id="world-map" class="active-map"></div>  
											</div>
											<div class="col-xl-4 impressionbox col-sm-5">
												<h4 class="card-title left-title">Weekly</h4>
												<div class="d-flex justify-content-between">
													<div class="wickly-update">
														<small>This Week</small>
														<h6 class="text-primary">+ 20%</h6>
													</div>
													<div class="wickly-update">
														<small>Last Week</small>
														<h6 class="text-warning">+ 20%</h6>
													</div>
												</div>
												<h5 class="fs-16 font-w700 mt-3">Impression</h5>
												<div id="impressionChart" class="impression"></div>
												<div class="d-flex align-items-center justify-content-between flex-wrap">
													<h5 class="mb-0 fs-18 font-w700">12.345%</h5>
													<p class="mb-0"><span class="text-primary font-w700">5.4%</span> than last year</p>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div> -->
							<div class="col-xl-12">
								<div class="card">
									<div class="card-body p-0">
										<div class="table-responsive active-projects">
											<div class="tbl-caption">
												<h4 class="card-title mb-0">Montly SMS Reports</h4>
											</div>
											<table class="table">
												<thead>
													<tr>
														<th>Month</th>
														<th>Year</th>
														<th>Submit Count</th>
														<!-- <th>Cost</th> -->
														<th>Dlr Count</th>
														<th>Status Delivered</th>
														<th>Status Failed</th>
														<th>Status Pending</th>
														<th>Status Nack</th>
													</tr>
												</thead>
												<tbody>
												<?php
                                                foreach($montlySmsReport as $report){
                                                   // $month = date("M",strtotime($report["submit_time"]));
                                                   // $urimonth = date("m",strtotime($report["submit_time"]));
                                                   // $year = date("Y",strtotime($report["submit_time"]));

                                                   $month = date('F', mktime(0, 0, 0, $report["month"], 10));
                                                   $urimonth = $report["month"];
                                                   $year = $report["year"];
                                                 ?>
													<tr>
														<td><a href="<?php echo base_url('sentDetail').'?month='.$urimonth.'&year='.$year?>"><?php echo $month;?></a></td>
														<td><?php echo $year;?></td>
														<td><a href="<?php echo base_url('sentDetail').'?month='.$urimonth.'&year='.$year?>"><?php echo $report["submit_count"];?></a></td>
														<td><?php echo $report["dlr_count"];?></td>
														<td><?php echo $report["status_delivered"];?></td>
														<td><?php echo $report["status_failed"];?></td>
														<td><?php echo $report["status_pending"];?></td>
														<td><?php echo $report["status_nack"];?></td>
													</tr>
													<?php }?>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
							<div class="col-xl-6">
								<div class="card">
									<div class="card-body p-0">
										<div class="table-responsive active-projects">
											<div class="tbl-caption">
												<h4 class="card-title mb-0">Daily SMS Reports</h4>
											</div>
											<table class="table">
												<thead>
													<tr>
														<th>Date</th>
														<th>Count</th>
														<th>Cost</th>
													</tr>
												</thead>
												<tbody>
												<?php foreach($dailySmsReport as $report){
													$date = date("Y-m-d",strtotime($report["submit_time"]));
													?>
													<tr>
														<td><a href="<?php echo base_url('sentDetail').'?date='.$date;?>"><?php echo date("d-M-Y",strtotime($report["submit_time"]));?></a></td>
														<td><a href="<?php echo base_url('sentDetail').'?date='.$date;?>"><?php echo $report["parts"];?></a></td>
														<td></td>
													</tr>
													<?php }?>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
							<div class="col-xl-6">
								<div class="card">
									<div class="card-body p-0">
										<div class="table-responsive active-projects">
											<div class="tbl-caption">
												<h4 class="card-title mb-0">Campaign Tracking Report</h4>
											</div>
											<table class="table">
												<thead>
													<tr>
														<th>Campaign ID</th>
														<th>Date</th>
														<th>Clicks</th>
													</tr>
												</thead>
												<tbody>
												<?php foreach($campaignTracking as $report){
													?>
													<tr>
														<td><?php echo $report["campaign"];?></td>
														<td><?php echo $report["campaign_date"];?></td>
														<td><?php echo $report["sumClicks"];?></td>
														<!-- <td><?php// echo $report["account"];?></td> -->
													</tr>
													<?php }?>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- <div class="calendar-warpper">
						<div class="card">
							<div class="my-calendar dz-scroll event-scroll">
								<div class="card-body schedules-cal p-2">
									<input type="text" class="form-control d-none" id="datetimepicker1">
									<div class="events">
										<h6>events</h6>
										<div class="">
											<div class="event-media">
												<div class="d-flex align-items-center">
													<div class="event-box">
														<h5 class="mb-0">20</h5>
														<span class="text-black">Tue</span>
													</div>
													<div class="event-data ms-2">
														<h5 class="mb-0"><a href="contacts.html">Development planning</a></h5>
														<span>w3it Technologies</span>
													</div>
												</div>
												<span class="">12:05 PM</span>
											</div>
											<div class="event-media">
												<div class="d-flex align-items-center">
													<div class="event-box">
														<h5 class="mb-0">03</h5>
														<span class="text-black">Wed</span>
													</div>
													<div class="event-data ms-2">
														<h5 class="mb-0"><a href="contacts.html">Desinging planning</a></h5>
														<span>w3it Technologies</span>
													</div>
												</div>
												<span class="">05:05 AM</span>
											</div>
											<div class="event-media">
												<div class="d-flex align-items-center">
													<div class="event-box">
														<h5 class="mb-0">05</h5>
														<span class="text-black">Tue</span>
													</div>
													<div class="event-data ms-2">
														<h5 class="mb-0"><a href="contacts.html">Frontend Designing</a></h5>
														<span>w3it Technologies</span>
													</div>
												</div>
												<span class="">03:06 PM</span>
											</div>
											<div class="event-media">
												<div class="d-flex align-items-center">
													<div class="event-box">
														<h5 class="mb-0">21</h5>
														<span class="text-black">Thu</span>
													</div>
													<div class="event-data ms-2">
														<h5 class="mb-0"><a href="contacts.html">Software planning</a></h5>
														<span>w3it Technologies</span>
													</div>
												</div>
												<span class="">06:05 AM</span>
											</div>	
										</div>	
									</div>
									<div class="contacts-group">	
										<div class="group-list d-flex align-items-center justify-content-between">
											<h6 class="mb-0">Contacts</h6>
											<a href="contacts.html" class="btn-link text-primary">View All</a>
										</div>	
										<div>
											<div class="friend-list1">
												<div class="d-flex">
													<a href="contacts.html">
														<div class="friend-user">
															<img src="assets/images/profile/friends/f3.jpg" class="avatar avatar-lg" alt="">
															<p>Tony</p>
														</div>
													</a>	
													<a href="contacts.html">
														<div class="friend-user">
															<img src="assets/images/contacts/pic2.jpg" class="avatar avatar-lg" alt="">
															<p>Lucas</p>
														</div>
													</a>	
													<a href="contacts.html">
														<div class="friend-user">
															<img src="assets/images/contacts/pic3.jpg" class="avatar avatar-lg" alt="">
															<p>Oliver</p>
														</div>
													</a>
													<a href="contacts.html">	
														<div class="friend-user">
															<img src="assets/images/profile/friends/f2.jpg" class="avatar avatar-lg" alt="">
															<p>Karen</p>
														</div>
													</a>	
												</div>
												<div class="d-flex">
													<a href="contacts.html">
														<div class="friend-user">
															<img src="assets/images/contacts/pic1.jpg" class="avatar avatar-lg" alt="">
															<p>Donald</p>
														</div>	
													</a>
													<a href="contacts.html">															
														<div class="friend-user">
															<img src="assets/images/contacts/d4.jpg" class="avatar avatar-lg" alt="">
															<p>Elijah</p>
														</div>
													</a>
													<a href="contacts.html">	
														<div class="friend-user">
															<img src="assets/images/profile/friends/f4.jpg" class="avatar avatar-lg" alt="">
															<p>Lucas</p>
														</div>
													</a>	
													<a href="contacts.html">
														<div class="friend-user">
															<img src="assets/images/profile/friends/f1.jpg" class="avatar avatar-lg" alt="">
															<p>Karen</p>
														</div>
													</a>	
												</div>
											</div>
										</div>
									</div>	
								</div>
							</div>
						</div>
					</div> -->
				</div>
			</div>
		</div>
		<?php $this->load->view('footer');?>
	</div>
</div>
<!-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel-2" aria-hidden="true">
	<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
		<h5 class="modal-title" id="exampleModalLabel-2">Add Expenses</h5>
		<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
			<i class="fa-solid fa-xmark"></i>
		</button>
		</div>
		<div class="modal-body">
			
			<label class="form-label d-block mb-2">Enter Name</label>
			<input type="text" class="form-control w-100 mb-3" placeholder="Enter your name">
			
			<label class="form-label d-block mb-2">Enter Amount</label>
			<input type="number" class="form-control w-100" placeholder="$">
			
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Close</button>
			<button type="button" class="btn btn-primary light">Save changes</button>
		</div>
	</div>
	</div>
</div>	
<div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel-1" aria-hidden="true">
	<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
		<h5 class="modal-title" id="exampleModalLabel-1">Add To Do Items</h5>
		<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
		<i class="fa-solid fa-xmark"></i></button>
		</div>
		<div class="modal-body">
			
			<label class="form-label d-block mb-2">Enter Title</label>
			<input type="text" class="form-control w-100 mb-3" placeholder="Enter your name">
			
			<label class="form-label d-block mb-2">Enter Amount</label>
			<input type="number" class="form-control w-100" placeholder="$">
			
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Close</button>
			<button type="button" class="btn btn-primary light">Save changes</button>
		</div>
	</div>
	</div>
</div> -->

<!--**********************************
	Content body end
***********************************-->
        
		
	</div>
	<?php setting_js(DASHBOARD_JS);?>
			<!-- <script src="assets/vendor/global/global.min.js"></script>
			<script src="assets/vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
	        <script src="assets/vendor/chart.js/Chart.bundle.min.js"></script>
            <script src="assets/vendor/apexchart/apexchart.js"></script>
            <script src="assets/js/dashboard/dashboard-1.js"></script>
            <script src="assets/vendor/draggable/draggable.js"></script>
            <script src="assets/vendor/swiper/js/swiper-bundle.min.js"></script>
            <script src="assets/vendor/tagify/dist/tagify.js"></script>
            <script src="assets/vendor/datatables/js/jquery.dataTables.min.js"></script>
            <script src="assets/vendor/datatables/js/dataTables.buttons.min.js"></script>
            <script src="assets/vendor/datatables/js/buttons.html5.min.js"></script>
            <script src="assets/vendor/datatables/js/jszip.min.js"></script>
            <script src="assets/js/plugins-init/datatables.init.js"></script>
            <script src="assets/vendor/bootstrap-datetimepicker/js/moment.js"></script>
            <script src="assets/vendor/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
            <script src="assets/vendor/jqvmap/js/jquery.vmap.min.js"></script>
            <script src="assets/vendor/jqvmap/js/jquery.vmap.world.js"></script>
            <script src="assets/vendor/jqvmap/js/jquery.vmap.usa.js"></script>
			<script src="assets/js/custom.js"></script>
			<script src="assets/js/deznav-init.js"></script>
			<script src="assets/js/demo.js"></script>
			<script src="assets/js/styleSwitcher.js"></script> -->
			<script>
		$(document).ready(function(){
			$(".nav-item .open-cal").click(function(){
			$(".calendar-warpper").toggleClass("active");
			});
		});
	</script>


    <!--**********************************
        Main wrapper end
    ***********************************-->
</body>

</html>