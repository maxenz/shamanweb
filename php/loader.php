<!doctype html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Shaman SGE - </title>

</head>
<body>
<div id="loading-image">
	<img src="../images/pacman.gif" />
</div>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>
$.ajax({
			type: 'GET',
			dataType: 'json',
			url:'getReclamos.php',
			success: function(reclamos){
			
				
				 				
			}
		});
		
$.ajax({
			type: 'GET',
			dataType: 'json',
			url:'getIVA.php',
			success: function(reclamos){
				
				$('#loading-image').css("display","none");
				$('body').html('listo');
				
				 				
			}
		});
		
</script>
</body>
</html>