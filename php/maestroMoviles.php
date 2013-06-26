<?php

 include_once("_header.php");

?>

    	<div id="ctGrillaMaestroMoviles" class="ctMaestroMoviles">	
           	<div id="grdMaestroMoviles" style="margin-left:auto;margin-right:auto"></div>
        </div>
        
       <div id="ctOpcionesMaestroMoviles" class="ctMaestroMoviles" style="display:none">

		<div id="tabsMoviles" style="margin-left:auto;margin-right:auto">
			<ul>
				<li id="tabDatosTitular">Datos Principales</li>
				<li id="tabCobGeografica">Cobertura Geogr&aacute;fica</li>
			</ul>
			
			<div>
				<input type="hidden" id="hidIdMovil" />
				<input type="hidden" id="hidIdVeh" />
				<div id="panelMovil" style="margin-left:auto;margin-right:auto;">
					<div id="ctPanelMovil" class="ctPanel">
						<table>
							<tr>
								<td>
									<label>M&oacute;vil</label>
									<input type="text" id="txtMov" style="width:50px" class="textbox" />
								</td>
								<td>
									<label>Dominio</label>
									<input type="text" id="txtDomMov" style="width:100px" class="textbox" />
								</td>
								<td>
									<label>Marca</label>
									<input type="text" readonly id="txtMarcaMov" style="width:238px" class="textbox" />                      
								</td>
								<td>
									<label>Modelo</label>
									<input type="text" readonly id="txtModeloMov" style="width:238px" class="textbox" />                      
								</td>   	
							</tr>
						</table>
						
						<table>
							<tr>
								<td>
									<label>Propietario</label>
									<input type="text" readonly id="txtPropMov" style="width:360px" class="textbox" />
								</td>
								<td>
									<div class="tdDropDown">
										<label>Tipo de M&oacute;vil</label>
										<div id="dpDownTipoMov" style="margin-top:-5px"></div>
									</div>
								</td>
							</tr>
						</table>
						
						<table>
							<tr>
								<td>
									<label>Grados Cobertura</label>
									<input type="text" readonly id="txtGradosCob" style="width:360px" class="textbox" />
								</td>		
								<td>
									<div class="tdDropDown">
										<label>Base Operativa</label>
										<div id="dpDownBaseOp" style="margin-top:-5px"></div>
									</div>
								</td>
							</tr>
						</table>
						
						<div id="grdHistorialMovil"></div>
					</div>               
				</div>
			</div>
			<div>
			<label class="titlePanel" style="text-align:center">Localidades</label>
				<table id="tbListas">
					<tr>
						<td>
							<div id="lstCob" style="border:1px solid black"></div>
						</td>
							<td>
							<div id="lstCobSel" style="border:1px solid black"></div>
						</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
     
       <div id="dialogoEliminar" title="Atencion!" class="popup">
		<p>
			<span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span>
			<p id="msgDialogoEliminar">¿Está seguro que desea eliminar el móvil?</p>
		</p>
	</div>
                
	<div class='notifications center' id='notif'></div>
			
	<footer class="win-commandlayout navbar-fixed-bottom win-ui-dark">
		<div class="container">
			<div class="row">
				<div class="span6 align-left">
   
					<button class="win-command" onClick="agregarMovil();">
						<span class="win-commandimage win-commandring">&#xe03e;</span>
						<span class="win-label">Agregar</span>
					</button>
			   
					<button class="win-command" onClick="editMovil();" >
						<span class="win-commandimage win-commandring"><b class="icon-pen-alt2"></b></span>
						<span class="win-label">Editar</span>
					</button>
   
					<button class="win-command" onClick="setPopupEliminar();">
						<span class="win-commandimage win-commandring">&#xe003;</span>
						<span class="win-label">Eliminar</span>
					</button>
   
					<button class="win-command" onClick="actualizarGrd();" >
						<span class="win-commandimage win-commandring">&#xe125;</span>
						<span class="win-label">Actualizar</span>
					</button>

					<button class="win-command" id="btnGuardarMovil" style="display:none" onClick="procesarNuevoMov();" >
						<span class="win-commandimage win-commandring">  &#xe1aa;</span>
						<span class="win-label">Guardar</span>
					</button>  

					<button class="win-command" id="btnVerGrilla" style="display:none" onClick="verGrilla();" >
						<span class="win-commandimage win-commandring">&#x0061;</span>
						<span class="win-label">Ver Clientes</span>
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
 
<script src="../scripts/maestroMoviles.js"></script>

<script>
	
	$('#tituloOpcion').text('Móviles');
	setFocusNext();
	initTab();
	initComponentes();
	bindEventos();
	initGrdMaestroMoviles();
	initGrdHistorialMovil();
	setGrdMaestroMoviles(0,-1);
	
</script>
</body>
</html>