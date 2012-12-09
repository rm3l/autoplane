<?php
	$page = 'home';
	include './../templates/header.php';
?>
<header id="page-header" class="center">
	<h1><span>Fully <em class="colored">autonomous</em> plane</span><small>Programmed in PHP, open sourced and <span class="colored">free</span>, forever!</small></h1>
</header><!--- #page-header -->
<div id="page-content">
<div class="row has-divider home-slider">
	<div class="span-9">
		<div class="flexslider">
			<ul class="slides">
				<li><img alt="Image" src="assets/home_slides/responsive.jpg" /></li>
				<li><img alt="Image" src="assets/home_slides/html5.jpg" /></li>
				<li><img alt="Image" src="assets/home_slides/awesome.jpg" /></li>
			</ul>
		</div>
	</div>
	<div class="span-3">
		<h1 style="line-height: 1em;">Simple but <em class="colored">powerful</em></h1>
		<h6 class="shade-9">The software is capable of taking complete control over an remote control airplane. It can fly from to any destination via waypoints.</h6>
		<div class="divider dashed micro"></div>
		<p>
		The software can sucessfully control the rudder, elevators, flaps, ailerons and the engine to fly to any given point in the world.
		</p>
		<p>
		It is able to complete all of this by using GPS data, gyroscopes and a camera as it's eyes and ears.
		</p>
		<a href="/download.php" class="button">Download the software</a>
	</div>
</div>
<div class="portfolio portfolio-4 row has-divider">
	<div class="span-3">
		<h3 class="fancy-title">Featured Work</h3>
		<p>
		Etiam auctor tincidunt augue at pharetra. Nam posuere tristique sem, eu ultricies tortor imperdiet vitae.
		</p>
	</div>
	<div class="span-3">
		<article class="entry">
			<div class="entry-wrap">
				<div class="entry-feature">
					<a href="assets/full/1.jpg" class="overlay colorbox" title="Mexican Coke">
						<span class="overlay-color"></span>
						<span class="overlay-icon zoom"></span>
						<img alt="Image" src="assets/resized_s/1.jpg" />
					</a>
				</div><!-- .entry-feature -->
				<div class="entry-body">
					<header>
						<h2 class="entry-title">
							<a href="#">Mexican Coke</a>
						</h2><!-- .entry-title -->
						<div class="entry-meta">
							<span class="tags">
								<span>Art Direction</span>
								<span class="separator">|</span>
								<span>Photography</span>
							</span>
						</div><!-- .entry-meta -->
					</header>
				</div><!-- .entry-body -->
			</div><!-- .entry-wrap -->
		</article>
	</div>
	<div class="span-3">
		<article class="entry">
			<div class="entry-wrap">
				<div class="entry-feature">
					<a href="assets/full/2h.jpg" class="overlay colorbox" title="The Land Within">
						<span class="overlay-color"></span>
						<span class="overlay-icon zoom"></span>
						<img alt="Image" src="assets/resized_s/2h.jpg" />
					</a>
				</div><!-- .entry-feature -->
				<div class="entry-body">
					<header>
						<h2 class="entry-title">
							<a href="#">The Land Within</a>
						</h2><!-- .entry-title -->
						<div class="entry-meta">
							<span class="tags">
								<span>Art Direction</span>
								<span class="separator">|</span>
								<span>Illustration</span>
							</span>
						</div><!-- .entry-meta -->
					</header>
				</div><!-- .entry-body -->
			</div><!-- .entry-wrap -->
		</article>
	</div>
	<div class="span-3">
		<article class="entry">
			<div class="entry-wrap">
				<div class="entry-feature">
					<a href="assets/full/6.jpg" class="overlay colorbox" title="Apples 2 Apples">
						<span class="overlay-color"></span>
						<span class="overlay-icon zoom"></span>
						<img alt="Image" src="assets/resized_s/6.jpg" />
					</a>
				</div><!-- .entry-feature -->
				<div class="entry-body">
					<header>
						<h2 class="entry-title">
							<a href="#">Apples 2 Apples</a>
						</h2><!-- .entry-title -->
						<div class="entry-meta">
							<span class="tags">
								<span>Digital Art</span>
								<span class="separator">|</span>
								<span>Illustration</span>
							</span>
						</div><!-- .entry-meta -->
					</header>
				</div><!-- .entry-body -->
			</div><!-- .entry-wrap -->
		</article>
	</div>
</div>
<div class="row has-divider clients-grid">
	<div class="span-3">
		<h3 class="fancy-title">Our Clients</h3>
		<p>
		Sed tristique aliquet massa a vulputate. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia.
		</p>
	</div>
	<div class="span-3">
		<a href="#" class="entry overlay">
			<span class="overlay-color"></span>
			<img alt="Image" src="assets/clients/1.png" />
		</a>
		<a href="#" class="entry overlay">
			<span class="overlay-color"></span>
			<img alt="Image" src="assets/clients/2.png" />
		</a>
	</div>
	<div class="span-3">
		<a href="#" class="entry overlay">
			<span class="overlay-color"></span>
			<img alt="Image" src="assets/clients/3.png" />
		</a>
		<a href="#" class="entry overlay">
			<span class="overlay-color"></span>
			<img alt="Image" src="assets/clients/4.png" />
		</a>
	</div>
	<div class="span-3">
		<a href="#" class="entry overlay">
			<span class="overlay-color"></span>
			<img alt="Image" src="assets/clients/5.png" />
		</a>
		<a href="#" class="entry overlay">
			<span class="overlay-color"></span>
			<img alt="Image" src="assets/clients/6.png" />
		</a>
	</div>
</div>
</div>
<?php
	include './../templates/footer.php';
?>
