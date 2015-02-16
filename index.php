<!DOCTYPE html>
<html lang="en">
<head>
	<?php
		include 'db/dbconn.php'; //contains DB connection string and global variables
		
		$sqlSetup = mysql_query("SELECT title, author, keywords, description, headercode, googleanalytics, portfolioheading FROM setup");
		$rowSetup  = mysql_fetch_array($sqlSetup);
	?>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?php echo $rowSetup["description"];?>">
    <meta name="keywords" content="<?php echo $rowSetup["keywords"];?>">
    <meta name="author" content="<?php echo $rowSetup["author"];?>">

    <title><?php echo $rowSetup["title"];?></title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Theme CSS -->
    <link href="css/freelancer.css" rel="stylesheet">

    <!-- Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">
    <!-- Custom CSS -->
		<link href="css/custom.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	<?php
	echo $rowSetup["headercode"]."\n";

	if ($rowSetup["googleanalytics"]) {
		$googleID = $rowSetup["googleanalytics"];
	?>
		<script type="text/javascript">
			
			var _gaq = _gaq || [];
			_gaq.push(['_setAccount', '<?php echo $googleID ?>']);
			_gaq.push(['_trackPageview']);
			
			(function() {
			  var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
			  ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
			  var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
			})();
			
		</script>
	<?php 
	} 
	?>
</head>

<body id="page-top" class="index">
	<?php 
		$sqlLanding = mysql_query("SELECT heading, introtext, skills, image FROM landing");
		$rowLanding = mysql_fetch_array($sqlLanding);
		
		$sqlAbout = mysql_query("SELECT heading, content FROM aboutus");
		$rowAbout = mysql_fetch_array($sqlAbout);
		
		$sqlFooter = mysql_query("SELECT heading, content FROM footer");
		$rowFooter = mysql_fetch_array($sqlFooter);
		
		$sqlContact = mysql_query("SELECT heading, email, sendtoemail, address, city, state, zipcode, phone FROM contactus");
		$rowContact = mysql_fetch_array($sqlContact);
		
		$sqlSocial = mysql_query("SELECT heading, facebook, twitter, linkedin, google FROM socialmedia");
		$rowSocial = mysql_fetch_array($sqlSocial);
	?>
    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#page-top"><?php echo $rowLanding["heading"];?></a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <li class="page-scroll">
                        <a href="#portfolio"><?php echo $rowSetup["portfolioheading"];?></a>
                    </li>
                    <li class="page-scroll">
                        <a href="#about"><?php echo $rowAbout["heading"];?></a>
                    </li>
                    <li class="page-scroll">
                        <a href="#contact"><?php echo $rowContact["heading"];?></a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

    <!-- Header -->
    <header>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <img class="img-responsive" src="uploads/<?php echo $rowLanding["image"];?>" alt="">
                    <div class="intro-text">
                        <span class="name"><?php echo $rowLanding["introtext"];?></span>
                        <hr class="star-light">
                        <span class="skills"><?php echo $rowLanding["skills"];?></span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Portfolio Grid Section -->
    <section id="portfolio">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2><?php echo $rowSetup["portfolioheading"];?></h2>
                    <hr class="star-primary">
                </div>
            </div>
            <div class="row">
			<?php
				$sqlPages = mysql_query("SELECT id, title, thumbnail, content, active, datetime FROM pages WHERE active=1 ORDER BY datetime DESC");
				while ($rowPages  = mysql_fetch_array($sqlPages)) {
			?>
            <div class="col-sm-4 portfolio-item">
                <a href="#portfolioModal<?php echo $rowPages["id"];?>" class="portfolio-link" data-toggle="modal">
                    <div class="caption">
                        <div class="caption-content">
                            <i class="fa fa-search-plus fa-3x"></i>
                        </div>
                    </div>
					<?php 
						if ($rowPages["thumbnail"] != "") {
						echo "<img src='uploads/".$rowPages["thumbnail"]."' class='img-responsive' alt=''>";
						} else {
							echo "<img src='img/portfolio/cake.png' class='img-responsive' alt=''>";
						}
					?>
                </a>
            </div>
      <?php 
				} 
			?>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="success" id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2><?php echo $rowAbout["heading"];?></h2>
                    <hr class="star-light">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-lg-offset-0 text-center">  
                	<?php echo $rowAbout["content"];?>
                </div>
            </div>
        </div>
    </section>
 
  <!-- Contact Section -->
    <section id="contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2><?php echo $rowContact["heading"];?></h2>
                    <hr class="star-primary">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">
                    <form name="sentMessage" id="contactForm" method="post" action="mail/contact_me.php">
                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <label>Name</label>
                                <input type="text" class="form-control" placeholder="Name" id="name" name="name" required data-validation-required-message="Please enter your name.">
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <label>Email Address</label>
                                <input type="email" class="form-control" placeholder="Email Address" id="email" name="email" required data-validation-required-message="Please enter your email address.">
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <label>Phone Number</label>
                                <input type="tel" class="form-control" placeholder="Phone Number" id="phone" name="phone" required data-validation-required-message="Please enter your phone number.">
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <label>Message</label>
                                <textarea rows="5" class="form-control" placeholder="Message" id="message" name="message" required data-validation-required-message="Please enter a message."></textarea>
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
						<input type="hidden" name="sendToEmail" value="<?php echo $rowContact["sendtoemail"];?>"/>
                        <br>

						<?php
							if ($_GET["msgsent"]=="thankyou") {
								echo "<div id='success'><div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-hidden='true' onclick=\"window.location.href='index.php#contact'\">×</button><strong>Your message has been sent. </strong></div></div>";
							} else if ($_GET["msgsent"]=="error") {
								echo "<div id='success'><div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-hidden='true' onclick=\"window.location.href='index.php#contact'\">×</button><strong>An error occured while sending your message. </strong></div></div>";
							}
						?>
						
                        <div class="row">
                            <div class="form-group col-xs-12">
                                <button type="submit" class="btn btn-success btn-lg">Send</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="text-center">
        <div class="footer-above">
            <div class="container">
                <div class="row">
                    <div class="footer-col col-md-4">
                        <h3>Location</h3>
                        <p><?php echo $rowContact["address"];?><br><?php echo $rowContact["city"];?>, <?php echo $rowContact["state"];?> <?php echo $rowContact["zipcode"];?><br><?php echo $rowContact["phone"];?><br><?php echo $rowContact["email"];?></p>
                    </div>
                    <div class="footer-col col-md-4">
                        <h3><?php echo $rowSocial["heading"];?></h3>
                        <ul class="list-inline">
                            <li>
								<?php
									if (!empty($rowSocial["facebook"])){
										echo "<a href=".$rowSocial["facebook"]." class='btn-social btn-outline'><i class='fa fa-fw fa-facebook'></i></a>";
									}
								?>
                            </li>
                            <li>
								<?php
									if (!empty($rowSocial["google"])){
										echo "<a href=".$rowSocial["google"]." class='btn-social btn-outline'><i class='fa fa-fw fa-google-plus'></i></a>";
									}
								?>
                            </li>
                            <li>
								<?php
									if (!empty($rowSocial["twitter"])){
										echo "<a href=".$rowSocial["twitter"]." class='btn-social btn-outline'><i class='fa fa-fw fa-twitter'></i></a>";
									}
								?>
                            </li>
                            <li>
								<?php
									if (!empty($rowSocial["linkedin"])){
										echo "<a href=".$rowSocial["linkedin"]." class='btn-social btn-outline'><i class='fa fa-fw fa-linkedin'></i></a>";
									}
								?>
                            </li>
                        </ul>
                    </div>
                    <div class="footer-col col-md-4">
                        <h3><?php echo $rowFooter["heading"];?></h3>
                        <p><?php echo $rowFooter["content"];?></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-below">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        Copyright &copy; <?php echo $_SERVER['HTTP_HOST']."&nbsp;".date("Y");?>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scroll to Top Button (Only visible on small and extra-small screen sizes) -->
    <div class="scroll-top page-scroll visible-xs visble-sm">
        <a class="btn btn-primary" href="#page-top">
            <i class="fa fa-chevron-up"></i>
        </a>
    </div>
<?php
	$sqlPages = mysql_query("SELECT id, title, thumbnail, content, active FROM pages WHERE active=1");
	while ($rowPages  = mysql_fetch_array($sqlPages)) {
?>
    <!-- Portfolio Modals -->
    <div class="portfolio-modal modal fade" id="portfolioModal<?php echo $rowPages["id"];?>" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-content">
            <div class="close-modal" data-dismiss="modal">
                <div class="lr">
                    <div class="rl">
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="modal-body">
                            <h2><?php echo $rowPages["title"];?></h2>
                            <hr class="star-primary">
							<?php 
	                            if ($rowPages["thumbnail"] != "") {
	                                echo "<img src='uploads/".$rowPages["thumbnail"]."' class='img-responsive img-centered' alt=''>";
	                            } else {
	                                echo "<img src='img/portfolio/cake.png' class='img-responsive' alt=''>";
	                            }
                            ?>
                            <p><?php echo $rowPages["content"];?></p>
                            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php 
	} 
?>
    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script src="js/classie.js"></script>
    <script src="js/cbpAnimatedHeader.js"></script>

    <!-- Contact Form JavaScript -->
    <script src="js/jqBootstrapValidation.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="js/freelancer.js"></script>

</body>

</html>
<?php
	//close all db connections
	mysql_close($db_conn);
	die();
?>