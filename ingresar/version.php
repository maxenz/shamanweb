<!DOCTYPE HTML>

<html>
	<head>
		<title>Astral by HTML5 UP</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400" rel="stylesheet" />
		<script src="js/jquery.min.js"></script>
		<script src="js/config.js"></script>
		<script src="js/skel.min.js"></script>
		<script src="js/jquery.transit.min.js"></script>		
		<noscript>
			<link rel="stylesheet" href="css/skel-noscript.css" />
			<link rel="stylesheet" href="css/style.css" />
			<link rel="stylesheet" href="css/style-desktop.css" />
			<link rel="stylesheet" href="css/noscript.css" />
		</noscript>
		<!--[if lte IE 8]><script src="js/html5shiv.js"></script><link rel="stylesheet" href="css/ie8.css" /><![endif]-->
		
		<script>
			$(document).ready(function(){
				$( ".image.version" ).hover(
					function() {
						$( this ).transition({ y: '17px' });
					}, function() {
						$( this ).transition({ y: '-17px' });
					}
				);
			});
		</script>
	</head>
	<body class="homepage">

		<!-- Wrapper-->
			<div id="wrapper">
				
				<!-- Nav -->
					<nav id="nav">
						<a href="#me" class="icon icon-home active"><span>Inicio</span></a>
						<a href="#work" class="icon icon-tasks"><span>Versiones</span></a>
						<a href="#email" class="icon icon-envelope"><span>Contacto</span></a>
					</nav>

				<!-- Main -->
					<div id="main">
						
						<!-- Me -->
							<article id="me" class="panel">
								<header>
									<h1>Shaman SGE</h1>
									<span class="byline">Sistema de Gesti&oacute;n de Emergencias</span>
								</header>
								<a href="#work" class="jumplink pic">
									<span class="jumplink arrow icon icon-chevron-right"><span>See my work</span></span>
									<img src="images/lateral.jpg" alt="" />
								</a>
							</article>

						<!-- Work --> 
							<article id="work" class="panel">
								<header>

								</header>

								<section>
									<table id="tbVersiones">
										<tr>
											<td>
												<a href="login.php?v=full" class="image version"><img src="css/images/full.png"></a>
												<h2>Shaman Full</h2>
											</td>
											<td>
												<a href="login.php?v=express" class="image version"><img src="css/images/express.png"></a>
												<h2>Shaman Express</h2>
											</td>
										</tr>
									</table>	
								</section>
							</article>

						<!-- Email -->
							<article id="email" class="panel">
								<header>
									<h2>Consultas</h2>
								</header>
								<form action="#" method="post">
									<div>
										<div class="row half">
											<div class="6u">
												<input type="text" class="text" name="name" placeholder="Nombre" />
											</div>
											<div class="6u">
												<input type="text" class="text" name="email" placeholder="Email" />
											</div>
										</div>
										<div class="row half">
											<div class="12u">
												<input type="text" class="text" name="subject" placeholder="Asunto" />
											</div>
										</div>
										<div class="row half">
											<div class="12u">
												<textarea name="message" placeholder="Mensaje"></textarea>
											</div>
										</div>
										<div class="row">
											<div class="12u">
												<input type="submit" class="button" value="Enviar" />
											</div>
										</div>
									</div>
								</form>
							</article>

					</div>
			</div>
	</body>
</html>