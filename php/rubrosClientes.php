<?php

 include_once("_header.php");

?>
	<div id="grdRubrosClientes" style="margin-left:auto;margin-right:auto"></div>
		
	<div id="dialogoAgregar" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
			<h3 id="myModalLabel">Agregar/Modificar Marca/Modelo</h3>
		</div>
		<div class="modal-body">
			<form class="form-horizontal">
			
				<div class="control-group">
					<label class="control-label" for="txtCodRubro">C&oacute;digo</label>
					<div class="controls">
						<input type="text" id="txtCodRubro">
					</div>
				</div>
				
				<div class="control-group">
					<label class="control-label" for="txtDescRubro">Descripci&oacute;n</label>
					<div class="controls">
						<input type="text" id="txtDescRubro">
					</div>
				</div>
			</form>
		</div>
		
		<div class="modal-footer" style="text-align:center">
			<div class="btn-group">
				<button class="btn btn-primary" id="btnAceptarRubroCliente">Aceptar</button>
				<button class="btn" data-dismiss="modal" id="btnCancelarRubroCliente">Cancelar</button>
			</div>
		</div>	
	</div>
	
	<div id="dialogoEliminar" class="modal message hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
			<h3>Aviso Importante!</h3>
		</div>
		<div class="modal-body">
			<p>Seguro que quiere eliminar el rubro?</p>
		</div>
		<div class="modal-footer">
			<button id="btnElimRubro" class="btn btn-info" >Aceptar</button>
			<button class="btn btn-danger" data-dismiss="modal">Cancelar</button>
		</div>
	</div>           
	
	
	<footer class="win-commandlayout navbar-fixed-bottom win-ui-dark">
      <div class="container">
         <div class="row">
            <div class="span6 align-left">
   
               <button class="win-command" onClick="agregarRubroCliente();">
                  <span class="win-commandimage win-commandring">&#xe03e;</span>
                  <span class="win-label">Agregar</span>
               </button>
   
               <button class="win-command" onClick="deleteRubroCliente();">
                  <span class="win-commandimage win-commandring">&#xe003;</span>
                  <span class="win-label">Eliminar</span>
               </button>
   
               <button class="win-command" onClick="actualizarGrd();" >
                  <span class="win-commandimage win-commandring">&#xe125;</span>
                  <span class="win-label">Actualizar</span>
               </button>
   
            </div>
   
            <div class="span6 align-right">
   
               <button id="btnFacebook" class="win-command">
                  <span class="win-commandimage win-commandring">&#xe090;</span>
                  <span class="win-label"></span>
               </button>
   
               <button id="btnTwitter" class="win-command">
                  <span class="win-commandimage win-commandring">&#xe091;</span>
                  <span class="win-label"></span>
               </button>
   
               <button id="btnGooglePlus" class="win-command">
                  <span class="win-commandimage win-commandring">&#xe08c;</span>
                  <span class="win-label"></span>
               </button>
			   
            </div>
         </div>
      </div>
   </footer>

	<?php include_once ("_footer.php"); ?>

	<script src="../scripts/fcsRubrosClientes.js"></script>

	<script>
	
		$('#tituloOpcion').text('Rubros de Clientes');
		initGrdRubrosClientes();
		setGrdRubrosClientes();
		bindEventos();
		setFocusGrid();
		setFocusNext();
		
	</script>

 </body>
</html>