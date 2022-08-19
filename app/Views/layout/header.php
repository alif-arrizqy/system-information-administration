<div class="d-flex align-items-center logo-box justify-content-between">
	<a href="#" class="waves-effect waves-light nav-link rounded d-none d-md-inline-block mx-10 push-btn" data-toggle="push-menu" role="button">
		<span class="icon-Align-left"><span class="path1"></span><span class="path2"></span>
			<span class="path3"></span></span>
	</a>
	<!-- Logo -->
	<a href="#" class="logo">
		<!-- logo-->
		<!-- <div class="logo-lg">
			<span class="light-logo"><img src="<?= base_url('public/assets/images/logo-light-text.png') ?>" alt="logo"></span>
			<span class="dark-logo"><img src="<?= base_url('public/assets/images/logo-light-text.png') ?>" alt="logo"></span>
		</div> -->
	</a>
</div>
<!-- Header Navbar -->
<nav class="navbar navbar-static-top pl-10">
	<div class="container">
		<!-- Sidebar toggle button-->
		<div class="app-menu">
			<ul class="header-megamenu nav">
			</ul>
		</div>

		<div class="navbar-custom-menu r-side">
			<ul class="nav navbar-nav">
				<li>
					<a href="<?= base_url('/view_users') ?>" class="dropdown-toggle" title="Profile">
						<i class="icon-User"><span class="path1"></span><span class="path2"></span></i>
					</a>
				</li>
				<li>
					<a href="<?=base_url ('login/logout') ?>" title="Logout">
						<i class="icon-Sign-out"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
					</a>
				</li>
			</ul>
		</div>
	</div>
</nav>