<?php

 include_once("_header.php");

?>
    	<div id="ctGrillaMaestroVehiculos" class="ctMaestroVehiculos">	

		<div id="grdMaestroVehiculos" style="margin-left:auto;margin-right:auto"></div>
		
        </div>
        
        <div id="ctOpcionesMaestroVehiculos" class="ctMaestroVehiculos" style="display:none">
 
            <input type="hidden" id="hidIdVeh" />
            <div id="panelVeh" style="margin-left:auto;margin-right:auto;">
            <div id="ctPanelVeh" class="ctPanel" >
                <table>
                    <tr>
                        <td>
                            <label>Dominio</label>
                            <input type="text" id="txtDomVeh" style="width:100px" class="textbox" />
                        </td>
                        <td>
				<div class="tdDropDown">
                            <label>Marca / Modelo</label>
                            <div id="dpDownMM" style="margin-top:-5px"></div>
					</div>
                        </td>
                        <td>
				<div class="tdDropDown">
                            <label>Situaci&oacute;n</label>
                            <div id="dpDownSit" style="margin-top:-5px"></div>  
					</div>
                        </td>  	
                    </tr>
                </table>
                <table>
                    <tr>
                        <td>
                            <label>A&ntilde;o</label>
                            <input type="text" id="txtAnioVeh" style="width:70px" class="textbox" />
                        </td>
                        <td>
				<div class="tdDropDown">
                            <label>Combustible</label>
                            <div id="dpDownComb" style="margin-top:-5px"></div>
				</div>
                        </td>
                        <td>
                            <label>N&uacute;mero de Motor</label>
                            <input type="text" id="txtNumMotorVeh" style="width:200px" class="textbox" />
                        </td>
                        <td>
                            <label>N&uacute;mero de Chasis</label>
                            <input type="text" id="txtNumChasisBase" style="width:210px" class="textbox" />
                        </td>
                    </tr>
                </table> 
                <table>
                    <tr>
                         <td>
                            <label>Propietario</label>
                            <input type="text" id="txtPropVeh" style="width:420px" />
                        </td>
                        <td>
                            <label>M&oacute;vil</label>
                            <input type="text" id="txtMovVeh" style="width:205px" />
                        </td>
                                    
                <table style="margin-right:auto;margin-left:auto;margin-top:10px;margin-bottom:5px">
                    <tr>
                        <td>
                            <button type="button" id="btnAceptarVeh" class="btn btnComun" onClick="procesarNuevoVeh();" >Aceptar</button>
                        </td>
                        <td>
                            <button type="button" id="btnCancelarVeh" class="btn btnComun" onClick="verGrilla();">Cancelar</button>
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
			<p>Seguro que quiere eliminar la el veh&iacute;culo?</p>
		</div>
		<div class="modal-footer">
			<button onClick="elimBase()" id="btnElimVeh" class="btn btn-info" >Aceptar</button>
			<button class="btn btn-danger" data-dismiss="modal">Cancelar</button>
		</div>
	</div>
              
		<div class='notifications center' id='notif'></div>
			  
            <div id="dialogo" title="Aviso" class="popup">
                <p>
                    <span class="ui-icon ui-icon-circle-check" style="float: left; margin: 0 7px 10px 0;"></span>
                </p>
                <p id="msgDialogo">
                </p>
    		</div>
            
           <div id="alerta" title="Error!" class="popup" >
                <p>
                <span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 50px 0;"></span>
                </p>
                <p id="msgAlerta">
                </p>
    		</div>

	

		<footer class="win-commandlayout navbar-fixed-bottom win-ui-dark">
      <div class="container">
         <div class="row">
            <div class="span6 align-left">
   
               <button class="win-command" onClick="agregarVehiculo();">
                  <span class="win-commandimage win-commandring">&#xe03e;</span>
                  <span class="win-label">Agregar</span>
               </button>
			   
		<button class="win-command" onClick="editVehiculo();" >
                  <span class="win-commandimage win-commandring"><b class="icon-pen-alt2"></b></span>
                  <span class="win-label">Editar</span>
               </button>
   
               <button class="win-command" onClick="setPopupEliminar();">
                  <span class="win-commandimage win-commandring">&#xe003;</span>
                  <span class="win-label">Eliminar</span>
               </button>
   
               <button class="win-command" onClick="setGrdMaestroVehiculos();" >
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
   
<script src="../scripts/maestroVehiculos.js"></script>
<script>

	$('#tituloOpcion').text('Maestro de Vehículos');
	setFocusNext();
	initComponentes();
	bindEventos();
	initGrdMaestroVehiculos();	
	setGrdMaestroVehiculos();
	setDropDown();
  $('.nav li.dropdown').css("display","block");	
</script>
</body>
</html>