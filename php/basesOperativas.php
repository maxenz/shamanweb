<?php

 include_once("_header.php");

?>
    
       <div id="ctGrillaBases" class="ctToggle"> 
		<div id="grdBases" style="margin-left:auto;margin-right:auto"></div>
	</div>
            
	<div id="ctOpcionesBases" class="ctToggle" style="display:none">
		<input type="hidden" id="hidIdBase" />
		<input type="hidden" id="hidAbrLoc" />
		<div id="panelBases" style="margin-left:auto;margin-right:auto;">
			<div id="ctPanelBases" class="ctPanel">
				
				<table>
					<tr>
						<td>
							<label class="lblPan">C&oacute;digo</label>
							<input type="text" id="txtCodBase" style="width:50px" class="textbox" />
						</td>
						<td>
							<label  class="lblPan">Descripci&oacute;n</label>
							<input type="text" id="txtDescBase" style="width:300px" class="textbox" />
						</td>
						<td>
							<label class="lblPan">Localidad</label>
							<input type="text" id="txtAbrLocBase" style="width:50px" class="textbox" />
							<input type="text" id="txtLocBase" style="width:245px;margin-left:-3px" class="textbox" />
						</td>  	
					</tr>
                            </table>
							
                            <table>
					<tr>
						<td>
							<label class="lblPan">Domicilio - Calle</label>
							<input type="text" id="txtCalleBase" style="width:390px" class="textbox" />
						</td>
						<td>
							<label class="lblPan">Altura</label>
							<input type="text" id="txtAlturaBase" style="width:70px" class="textbox" />
						</td>
						<td>
							<label class="lblPan">Piso</label>
							<input type="text" id="txtPisoBase" style="width:70px" class="textbox" />
						</td>
						<td>
							<label class="lblPan">Depto</label>
							<input type="text" id="txtDeptoBase" style="width:70px" class="textbox" />
						</td>
						<td>
							<label class="lblPan">CP</label>
							<input type="text" id="txtCodPostBase" style="width:70px" class="textbox" />
						</td>
					</tr>
                            </table> 
                            
                            <table>
					<tr>
						<td>
							<label class="lblPan">Entre Calle 1</label>
							<input type="text" id="txtECalle1Base" style="width:228px" class="textbox" />
						</td>
						<td>
							<label class="lblPan">Entre Calle 2</label>
							<input type="text" id="txtECalle2Base" style="width:228px" class="textbox" />
						</td>
						<td>
							<label class="lblPan">Referencias</label>
							<input type="text" id="txtRefBase" style="width:220px" class="textbox" />
						</td>                            
					</tr>
				</table>
                             
				<table>
					<tr>
						<td>
							<label class="lblPan">Tel&eacute;fono 1</label>
							<input type="text" id="txtTel1Base" style="width:120px" class="textbox" />
						</td>
						<td>
							<label class="lblPan">Tel&eacute;fono 2</label>
							<input type="text" id="txtTel2Base" style="width:120px" class="textbox" />
						</td>
						<td>
							<label class="lblPan">Tel&eacute;fono 3</label>
							<input type="text" id="txtTel3Base" style="width:120px" class="textbox" />
						</td>
						<td>
							<label class="lblPan">Observaciones</label>
							<input type="text" id="txtObsBase" style="width:315px" class="textbox" />
						</td>
					</tr>
                             </table>
							 
                             <table style="margin-right:auto;margin-left:auto;margin-top:8px;margin-bottom:12px">
					<tr>
						<td>
							<button type="button" id="btnAceptarBase" class="btn btnComun" onClick="procesarNuevaBase();" >Aceptar</button>
						</td>
						<td>
							<button type="button" id="btnCancelarBase" class="btn btnComun" onClick="verGrilla();" >Cancelar</button>
						</td>
					</tr>
                             </table>
                    	</div>
		</div>
	</div>
               		
   	<div id="dialogoEliminar" class="modal message hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
			<h3>Aviso Importante!</h3>
		</div>
		<div class="modal-body">
			<p>Seguro que quiere eliminar la base?</p>
		</div>
		<div class="modal-footer">
			<button onClick="elimBase()" id="btnElimBase" class="btn btn-info" >Aceptar</button>
			<button class="btn btn-danger" data-dismiss="modal">Cancelar</button>
		</div>
	</div> 
                	
	<div class='notifications center' id='notif'></div>
		
	<div id='popupBuscoLocalidades' style="display:none">
		<div>Seleccione la localidad...</div>
		<div> 
			<div id="grdLocalidades" style="margin-left:5px"></div> 
		</div>
	</div> 
               	   
	<footer class="win-commandlayout navbar-fixed-bottom win-ui-dark">
		<div class="container">
			<div class="row">
				<div class="span6 align-left">
				
					<button class="win-command" onClick="agregarBase();">
						<span class="win-commandimage win-commandring">&#xe03e;</span>
						<span class="win-label">Agregar</span>
					</button>
			   
					<button class="win-command" onClick="editBase();" >
						<span class="win-commandimage win-commandring"><b class="icon-pen-alt2"></b></span>
						<span class="win-label">Editar</span>
					</button>
   
					<button class="win-command" onClick="setPopupEliminar();">
						<span class="win-commandimage win-commandring">&#xe003;</span>
						<span class="win-label">Eliminar</span>
					</button>
   
					<button class="win-command" onClick="setGrdBases();" >
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

<script src="../scripts/fcsBasesOperativas.js"></script>
<script>
	
	$('#tituloOpcion').text('Bases Operativas');
	initComponentes();
	bindEventos();
	initGrdBases();
	setGrdBases();
	setPopupsGenerales();
	setFocusNext();
	setStyleFocusButtons();
	setGrillaBusquedaLocalidades();
	bindGrillaLocalidades();
			
</script>
</body>
</html>