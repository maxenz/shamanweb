<?php

 include_once("_header.php");

?>

<div id="ctGrillaPlanes" class="ctToggle"> 
	 
	<div id="grdPlanesCobertura" style="margin-left:auto;margin-right:auto"></div>
	
</div>

<div id="ctOpcionesPlanes" class="ctToggle" style="display:none">
	<table style="margin-left:auto;margin-right:auto">
		<tr>
			<td>
				<div id="panelPlanes" style="width:300px;height:350px;border:1px solid black;background:#FFFFFF">
					<div style="text-align:center">
						<span class="label" style="padding:15px;margin-top:15px;margin-bottom:10px;background:#24A0DA">Coberturas y CoPagos</span>
					</div>
					<div id="grdPlanes" style="margin-left:auto;margin-right:auto;"></div>   
				</div>
			</td>
			<td>
				<div id="panelObservaciones" style="width:623px;height:350px;border:1px solid black;background:#FFFFFF">
					<table style="margin-left:5px">
						<tr>
							<td>
								<label>C&oacute;digo</label>
								<input type="text" id="txtCodPlan" style="width:150px" class="textbox" />                                        
							</td>
							<td>
								<label>Descripci&oacute;n</label>
								<input type="text" id="txtDescPlan" style="width:450px" class="textbox" />
							</td>
						 </tr>
					</table>
					
					<div style="text-align:center">
						<span class="label" style="padding:15px;margin-bottom:5px;background:#24A0DA">Observaciones Operativas</span>
					</div>
				
				<input type="hidden" id="hidIdPlan" />
				<div style="margin-left:1px">
					<textarea id="txtAObsCobertura" style="width:600px;height:185px;resize:none;margin-left:10px"></textarea>
				</div>
				
				<table style="margin-left:auto;margin-right:auto">
					<tr>
						<td><button type="button" class="btn btnComun" id="btnGuardarPlan"  onClick="guardarPlan();" >Guardar</button></td>
						<td><button type="button" class="btn btnComun"  id="btnCancelarPlan" onClick="verGrilla();">Cancelar</button></td>
					</tr>
				</table>
				</div>
			</td>
		</tr>
	</table>   
</div>

<footer class="win-commandlayout navbar-fixed-bottom win-ui-dark">
      <div class="container">
         <div class="row">
            <div class="span6 align-left">
   
               <button class="win-command" onClick="agregarPlan();">
                  <span class="win-commandimage win-commandring">&#xe03e;</span>
                  <span class="win-label">Agregar</span>
               </button>
   
               <button class="win-command" onClick="editPlan();" >
                  <span class="win-commandimage win-commandring"><b class="icon-pen-alt2"></b></span>
                  <span class="win-label">Editar</span>
               </button>
   
               <button class="win-command" onClick="setPopupEliminar();">
                  <span class="win-commandimage win-commandring">&#xe003;</span>
                  <span class="win-label">Eliminar</span>
               </button>
   
               <button class="win-command" onClick="setGrdPlanesCobertura();" >
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
   
   	 <div id="dialogoEliminar" class="modal message hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-header">
                   <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                   <h3>Aviso Importante!</h3>
                </div>
                <div class="modal-body">
                   <p>Seguro que quiere eliminar el plan?</p>
                </div>
                <div class="modal-footer">
                   <button class="btn btn-info" onclick="deletePlan()">Aceptar</button>
			<button class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                </div>
       </div>


<?php include_once ("_footer.php"); ?>

	<script src="../scripts/fcsPlanesCobertura.js"></script>

	<script>
	
		$('#tituloOpcion').text('Planes de Cobertura');
		setControles();
		initGrdPlanesCobertura();
		setGrdPlanesCobertura();
		initGrdPlanes();	
		setStyleFocusButtons();
		setFocusNext();
		bindEventos();
		
	</script>

 </body>
</html>