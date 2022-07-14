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
    
    <title>Dirmawa Web</title>
    
    <!-- css -->
    <?= $this->include('layout/css') ?>
</head>

<body class="hold-transition light-skin sidebar-mini theme-primary fixed">
    <div class="wrapper">
        <div id="loader"></div>
        <!-- header -->
        <header class="main-header">
            <?= $this->include('layout/header') ?>
        </header>

        <!-- sidebar -->
        <aside class="main-sidebar">
            <?= $this->include('layout/sidebar') ?>
        </aside>

        <!-- content -->
        <div class="content-wrapper">
            <?= $this->renderSection('content') ?>
        </div>

        <!-- footer -->
        <footer class="main-footer">
            <?= $this->include('layout/footer') ?>
        </footer>

        <!-- control sidebar -->
        <aside class="control-sidebar">
            <?= $this->include('layout/control-sidebar') ?>
        </aside>

        <div class="control-sidebar-bg"></div>
    </div>

    <!-- JS -->
    <?= $this->include('layout/js') ?>
</body>