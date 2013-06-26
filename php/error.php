<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ERROR</title>
<link rel="stylesheet" href="../jqwidgets/styles/jqx.base.css" type="text/css">
<link rel="stylesheet" href="../jqwidgets/styles/jqx.metro.css" type="text/css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
<script type="text/javascript" src="../jqwidgets/jqxcore.js"></script>
<script type="text/javascript" src="../jqwidgets/jqxwindow.js"></script>
<script type="text/javascript" src="../jqwidgets/jqxbuttons.js"></script>
</head>

<body>
<script type="text/javascript">
$(document).ready(function(e) {
    
$('#okButton').jqxButton({ width:100, height:30, theme: 'metro' });
$('#okButton').css("margin-left","35%").css("margin-top","15px").css("cursor","pointer");

$("#jqxwindow").jqxWindow({ width: 300, height: 120, theme: 'metro', okButton: $('#okButton'), showCloseButton: false, isModal: false });
$('#okButton').click(function(e) {
    
	window.location = '../login/login.php';
	
	});

});

</script>

<div id="jqxwindow">
<div>ERROR</div>
<div>
<table>
<tr>
<td>No tiene autorización para ingresar al sitio.</td></tr>
<tr><td><input type="button" id="okButton" value="Ir a Login" /></td></tr>

</table>
</div>
</div>
</body>
</html>