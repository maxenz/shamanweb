<?php

 include_once("_header.php");

?>
<div class="ctIndex">
	<div class="hero-unit" style="text-align:center;margin-top:-13px;margin-bottom:50px;border-bottom:3px solid #0088cc;" id="tituloIndex">
		<h1>Shaman SGE</h1>
		<p>Sistema Web de Emergencias M&eacute;dicas</p>
		<p><a href="#" class="m-btn blue">Acerca de &raquo;</a></p>
	</div>

  	<div class="row-fluid">

    	<div class="span4 titulosIndex">
      		<h2>Operativa</h2>
      		<p>Aca deberia haber informacion, pero la verdad que no tengo idea que verga poner. Cuando javi me diga que seria conveniente poner aca,
      			seguramente va a haber informacion mucho mas valiosa que esta cagada. </p>
	  		<div style="text-align:center">
				<button class="win-command">
					<span class="win-commandimage win-commandring" id="btnGoToOperativa">&#xe189;</span>
				</button>
			</div>
        </div>

        <div class="span4 titulosIndex">
          	<h2>Clientes</h2>
          	<p>Aca deberia haber informacion, pero la verdad que no tengo idea que verga poner. Cuando javi me diga que seria conveniente poner aca,
          		seguramente va a haber informacion mucho mas valiosa que esta cagada. </p>
           	<div style="text-align:center">
				<button class="win-command" id="btnGoToClientes">
					<span class="win-commandimage win-commandring">&#xe15f;</span>
				</button>
			</div>
       	</div>

        <div class="span4 titulosIndex">
          	<h2>M&oacute;viles</h2>
          	<p>Aca deberia haber informacion, pero la verdad que no tengo idea que verga poner. Cuando javi me diga que seria conveniente poner aca,
          		seguramente va a haber informacion mucho mas valiosa que esta cagada.</p>
			<div style="text-align:center">
				<button class="win-command" id="btnGoToMoviles">
					<span class="win-commandimage win-commandring">&#xe006;</span>
				</button>
        	</div>
      	</div>
      </div>

	<?php include_once ("_footer.php"); ?>
	
	<script>

		$('#btnGoToOperativa').click(function(e){ window.location = 'panelOperativo.php'; });
		$('#btnGoToClientes').click(function(e){ window.location = 'clientes.php'; });
		$('#btnGoToMoviles').click(function(e){ window.location = 'maestroMoviles.php'; });

		var version = '<?php echo $_SESSION["v"]; ?>';
		console.log(version);

		if (version == 'full') {

			$('#btnGoToMoviles, #btnGoToClientes').attr("disabled","disabled");
			$('#btnGoToMoviles, #btnGoToClientes').off('click');
			$('#tituloIndex').css("border-bottom","3px solid green");

		} else {

			$('.nav li.dropdown').css("display","block");
		}

		$('.ctIndex').css("display","block");

	</script>

</body>
</html>
