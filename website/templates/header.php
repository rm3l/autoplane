<?php
	error_reporting(E_ALL);
	include 'config.php';
	if (!isset($pagetitle)) {
		$pagetitle = $tagline;
	}

	function checkPage ($target) {
		global $page;
		if ($target == $page) {
			echo ' current';
		}
	}
?><!DOCTYPE html>
<html>
	<head>
		<!-- Meta -->
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<?
		if (isset($url) && strlen($url) > 2) {
			echo '<link rel="canonical" href="http://localhost/'.$url.'" />';
		}
		?>

		<!-- Favicon -->
		<link rel="shortcut icon" href="images/favicon.ico" />

		<!-- Title -->
		<title><?=$pagetitle;?>, <?=$product;?></title>

		<!-- Fonts -->
		<link href='http://fonts.googleapis.com/css?family=Droid+Serif:400,400italic|Open+Sans:400,400italic,600,800' rel='stylesheet' type='text/css'>

		<!-- Styles -->
		<link href="styles/style.css" rel="stylesheet" type="text/css" media="screen" />

		<!-- Plugins -->
		<link href="plugins/colorbox/colorbox.css" rel="stylesheet" type="text/css" media="screen" />
		<link href="plugins/colorbox/skin.css" rel="stylesheet" type="text/css" media="screen" />

		<link href="plugins/flexslider/flexslider.css" rel="stylesheet" type="text/css" media="screen" />
		<link href="plugins/flexslider/skin.css" rel="stylesheet" type="text/css" media="screen" />

		<link href="plugins/mediaelement/mediaelementplayer.min.css" rel="stylesheet" type="text/css" media="screen" />
		<link href="plugins/mediaelement/skin.css" rel="stylesheet" type="text/css" media="screen" />

		<?php
			if (isset($extrahead)) {
				echo $extrahead;
			}
		?>

		<!-- IE -->
		<!--[if lt IE 9]>
			<link href="styles/ie/ie.css" rel="stylesheet" type="text/css" media="screen" />
			<script src="scripts/ie/html5.js" type="text/javascript"></script>
		<![endif]-->
		<script type="text/javascript" src="scripts/jquery.js"></script>
	</head>
	<body>
		<div id="main-wrap">
			<div id="announcement" class="container-wrap">
				<div id="announcement-container" class="container">
					<div id="announcement-content">
						<p>
						This project is need for developers. Contact me by sending an <a href="mailto:PaulHappyHutchinson@gmail.com?subject=The+auto+plane+project">email</a>
						</p>
					</div><!--- #announcement-content -->

					<a href="#" class="close-announcement">Close</a>
				</div><!--- #announcement-container -->
			</div><!--- #announcement -->
			<div id="cap" class="container-wrap"></div><!--- #cap -->
			<header id="header" class="container-wrap">
				<div id="header-container" class="container">
					<div id="logo">
						<a id="site-title" href="/">
							<img src="images/logo.png" alt="<?=$product;?>" />
						</a><!--- #site-title -->
						<span id="site-description">
							<?=$tagline;?>
						</span><!--- #site-description -->
					</div><!--- #logo -->
					<nav id="main-nav-menu">
						<ul>
							<li class="nav-menu-item<? checkPage('home'); ?>">
								<a href="/">Home</a>
							</li>
							<li class="nav-menu-item<? checkPage('team'); ?>">
								<a href="the-team.php">The Team</a>
							</li>
							<li class="nav-menu-item<? checkPage('docs'); ?>">
								<a href="documentation.php">Documentation</a>
								<ul class="sub-menu">
									<li class="nav-menu-item">
										<a href="documentation.php#h.x8y65o117efn">Contents</a>
									</li>
									<li class="nav-menu-item">
										<a href="documentation.php#h.vph7732ilxkv">Introduction</a>
									</li>
									<li class="nav-menu-item">
										<a href="documentation.php#h.552fkml9thrp">Goals</a>
										<ul class="sub-menu">
											<li class="nav-menu-item">
												<a href="documentation.php#h.3z8rcpgze86o">Learning to fly</a>
											</li>
											<li class="nav-menu-item">
												<a href="documentation.php#h.lprmq6m5h2fk">Installing Hardware</a>
											</li>
											<li class="nav-menu-item">
												<a href="documentation.php#h.en8v2hb01i6y">Processing Data</a>
											</li>
											<li class="nav-menu-item">
												<a href="documentation.php#h.5hodcr5awir0">First Flight</a>
											</li>
											<li class="nav-menu-item">
												<a href="documentation.php#h.addcxgxaa0n9">Second Flight</a>
											</li>
											<li class="nav-menu-item">
												<a href="documentation.php#h.ud23qq5nn1ex">Tweaking/Improving</a>
											</li>
											<li class="nav-menu-item">
												<a href="documentation.php#h.ajk26bb56jgj">Downgrading/Improving</a>
											</li>
											<li class="nav-menu-item">
												<a href="documentation.php#h.cqows8ncbvgh">The End</a>
											</li>
											<li class="nav-menu-item">
												<a href="documentation.php#h.3l9rikx4zsmj">Going one step futher</a>
											</li>
										</ul>
									</li>
									<li class="nav-menu-item">
										<a href="documentation.php#h.am66h2pyitus">Technical Jargon</a>
									</li>
									<li class="nav-menu-item">
										<a href="documentation.php#h.kp8aspxn5rmf">Files &amp; Programs</a>
										<ul class="sub-menu">
											<li class="nav-menu-item">
												<a href="documentations.php#h.3d8hvu2z4u3h">Locations</a>
											</li>
											<li class="nav-menu-item">
												<a href="documentations.php#h.82te431r9qi2">File-types</a>
											</li>
											<li class="nav-menu-item">
												<a href="documentations.php#h.37f61o9l5e2">Programs</a>
											</li>
										</ul>
									</li>
									<li class="nav-menu-item">
										<a href="documentation.php#h.5wuqg4n9mbsj">Error Management</a>
									</li>
									<li class="nav-menu-item">
										<a href="documentation.php#h.22muku6bk5e3">Parts</a>
									</li>
									<li class="nav-menu-item">
										<a href="documentation.php#h.644tt0b7gn85">Credits</a>
									</li>
									<li class="nav-menu-item">
										<a href="documentation.php#h.ivvufjcxgv3a">Questions &amp; Answers</a>
									</li>
									<li class="nav-menu-item">
										<a href="documentation.php#h.q4vi9e3nix0y">Development &amp; Programming</a>
									</li>

								</ul>
							</li>
							<li class="nav-menu-item<? checkPage('license'); ?>">
								<a href="license.php">License</a>
								<ul class="sub-menu">
									<li class="nav-menu-item">
										<a href="license.php#preamble">Preamble</a>
									</li>
									<li class="nav-menu-item">
										<a href="license.php#terms">Terms &amp; Conditions</a>
										<ul class="sub-menu">
											<li class="nav-menu-item">
												<a href="license.php#section0">Definitions</a>
											</li>
											<li class="nav-menu-item">
												<a href="license.php#section1">Source Code</a>
											</li>
											<li class="nav-menu-item">
												<a href="license.php#section2">Basic Permissions</a>
											</li>
											<li class="nav-menu-item">
												<a href="license.php#section3">Protecting Users' Legal Rights From Anti-Circumvention Law</a>
											</li>
											<li class="nav-menu-item">
												<a href="license.php#section4">Conveying Verbatim Copies</a>
											</li>
											<li class="nav-menu-item">
												<a href="license.php#section5">Conveying Modified Source Versions</a>
											</li>
											<li class="nav-menu-item">
												<a href="license.php#section6">Conveying Non-Source Forms</a>
											</li>
											<li class="nav-menu-item">
												<a href="license.php#section7">Additional Terms</a>
											</li>
											<li class="nav-menu-item">
												<a href="license.php#section8">Termination</a>
											</li>
											<li class="nav-menu-item">
												<a href="license.php#section9">Acceptance Not Required for Having Copies</a>
											</li>
											<li class="nav-menu-item">
												<a href="license.php#section10">Automatic Licensing of Downstream Recipients</a>
											</li>
											<li class="nav-menu-item">
												<a href="license.php#section11">Patents</a>
											</li>
											<li class="nav-menu-item">
												<a href="license.php#section12">No Surrender of Others' Freedom</a>
											</li>
											<li class="nav-menu-item">
												<a href="license.php#section13">Use with the GNU Affero General Public License</a>
											</li>
											<li class="nav-menu-item">
												<a href="license.php#section14">Revised Versions of this License</a>
											</li>
											<li class="nav-menu-item">
												<a href="license.php#section15">Disclaimer of Warranty</a>
											</li>
											<li class="nav-menu-item">
												<a href="license.php#section16">Limitation of Liability</a>
											</li>
											<li class="nav-menu-item">
												<a href="license.php#section17">Interpretation of Sections 15 and 16</a>
											</li>
										</ul>
									</li>
								</ul>
							</li>
							<li class="nav-menu-item<? checkPage('contact'); ?>">
								<a href="contact.php">Contact</a>
							</li>
							<li class="nav-menu-item<? checkPage('monitor'); ?>">
								<a href="monitor.php">Monitor</a>
								<ul class="sub-menu">
									<li class="nav-menu-item">
										<a href="monitor.php#FlightTracker">Flight Tracker</a>
									</li>
									<li class="nav-menu-item">
										<a href="monitor.php#Devices">Devices</a>
									</li>
								</ul>
							</li>
						</ul>
					</nav><!--- #main-nav-menu -->
					<select id="responsive-main-nav-menu" onchange="javascript:window.location.replace(this.value);"></select>
				</div><!--- #header-container -->
			</header><!--- #header -->
			<section id="page" class="container-wrap">
				<div id="page-container" class="container">
