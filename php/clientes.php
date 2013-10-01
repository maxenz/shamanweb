<?php

 include_once("_header.php");

?>
    	<div id="ctGrillaClientes" class="ctCliente">
	
         <div id="grdMaestroClientes" style="margin-left:auto;margin-right:auto"></div>  
         
        </div>
		
       <div id="ctOpcionesClientes" class="ctCliente" style="display:none">
       <!--<div id="barTopOpcionesCliente">
        <table>
        	<tr>
            	<td><label id="titleOpcionesCliente" class="titlePanel">Actualizaci&oacute;n de clientes</label></td>
                <td><a href="#" onClick="procesarNuevoCliente();" id="btnAceptarCliente" style="margin-left:5px;cursor:pointer"><img src="../images/small/save.png" /></a></td>
                <td><a href="#" onClick="verGrilla();" id="verGrilla" style="margin-left:5px;cursor:pointer"><img src="../images/small/cancel.png" /></a></td>
            </tr>
        </table>
	</div>-->
        	
	<div id="tabsOpcionesClientes" style="margin-left:auto;margin-right:auto">
		<ul>
			<li id="tabDatosTitular">Datos Titular</li>
			<li id="tabIntegrantes">Integrantes</li>
			<li id="tabCobertura">Cobertura</li>
		</ul>
		
		
	<div style="margin-top:2px">
   
 			<input type="hidden" id="hidAbrLoc" />
        		<div id="panelDatosTitular">
            		<div id="ctPanelDatosTitular" class="ctPanel">
                    	<input type="hidden" id="hidIdCliente" />
                       
                		<table>
                        	<tr>
                            	<td>
                                	<label>C&oacute;digo</label> 
                                	<input type="text" id="txtCodTit" style="width:200px" class="textbox" />
                                </td>
                                <td>
 					<label>Raz&oacute;n Social</label> 
                                	<input type="text" id="txtRzSocTit" style="width:320px" class="textbox" />                                      
                                </td>
                                <td>
					<div class="tdDropDown">
                                	<label>Rubro</label>
                                    <div id="dpDownRubroTit" style="margin-top:-5px"></div>
					</div>
                                </td>
                                <td>
						<div class="tdDropDown">
                                	<label>Cz. P.</label>
                                	<div id="chkCategorizacionPropia" style="margin-top:-5px"></div>
						</div>
                                </td>
                            </tr>
                        </table>
                        <table>
                        	<tr>
                            	<td>
                                	<label>Localidad</label>
                                    <input type="text" id="txtAbrLocTit" style="width:80px" class="textbox" />
                                	<input type="text" id="txtLocalidadTit" style="width:290px" disabled="disabled" class="textbox" />
                                </td>
                            	<td>
                                	<label>Domicilio - Calle</label>
                                	<input type="text" id="txtCalleTit" style="width:310px" class="textbox" />
                                </td>
                                <td>
                                	<label>Altura</label>
                                	<input type="text" id="txtAltTit" style="width:80px" class="textbox" />
                                </td>
                                <td>
                                	<label>Piso</label>
                                	<input type="text" id="txtPisoTit" style="width:80px" class="textbox" />
                                </td>
                                <td>
                                	<label>Depto</label>
                                	<input type="text" id="txtDeptoTit" style="width:80px" class="textbox" />
                                </td>
                        	</tr>
                        </table>
                        <table>
                        	<tr>
                            	<td>
                                	<label>C&oacute;digo Postal</label>
                                    <input type="text" id="txtCodPostalTit" style="width:230px" class="textbox" />
                                </td>
                                <td>
                                	<label>Entre Calle 1</label>
                                    <input type="text" id="txtEntreCalle1Tit" style="width:230px"  class="textbox"/>
                                </td>
                                <td>
                                	<label>Entre Calle 2</label>
                                    <input type="text" id="txtEntreCalle2Tit" style="width:230px" class="textbox" />
                                </td>
                                <td>
                                	<label>Referencias</label>
                                    <input type="text" id="txtRefTit" style="width:235px" class="textbox" />
                                </td>
                             </tr>
                         </table>
                	</div>
           		 </div>
                 <label id="titlePanelContactosCliente" class="titlePanel" style="text-align:center">Contactos del Cliente</label>
                 <div id="panelContactosCliente">
                 	<div id="ctPanelContactosCliente" class="ctPanel">
                 		<div id='menuContactosCliente'>
                            <ul>
                                <li id="rowAgregarContacto">
                                    <img style="margin-right: auto; margin-left:auto; " id="itmAgregarContacto"  src='../images/small/add.png' />
                                </li>
                                <li id="rowEliminarContacto">
                                     <img style="margin-right: auto; margin-left:auto;" id="itmEliminarContacto"  src='../images/small/eliminar.png'/>
                                </li>
                                <li id="rowEditarContacto">
                                     <img style="margin-right: auto; margin-left:auto;" id="itmEditarContacto" src='../images/small/editar.png'/>
                                </li>
                                <li id="rowActualizarContacto">
                                     <img style="margin-right: auto; margin-left:auto;" id="itmActualizarContacto" src='../images/small/actualizar.png'/>
                                </li>                
                            </ul>
           	 	</div>
                        
                        <div id="grdContactosCliente"></div>
                        
                    </div>
                 </div>
        	</div>
		<div>
        
        	<div id="ctGrillaIntegrantes" class="ctIntegrante">
             
            <div id='menuGrillaIntegrantes'>
                <ul>
                    <li>
                        <img style="margin-right: auto; margin-left:auto; " id="itmAgregarIntegrante" onClick="agregarIntegrante();" src='../images/add.png'/>
                    </li>
                    <li>
                         <img style="margin-right: auto; margin-left:auto;" id="itmEliminarIntegrante" onClick="abroDecisionEliminarIntegrante()";   src='../images/eliminar.png'/>
                    </li>
                    <li>
                         <img style="margin-right: auto; margin-left:auto;" id="itmEditarIntegrante" onClick="editShowIntegrante();" src='../images/editar.png'/>
                    </li>
                    <li>
                         <img style="margin-right: auto; margin-left:auto;" id="itmActualizarIntegrante" onClick="actualizarGrillaIntegrantes();" src='../images/actualizar.png'/>
                    </li>                
                </ul>      
            </div>
        	
            <div id="grdIntegrantes"></div>
        </div>
        
            <div id="ctOpcionesIntegrantes" style="display:none" class="ctIntegrante" >
                <!--<table>
                    <tr>
                        <td><label id="titleOpcionesIntegrante" class="titlePanel">Integrante</label></td>
                        <td><a href="#" onClick="verGrillaIntegrantes();" id="verGrillaInt" style="margin-left:5px;"><img src="../images/ver_grilla.png" /></a></td>
                    </tr>
                 </table>-->
           
            
            <div id="panelIntegrante">
            	<div id="ctPanelIntegrante" style="height:388px;margin-top:2px" class="ctPanel">
                <input type="hidden" id="hidIdIntegrante" />
            		<table>
                    	<tr>
                        	<td>
                            	<label>Nro. Afiliado</label>
                            	<input type="text" id="txtNroAfInt" style="width:210px" class="textbox" />
                            </td>
                            <td>
				<div class="tdDropDown">
                            	<label>Tipo</label>
                            	<div id="dpDownTipoInt" style="margin-top:-5px"></div>
					</div>
                            </td>
                            <td>
                            	<label>Apellido</label>
                            	<input type="text" id="txtApeInt" style="width:275px" class="textbox" />
                            </td>
                            <td>
                            	<label>Nombre</label>
                                <input type="text" id="txtNomInt" style="width:275px" class="textbox" />
                            </td>
            			</tr>
            		</table>
                    
                    <table>
                    	<tr>
                        	<td>
                            	<label>Localidad</label>
                            	<input type="text" id="txtAbrLocInt" style="width:80px" class="textbox" />
                             <input type="text" id="txtLocInt" style="width:250px" class="textbox" />
                            </td>
                            <td>
                            	<label>Domicilio - Calle</label>
                            	<input type="text" id="txtCalleInt" style="width:335px" class="textbox" />
                            </td>
                            <td>
                            	<label>Altura</label>
                            	<input type="text" id="txtAltInt" style="width:80px" class="textbox" />
                            </td>
                            <td>
                            	<label>Piso</label>
                                <input type="text" id="txtPisoInt" style="width:80px" class="textbox" />
                            </td>
                            <td>
                            	<label>Depto</label>
                                <input type="text" id="txtDeptoInt" style="width:80px" class="textbox" />
                            </td>
            			</tr>
            		</table>
                    
                     <table>
                    	<tr>
                        	<td>
                            	<label>C&oacute;digo Postal</label>
                            	<input type="text" id="txtCodPostInt" style="width:228px" class="textbox" />
                            </td>
                            <td>
                            	<label>Entre Calle 1</label>
                            	<input type="text" id="txtECalle1Int" style="width:228px" class="textbox" />
                            </td>
                            <td>
                            	<label>Entre Calle 2</label>
                            	<input type="text" id="txtECalle2Int" style="width:228px" class="textbox" />
                            </td>
                            <td>
                            	<label>Referencias</label>
                                <input type="text" id="txtRefInt" style="width:226px" class="textbox" />
                            </td>              
            			</tr>
            		</table>
                    
                     <table>
                    	<tr>
                        	<td>
					<div class="tdDropDown">
                            	<label>T. Doc.</label>
                            	<div id="dpDownTipoDocInt" style="margin-top:-5px"></div>
					</div>
                            </td>
                            <td>
                            	<label>Nro. Documento</label>
                            	<input type="text" id="txtNroDocInt" style="width:150px" class="textbox" />
                            </td>
                            <td>
					<div class="tdDropDown">
                            	<label>Sexo</label>
                            	<div id="dpDownSexoInt" style="margin-top:-5px"></div>
					</div>
                            </td>
                            <td>
				<div class="tdDropDown">
                            	<label>Fec. Nacimiento</label>
                                <div id="dtFecNacInt" style="margin-top:-5px"></div>
					</div>
                            </td>
                            <td>
                            	<label>Tel&eacute;fono 1</label>
                            	<input type="text" id="txtTelefono1Int" style="width:144px" class="textbox" />
                            </td>
                            <td>
                            	<label>Tel&eacute;fono 2</label>
                            	<input type="text" id="txtTelefono2Int" style="width:144px" class="textbox" />
                            </td> 
                            <td>
						<div class="tdDropDown">
                            	<label>Fec. Ingreso</label>
                                <div id="dtFecIngInt" style="margin-top:-5px"></div>
					</div>
                            </td>             
            			</tr>
            		</table>
                    <table>
                    	<tr>
                        	<td>
                    		<label>Observaciones</label>
                    		<textarea id="txtAObsInt" style="resize:none;width:920px;margin-bottom:17px"></textarea>
                            </td>
                    	</tr>
                     </table>
                     
                     <table style="margin-left:auto; margin-right:auto;">
                     	<tr>
                        	<td><button type="button" id="btnGrabarIntegrante" onClick="grabarIntegrante();"  class="btn btnComun" >Aceptar</button></td>
                            <td><button type="button" id="btnCancelarIntegrante" class="btn btnComun"  onClick="verGrillaIntegrantes();" >Cancelar</button></td>
                        </tr>
          		</table>   
            	</div>
                	
            </div>
         </div> 
        </div>
		<div>      	
            <table>
            	<tr>
                	<td>
                    	<div id="panelPlanes" style="width:300px;height:389px;" class="ctPanel">
                        	<div style="text-align:center;padding-top:20px">
					<span class="label" style="padding:15px;background:#24A0DA">Coberturas y CoPagos</span>
				</div>
                    		<div id="dpDownCobertura" style="margin-left:auto;margin-right:auto;margin-bottom:10px;margin-top:10px"></div>
                            <div id="dpDownPlan" style="margin-left:auto;margin-right:auto;margin-bottom:10px"></div>
                            <div id="grdPlanes" style="margin-left:auto;margin-right:auto;"></div>
                            <div style="text-align:center;margin-top:5px;">
                            	<input style="cursor:pointer" type="button" id="btnGrabarModifCobertura" value="Guardar Modif." onClick="guardarCliCobertura(1);" />
                            </div>
                    	</div>
                    </td>
                    <td>
                    	<div id="panelObservaciones" style="width:633px;height:389px;" class="ctPanel">
                        	<div style="text-align:center;padding-top:20px">
					<span class="label" style="padding:15px;background:#24A0DA">Observaciones Operativas</span>
				</div>
                            <div style="margin-top:10px;text-align:center">
                        	<textarea id="txtAObsCobertura" style="width:550px;height:300px;resize:none"></textarea>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>

       	 </div>
        </div>
        		
	</div>
    

            
		<div id='popupBuscoLocalidades' style="display:none">
			<div>Seleccione la localidad...</div>
			<div> 
					<div id="grdLocalidades" style="margin-left:5px"></div> 
			</div>
		</div> 

			
	<div id="dialogoEliminarCliente" class="modal message hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
			<h3>Aviso Importante!</h3>
		</div>
		<div class="modal-body">
			<p>Seguro que quiere eliminar el cliente?</p>
		</div>
		<div class="modal-footer">
			<button id="btnElimCliente" class="btn btn-info" >Aceptar</button>
			<button class="btn btn-danger" data-dismiss="modal">Cancelar</button>
		</div>
	</div> 

	<div id="dialogoEliminarContacto" class="modal message hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
			<h3>Aviso Importante!</h3>
		</div>
		<div class="modal-body">
			<p>Seguro que quiere eliminar el contacto?</p>
		</div>
		<div class="modal-footer">
			<button id="btnElimContacto" class="btn btn-info" >Aceptar</button>
			<button class="btn btn-danger" data-dismiss="modal">Cancelar</button>
		</div>
	</div>

	<div id="dialogoEliminarIntegrante" class="modal message hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
			<h3>Aviso Importante!</h3>
		</div>
		<div class="modal-body">
			<p>Seguro que quiere eliminar el integrante?</p>
		</div>
		<div class="modal-footer">
			<button id="btnElimIntegrante" class="btn btn-info" >Aceptar</button>
			<button class="btn btn-danger" data-dismiss="modal">Cancelar</button>
		</div>
	</div> 
	
	<div id="dialogoNuevoContacto" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
			<h3 id="myModalLabel">Agregar/Modificar Contacto</h3>
		</div>
		<div class="modal-body">
			<form class="form-horizontal">
				<div id="ctPanel">
					<input type="hidden" id="idContactoCliente" />
					<div class="control-group">
						<label class="control-label" for="txtNomSectorContacto">Nombre / Sector</label>
						<div class="controls">
							<input type="text" id="txtNomSectorContacto">
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label" for="txtEmailContacto">Email</label>
						<div class="controls">
							<input type="text" id="txtEmailContacto">
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label" for="txtTelContacto">Tel&eacute;fono</label>
						<div class="controls">
							<input type="text" id="txtTelContacto">
						</div>
					</div>
				</form>
			</div>
		</div>
		
		<div class="modal-footer" style="text-align:center">
			<div class="btn-group">
				<button class="btn btn-primary" id="btnAceptarContacto" onClick="agregarContacto();">Aceptar</button>
				<button class="btn" data-dismiss="modal" id="btnCancelarContacto" >Cancelar</button>
			</div>
		</div>	
	</div>
	
	          
	
	<div class='notifications center' id='notif'></div>
			
	<footer class="win-commandlayout navbar-fixed-bottom win-ui-dark">
      <div class="container">
         <div class="row">
            <div class="span6 align-left">
   
               <button class="win-command" onClick="agregarCliente();">
                  <span class="win-commandimage win-commandring">&#xe03e;</span>
                  <span class="win-label">Agregar</span>
               </button>
			   
		<button class="win-command" onClick="editShowCliente();" >
                  <span class="win-commandimage win-commandring"><b class="icon-pen-alt2"></b></span>
                  <span class="win-label">Editar</span>
               </button>
   
               <button class="win-command" onClick="abroDecisionEliminarCliente();">
                  <span class="win-commandimage win-commandring">&#xe003;</span>
                  <span class="win-label">Eliminar</span>
               </button>
   
               <button class="win-command" onClick="actualizarGrdClientes();" >
                  <span class="win-commandimage win-commandring">&#xe125;</span>
                  <span class="win-label">Actualizar</span>
               </button>
		         
		<button class="win-command" id="btnGuardarCliente" style="display:none" onClick="procesarNuevoCliente();" >
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
   
<script src="../scripts/fcsClientes.js"></script>
<script>
	
	$('#tituloOpcion').text('Clientes');
	setFocusNext();
	setPopupsGenerales();
	setStyleFocusButtons();
	setGrillaBusquedaLocalidades();
	bindEventos();
	bindGrillaClientes();
	bindEventosDialogos();
	bindGrillaIntegrantes();
	bindDecisionEliminar();
	bindControlsCobertura();
	bindGrillaLocalidades();
	bindComportamientoForm();
	initMenuClientes();
	initGrdPlanes();
	initGrdMaestroClientes();
	initGrdIntegrantes();
	initDateTime();
	setGrdMaestroClientes();
	initGrdContactosCliente();
	initTabOpcionesClientes();
	initDropDown();
	initCheckbox();
	initButtons();
    $('.nav li.dropdown').css("display","block");
	
</script>
</body>
</html>