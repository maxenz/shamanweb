<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>

<!--------------------
LOGIN FORM
by: Amit Jakhu
www.amitjakhu.com
--------------------->

<!--META-->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Shaman SGE - Login</title>

<!--STYLESHEETS-->
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="../jqwidgets/styles/jqx.base.css" type="text/css">
<link rel="stylesheet" href="../jqwidgets/styles/jqx.ui-sunny.css" type="text/css">
<link rel="stylesheet" href="../jqwidgets/styles/jqx.alert-window.css" type="text/css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
<script type="text/javascript" src="../jqwidgets/jqxcore.js"></script>
<script type="text/javascript" src="../jqwidgets/jqxwindow.js"></script>

<!--SCRIPTS-->

<!--Slider-in icons-->
<script type="text/javascript">
$(document).ready(function() {
	
$("#jqxwindow").jqxWindow({ width: 300, height: 100, theme: 'metro', isModal: true, autoOpen: false });

<?php
session_start();
if (isset($_GET["error"])) {
	?>
    

var error = '<?php echo $_SESSION['error']; ?>';

$('#jqxwindow').jqxWindow('setContent',error);
$('#jqxwindow').jqxWindow('setTitle','ERROR');
$('#jqxwindow').jqxWindow('open');
  
     <?php
 }

 ?>



	
	$(".username").focus(function() {
		$(".user-icon").css("left","-48px");
	});
	$(".username").blur(function() {
		$(".user-icon").css("left","0px");
	});
	
	$(".password").focus(function() {
		$(".pass-icon").css("left","-48px");
	});
	$(".password").blur(function() {
		$(".pass-icon").css("left","0px");
	});
});
</script>

</head>
<body>



<div id='jqxwindow'>
<div></div>
<div></div>
</div>

<!--WRAPPER-->
<div id="wrapper">

	<!--SLIDE-IN ICONS-->
    <div class="user-icon"></div>
    <div class="pass-icon"></div>
    <!--END SLIDE-IN ICONS-->

<!--LOGIN FORM-->
<form name="login-form" class="login-form" action="../php/control.php" method="post">

	<!--HEADER-->
    <div class="header">
    <!--TITLE--><h1>Login Shaman SGE</h1><!--END TITLE-->
    <!--DESCRIPTION--><span>Por favor ingrese su nombre de usuario y contraseña.</span><!--END DESCRIPTION-->
    </div>
    <!--END HEADER-->
	
	<!--CONTENT-->
    <div class="content">
	<!--USERNAME--><input name="usuario" type="text" class="input username" value=""  /><!--END USERNAME-->
    <!--PASSWORD--><input name="password" type="password" class="input password" value=""  /><!--END PASSWORD-->
    </div>
    <!--END CONTENT-->
    
    <!--FOOTER-->
    <div class="footer">
    <!--LOGIN BUTTON--><input type="submit" name="submit" value="Login" class="button" /><!--END LOGIN BUTTON-->
    </div>
    <!--END FOOTER-->

</form>
<!--END LOGIN FORM-->

</div>
<!--END WRAPPER-->

<!--GRADIENT--><div class="gradient"></div><!--END GRADIENT-->

</body>
</html>