<!DOCTYPE html>
<html lang="pl">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no" name="viewport">
	<title>TS3AudioBot @ PANEL</title>
	<link rel="icon" type="image/png" href="assets/img/favicon.png">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
	<link rel="stylesheet" href="assets/css/material-dashboard.css?v=2.1.0">
	<link rel="stylesheet" href="assets/css/animate.css">
</head>
<body>
<div class="wrapper">
	<div class="sidebar wow slideInLeft" data-wow-duration="1s" data-color="green" data-background-color="white" data-image="assets/img/sidebar-1.png">
		<div class="logo">
			<a href="#" class="simple-text logo-normal">
				TS3AudioBot @ PANEL
			</a>
		</div>
		<div class="sidebar-wrapper">
			<ul class="nav">
				<li class="nav-item <?php echo (isset($_SESSION['PAGE_REQUEST']) && $_SESSION['PAGE_REQUEST'] == 'dashboard' ? 'active' : ''); ?>">
					<a class="nav-link" href="?dashboard">
						<i class="material-icons">dashboard</i>
						<p>Zarządzaj botami</p>
					</a>
				</li>
				<li class="nav-item <?php echo (isset($_SESSION['PAGE_REQUEST']) && $_SESSION['PAGE_REQUEST'] == 'create' ? 'active' : ''); ?>">
					<a class="nav-link" href="?create">
						<i class="material-icons">build</i>
						<p>Stwórz bota</p>
					</a>
				</li>
				<li class="nav-item <?php echo (isset($_SESSION['PAGE_REQUEST']) && $_SESSION['PAGE_REQUEST'] == 'logs' ? 'active' : ''); ?>">
					<a class="nav-link" href="?logs">
						<i class="material-icons">event_note</i>
						<p>Logi TS3AudioBot</p>
					</a>
				</li>
				<li class="nav-item <?php echo (isset($_SESSION['PAGE_REQUEST']) && $_SESSION['PAGE_REQUEST'] == 'changepass' ? 'active' : ''); ?>">
					<a class="nav-link" href="?changepass">
						<i class="material-icons">create</i>
						<p>Zmiana hasła</p>
					</a>
				</li>
				<li class="nav-item <?php echo (isset($_SESSION['PAGE_REQUEST']) && $_SESSION['PAGE_REQUEST'] == 'donate' ? 'active' : ''); ?>">
					<a class="nav-link" href="?donate">
						<i class="material-icons">attach_money</i>
						<p>Donacje</p>
					</a>
				</li>
			</ul>
		</div>
	</div>
	<div class="main-panel">
		<nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top wow slideInDown" data-wow-duration="1s">
			<div class="container-fluid">
				<?php if ($_SESSION['user_online']) {?>
				<div class="navbar-wrapper">
					<div class="navbar-brand">Zalogowany jako: <b><?php echo $_SESSION['user_name']; ?></b></div>
				</div>
				<?php } ?>
				<button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index"
				        aria-expanded="false" aria-label="Toggle navigation">
					<span class="sr-only">Toggle navigation</span>
					<span class="navbar-toggler-icon icon-bar"></span>
					<span class="navbar-toggler-icon icon-bar"></span>
					<span class="navbar-toggler-icon icon-bar"></span>
				</button>
				<?php if ($_SESSION['user_online']) {?>
				<div class="collapse navbar-collapse justify-content-end">
					<ul class="navbar-nav">
						<li class="nav-item">
							<a class="nav-link" href="?logout">
								<i class="material-icons">power_settings_new</i>
							</a>
						</li>
					</ul>
				</div>
				<?php } ?>
			</div>
		</nav>