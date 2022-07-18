<!DOCTYPE html>
<html lang="en" dir="ltr">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />

<head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="icon" href="http://powerbi-admin-template.multipurposethemes.com/bs4/images/favicon.ico">
    
    <title>Login - Dirmawa</title>
    
    <!-- css -->
    <?= $this->include('layout_login/css') ?>
</head>

<body class="hold-transition theme-primary bg-img" style="background-image: url(<?= base_url('public/assets/images/auth-bg/bg-1.jpg') ?>">
    
    <div class="container h-p100">
		<div class="row align-items-center justify-content-md-center h-p100">	
            
            <!-- content -->
            <?= $this->renderSection('content') ?>

        </div>
    </div>

    <!-- JS -->
    <?= $this->include('layout_login/js') ?>
</body>