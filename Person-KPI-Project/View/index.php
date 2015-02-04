<? session_start(); ob_start();?>
<?php include_once '../config.inc.php';?>
<?php 

if(($_SESSION['emp_id']=="") and ($_SESSION['admin_id']=="")){
	header( "location: ../login.php" );
	echo "redirect";
	exit(0);	
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../docs-assets/ico/favicon.png">
    <title>KPI (Key Performance Indicators)</title>
	
    <!-- Bootstrap core CSS -->
    <link href="../bootstrap-3.0.2/css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../Css/starter-template.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../docs-assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
      <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../kendoCommercial/js/jquery.min.js"></script>
    <script src="../bootstrap-3.0.2/js/bootstrap.min.js"></script>
    
    
<!-- Don't touch this!  jplot-->
<!-- 
	<link class="include" rel="stylesheet" type="text/css" href="../jqPlot/jquery.jqplot.min.css" />
    <link type="text/css" rel="stylesheet" href="../jqPlot/syntaxhighlighter/styles/shCoreDefault.min.css" />
    <link type="text/css" rel="stylesheet" href="../jqPlot/syntaxhighlighter/styles/shThemejqPlot.min.css" />
    <script class="include" type="text/javascript" src="../jqPlot/jquery.jqplot.min.js"></script>
    <script type="text/javascript" src="../jqPlot/examples/syntaxhighlighter/scripts/shCore.min.js"></script>
    <script type="text/javascript" src="../jqPlot/examples/syntaxhighlighter/scripts/shBrushJScript.min.js"></script>
    <script type="text/javascript" src="../jqPlot/examples/syntaxhighlighter/scripts/shBrushXml.min.js"></script>
   <script class="include" type="text/javascript" src="../jqPlot/plugins/jqplot.meterGaugeRenderer.min.js"></script>
 -->
<!-- End additional plugins jplot-->
<!-- start load script jplot-->
	<link class="include" rel="stylesheet" type="text/css" href="../jqPlot/jquery.jqplot.min.css" />
    <link type="text/css" rel="stylesheet" href="../jqPlot/examples/syntaxhighlighter/styles/shCoreDefault.min.css" />
    <link type="text/css" rel="stylesheet" href="../jqPlot/examples/syntaxhighlighter/styles/shThemejqPlot.min.css" />	
    <script class="include" type="text/javascript" src="../jqPlot/jquery.jqplot.min.js"></script>
    <script type="text/javascript" src="../jqPlot/examples/syntaxhighlighter/scripts/shCore.min.js"></script>
    <script type="text/javascript" src="../jqPlot/examples/syntaxhighlighter/scripts/shBrushJScript.min.js"></script>
    <script type="text/javascript" src="../jqPlot/examples/syntaxhighlighter/scripts/shBrushXml.min.js"></script>
   <script class="include" type="text/javascript" src="../jqPlot/plugins/jqplot.meterGaugeRenderer.min.js"></script>
   <script type="text/javascript" src="../jqPlot/plugins/jqplot.pieRenderer.min.js"></script>

   <script type="text/javascript" src="../jqPlot/plugins/jqplot.barRenderer.min.js"></script>
   <script type="text/javascript" src="../jqPlot/plugins/jqplot.categoryAxisRenderer.min.js"></script>
   <script type="text/javascript" src="../jqPlot/plugins/jqplot.pointLabels.min.js"></script>
   <script type="text/javascript" src="../jqPlot/plugins/jqplot.pieRenderer.min.js"></script>
   <script type="text/javascript" src="../Controller/jquery.form.min.js"></script>

<!-- end load script jplot-->
<!--start morris script -->
  <script src="https://raw.github.com/DmitryBaranovskiy/raphael/300aa589f5a0ba7fce667cd62c7cdda0bd5ad904/raphael-min.js"></script>
  <script src="../morris.js-0.4.3/morris.js"></script>
  <script src="../morris.js-0.4.3/examples/lib/prettify.js"></script>
  <script src="../morris.js-0.4.3/examples/lib/example.js"></script>
  <link rel="stylesheet" href="../morris.js-0.4.3/examples/lib/prettify.css">
  <link rel="stylesheet" href="../morris.js-0.4.3/morris.css">
<!--end morris script start -->

	 <!-- full screen plugin start -->
	 <script type="text/javascript" src="../jquery-fullscreen/jquery.fullscreen-min.js"></script>
	 <!-- full screen plugin end -->

    <!--start kendo ui -->
    
    <link href="../kendoCommercial/styles/kendo.common.min.css" rel="stylesheet" />
    <link href="../kendoCommercial/styles/kendo.default.min.css" rel="stylesheet" />
    <script src="../kendoCommercial/js/angular.min.js"></script>
    <script src="../kendoCommercial/js/kendo.all.min.js"></script>
     <!-- easy pie chart start -->
 	<script src="../easy-pie-chart/dist/jquery.easypiechart.min.js"></script>
	 <!-- easy pie chart end -->
	 
	 <!--  library function chart start -->

	<script type="text/javascript" src="../Controller/initial.js"></script> 
	<script type="text/javascript" src="../Controller/cBarChart.js"></script> 
	<script type="text/javascript" src="../Controller/cBarChartHorizontal.js"></script>
	<script type="text/javascript" src="../Controller/cDonutChart.js"></script>
	<script type="text/javascript" src="../Controller/cLineChart.js"></script>
	<script type="text/javascript" src="../Controller/cPieChart.js"></script>
	<script type="text/javascript" src="../Controller/cBarLineChart.js"></script>
	<script type="text/javascript" src="../Controller/cGaugeChart.js"></script>
	<script type="text/javascript" src="../Controller/cMap.js"></script>
	<script type="text/javascript" src="../Controller/cTable.js"></script>
	<script type="text/javascript" src="../Controller/mainJs.js"></script>
	
	<!--  library function chart end -->

    <script src="../Controller/main.js"></script>
    
    
    <!-- start jquery.flot-->
    <!--[if lte IE 8]><script language="javascript" type="text/javascript" src="../flot-flot-0.8.1-58/excanvas.min.js"></script><![endif]-->
	<!-- 
	<script language="javascript" type="text/javascript" src="../flot-flot-0.8.1-58/jquery.flot.js"></script>
	<script language="javascript" type="text/javascript" src="../flot-flot-0.8.1-58/jquery.flot.pie.js"></script>
	<script language="javascript" type="text/javascript" src="../flot-flot-0.8.1-58/jquery.flot.categories.js"></script>
	 -->

	<!--  start jquery.flot-->
	<!-- spark line start -->
	<script src="../sparkLine/jquery.sparkline.min.js"></script>
	<!-- spark line end -->
	
	<!-- start jqueryui -->
	<link rel="stylesheet" href="../jquery-ui/css/cupertino/jquery-ui-1.10.3.custom.min.css">
	<script src="../jquery-ui/js/jquery-ui-1.10.3.custom.min.js"></script>
	<!-- end jqueryui -->
	
	<!-- start gantt chart -->
	<link rel="stylesheet" href="../gattChartjQuery/css/style.css" />
	<script src="../gattChartjQuery/js/jquery.fn.gantt.js"></script>
	<!-- end gantt chart -->
	<!-- start main css -->
	
	
	
	<link rel="stylesheet" href="../Css/main.css">
	
	<!--  end main css-->
    <style>
   .k-grid td{
   	/*padding:0px;*/
   }
    </style>
    <!--end kendo ui -->
    <!--  css customize -->
    <link href="../Css/executive.css" rel="stylesheet">
    <!--  css customize -->
    <script>
    var withdrawEnlargeCom=function(thisParam){
		    $("#slideLeft").css({"width":"200px"});
		$(".sidebar-background").css({"width":"200px"});
		$("#mainContent").css({"margin-left":"201px"});
		$(thisParam).addClass("active");
		$(".menu-text").show();
		$(".boxTitle").css({"width":"200px"});
		$(".boxLeftTopSmall").hide();
		$(".boxLeftTopLarge").show();
		$(".subMenu").removeClass("submenuHover").css({"padding-left":"5px"});
		$("#slideLeft").show();
	  };
	var moblieFn = function(){
		 $(".topParameter .box1").css({
			    "width":"100%",
				"margin-top":"2px"
		   });
		   $(".topParameter .box2").css({
			    "width":"100%",
				"margin-top":"2px"
		   });
		   $(".topParameter .box3").css({
			    "width":"100%",
				"margin-top":"2px"
		   });
		   $(".topParameter .box4").css({
			    "width":"100%",
				"margin-top":"2px"
		   });
		  // $("#slideLeft").show();
	}
	var computerFn = function(){
		
		 	$(".topParameter .box1").css({
			    "width":"110px",
				"margin-top":"2px",
				"float":"left"
		   });
		   $(".topParameter .box2").css({
			    "width":"90px",
				"margin-top":"2px",
				"float":"left"
		   });
		   $(".topParameter .box3").css({
			    "width":"90px",
				"margin-top":"2px",
				"float":"left"
		   });
		   $(".topParameter .box4").css({
			    "width":"90px",
				"margin-top":"2px",
				"float":"left"
		   });
		  withdrawEnlargeCom(this);
		 //  $("#slideLeft").show();
	}
	var widthWindow=$(window).width();
	//alert(widthWindow);
	$(window).resize(function(){
		
		var widthWindowPercentage= (parseFloat($(window).width())/parseFloat(widthWindow))*100;
		
		/*console.log(widthWindowPercentage+"%");*/
		/*widthWindowPercentage=(widthWindowPercentage);*/
		//console.log(widthWindowPercentage+"%");
		//$(".KpiPerspective").css({"min-width":(widthWindowPercentage+60)+"px"});
		if($(window).width() < 980){
			
			$(".KpiPerspective").css({"min-width":"100px"});
		}
		 if($(window).width() > 980){
			$(".KpiPerspective").css({"min-width":"160px"});
		}
	});
	
   	$(window).resize(function(){
	   if($(window).width()<980){
		   //console.log($(window).width()); 
		   $("#slideLeft").hide();
		   $(".boxTitle").hide();
		   $(".sidebar-background").hide();
		   $("#mainContent").css({"margin-left":"0px"});
		   moblieFn();

	   }else{
		   $("#slideLeft").show();
		   $("#mainContent").css({"margin-left":"201px"});
		   $(".boxTitle").show();
		   $(".sidebar-background").show();
		   computerFn();
	   }
   	});
   	

   </script>
   <style>
   /*
  	ul.subMenu{
  	padding:0px;
  	margin:0px;
  	margin-top:10px;
  	
  	}
	ul.subMenu  li{
	//border-top:1px solid #cccccc;
	display:block;
	padding-top:5px;
	padding-bottom:5px;
	}
	ul.subMenu  li{
	border-left:1px solid #cccccc;
	}
	ul.subMenu  li .dash a {
	
	}
	ul.subMenu  li .dash a:hover{
	background:#cccccc;
	display:block;
	}
	ul.subMenu  li .dash{
	hieght:1px;
	border-top:1px #cccccc solid;
	width:20px;
	//background:red;
	padding:0px;
	margin:0px;
	position:relative;
	top:10px;
	}
	.navList{
	float:right;
	border:1px solid #cccccc;
	font-size:10px;
	width:10px;
	height:10px;
	padding:0px;
	margin:0px;
	position:relative;
	top:7px;
	}
	.boxLeft{
	margin-left:10px;
	padding-top: 5px;
	}
	*/
   </style>
  </head>

  <body>
<script type="text/javascript">
   $(document).ready(function(){
	   
		
   });
   
</script>

												
 	
    <div class="navbar navbar-blue navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header" >
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#" > <span class="iconMenu glyphicon glyphicon-dashboard"></span> Key Performance Indicators</a>
        </div>
        
        <div class="collapse navbar-collapse">
       	
          
          <ul class="nav navbar-nav navbar-right">
          <!-- 
            <li class="active boxNav">
	            <button class="boxB btn btn-success" data-toggle="dropdown">
					<i class="glyphicon glyphicon-hdd"></i>
				</button>
				
				
				<ul class="pull-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
					<li class="dropdown-header">
					<i class="icon-ok"></i>
					4 Tasks to complete
					</li>
					<li>
					<a href="#">
					<div class="clearfix">
					<span class="pull-left">Software Update</span>
					<span class="pull-right">65%</span>
					</div>
					<div class="progress progress-mini ">
					<div class="progress-bar " style="width:65%"></div>
					</div>
					</a>
					</li>
					<li>
					<a href="#">
					<div class="clearfix">
					<span class="pull-left">Hardware Upgrade</span>
					<span class="pull-right">35%</span>
					</div>
					<div class="progress progress-mini ">
					<div class="progress-bar progress-bar-danger" style="width:35%"></div>
					</div>
					</a>
					</li>
					<li>
					<a href="#">
					<div class="clearfix">
					<span class="pull-left">Unit Testing</span>
					<span class="pull-right">15%</span>
					</div>
					<div class="progress progress-mini ">
					<div class="progress-bar progress-bar-warning" style="width:15%"></div>
					</div>
					</a>
					</li>
					<li>
					<a href="#">
					<div class="clearfix">
					<span class="pull-left">Bug Fixes</span>
					<span class="pull-right">90%</span>
					</div>
					<div class="progress progress-mini progress-striped active">
					<div class="progress-bar progress-bar-success" style="width:90%"></div>
					</div>
					</a>
					</li>
					<li>
					<a href="#">
					See tasks with details
					<i class="icon-arrow-right"></i>
					</a>
					</li>
				</ul>
				 
			</li>
            <li class="boxNav">
            	
            	<button class="boxB btn btn-info" data-toggle="dropdown">
					<i class="glyphicon glyphicon-indent-left"></i>
				</button>
				
            	<ul class="pull-right dropdown-navbar navbar-pink dropdown-menu dropdown-caret dropdown-close">
					<li class="dropdown-header">
						<i class="icon-warning-sign"></i>
						8 Notifications
					</li>

					<li>
						<a href="#">
							<div class="clearfix">
								<span class="pull-left">
									<i class="btn btn-xs no-hover btn-pink icon-comment"></i>
									New Comments
								</span>
								<span class="pull-right badge badge-info">+12</span>
							</div>
						</a>
					</li>

					<li>
						<a href="#">
							<i class="btn btn-xs btn-primary icon-user"></i>
							Bob just signed up as an editor ...
						</a>
					</li>

					<li>
						<a href="#">
							<div class="clearfix">
								<span class="pull-left">
									<i class="btn btn-xs no-hover btn-success icon-shopping-cart"></i>
									New Orders
								</span>
								<span class="pull-right badge badge-success">+8</span>
							</div>
						</a>
					</li>

					<li>
						<a href="#">
							<div class="clearfix">
								<span class="pull-left">
									<i class="btn btn-xs no-hover btn-info icon-twitter"></i>
									Followers
								</span>
								<span class="pull-right badge badge-info">+11</span>
							</div>
						</a>
					</li>

					<li>
						<a href="#">
							See all notifications
							<i class="icon-arrow-right"></i>
						</a>
					</li>
				</ul>
				
            </li>
            <li class="boxNav">
            	
            	<button class="boxB btn btn-warning">
					<i class="glyphicon glyphicon-lock"></i>
				</button>
            	
            </li>
             <li class="boxNav">
            	
            	<button class="boxB btn btn-danger" data-toggle="dropdown">
					<i class="glyphicon glyphicon-list-alt"></i>
				</button>
				
				<ul class="pull-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
					<li class="dropdown-header">
						<i class="icon-envelope-alt"></i>
						5 Messages
					</li>

					<li>
						<a href="#">
							<img alt="Alex's Avatar" class="msg-photo" src="assets/avatars/avatar.png">
							<span class="msg-body">
								<span class="msg-title">
									<span class="blue">Alex:</span>
									Ciao sociis natoque penatibus et auctor ...
								</span>

								<span class="msg-time">
									<i class="icon-time"></i>
									<span>a moment ago</span>
								</span>
							</span>
						</a>
					</li>

					<li>
						<a href="#">
							<img alt="Susan's Avatar" class="msg-photo" src="assets/avatars/avatar3.png">
							<span class="msg-body">
								<span class="msg-title">
									<span class="blue">Susan:</span>
									Vestibulum id ligula porta felis euismod ...
								</span>

								<span class="msg-time">
									<i class="icon-time"></i>
									<span>20 minutes ago</span>
								</span>
							</span>
						</a>
					</li>

					<li>
						<a href="#">
							<img alt="Bob's Avatar" class="msg-photo" src="assets/avatars/avatar4.png">
							<span class="msg-body">
								<span class="msg-title">
									<span class="blue">Bob:</span>
									Nullam quis risus eget urna mollis ornare ...
								</span>

								<span class="msg-time">
									<i class="icon-time"></i>
									<span>3:15 pm</span>
								</span>
							</span>
						</a>
					</li>

					<li>
						<a href="inbox.html">
							See all messages
							<i class="icon-arrow-right"></i>
						</a>
					</li>
				</ul>
            	 
            </li>
           -->
           
           
            <li class="dropdown">
			<a class="dropdown-toggle" href="#" data-toggle="dropdown">
					
					<?php 
					// GET EMPLOYEE FOR DISPLAY HERE..
					if($_SESSION[emp_ses_id]!=""){
					$strSQLEmp="select * from employee where emp_id=$_SESSION[emp_ses_id]";
					$resultEmp=mysql_query($strSQLEmp);
					$rsEmp=mysql_fetch_array($resultEmp);
						//echo $rsEmp['emp_picture_thum'];
					$role="emp";
					?>
					<img src="<?=$rsEmp['emp_picture_thum']?>" width="45" class="img-circle">
					<strong>Emp ID(<?=$rsEmp['emp_id']?>)</strong><?=$rsEmp['emp_name']?>
					<input type="hidden" name="emp_id" id="emp_id"  value="<?=$rsEmp['emp_id']?>">
					
					<?php
					}else if($_SESSION[admin_id]!=""){
						$strSQLEmp="select * from admin where admin_id=$_SESSION[admin_id]";
						$resultEmp=mysql_query($strSQLEmp);
						$rsEmp=mysql_fetch_array($resultEmp);
						$role="admin";
						
						//echo $rsEmp['emp_picture_thum'];
						?>
						
						<strong>
						<button class="boxC btn btn-info " style="margin-top:5px;">
							<i class="glyphicon  glyphicon-user"></i>
						</button>
						Admin
						(<?=$rsEmp['admin_id']?>) || </strong> <?=$rsEmp['admin_name']?> &nbsp;&nbsp; <?=$rsEmp['admin_surname']?>
					<?php
					}
					?>
					
			
			<span class="caret"></span>
			</a>
				<ul class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
					<!-- 
					<li>
						<a href="#">
							<i class="icon-cog"></i>
							Settings
						</a>
					</li>

					<li>
						<a href="#">
							<i class="icon-user"></i>
							Profile
						</a>
					</li>
					 -->
					<li class="divider"></li>

					<li>
						<a href="../logout.php?role=<?=$role?>&superUser=<?=$_SESSION[admin_id]?>">
							<i class="icon-off"></i>
							Logout
						</a>
					</li>
				</ul>
			</li>
			
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>
    
    <div class="sidebar-background">
		<div class="primary-sidebar-background"></div>
	</div>
	<div id="slideLeft">
	
			<div class="list-group listGroupTop">
				
					<ul class="nav nav-list">
						<?php 
				  		if(($_SESSION['admin_status']==3) or ($_SESSION['admin_status']==1 
						or ($_SESSION['emp_role_leve']=="Level2")
						or ($_SESSION['emp_role_leve']=="Level1")
						)){
				  		?>
						<li class="active">
				  			<a href="#" id="kpiDashboard" class=""><i class="iconMenu glyphicon glyphicon-dashboard"></i>  <span class="menu-text">Kpi Dashboard</span></a>
				  			<b class="arrow"></b>
				  		</li>
				  		
						<li >
						  <a href="#" id="threshold" class=" "><i class="iconMenu glyphicon glyphicon-th-large"></i> <span class="menu-text">Threshold</span></a>
						</li>
						<li >
				  			<a href="#" id="appraisalPeriod" class=""><i class="iconMenu glyphicon glyphicon-time"></i>  <span class="menu-text"> Appraisal Period</span></a>
				  			<b class="arrow"></b>
				  		</li>
						<li > 
				  			<a href="#" id="department" class=""><i class="iconMenu glyphicon glyphicon-road"></i>  <span class="menu-text">Department</span></a>
				 			<b class="arrow"></b>
				 		</li>
				 		<!-- 
				 		<li > 
				  			<a href="#" id="division" class=""><i class="iconMenu glyphicon glyphicon-road"></i>  <span class="menu-text">Division</span></a>
				 			<b class="arrow"></b>
				 		</li>
				 		 -->
				 		<li >
				  			<a href="#" id="position" class=""><i class="iconMenu glyphicon glyphicon glyphicon-fire"></i>  <span class="menu-text"> Position</span></a>
				  			<b class="arrow"></b>
				  		</li>
				  		<li>
				 			 <a href="#" id="kpi" class=""><i class="iconMenu glyphicon glyphicon-signal"></i>  <span class="menu-text">KPIs</span></a>
				 		 	<b class="arrow"></b>
				 		 </li>
				 		<li >
				  			<a href="#" id="employee" class=""><i class="iconMenu glyphicon glyphicon-user"></i>  <span class="menu-text"> Employee</span></a>
				  			<b class="arrow"></b>
				  		</li>
				  		<li >
				  			<a href="#" id="assignKPI" class=""><i class="iconMenu glyphicon glyphicon-indent-left"></i>  <span class="menu-text"> Assign KPI</span></a>
				  			<b class="arrow"></b>
				  		</li>
				  		<?php 
					  		if(($_SESSION['admin_status']==3) or ($_SESSION['admin_status']==1 
							or ($_SESSION['emp_role_leve']=="Level1")
							)){
					  		?>
					  		<li >
					  			<a href="#" id="approveKpiResult" class=""><i class="iconMenu glyphicon glyphicon-edit"></i>  <span class="menu-text">Approve Kpi Result</span></a>
					  			<b class="arrow"></b>
					  		</li>
					  		
					  		<?php 
					  		}
				  		}
				  		?>
					
					
				</ul>
				 
				


		 </div>
	</div>
	<div class="titleTab">
		
		<div class="boxTitle">
			<div class="boxLeft">
				
				<div class="boxLeftTopLarge">
					<button class="boxC btn btn-success connect-database">
						<i class="glyphicon glyphicon-align-center"></i>
					</button>
					<button class="boxC btn btn-info connect-admin">
						<i class="glyphicon  glyphicon-user"></i>
					</button>
					<button class="boxC btn btn-warning connect-message">
						<i class="glyphicon  glyphicon-envelope"></i>
					</button>
					<button class="boxC btn btn-danger connect-mission">
						<i class="glyphicon glyphicon-calendar"></i>
					</button>
				</div>
				 
				<div class="boxLeftTopSmall">
					<span class="boxSmall colorGreen"></span>
					<span class="boxSmall colorBlue"></span>
					<span class="boxSmall colorOrange"></span>
					<span class="boxSmall colorRed"></span>
				</div>
				<!-- 
				<button class="boxC btn btn-success">
					<i class="glyphicon glyphicon-align-center"></i>
				</button>
				<button class="boxC btn btn-info">
					<i class="glyphicon glyphicon-asterisk"></i>
				</button>
				<button class="boxC btn btn-warning">
					<i class="glyphicon glyphicon-briefcase"></i>
				</button>
				<button class="boxC btn btn-danger">
					<i class="glyphicon glyphicon-cloud-download"></i>
				</button>
				 -->
				 
			</div>
		</div>
		
		<div class="boxTitleN">
		<div id="subjectPage" ></div>
		 <!-- 
		&nbsp; &nbsp;<span class="glyphicon glyphicon-home"></span>
		Home <span class="glyphicon glyphicon-chevron-right" style="font-size:10px;"></span> Dashboard
		 -->
		</div>
		
		<!-- button Withdraw/Enlarge option Start-->
		<!-- 
		<div class="gearOption" style="display:inline; float:right ; position:relative; magin-right:5px">
			 
			 <div class="optionArea">
		 		<div class="gear" id="gearOption"><div  class=" glyphicon glyphicon-cog buttonGearOption fontWhite"></div></div>
		 		<div class="option">
		 			
		 				<div class="tableOption fontWhite">
				 			<table  cellspacing="0"  cellpadding="0" border="0">
				 				<tr>
				 					<td colspan="6"><b>Layout Options</b></td>
				 				</tr>
				 				<tr>
				 					<td><input type="checkbox" class="themeAction"></td>
				 					<td>Fixed Header</td>
				 					
				 					<td><input type="checkbox" class="themeAction"></td>
				 					<td>Fixed Footer</td>
				 					
				 					<td><input type="checkbox" class="themeAction"></td>
				 					<td>Fixed sidebar</td>
				 					
				 				</tr>
				 				
				 				
				 			</table>
			 			</div>
			 			
			 			<div class="tableOption fontWhite">
			 				<table  cellspacing="0"  cellpadding="0" border="0">
				 				<tr>
				 					<td colspan="6"><b>Theme Color</b></td>
				 				</tr>
				 				<tr>
				 					<td><button class="boxB btn btn-success themeAction"></button></td>
				 					<td><button class="boxB btn btn-info themeAction"></button></td>
				 					<td><button class="boxB btn btn-warning themeAction"></button></td>
				 					<td><button class="boxB btn btn-danger themeAction"></button></td>
				 					
				 					
				 				</tr>
				 			</table>
			 			</div>
		 			
		 		</div>
	 		</div>
		
		</div>
		 -->
		<!-- button Withdraw/Enlarge option  End-->
		
		
		
		<!--  form search,button fullscreen start -->
		<div class="boxTopRight" style="float:right; margin-right:5px;">
				<div class="withdraw-Enlarge" style="display:inline; float:right ; position:relative; magin-right:200px">
					<button id="withdrawEnlarge" class="glyphicon glyphicon-align-justify active" style="width:30px;height:30px; color:#6d6a69;font-weight:normal;"></button>
				</div>
				
				<div class="boxTitleR" style=" float:right; margin-right:2px">
					<div class="formSearch" >
				<!-- 
					<form class="form-search">
						
						
						  <input type="text" style="width:200px;height:28px;margin-top: 2px;" placeholder="Search">
						  <span class="glyphicon glyphicon-search searchButton">
							
						  </span>
						
					</form>
					 
				 -->
					 </div>
			</div>
			<!--  form search,button fullscreen end -->
			
			<!-- button full screen start -->
			<div class="fullScreen" style="display:inline; float:right ; position:relative; magin-right:5px">
				<button class=" glyphicon glyphicon-fullscreen" id="btnFullScreen" style="width:30px;height:30px;"></button>
			</div>
			<!-- button full screen end -->
			
		</div>
		<!--  form search,button fullscreen end -->
		
		<!-- 
		<div class="topParameter">
			
			<table>
				<tr>
					<td>&nbsp; &nbsp; <strong>ปีการประเมิน</strong></td>
					<td id="appraisalYearArea">
						
					</td>
					<td><strong>ประเมินครั้งที่</strong></td>
					<td id="appraisalPeriodAea">
						
					</td>
					<td>
						<button id="appraisalPeriodSubmit">ตกลง</button>
					</td>
				</tr>
				
			</table>
		</div>
		 -->
	</div>
	<div class="container">
		
		<div id="mainContent">
			
		</div>
	</div>


 <div id="testChart"></div>
  <!-- 
<div style="height:250px;width:500px;float:left;"  id="chart"></div>

<button id="btnBarChart">btnBarChart</button>
<button id="btnBarChartMutiSeries">btnBarChartMutiSeries</button>
<button id="btnChartHorizontal">Horizontal</button>
<button id="btnChartHorizontalMutiSeries">barchartHorizontalMutiSeries</button>
<button id="btnChartHorizontalMutiSeriesStace">btnChartHorizontalMutiSeriesStace</button>

<button id="btnChartLine">btnChartLine</button>
<button id="btnDonut">Donut chart</button>
<button id="btnPie">Pie chart</button>
<button id="btnBarLineChart">BarLine chart</button>
<button id="btngaugeChart">gaugeChart</button>
<button id="btnMapRegion">MapRegion</button>
<button id="btnMapProvince">MapProvince</button>
<button id="btnTable">Table</button>
 --> 



  </body>
</html>
