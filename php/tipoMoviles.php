<?php

 include_once("_header.php");

?>

    	<div id="ctGrillaTipoMoviles" class="ctTipoMoviles">	

                
       <div id="grdTipoMoviles" style="margin-left:auto;margin-right:auto"></div>
        </div>
        
        <div id="ctOpcionesTipoMoviles" class="ctTipoMoviles" style="display:none">
 
            <input type="hidden" id="hidIdTipoMovil" />
            <div id="panelTipoMovil" style="margin-left:auto;margin-right:auto;">
            <div id="ctPanelTipoMovil" class="ctPanel" > 
             <table>
             	<tr>
                	<td>
                    	<label class="lblPan">C&oacute;digo</label>
                    	<input type="text" id="txtCodTipMov" style="width:120px" class="textbox" />
                    </td>
                	<td>
                    	<label class="lblPan">Descripci&oacute;n</label>
                    	<input type="text" id="txtDescTipMov" style="width:475px" class="textbox" />
                    </td>
                    <td>
                    			
                   	<div id="chkDespachable" style="margin-top:13px"></div>
						
                    </td>     
                </tr>   
             </table>
             <table id="tbListas">
             	<tr>
             		<td><div id="lstGrados" style="border: 1px solid black"></div></td>
               		<td><div id="lstGradosSel" style="border: 1px solid black"></div></td>
             	</tr>
             </table>
             
              <table style="margin-right:auto;margin-left:auto;margin-top:10px;margin-bottom:5px">
                    <tr>
                        <td>
                            <button type="button" id="btnAceptarGrados" class="btn btnComun" onClick="procesarNuevoTipMov();">Aceptar</button>
                        </td>
                        <td>
                            <button type="button" value="Cancelar" id="btnCancelarGrados" class="btn btnComun" onClick="verGrilla();" >Cancelar</button>
                        </td>
                    </tr>
                 </table>
    
            </div>
       </div>
     </div>
     
     		<div class='notifications center' id='notif'></div>
                  	<div id="dialogoEliminar" class="modal message hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
			<h3>Aviso Importante!</h3>
		</div>
		<div class="modal-body">
			<p>Seguro que quiere eliminar el tipo de móvil?</p>
		</div>
		<div class="modal-footer">
			<button onClick="elimTipoMovil()" id="btnElimTipoMovil" class="btn btn-info">Aceptar</button>
			<button class="btn btn-danger" data-dismiss="modal">Cancelar</button>
		</div>
	</div> 
                
         
		<footer class="win-commandlayout navbar-fixed-bottom win-ui-dark">
		  <div class="container">
			 <div class="row">
				<div class="span6 align-left">
	    
				   <button class="win-command" onClick="agregarTipoMovil();">
					  <span class="win-commandimage win-commandring">&#xe03e;</span>
					  <span class="win-label">Agregar</span>
				   </button>
				   
				<button class="win-command" onClick="editTipoMovil();" >
					  <span class="win-commandimage win-commandring"><b class="icon-pen-alt2"></b></span>
					  <span class="win-label">Editar</span>
				   </button>
	   
				   <button class="win-command" onClick="setPopupEliminar();">
					  <span class="win-commandimage win-commandring">&#xe003;</span>
					  <span class="win-label">Eliminar</span>
				   </button>
	   
				   <button class="win-command" onClick="setGrdTipoMoviles();" >
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

<?php include_once("_footer.php"); ?>

<script src="../scripts/tipoMoviles.js"></script>
<script>
	
	$('#tituloOpcion').text('Tipo de Móviles');
	setFocusNext();
	inicioComponentes();
	bindEventos();
	initGrdTipoMoviles();	
	setGrdTipoMoviles();
    $('.nav li.dropdown').css("display","block");		
</script>
</body>
</html>