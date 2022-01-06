<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html> 
  <head>
  	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title><?php echo $product; ?> - PHP Installer - <?php echo $step; ?></title>
        <!-- Bootstrap -->
        <link href="../res/css/bootstrap.min.css" rel="stylesheet" media="screen">
    </head>
  
  <body>
    <div class="container-fluid">
            <div class="row-fluid">
    		<!--/span-->
                <div class="row" >
					<div class="col-md-2"></div>
                     <div class="col-md-8"><div class="panel panel-default" id="content">
                            <div class="panel-heading">
                                <h2 class="panel panel-info"><?php echo $header; ?></h2>
 							</div>
                            <div class="panel-body">
                                        <div class="navbar">
                                          <div class="navbar-inner">
                                            <div >
		                                        <ul class="nav nav-pills">
		                                            <li class="<?php if ($step == "introduction") {echo "active";} else {echo "disabled";} ?>"><a href="#tab1" data-toggle="tab">Introduction</a></li>
		                                            <li class="<?php if ($step == "eula") {echo "active";} else {echo "disabled";} ?>"><a href="#tab2" data-toggle="tab">License</a></li>
		                                            <li class="<?php if ($step == "requirements") {echo "active";} else {echo "disabled";} ?>"><a href="#tab3" data-toggle="tab">Server requirements</a></li>
		                                            <li class="<?php if ($step == "filePermissions") {echo "active";} else {echo "disabled";} ?>"><a href="#tab4" data-toggle="tab">File permissions</a></li>
		                                            <li class="<?php if ($step == "appconfig") {echo "active";} else {echo "disabled";} ?>"><a href="#tab5" data-toggle="tab">Application settings</a></li>
		                                            <li class="<?php if ($step == "database") {echo "active";} else {echo "disabled";} ?>"><a href="#tab6" data-toggle="tab">Database connection</a></li>
		                                            <li class="<?php if ($step == "importSQL") {echo "active";} else {echo "disabled";} ?>"><a href="#tab7" data-toggle="tab">Import SQL</a></li>
		                                            <li class="<?php if ($step == "done") {echo "active";} else {echo "disabled";} ?>"><a href="#tab8" data-toggle="tab">Done</a></li>
		                                        </ul>
                                         </div>
                                          </div>
                                        </div>
                                        <div class="progress">
										  <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $progress; ?>%;">
										    <span class="sr-only"><?php echo $progress; ?>% Complete</span>
										  </div>
										</div>
                                            