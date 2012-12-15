<?php
	include './../init.php';
	$page = 'monitor';
	$extrafoot = '<script src="assets/jquery.knob.js" type="text/javascript"></script>';
	include './../templates/header.php';
	$tempResults = getTemp();
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
$(function() {
	$(".knob").knob({
		change : function (value) {
			//console.log("change : " + value);
		},
		release : function (value) {
			console.log("release : " + value);
		},
		cancel : function () {
			console.log("cancel : " + this.value);
		}
	});
});
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
				<?php
					$cell = new Battery($GLOBALS['batteryLife']);
					$time = $cell->getTimeLeft();
					if ($time < 0) {
						$battery = "<strong>Dead!</strong>";
					} else {
						$battery = seconds2human($time) . ' remaining';
					}
					$data = getRam();
					$lines = array();
					@exec('acpi -b', $lines, $code);
					if ($code !== 0) {
						// Use default
					} else {
						$battery = explode(':', $lines[0]);
						$battery = $battery[1];
					}
				?>
				<div class="styled-box iconed-box info">
					<span class="icon"></span>
					<b>RAM</b>; Total: <?=bytes2human($data['MemTotal']);?>, Free: <?=bytes2human($data['MemFree']);?>
				</div>
				<div class="styled-box iconed-box <?=($battery === false || strpos($battery, 'Dead') !==false ? 'error' : 'info')?>">
					<span class="icon"></span>
					<b>Battery</b>; <?=($battery === false) ?'Unknown' : $battery; ?>
				</div>
				<?php if (!isset($tempResults['pressure'])) { ?>
					<div class="styled-box iconed-box error">
						<span class="icon"></span>
						<b>Air Pressure</b>; Unknown
					</div>
				<?php } else {
					if ($tempResults['pressure'] < 100 || $tempResults['pressure'] > 1000000) {
						$state = 'warning';
					} else {
						$state = 'success';
					}
				?>
					<div class="styled-box iconed-box <?php echo $state; ?>">
						<span class="icon"></span>
						<b>Air Pressure</b>; <?php echo $tempResults['pressure']; ?>
					</div>
				<?php } ?>
			</div>
			<div class="span-6">
				<?php
					$gryo = getXYZ();
					if (is_array($gryo) && count($gryo) === 3) {
				?>
					<div class="styled-box iconed-box success">
						<span class="icon"></span>
						<b>Gyroscope</b> is working fine. Plane tilt is <a href="monitor.php#Tilt">
							<?php echo $gryo['x']; ?>&deg;,
							<?php echo $gryo['y']; ?>&deg;,
							<?php echo $gryo['z']; ?>&deg;</a>
					</div>
				<?php
					} else {
						if (!is_string($gryo)) {
							$gryo = 'And I\'m not sure why.';
						}
				?>	<div class="styled-box iconed-box error">
						<span class="icon"></span>
						<b>Gyroscope</b> is not working! <strong><?php echo $gryo; ?></strong>
					</div>
				<?php
					}
				?>
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
				<div class="styled-box iconed-box <?=($data === false ? 'alert' : ($data[0] > 0.8 * $cores ? 'error' : 'success'));?>">
					<span class="icon"></span>
					<b>Load</b> <?=($data === false ? ' information is unavailable on this system' : 'averages are; '.implode(', ', $data));?>
				</div>
				<div class="styled-box iconed-box <?=($df > 262144000 ? 'success' : ($df > 104857600 ? 'info' : 'alert'));?>">
					<span class="icon"></span>
					<b>Free Disk Space:</b> <?php echo bytes2human($df); ?>
				</div>
				<?php if (!isset($tempResults['temp'])) { ?>
					<div class="styled-box iconed-box alert">
						<span class="icon"></span>
						<b>Temperature: </b> Unknown
					</div>
				<?php } else {
					if ($tempResults['temp'] > 50 || $tempResults < - 10) {
						$state = 'warning';
					} else {
						$state = 'success';
					}
				?>
					<div class="styled-box iconed-box <?php echo $state; ?>">
						<span class="icon"></span>
						<b>Temperature:</b> <?php echo $tempResults['temp']; ?>&deg;C
					</div>
				<?php } ?>
			</div>
		</div>
		<div class="divider"></div>
		<h3 class="fancy-title"><a href="#Dials" name="Devices">Dials/Gauges</a></h3>
		<div class="row">
			<div class="span-4 knob-wrapper">
				<h3 class="fancy-title">Battery</h3>
				<input class="knob" data-min="0" data-max="100" data-angleOffset="-125" data-angleArc="250" value="<?php
					$a = round($cell->getTimeLeftPercent(),1);
					echo $a;
				?>" data-readOnly="true" />
			</div>
			<div class="span-4 knob-wrapper">
				<h3 class="fancy-title">Load</h3>
				<input class="knob" data-angleOffset="-125" data-max="1" value="<?php echo $data[0]; ?>" data-angleArc="250" value="<?php echo $cores; ?>" data-readOnly="true" />
			</div>
		</div>
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
<?php
	include './../templates/footer.php';
?>