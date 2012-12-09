<?
	$page = 'contact';
	include './../templates/header.php';
?>
				<div id="page-container" class="container">
					<header id="page-header">
						<h1><span>Contact</span><small>We'd love to hear from you</small></h1>
					</header><!--- #page-header -->
					<div id="page-content">
						<div id="contact-page">
							<div class="row">
								<span class="span-12">
									<iframe style="width: 100%; height: 300px;" src="http://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=&amp;sll=38.013775,-84.198042&amp;sspn=22.333806,53.569336&amp;ie=UTF8&amp;ll=38.013775,-84.198042&amp;spn=22.333806,53.569336&amp;t=m&amp;z=5&amp;output=embed"></iframe>
								</span>
							</div>
							<div class="micro divider"></div>
							<div class="row">
								<div class="span-6">
									<h3 class="fancy-title">Contact Form</h3>
									<div>
										<form class="contact-form" action="contact.php" method="post">
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
								</div>
								<div class="span-6">
									<h3 class="fancy-title">Contact Info.</h3>
									<dl>
										<dt>Telephone:</dt>
										<dd>+1 234 567 8910</dd>
										<dt>Fax:</dt>
										<dd>+1 0198 432 4567</dd>
										<dt>E-mail:</dt>
										<dd><a href="mailto:mail@domain.com">mail@domain.com</a></dd>
									</dl>
									<hr>
									<p>Lorem ipsum dolor sit amet nec, consectetuer adipiscing elit. Aenean commodo ligula eget dolor.</p>
								</div>
							</div>
						</div>
					</div><!--- #page-content -->
				</div><!--- #page-container -->
<?
	include './../templates/footer.php';
?>
