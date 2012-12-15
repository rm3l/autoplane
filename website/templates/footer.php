				</div><!--- #page-container -->
			</section><!--- #page -->
			<footer id="page-footer" class="container-wrap">
				<div id="page-footer-container" class="container">
					<div class="widget span-3">
						<div class="widget-content">
							<img alt="Image" src="images/logo_bw.png" style="margin-bottom: 15px;" />
							<p>If you have any questions or would just like a chat about anything computer related then feel free to send me a message. Please remember, I'm in the UK. Please take account for any timezone differences. I like my sleep.</p>
							<hr>
							<dl>
								<dt>Telephone:</dt>
								<dd>+44 791 581 0570</dd>
								<dt>Fax:</dt>
								<dd>Don't waste paper</dd>
								<dt>E-mail:</dt>
								<dd><a href="mailto:<?=$email;?>"><?=$email;?></a></dd>
							</dl>
						</div><!-- .widget-content -->
					</div><!-- .widget -->
					<div class="widget span-3">
						<h4 class="widget-title">Log Feed</h4>
						<div class="widget-content">
							<div class="twitter-feed" data-user="envato">
								<div class="tweet">
									<div class="text">{text}</div>
									<div class="time">
										<a href="{tweet_url}" title="View this on Twitter" rel="nofollow">{time}</a>
									</div>
								</div>
							</div>
						</div><!-- .widget-content -->
					</div><!-- .widget -->
					<div class="widget span-3">
						<h4 class="widget-title">Flicker Stream</h4>
						<div class="widget-content">
							<div class="flickr-feed" data-user="52617155@N08">
								<div class="image">
									<a class="overlay" href="{url}" title="View this on Flickr" rel="nofollow"><span class="overlay-color"></span><img class="framed-image" src="{image}" alt="Image" /></a>
								</div>
							</div>
						</div><!-- .widget-content -->
					</div><!-- .widget -->
					<div class="widget span-3">
						<h4 class="widget-title">Contact</h4>
						<div class="widget-content">
							<form class="contact-form" action="send.php" method="post">
								<div class="form-input">
									<input type="text" data-prompt="Name" value="Name" name="name">
								</div>
								<div class="form-input">
									<input type="text" data-prompt="E-mail" value="E-mail" name="email">
								</div>
								<div class="form-input">
									<textarea data-prompt="Message" name="message">Message</textarea>
								</div>
								<p class="meta"><span>*</span> All fields are required</p>
								<button name="submit" type="submit">Send Message</button>
								<div class="form-failure">
									Message couldn't be sent, please try again.
								</div>
							</form>
							<div class="form-success">
								<h5>Thank You</h5>
								<p>
								We received your message and will be in touch with you as soon as possible.
								</p>
							</div>
						</div><!-- .widget-content -->
					</div><!-- .widget -->
				</div><!--- #page-footer-container -->
			</footer><!--- #page-footer -->
			<footer id="footer" class="container-wrap">
				<div id="footer-container" class="container">
					<div class="row">
						<div id="footer-left" class="span-6">
							<p id="copyright">&copy; <?=date("Y");?> <?=$copyright;?></p>
							<nav id="footer-nav-menu">
								<ul>
									<li>
										<a href="license.php">License</a>
									</li>
									<li>
										<a href="contact.php">Contact</a>
									</li>
								</ul>
							</nav>
						</div>
						<div id="footer-right" class="span-6">
							<div id="social-links">
								<p>Stay Connected</p>
								<ul>
									<li class="twitter-link">
										<a href="https://www.twitter.com/GingerPaul55" title="Twitter">Twitter</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div><!--- #page-footer-container -->
			</footer><!--- #page-footer -->
		</div><!--- #main-wrap -->
		<!-- Scripts -->
		<script type="text/javascript" src="scripts/jquery.easing.js"></script>
		<script type="text/javascript" src="scripts/jquery.cookie.js"></script>
		<script type="text/javascript" src="scripts/scripts.js"></script>
		<!-- Plugins -->
		<script type="text/javascript" src="plugins/colorbox/jquery.colorbox.js"></script>
		<script type="text/javascript" src="plugins/flexslider/jquery.flexslider-min.js"></script>
		<script type="text/javascript" src="plugins/mediaelement/mediaelement.min.js"></script>
		<script type="text/javascript" src="plugins/social/jquery.social.js"></script>
		<script type="text/javascript" src="plugins/quicksand/jquery-animate-css-rotate-scale.js"></script>
		<script type="text/javascript" src="plugins/quicksand/jquery-css-transform/jquery-css-transform.js"></script>
		<script type="text/javascript" src="plugins/quicksand/jquery.quicksand.js"></script>
		<!--[if lt IE 9]>
			<script src="scripts/ie/scripts.js" type="text/javascript"></script>
		<![endif]-->
		<?php
			if (isset($extrafoot)) {
				echo $extrafoot;
			}
		?>
	</body>
</html>
