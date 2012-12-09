<?
	$page = 'monitor';
	$extrafoot = '<script src="assets/jquery.percentageloader-0.1.min.js" type="text/javascript"></script>';
	include './../templates/header.php';
?>
<div id="page-container" class="container">
	<header id="page-header">
		<h1><span>Monitor</span><small>Keep an eye of all the nitty gritty</small></h1>
	</header><!--- #page-header -->
	<div id="page-content">
		<div class="row">
			<h3 class="fancy-title"><a href="#FlightTracker" name="FlightTracker">Flight Tracker</a></h3>
			<div id="map" style="width: 100%; height: 300px;"></div>
		</div>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script><script>
var myLatlng = new google.maps.LatLng(41.875696,-87.624207);
var myOptions = {
	zoom: 4,
	center: myLatlng,
	mapTypeId: google.maps.MapTypeId.ROADMAP
}
var map = new google.maps.Map(document.getElementById("map"), myOptions);
//var ctaLayer = new google.maps.KmlLayer('http://localhost/autoplane/test.kml');
//ctaLayer.setMap(map);
</script>
		<div class="micro divider"></div>
		<h3 class="fancy-title"><a href="#Devices" name="Devices">Devices</a></h3>
		<div class="row">
			<div class="span-6">
				<div class="styled-box iconed-box success">
					<span class="icon"></span>
					<b>GPS</b> is working fine. Current location is
					<a href="monitor.php#FlightTracker" onclick="map.setCenter(new google.maps.LatLng(25,45));">25.45654, 45.6728</a>.
				</div>
				<div class="styled-box iconed-box error">
					<span class="icon"></span>
					<b>Proximity sensor</b> is not working or doesn't exist.
				</div>
				<?
					$data = getRam();
					$lines = array();
					@exec('acpi -b', $lines, $code);
					if ($code !== 0) {
						$battery = false;
					} else {
						$battery = explode(':', $lines[0]);
						$battery = $battery[1];
					}
				?>
				<div class="styled-box iconed-box info">
					<span class="icon"></span>
					<b>RAM</b>; Total: <?=bytes2human($data['MemTotal']);?>, Free: <?=bytes2human($data['MemFree']);?>
				</div>
				<div class="styled-box iconed-box <?=($battery === false ? 'error' : 'info')?>">
					<span class="icon"></span>
					<b>Battery</b>; <?=($battery === false) ?'Unknown' : $battery; ?>
				</div>
			</div>
			<div class="span-6">
				<div class="styled-box iconed-box success">
					<span class="icon"></span>
					<b>Gyroscope</b> is working fine. Plane tilt is <a href="monitor.php#Tilt">23&deg;, 1&deg;, 0&deg;</a>
				</div>
				<div class="styled-box iconed-box tip">
					<span class="icon"></span>
					<b>Camera</b> maybe working. Please check the <a href="monitor.php#Latest">gallery</a> for updates
				</div>
				<?
					if (function_exists('sys_getloadavg')) {
						$data = sys_getloadavg();
					} else {
						$data = false;
					}
					$df = disk_free_space("/");
				?>
				<div class="styled-box iconed-box <?=($data === false ? 'alert' : ($data[0] > 0.8 * $cores ? 'alert' : 'info'));?>">
					<span class="icon"></span>
					<b>Load</b> <?=($data === false ? ' information is unavailable on this system' : 'averages are; '.implode(', ', $data));?>
				</div>
				<div class="styled-box iconed-box <?=($df > 262144000 ? 'success' : ($df > 104857600 ? 'info' : 'alert'));?>">
					<span class="icon"></span>
					<b>Free Disk Space:</b> <?=bytes2human($df);?>
				</div>
			</div>
		</div>
		<div class="divider"></div>
		<h3 class="fancy-title"><a href="#Dials" name="Devices">Dials/Gauges</a></h3>
		<div class="row">
			<div class="span-4">
				<h3 class="fancy-title">Battery</h3>
				<div id="batterydial"></div>
			</div>
			<div class="span-4">
				<h3 class="fancy-title">Load</h3>
				<div id="loaddial"></div>
			</div>
		</div>

		<script type="text/javascript">
			var dials = [];
			$(function() {
				dials[0] = $("#batterydial").percentageLoader({
					width:	290,
					height:	290,
					value:	'...'
				});
				dials[0].setValue(<?php $a = (int)preg_replace("/[^0-9]/", '', $battery); echo $a; ?>);
				dials[0].setProgress(<?php echo (float)($a / 100); ?>);
				setTimeout(function () {
					dials[0].setValue(<?php $a = (int)preg_replace("/[^0-9]/", '', $battery); echo $a; ?>);
					dials[0].setProgress(<?php echo (float)($a / 100); ?>);
				}, 1500);

				dials[1] = $("#loaddial").percentageLoader({
					width:	290,
					height:	290,
					value:	'...'
				});
				dials[1].setValue(<?php echo $data[0]; ?>);
				dials[1].setProgress(<?php echo $data[0]; ?>);
				setTimeout(function () {
					dials[1].setValue(<?php echo $data[0]; ?>);
					dials[1].setProgress(<?php echo $data[0]; ?>);
				}, 1500);
			});
		</script>

		<div class="divider"></div>
		<div class="row">
			<div class="span-4">
				<h3 class="fancy-title">Accordion</h3>
				<div class="accordion">
					<div class="accordion-panel">
						<div class="accordion-panel-title">
							<span class="indicator"></span>Panel one
						</div>
						<div class="accordion-panel-body" style="display: none; ">
							In nisi quam, placerat fringilla consectetur laoreet, viverra ut lorem. Morbi vel lacus sit amet augue fringilla laoreet. Aliquam a eros sapien, in malesuada leo. Nunc ut nibh faucibus ante pretium tincidunt. Maecenas scelerisque enim quis lacus sagittis vitae euismod eros rutrum. Nulla cursus dolor ac odio gravida lacinia. Donec fermentum scelerisque mi ut semper.
						</div>
					</div>
					<div class="accordion-panel active">
						<div class="accordion-panel-title">
							<span class="indicator"></span>Panel two
						</div>
						<div class="accordion-panel-body" style="display: block; ">
							Sed imperdiet aliquam lectus pharetra tempor. Vestibulum eget quam odio. Suspendisse tellus est, fringilla quis gravida ut, pellentesque vel lorem. Ut pharetra metus sit amet magna volutpat suscipit. Integer vehicula sem ac nibh ultricies tristique. Etiam nec diam elit, eget vulputate nisi.
						</div>
					</div>
					<div class="accordion-panel">
						<div class="accordion-panel-title">
							<span class="indicator"></span>Panel three
						</div>
						<div class="accordion-panel-body" style="display: none; ">
							Maecenas sed eros id felis gravida faucibus. Integer sit amet sapien sit amet magna fermentum cursus in et justo. Donec scelerisque dolor augue, non scelerisque nunc. Duis justo velit, euismod vel dapibus commodo, faucibus sed ante.
						</div>
					</div>
				</div>
			</div>
			<div class="span-4">
				<h3 class="fancy-title">Toggles</h3>
				<div class="toggle">
					<div class="toggle-title">
						<span class="indicator"></span>Normally Closed Toggle
					</div>
					<div class="toggle-body" style="display: none; ">
						Nulla porttitor purus in eros elementum in ultrices neque commodo. Donec lacinia rhoncus imperdiet. Sed ut luctus orci. Fusce dui leo, laoreet id laoreet ut, pretium sed felis.
					</div>
				</div>
				<div class="toggle">
					<div class="toggle-title">
						<span class="indicator"></span>Normally Opened Toggle
					</div>
					<div class="toggle-body" style="display: none; ">
						Nulla porttitor purus in eros elementum in ultrices neque commodo. Donec lacinia rhoncus imperdiet. Sed ut luctus orci. Fusce dui leo, laoreet id laoreet ut, pretium sed felis.
					</div>
				</div>
				<div class="toggle active">
					<div class="toggle-title">
						<span class="indicator"></span>Another Toggle Just for Fun
					</div>
					<div class="toggle-body" style="display: block; ">
						Nulla porttitor purus in eros elementum in ultrices neque commodo. Donec lacinia rhoncus imperdiet. Sed ut luctus orci. Fusce dui leo, laoreet id laoreet ut, pretium sed felis.
					</div>
				</div>
			</div>
			<div class="span-4">
				<h3 class="fancy-title">Tabs</h3>
				<div class="tabs">
					<ul class="tab-group">
						<li class="tab">Tab one</li>
						<li class="tab active">Tab two</li>
						<li class="tab">Tab three</li>
					</ul>
					<ul class="tab-body-group">
						<li class="tab-body" style="display: none; ">
							Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus quis mauris tortor. Proin at nisi nec elit ultricies luctus.
						</li>
						<li class="tab-body" style="display: list-item; ">
							Quisque congue sollicitudin elementum. Integer justo tellus, facilisis eu tincidunt id, placerat quis lorem. Maecenas et augue orci, vel vehicula ligula.
						</li>
						<li class="tab-body" style="display: none; ">
							Nam gravida euismod arcu, a pretium ante consectetur ac. Integer gravida metus vel ligula placerat volutpat.
						</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="divider"></div>
	</div><!--- #page-content -->
				</div><!--- #page-container -->
<?
	include './../templates/footer.php';
?>
