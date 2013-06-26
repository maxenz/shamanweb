   
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<script>window.jQuery || document.write("<script src='../bootmetro-0.6.0/scripts/jquery-1.8.2.min.js'>\x3C/script>")</script>
	<script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
	<script src="../jqwidgets/jqxcore.js"></script>
	<script src="../jqwidgets/jqxbuttons.js"></script>
	<script src="../jqwidgets/jqxscrollbar.js"></script>
	<script src="../jqwidgets/jqxmenu.js"></script>
	<script src="../jqwidgets/jqxtabs.js"></script>
	<script src="../jqwidgets/jqxdata.js"></script>
	<script src="../jqwidgets/jqxdropdownlist.js"></script>
	<script src="../jqwidgets/jqxgrid.js"></script>
	<script src="../jqwidgets/jqxgrid.sort.js"></script>
	<script src="../jqwidgets/jqxgrid.columnsresize.js"></script>
	<script src="../jqwidgets/jqxgrid.filter.js"></script>
	<script src="../jqwidgets/jqxgrid.pager.js"></script>
	<script src="../jqwidgets/jqxgrid.edit.js"></script>
	<script src="../jqwidgets/jqxgrid.selection.js"></script>
	<script src="../jqwidgets/jqxwindow.js"></script>
	<script src="../jqwidgets/jqxpanel.js"></script>
	<script src="../jqwidgets/jqxdragdrop.js"></script>
	<script src="../jqwidgets/jqxinput.js"></script>
	<script src="../jqwidgets/jqxdatetimeinput.js"></script>
	<script src="../jqwidgets/jqxnumberinput.js"></script>
	<script src="../jqwidgets/jqxgrid.columnsresize.js"></script>
	<script src="../jqwidgets/jqxcalendar.js"></script>
	<script src="../jqwidgets/jqxlistbox.js"></script>
	<script src="../jqwidgets/globalization/jquery.global.js"></script>
	<script src="../jqwidgets/jqxcheckbox.js"></script>
	<script src="../scripts/global.js"></script>
	<script src="../notify/js/bootstrap-notify.js"></script>
	<script type="text/javascript" src="../bootmetro-0.6.0/scripts/google-code-prettify/prettify.js"></script>
	<script type="text/javascript" src="../bootmetro-0.6.0/scripts/jquery.mousewheel.js"></script>
	<script type="text/javascript" src="../bootmetro-0.6.0/scripts/jquery.scrollTo.js"></script>
	<script type="text/javascript" src="../bootmetro-0.6.0/scripts/bootstrap.min.js"></script>
	<script type="text/javascript" src="../bootmetro-0.6.0/scripts/bootmetro.js"></script>
	<script type="text/javascript" src="../bootmetro-0.6.0/scripts/bootmetro-charms.js"></script>
	<script type="text/javascript" src="../scripts/context.js"></script>
   
	<script type="text/javascript">
   
	setTooltips();
	bindEventosGrales();
   
	function setTooltips() {
	
		//$(".metro").metro();
		$('#home').tooltip({title: 'Ir a Home', placement: 'bottom'});
		$('#close').tooltip({title: 'Cerrar Sesión', placement: 'bottom'});
		$('#btnFacebook').tooltip({title: 'Facebook', placement: 'top'});
		$('#btnTwitter').tooltip({title: 'Twitter', placement: 'top'});
		$('#btnGooglePlus').tooltip({title: 'Google +', placement: 'top'});
		$('#btnGoToOperativa').tooltip({title: 'Ir a Operativa', placement: 'top'});
		$('#btnGoToMoviles').tooltip({title: 'Ir a Móviles', placement: 'top'});
		$('#btnGoToClientes').tooltip({title: 'Ir a Clientes', placement: 'top'});
		
	}
	
	function bindEventosGrales() {
	
		$('#close').on('click',function(ev){

			$.ajax({
				type: "GET",
				url: "cierrosesion.php",
				success: function(datos){			
					$('#modalCerrarSesion').modal('show');	
				}
			});				
		});
		
		$('#home').on('click',function(ev){
		
			window.location = 'index.php';
		
		});
	
		 $('#menuPrincipal li a').click(function(e) {
		
			var id = $(this).attr("id");
			//alert(id);
			switch (id) {
				
				case '209':
					window.location = 'panelOperativo.php';
				break;
				
				case '112':
					window.location = 'clientes.php';
				break;
				
				case '109':
					window.location = 'rubrosClientes.php';
				break;
				
				case '111':
					window.location = 'planesDeCobertura.php';
				break;
				
				case '96':
					window.location = 'marcasModelos.php';
				break;
				
				case '94':
					window.location = 'basesOperativas.php';
				break;
				
				case '97':
					window.location = 'maestroVehiculos.php';
				break;
				
				case '95':
					window.location = 'tipoMoviles.php';
				break;
				
				case '98':
					window.location = 'maestroMoviles.php';
				break;
											
			}
		
		});
	}
		
	
	function showLogin() {
	
		window.location = '../login/login.php';
	
	}
	
	
	  
   </script>
   
	




  