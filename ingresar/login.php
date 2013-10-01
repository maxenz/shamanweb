<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Shaman SGE - Login</title>

<link href="css/stylelogin.css" rel="stylesheet" type="text/css" />
<link href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700' rel='stylesheet' type='text/css'>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script src="js/jquery.leanModal.min"></script>


<script type="text/javascript">

$(document).ready(function() {
	
<?php

$version = $_GET["v"];


session_start();
if (isset($_GET["error"])) {
	
?>
    
var error = '<?php echo $_SESSION['error']; ?>';
alert(error);
    <?php
}

 ?>

});
</script>

<style>

#lean_overlay {
    position: fixed;
    z-index:100;
    top: 0px;
    left: 0px;
    height:100%;
    width:100%;
    background: #000;
    display: none;
}

</style>

</head>
<body class="invisible">

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
    <input type="hidden" name="version" value="<?php echo $version ?>"></input>
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

<input type="button" value="modal" id="btnModal"/>

<!--GRADIENT--><div class="gradient"></div><!--END GRADIENT-->


<script>

var version = '<?php echo $version ?>';
//alert(version);

if (version == 'full') {

    $('.login-form .footer .button ').css("background","green");
    $('.login-form .footer .button ').css("border","1px solid green");
    $('.login-form .footer .button:hover').css("background","green");
    $('body').css("background","green");

}

    $('body').removeClass("invisible");
    $("#btnModal").leanModal();

</script>


</body>
</html>