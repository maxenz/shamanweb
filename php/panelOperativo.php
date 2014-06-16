<?php

	include_once("_header.php");

?>

<div id='popupSanatorios' style="display:none">
	<div>Seleccione el sanatorio...</div>
	<div> 
        <div id="grdSanatorios" style="margin-left:5px"></div> 
    </div>
</div>

<div id='popupClientes' style="display:none">
	<div>Seleccione el cliente...</div>
	<div> 
        <div id="grdClientes" style="margin-left:5px"></div> 
    </div>
</div>


<div id='popupBuscoLocalidades' style="display:none">
	<div>Seleccione la localidad...</div>
	<div> 
        <div id="grdLocalidades" style="margin-left:5px"></div> 
    </div>
</div>
     
<div id='popupBuscoAfiliado' style="display:none">
	<div>Seleccione el afiliado...</div>
	<div> 
    	<div id="grdAfiliados" style="margin-left:5px"></div> 
    </div>
</div>
    
<div id="popupBusqServ" style="display:none">
    <div>B&uacute;squeda de Servicios...</div>
    <div>
        <div id='menuBusqServ' style="margin-left:2px; margin-top:2px; margin-bottom:3px">
             <ul>
                <li>
				    <b class="icon-spin" id="itmActBusqServ" onClick="actBusqServ();"></b>     
                </li>
                <li>
				    <b class="icon-write" id="itmModifBusqServ"></b>          
                </li> 
                <li>
                    <div id="dtDesdeBusqServ"></div>
                </li>
                <li>
                    <div id="dtHastaBusqServ"></div>
                </li>         
            </ul>   
        </div>
        <div id="grdBusqServ"></div>     	
    </div>
</div>   
     
<div id='popupBuscoSintoma' style="display:none">
	<div>Seleccione el s&iacute;ntoma...</div>
	<div> 
    	<div id="grdSintomas" style="margin-left:5px"></div> 
    </div>
</div>    
        
<div id='popupCategorizador' style="display:none">
	<div>Categorizador de Incidente</div>
	<div id="contentCategorizador"></div>
</div>   
    
<div id='popupDiagnosticos' style="display:none">
	<div>Seleccione el diagn&oacute;stico</div>
	<div id="grdDiagnosticos"></div>
</div>    
       
<!--FINALIZA POPUPS PARA FORMULARIO DE RECEPCION-->


<!--POPUPS PARA MENU CONTEXTUALES DE GRILLA DE RECEPCION-->

<div id='popupPreasignoDespacho' style="display:none">
    <div>Despacho de Servicios</div>
    <div class="contentPopup"> 
       <input type="hidden" id="hidIdViaje" />
       <input type="hidden" id="hidFlgSalida" />
	   <table style="margin-left:3px">
            <tr>
                <td>
                    <div class="tdDropDown">
                        <label>Fecha</label>
                        <div id="dtPreDespIncidente" style="margin-top:-5px"></div>
                    </div>
                </td>    		              
                <td>
                    <label>Nro</label>
                    <input type="text" id="txtNroIncPreDespIncidente" style="width:50px" class="textbox centrado" />
                </td>
                <td>
                    <label>Gdo</label>
                    <input type="text" id="txtGdoIncPreDespIncidente" style="width:50px" class="textbox centrado" />
                </td>
                <td>
                    <label>Domicilio</label>
                    <input type="text" id="txtDomIncPreDespIncidente" style="width:180px" class="textbox" />
                    <input type="text" id="txtDomAbrIncPreDespIncidente" style="width:50px" class="textbox centrado" />
                </td>
                <td>
                    <div class="tdDropDown">
                        <label>Despachar</label>
                        <div id="dpDownDespacharPreDespIncidente" style="margin-top:-5px"></div>
                    </div>
                </td>
        	
            </tr>
        </table>


        
        <div style="margin-top:3px">
                 <hr class="separadorPopup" style="margin-top:1px" />

            	<div id="grdSugerenciaMovilesEmpresas" style="margin-left:4px"></div>               
        </div>
        
        <div>
            <hr class="separadorPopup" />
           		<input type="hidden" id="hidRowIncidente" />
                <input type="hidden" id="hidIdAfiliado" />
                <input type="hidden" id="hidAbrLoc" />
                <div id="grpSugerencia">
            	<table>
                	<tr>
                    	<td>
                            <label id="movEmpresa">M&oacute;vil</label>
                            <input type="text" id="txtMovEmpresa" readonly style="width:80px" class="textbox centrado" />
                        </td>
                    	<td>
                            <label id="estNombre">Estado</label>
                            <input type="text" id="txtEstNombre" readonly style="width:150px" class="textbox" />
                        </td>
                    	<td>
                            <label id="tipoMovCob">Tipo de M&oacute;vil</label>
                            <input type="text" id="txtTipoMovCob" readonly style="width:150px" class="textbox" />
                        </td>
                        <td id="accionPreDesp" style="display:none">
                            <div class="tdDropDown" id="accion" >
                                <label style="margin-top:8px">Accion</label>
                                <div id="dpDownAccion" style="margin-top:-5px" ></div>
                            </div>
                        </td>
     	
                    </tr>
                </table>
            </div>
        </div>

		<div class="centrado" style="margin-top:10px">
			<div class="btn-group">
				<button type="button" id="btnAceptarPreDesp" class="btn btnComun">Aceptar</button>
				<button type="button" id="btnCancelarPreDesp" class="btn btnComun">Cancelar</button>
			</div>
		</div>
        
	</div>  
</div>	

<div id='popupEstablecerCierre' style="display:none">
	<div>EMPRESA - </div>
	<div> 
    	<div id="panelCierreIncidente" class="clsPanel" style="margin-bottom:2px">
        	<span class="label label-inverse">Incidente &raquo;</span>
            <div id="contentPanelCierreIncidente"> 
                <table>
                	<tr>
                    	<td>
				            <div class="tdDropDown">
                            <label>Fecha</label>
                            <div id="dtFechaCierre" style="margin-top:-5px"></div>
				            </div>
                        </td>
                    	<td>
                            <label>Nro.</label>
                            <input type="text" id="txtNroIncCierre" style="width:50px" class="textbox centrado" />
                        </td>
                    	<td>
                            <label>Gdo.</label>
                            <input type="text" id="txtGdoCierre" style="width:50px" class="textbox centrado" />
                        </td> 
                        <td>
                            <label>Domicilio</label>
                            <input type="text" id="txtDomCierre" style="width:340px" class="textbox" />
                            <input type="text" id="txtDomAbrCierre" style="width:50px" class="textbox centrado" />
                        </td>               
                    </tr>
                </table>
            	            
            </div>
        </div>
            
        <div id="panelDatosDeCierre" class="clsPanel" style="margin-bottom:2px">
        	<span class="label label-inverse">Datos de Cierre &raquo;</span>
            <div id="contentPanelDatosDeCierre"> 
                <table>
                	<tr>
                    	<td>
				            <div class="tdDropDown" style="width:60px">
                        	   <label>Hor. Sal.</label>
                        	   <div id="dtFechaHorSalCierre" class="horCierre" style="margin-top:-5px"></div>
					        </div>
                        </td>
                    	<td>
				            <div class="tdDropDown" style="width:60px">
                        	   <label>Hor. Lle.</label>
                        	   <div id="dtFechaHorLleCierre" class="horCierre" style="margin-top:-5px"></div>
					        </div>
                        </td>
                    	<td>
				            <div class="tdDropDown">
                        	   <label>Deriv.</label>
                        	   <div id="dpDownDeriv" style="margin-top:-5px"></div>
					        </div>
                        </td> 
                        <td>
                        	<label>Lugar Derivaci&oacute;n</label>
                        	<input type="text" id="txtAbrLugarDerivacion" style="width:50px" class="textbox centrado" />
                        	<input type="text" id="txtLugarDerivacion" style="width:297px" class="textbox" />
                        </td>  
                        <td>
				            <div class="tdDropDown" style="width:60px">
                        	   <label>Hor. Der.</label>
                       	 	   <div id="dtFechaHorDeriv" class="horCierre" style="margin-top:-5px"></div>
					        </div>
                        </td>
                    	<td>
				            <div class="tdDropDown" style="width:60px">
                        	   <label>Hor. Ite.</label>
                        	   <div id="dtFechaHorIte" class="horCierre" style="margin-top:-5px"></div>
				            </div>
                        </td>             
                  	</tr>
                </table>
                <table>
                    <tr>
                    	<td>
                    		<label>Domicilio Derivaci&oacute;n</label>
                        	<input type="text" id="txtDomicilioDerivacion" style="width:200px;text-align:center" />     	
                   	    </td>
                    	<td>
                        <td>
				            <label>Altura</label>
				            <input type="text" id="txtAlturaDerivacion" style="width:50px;text-align:center" />
                        </td>				
                        <td>
				            <label>Piso</label>
				            <input type="text" id="txtPisoDerivacion" style="width:50px;text-align:center" />
                        </td>				
                        <td>
				            <label>Depto</label>
				            <input type="text" id="txtDeptoDerivacion" style="width:50px;text-align:center" />
                        </td>
                        <td>
                    		<label>Localidad Derivaci&oacute;n</label>
                       	 	<input type="text" id="txtAbrLocDerivacion" style="width:50px;text-align:center" />
                        	<input type="text" id="txtLocDerivacion" style="width:201px" />
                    	</td>
                    </tr>
                </table>
            
                <table>
                    <tr>
                    	<td>
                    		<label>Nombre del Lugar</label>
                       		<input type="text" id="txtNombreLugarDerivacion" style="width:150px" class="textbox" />
                    	</td>
                    	<td>
				            <div class="tdDropDown" style="width:60px">
                    		  <label>Hor. Fin.</label>
                        	   <div id="dtFechaHorFinDeriv" class="horCierre" style="margin-top:-5px"></div>
				            </div>
                    	</td>
                    	<td>
                    		<label>Diagn&oacute;stico</label>
                        	<input type="text" id="txtDiagnosticoAbrDerivacion" style="width:50px" class="textbox centrado" />
                        	<input type="text" id="txtDiagnosticoDerivacion" style="width:353px" class="textbox" />
                        
                    	</td> 
                    	<td>
				            <div class="tdDropDown">
                                <label>V.R.</label>
                                <div id="chkViajeRealizado" style="margin-top:-5px"></div>
				            </div>
                   	 	</td>           
                    </tr>
                </table>
                <table>
                    <tr>
                    	<td>
	                       <label>Observaciones</label>
            	           <input type="text" id="txtObservacionesDerivacion" style="width:673px" class="textbox itmInput" />
                        </td>
                    </tr>
                </table>                  
            </div>   
        </div>
 		<div class="centrado" style="margin-top:10px">
			<div class="btn-group">
				<button type="button" id="btnAceptarCierre" class="btn btnComun">Aceptar</button>
				<button type="button" id="btnCancelarCierre" class="btn btnComun">Cancelar</button>
			</div>
		</div>    
    </div>     
</div> 
    
<div id="popupLogObservaciones" style="display:none">
    <div>Log de Observaciones</div>
    <div>
        <div id="panelLogObservaciones">
            <table style="margin-left:auto;margin-right:auto">
                <tr>
                    <td>
                        <div class="tdDropDown">
                        	<label class="lblPan">Fecha / Hora / Usuario</label>
                        	<div id="dpDownLogObserv" style="margin-top:-5px"></div>
                        </div>
                    </td>
                    <td>
                        <label>Usuario</label>
                        <input type="text" readonly id="txtUsrLogObserv" style="width:220px" class="textbox" />	
                    </td>
                    <td>
                        <div class="tdDropDown">
                        	<label>Rec.</label>
                            <div id="chkReclamoLogObserv" style="margin-top:-5px"></div>	
                       </div>
                    </td>
                </tr>
            </table>
            <label style="margin-left:15px">Observaciones</label>
			<div style="text-align:center">
                <textarea id="txtLogObservaciones" readonly style="width:460px;height:55px;resize:none;"></textarea>
			</div>
        </div>
    </div>
</div>
         
<div id="popupHistoriaClinica" style="display:none">
 	<div>Historia Cl&iacute;nica</div>
	<div>
    	<div id="panelHistoriaClinica" class="ctPanel">
        	<table>
            	<tr>
                	<td>
                    	<label>Cliente</label>
                        <input type="text" readonly id="txtClienteHC" style="width:200px" class="textbox" />      
                    </td>
                    <td>
                    	<label>Nro. Afiliado</label>
                        <input type="text" id="txtAfiliadoHC" readonly style="width:200px" class="textbox" />      
                    </td>
                     <td>
                    	<label>Paciente</label>
                        <input type="text" id="txtPacienteHC" readonly style="width:260px" class="textbox" />      
                    </td>
                 </tr>
             </table>
             
            <table>
            	<tr>
                	<td>
                    	<label class="lblPan">Sexo</label>
                        <input type="text" id="txtSexoHC" readonly style="width:70px" class="textbox centrado" />      
                    </td>
                    <td>
                    	<label class="lblPan">Edad</label>
                        <input type="text" id="txtEdadHC" readonly style="width:70px;height:19px" class="textbox" />      
                    </td>
                     <td>
                    	<label class="lblPan">Domicilio</label>
                        <input type="text" id="txtDomHC" readonly style="width:300px" class="textbox" />  
                        <input type="text" id="txtLocHC" readonly style="width:60px;margin-left:-3px" class="textbox" />    
                    </td>
                    <td>
                    	<label class="lblPan">Tel&eacute;fono</label>
                        <input type="text" id="txtTelHC" readonly style="width:148px" class="textbox" />      
                    </td>
                 </tr>
            </table>
            <table>
             	<tr>
                	<td>
                        <label class="lblPan">Observaciones</label>
                        <input type="text" id="txtObservHC" readonly style="width:330px" class="textbox" /> 
                    </td>
             		<td>
			            <div class="tdDropDown">
                    	   <label>Desde</label>
                    	   <div id="dtDesdeHC" style="margin-top:-5px"></div>
			            </div>
                    </td>
                    <td>
			            <div class="tdDropDown">
                    	   <label>Hasta</label>
                            <div id="dtHastaHC" style="margin-top:-5px"></div>
			            </div>
                    </td>
                    <td>
                   		<label>&nbsp;</label>
                        <button type="button" id="btnRefreshHC" onClick="refreshHC();" style="width:10px;min-width:30px;margin-top:-15px;background:#1FAEFF"></button>
                    </td>
             	</tr>
            </table>
             
            <div id="grdHistoriaClinica" style="margin-left:auto;margin-right:auto"></div>
             
        </div>
    </div>
</div>
                         
         
            	
    
<div id='popupObservaciones' style="display:none">
	<div>Observaciones</div>
	<div class="contentPopup"> 
    	<div style="margin-bottom:3px">
            <table>
                	<tr>
                    	<td>
				            <div class="tdDropDown">	
                        	    <label>Fecha</label>
                        	    <div id="dtFechaIncObservaciones" style="margin-top:-5px"></div>
					       </div>
                        </td>
                    	<td>
                        	<label>Nro.</label>
                        	<input type="text" id="txtNroIncObservaciones" style="width:50px" class="textbox centrado" />
                        </td>
                    	<td>
                        	<label>Gdo.</label>
	                        <input type="text" id="txtGdoObservaciones" style="width:50px" class="textbox centrado" />
                        </td> 
                        <td>
    	                    <label>Paciente</label>
        	                <input type="text" id="txtPacienteObservaciones" style="width:380px" class="textbox" />
                        </td>    
                        <td>
				            <div class="tdDropDown">
            	               <label>Recl.</label>
                	           <div id="chkReclamo" style="margin-top:-5px"></div>
				            </div>
                        </td>           
                    </tr>
            </table>
        </div>
                
        <div>          
            <textarea id="txtAreaObservacionesRecl" style="width:677px;height:100px;resize:none;margin-left:5px;"></textarea>	     
        </div>
        <div class="centrado" style="margin-top:7px">
			<div class="btn-group">
				<button type="button" id="btnAceptarObservacionesRec" class="btn btnComun">Aceptar</button>
				<button type="button" id="btnCancelarObservacionesRec" class="btn btnComun">Cancelar</button>
			</div>
		</div>      
    </div>
</div>
      
      
      
<div id='popupAvisos' style="display:none">
	<div>Tips / Avisos de Servicios</div>
	<div class="contentPopup"> 
                <table>
                    	<tr>
                        	<td>
    				            <div class="tdDropDown">
                        	       <label>Fecha</label>
                            	   <div id="dtFechaAviso" style="margin-top:-5px"></div>
    					        </div>
                            </td>
                        	<td>
    	                        <label>Nro.</label>
        	                    <input type="text" id="txtNroIncAviso" style="width:50px" class="textbox centrado" />
                            </td>
                        	<td>
            	                <label>Gdo.</label>
                	            <input type="text" id="txtGdoAviso" style="width:50px" class="textbox centrado" />
                            </td> 
                            <td>
                    	        <label>Paciente</label>
                        	    <input type="text" id="txtPacienteAviso" style="width:250px" class="textbox" />
                            </td>    
                            <td>
                            	<label>Tip / Aviso</label>
    	                        <input type="text" id="txtTipAviso" style="width:165px" class="textbox" />
                            </td>           
                       </tr>
                </table>
                   
        <div class="centrado" style="margin-top:12px">
			<div class="btn-group">
				<button type="button" id="btnAceptarAviso" class="btn btnComun">Aceptar</button>
				<button type="button" id="btnCancelarAviso" class="btn btnComun">Cancelar</button>
			</div>
		</div>               
    </div>
</div>
      

<!-- TERMINA DEFINICION POPUPS DE MENU CONTEXTUAL DE GRILLA DE SERVICIOS -->

<div id="jqxTabsOperativa" style="overflow:hidden">
<ul>
<li id="tabDespacho">Despacho</li>
<li id="tabRecepcion">Recepcion</li>
<li id="tabTraslado">Traslados</li>
</ul>
<div>
<div id="panelIncidentesPrincipal" style="border:none;margin-left:2px">
<div id="contentPanelIncidentesPrincipal">
<table>
	<tr valign="top">
		<td><div id="grdIncidentes" data-toggle="context" data-target="#contextIncidentes"></div></td>
		<td><div id="grdMoviles" data-toggle="context" data-target="#contextMoviles"></div></td>
	</tr>
</table>
<!-- DESHABILITADO PARA READ ONLY MIENTRAS SE CORRIGE LA APP -->
<!-- 		<div id="contextIncidentes">
			<ul class="dropdown-menu" role="menu">
			<li><a  tabindex="-1" id="itmCtxLlegada" href="#">Llegada</a></li>
			<li><a  tabindex="-1" id="itmCtxPreasignar" href="#">Preasignar</a></li>
			<li><a  tabindex="-1" id="itmCtxDespachar" href="#">Despachar</a></li>
					<li><a  tabindex="-1" id="itmCtxCierre" href="#">Establecer Cierre</a></li>
						<li class="divider"></li>
					<li><a  tabindex="-1" id="itmCtxReclamos" href="#">Reclamos - Observaciones</a></li>
					<li><a  tabindex="-1" id="itmCtxTips" href="#">Tips - Avisos</a></li>    

			</ul>
		</div> 
		
		<div id="contextMoviles">
			<ul class="dropdown-menu" role="menu">
				<li><a  tabindex="-1" id="itmCtxLlegada" href="#">Llegada</a></li>
				<li><a  tabindex="-1" id="itmCtxDerivacion" href="#">Derivaci&oacute;n</a></li>
				<li><a  tabindex="-1" id="itmCtxFinalizacion" href="#">Finalizaci&oacute;n</a></li>
				<li class="divider"></li>
				<li><a  tabindex="-1" id="itmCtxVerIncidente" href="#">Ver Incidente</a></li>
				<li><a  tabindex="-1" id="itmCtxVerMovil" href="#">Ver M&oacute;vil</a></li>    
				<li><a  tabindex="-1" id="itmCtxVerHistorial" href="#">Ver Historial</a></li> 
				<li class="divider"></li>
				<li><a  tabindex="-1" id="itmCtxAltaOperativa" href="#">Alta Operativa de M&oacute;viles</a></li>    
				<li><a  tabindex="-1" id="itmCtxBajaOperativa" href="#">Baja Operativa de M&oacute;viles</a></li> 
			</ul>
		</div>

        -->
		  	  
<div id="logs" style="margin-top:5px;margin-left:3px;margin-bottom:1px;line-height:20px">
<table style="margin-left:auto;margin-right:auto">
	<tr>
		<td><div id="dropDownTipoIncidentes"></div></td>
		<td><div id="jqxSelGradoChart" style="margin-right:30px"></div></td>
		<td><span class="label label-inverse" style="margin-right:20px">Totales &raquo;</span></td>
		<td><div id="logIncidentes"></div></td>
	</tr>
</table>



</div>

<table>
    <tr>
        <td>
            <div id='jqxChartTiemposOperativos' style="width:465px; height: 130px; margin-top:10px; margin-left:10px"></div>
        </td>
        <td>
            <div id='jqxChartServicios' style="width:465px; height: 130px; margin-top:10px; position: relative; left: 0px;
            top: 0px;"></div>
        </td>
        </tr>
</table>

</div>
</div>
</div>
                
<!--TAB FORMULARIO DE RECEPCION-->
<div id="contentTabRecepcion" style="background-color:#f0f0f0" >
		<!--MENU FORMULARIO DE RECEPCION-->
		
			<div id='jqxMenuRecepcion' style="margin-left:5px;margin-top:2px;">

                <ul style="margin-left:85px">
                    <li id="itmAgregar2"> 
				<span class="win-commandimage" id="itmAgregar">&#xe03e;</span>
			     </li>		              
                    <li>
                         <span class="win-commandimage" id="itmCancelar">&#xe20a;</span>
                    </li>
                    <li>
                         <span class="win-commandimage" id="itmEditar">&#xe193;</span>
                    </li>
                    <li>
                         <span class="win-commandimage" id="itmActualizar">&#xe125;</span>
                    </li>
                    <li>
				<span class="win-commandimage" id="itmAtrasTotal" onClick="moveRecepcion(1,'');">&#xe1dc;</span>
                    </li>
                    <li>
				<span class="win-commandimage" id="itmAtras" onClick="moveRecepcion(0,'<');">&#xe1cc;</span>
                    </li>
                    <li>
                         <span class="win-commandimage" id="itmAdelante" onClick="moveRecepcion(0,'>');">&#xe1c9;</span>
                    </li>
                    <li>
                          <span class="win-commandimage" id="itmAdelanteTotal" onClick="moveRecepcion(1,1);">&#xe1dd;</span>
                    </li>
                    <li>
                         <span class="win-commandimage" id="itmCategorizacion">&#xe184;</span>
                    </li>
                    <li>
                         <span class="win-commandimage" id="itmImprimir">&#xe14c;</span>
                    </li>
                    <li>
                         <span class="win-commandimage" id="itmProgramarFecha">&#xe182;</span>
                    </li>
                    <li>
				<span class="win-commandimage" id="itmHistoriaClinica" onClick="verHistoriaClinica()">&#xe18e;</span>
                    </li>
                    <li>
				<span class="win-commandimage" id="itmObservaciones" onClick="openLogObserv()">&#xe12a;</span>                  
                    </li>
                    <li>
                        <span class="win-commandimage" id="itmBuscar" onClick="openBusqServ()">&#xe1e8;</span>  
                    </li>
                    
                           
                </ul>
                 
                
            </div>
            <!--FINALIZA MENU FORMULARIO DE RECEPCION-->
            
            
            
            <!--FORMULARIO DE RECEPCION-->
             <div id="jqxPanelRecepcion">
             

             	<table>
                	<tr>
                		<td>
					<div class="tdDropDown">
             				<label>Fecha Incidente</label>
              				<div id="jqxDateIncidente" style="margin-top:-5px"></div>
						</div>
            			</td>
						
             
            			<td>
             				<label>Inc</label>
              				<input type="text" id="txtNroIncidente" style="width:40px" class="textbox centrado" />
           				</td>
                
               			 <td>
             				<label>Tel&eacute;fono</label>
              				<input type="text" id="txtTelefono" style="width:120px" class="textbox"  />
           				</td>
                
               			 <td>
             				<label>Cliente</label>
              				<input type="text" id="txtCliente" style="width:150px" class="textbox"  />
           				</td>
                
                		<td>
             				<label>Nro. Afi.</label>
              				<input type="text" id="txtNroAfiliado" style="width:100px" class="textbox" />
           				</td>
                
               			 <td>
             				<label>Aviso</label>
              				<input type="text" id="txtAviso" style="width:120px" class="itmInput textbox" />           				
					</td>
                
               			 <td>
             				<label>Localidad</label>
              				<input type="text" id="txtAbrLoc" style="width:40px" class="textbox centrado"   />
						<input type="text" id="txtLoc" style="width:175px" class="textbox"  />
           				</td>
                
                </tr>
                </table>
                
                <table>
                <tr>
                	<td>
                		<label>Partido</label>
              			<input type="text" id="txtPartido" style="width:160px" class="textbox" />
                	</td>
                    
                    <td>
                		<label>Domicilio - Calle</label>
              			<input type="text" id="txtCalle" class=" textbox itmInput" style="width:250px" />        
                	</td>
                    
                    <td>
                    	<label id="lblAlt">Altura</label>
              			<input type="text" id="txtAltura" class="textbox centrado itmInput" style="width:50px"  />
                    </td>
                    
                    <td>
                    	<label id="lblPiso">Piso</label>
              			<input type="text" id="txtPiso" class="textbox centrado itmInput" style="width:50px" />
                    </td>
                    
                    <td>
                    	<label id="lblDepto">Depto</label>
              			<input type="text" id="txtDepartamento" class="textbox centrado itmInput" style="width:50px" />
                    </td>
                    <td>
                    	<label>Entre Calle 1</label>
              			<input type="text" id="txtEntreCalle1" style="width:160px" class="textbox itmInput" name="txtEntreCalle1"  /> 
             		</td>
                    
                    <td>
                    	<label>Entre Calle 2</label>
              			<input type="text" id="txtEntreCalle2" style="width:165px"  class=" textbox itmInput"  /> 
             		</td>
                    
                </tr>
                </table>
  
                <table>
                <tr>
			<td>
                    	<label>Referencias</label>
				<input type="text" id="txtReferencias" class="textbox itmInput" style="width:250px"  /> 
             		</td>
                	<td>
			<div class="tdDropDown">
                    	<label>Sexo</label>
				<div id="dropDownSexo" style="margin-top:-5px"></div> 
                    </td>
                    </div>
                    <td>
                    	<label>Edad</label>
              		<input type="text" id="txtEdad" class="textbox centrado itmInput" style="width:50px" /> 
                    </td>
                    
                    <td>
                    	<label> S&iacute;ntomas</label>
              		<input type="text" id="txtSintomas" class="textbox itmInput" style="width:385px" /> 
                    </td>
                    
                    <td>
				<div class="tdDropDown">
                    	<label>Grado</label>
              		<div id="dropDownGrados" style="margin-top:-5px"></div> 
				</div>
                    </td>
                
                </tr>
                </table>     
                
                <table>
                <tr>
                	<td>
                    	<label>Paciente</label>
              		<input type="text" id="txtPaciente" class="textbox itmInput" style="width:300px"  /> 
                    
                    </td>
                    
                    <td>
				<div class="tdDropDown">
                    	<label>Iva</label>
                        <div id="dropDownIVA" style="margin-top:-5px"></div>
              		</div>	 
                    </td>
                    
                    <td>
                    	<label>Plan</label>
              		<input type="text" id="txtPlan" class="textbox itmInput" style="width:80px" /> 
                    </td>
                    
                    <td>
                    	<label>CoPago</label>
              		<input type="text" id="txtCoPago" class="textbox itmInput"  style="text-align:right;width:80px"  />
                    </td>
			<td>
                    	<label>Diagn&oacute;stico</label>
              		<input type="text" id="txtDiagnostico" class="textbox" style="width:370px" /> 
                    
                    </td>
                
                </tr>
                </table>
                  
                <table>
                <tr>
                	
                    
                    <td>
                    	<label>Cierre</label>
                        <input type="text" id="txtCierre" class="textbox"  /> 
              			 
                    </td>
                    
                    <td>
                    	<label>Paciente derivado en..</label>
              			<input type="text" id="txtPacienteDerivado" class="textbox" /> 
                    </td>
                <td>
                    	<label>Observaciones</label>
              		<input type="text" id="txtObservaciones" class="textbox itmInput"  style="width:525px"/>  
                    </td>   
                </tr>
                </table>
               
                <!--FINALIZA FORMULARIO DE RECEPCION-->
                
                <!--GRILLAS FORMULARIO DE RECEPCION-->
               <table>
               <tr valign="top">
                 <td>
                	<div id="grdRecepcionProgramacion"></div>
                </td>
                <td>
             		<div id="grdRecepcionHistorial"></div>
                </td>
              </tr>
                </table>
                <!--FINALIZA GRILLAS FORMULARIO DE RECEPCION-->
                                  
           </div>
           
           <!--Termina DIV Panel-->

                
     <!--Termina TAB FORMULARIO DE RECEPCION-->      
     </div>
     
     <!--EMPIEZA TAB TRASLADOS-->
<div  style="overflow:hidden;background-color:#f0f0f0">

<div id='jqxMenuTraslados' style="margin-left:5px; margin-top:2px;">
 <ul style="margin-left:85px">
                    <li> 
				<span class="win-commandimage" id="itmAgregarTraslado">&#xe03e;</span>
			</li>		              
                    <li>
                         <span class="win-commandimage" id="itmCancelarTraslado">&#xe20a;</span>
                    </li>
                    <li>
                         <span class="win-commandimage" id="itmEditarTraslado">&#xe193;</span>
                    </li>
                    <li>
                         <span class="win-commandimage" id="itmActualizarTraslado">&#xe125;</span>
                    </li>
                    <li>
				<span class="win-commandimage" id="itmAtrasTotalTraslado" >&#xe1dc;</span>
                    </li>
                    <li>
				<span class="win-commandimage" id="itmAtrasTraslado" >&#xe1cc;</span>
                    </li>
                    <li>
                         <span class="win-commandimage" id="itmAdelanteTraslado">&#xe1c9;</span>
                    </li>
                    <li>
                          <span class="win-commandimage" id="itmAdelanteTotalTraslado" >&#xe1dd;</span>
                    </li>
                    <li>
                         <span class="win-commandimage" id="itmImprimirTraslado">&#xe14c;</span>
                    </li>
                    <li>
                         <span class="win-commandimage" id="itmProgramarFechaTraslado">&#xe182;</span>
                    </li>
                    <li>
				<span class="win-commandimage" id="itmHistoriaClinicaTraslado" >&#xe18e;</span>
                    </li>
                    <li>
				<span class="win-commandimage" id="itmObservacionesTraslado" >&#xe12a;</span>                  
                    </li>
                    <li>
                        <span class="win-commandimage" id="itmBuscarTraslado" onClick="openBusqServ()">&#xe1e8;</span>  
                    </li>                                          
                </ul>
</div>
            
            

           <div >

            	<table>
                	<tr>
                		<td>
                        	<label>Nro. Trasl.</label>
            				<input type="text" id="txtNroTraslado" class="textbox" style="width:80px" />
            			</td>
                        <td>
				<div class="tdDropDown">
	                        <label>Fecha Inc.</label>
    	                    <div id="dtFechaTraslado" style="margin-top:-5px"></div>
				</div>
                         </td>
                        <td>
	                        <label> Nro. Inc.</label>
            				<input type="text" id="txtNroIncidentePanelTraslado" style="width:70px" class="textbox" />
                        </td>
                        
                        <td>
                        	<label>Cliente</label>
            				<input type="text" id="txtClienteTraslado" class="textbox" style="width:180px" />
                        </td>
                        
                        <td>
                        	<label>Nro. Afiliado</label>
            				<input type="text" id="txtNroAfiliadoTraslado" style="width:100px" class="textbox" />
                        </td>
                        
                        <td>
                        	<label>Tel&eacute;fono</label>
            				<input type="text" id="txtTelefonoTraslado" class="textbox" style="width:130px" />
                        </td>
                        
                        <td>
                        	<label>Paciente</label>
            				<input type="text" id="txtPacienteTraslado" class="textbox" style="width:250px" />
                        </td>
                    </tr>
                </table>
                
                         	<table style="margin-top:-5px">
                	<tr>
                		<td>
					<div class="tdDropDown">
                        	<label>Sexo</label>
            				<div id="dpDownSexoTraslado" style="margin-top:-5px"></div>
						</div>
            			</td>
                        
                        <td>
	                        <label>Edad</label>
            				<input type="text" id="txtEdadTraslado" class="textbox itmInput" style="width:50px" />
                        	
                        </td>
                        
                        <td>
                        	<label>Motivo de Llamada - S&iacute;ntomas</label>
            				<input type="text" id="txtSintomasTraslado" class="textbox" style="width:390px" />
                        </td>
                        
                        <td>
				<div class="tdDropDown">
                        	<label>Ret.</label>
                            <div id="chkTrasladoConRetorno" style="margin-top:-5px"></div>
            			</div>	
                        </td>
                        
                        <td>
				<div class="tdDropDown">
                        	<label>Grado</label>
            				<div id="dpDownGradosTraslados" style="margin-top:-5px"></div>
							</div>
                        </td>
                        
                        <td>
				<div class="tdDropDown">
                        	<label>IVA</label>
            				<div id="dpDownIVATraslado" style="margin-top:-5px"></div>
						</div>
                        </td>
                        
                         <td>
                        	<label>Plan</label>
            				<input type="text" id="txtPlanTraslado" class="textbox itmInput" style="width:100px" />
                        </td>
                        
                         <td>
                        	<label>CoPago</label>
            				<input type="text" id="txtCoPagoTraslado" style="text-align:right-align;width:70px" class="textbox itmInput" />
                        </td>
                    </tr>
                </table> 
                		<label style="margin-top:-5px">Observaciones</label>
                		<input type="text" id="txtObservTraslado" style="resize:none;margin-left:2px;width:950px" class="textbox" > </textarea>  
                     
         </div>   
  
  			<div>
                <hr  style="margin-top:-3px;margin-bottom:3px;border-bottom:1px solid black"/>
            	<table>
                	<tr>
                		<td>
                        	<label>Nosocomio</label>
            				<input type="text" id="txtNosocomioTrasladoOrigen" class="textbox" style="width:200px" />
            			</td>
                        <td>
	                        <label>Localidad</label>
    	                    <input type="text" id="txtAbrLocTrasladoOrigen" class="textbox centrado" style="width:50px" />
                            <input type="text" id="txtLocTrasladoOrigen" class="textbox" style="width:150px" />
                         </td>
                        <td>
	                        <label>Domicilio - Calle</label>
            				<input type="text" id="txtDomTrasladoOrigen" class="textbox itmInput" style="width:333px" />
                        </td>
                        
                        <td>
                        	<label>Altura</label>
            				<input type="text" id="txtAlturaTrasladoOrigen"  class="textbox centrado itmInput" style="width:50px" />
                        </td>
                        
                        <td>
                        	<label>Piso</label>
            				<input type="text" id="txtPisoTrasladoOrigen"  class="textbox centrado itmInput" style="width:50px" />
                        </td>
                        
                        <td>
                        	<label>Depto</label>
            				<input type="text" id="txtDepartamentoTrasladoOrigen"  class="textbox centrado itmInput" style="width:50px" />
                        </td>                      
                    </tr>
                </table>
                
                         	<table style="margin-top:-5px">
                	<tr>
                		<td>
                        	<label>Entre Calle 1</label>
            				<input type="text" id="txtEntreCalle1TrasladoOrigen" class="textbox itmInput" style="width:150px" />
            			</td>
                        
                        <td>
	                        <label>Entre Calle 2</label>
            				<input type="text" id="txtEntreCalle2TrasladoOrigen" class="textbox itmInput" style="width:150px" />
                        	
                        </td>
                        
                        <td>
                        	<label>Referencias</label>
            				<input type="text" id="txtReferenciasTrasladoOrigen" class="textbox" style="width:240px" />
                        </td>
                        
                        <td>
                        	<label>Partido</label>
                            <input type="text" id="txtPartidoTrasladoOrigen" class="textbox" style="width:250px" />
            				
                        </td>
                        
                        <td>
				<div class="tdDropDown">
                        	<label>Fecha/Hora Dom.</label>
            				<div id="dtFechaHoraDomTrasladoOrigen" style="margin-top:-5px"></div>
					</div>
                        </td>
                        
                    </tr>
                </table>     
            </div>   
         
         
         <div>
                <hr  style="margin-top:-3px;margin-bottom:3px;border-bottom:1px solid black"/>
            	<table>
                	<tr>
                		<td>
                        	<label>Nosocomio</label>
            				<input type="text" id="txtNosocomioTrasladoDestino" class="textbox" style="width:200px" />
            			</td>
                        <td>
	                        <label>Localidad</label>
    	                    <input type="text" id="txtAbrLocTrasladoDestino" class="textbox centrado" style="width:50px" />
                            <input type="text" id="txtLocTrasladoDestino" class="textbox"  style="width:150px" />
                         </td>
                        <td>
	                        <label>Domicilio - Calle</label>
            				<input type="text" id="txtDomTrasladoDestino" class="textbox itmInput"  style="width:333px" />
                        </td>
                        
                        <td>
                        	<label>Altura</label>
            				<input type="text" id="txtAlturaTrasladoDestino"  class="textbox centrado itmInput"  style="width:50px" />
                        </td>
                        
                        <td>
                        	<label>Piso</label>
            				<input type="text" id="txtPisoTrasladoDestino" class="textbox centrado itmInput"  style="width:50px"/>
                        </td>
                        
                        <td>
                        	<label>Depto</label>
            				<input type="text" id="txtDepartamentoTrasladoDestino" class="textbox centrado itmInput"  style="width:50px" />
                        </td>                      
                    </tr>
                </table>
                
                         	<table style="margin-top:-10px">
                	<tr>
                		<td>
                        	<label>Entre Calle 1</label>
            				<input type="text" id="txtEntreCalle1TrasladoDestino" class=" textbox itmInput"  style="width:150px" />
            			</td>
                        
                        <td>
	                        <label>Entre Calle 2</label>
            				<input type="text" id="txtEntreCalle2TrasladoDestino" class=" textbox itmInput"  style="width:150px" />
                        	
                        </td>
                        
                        <td>
                        	<label>Referencias</label>
            				<input type="text" id="txtReferenciasTrasladoDestino" class="textbox"  style="width:240px" />
                        </td>
                        
                        <td id="tdPartidoTrasladoDestino" class="escondoElemento">
                        	<label>Partido</label>
                            <input type="text" id="txtPartidoTrasladoDestino" class="textbox"  style="width:250px" />     
                        </td>
                        <td>
				<div class="tdDropDown">
                        	<label>Fecha/Hora Dom.</label>
                            <div id="dtFechaHoraDomTrasladoDestino" style="margin-top:-5px"></div>
					</div>
            				
                        </td>
                        
                        <!--<td id="tdFecHoraRetorno" >
				<div class="tdDropDown">
                        	<label>Fecha/Hora Retorno</label>
            				<div id="dtFechaHoraRetornoTrasladoDestino" style="margin-top:-5px"></div>
					</div>
                        </td>-->
                        
                    </tr>
                </table> 
                    
         </div> 
         
         <!--<div id="grillasRealizacionProgramaciones" class='escondoElemento'>
         
         	<table style="margin-left:2px">
            	<tr>
                	<td><div id="grdHistorialTraslado"></td>
                    <td><div id="grdProgramacionTraslado"></td>
                </tr>
            </table>
         </div>
           
         		<div style="background-color:#000;width:958px;height:26px;">
                   <table style="margin-top:1px;margin-left:auto; margin-right:auto;">
                   		<tr>
                        	<td><input type="button" id="btnDomicilioOrigenDestino"  value="Domicilios de Origen y Destino" class="btnTraslado"  /></td>
                            <td><input type="button" id="btnDomicilioAnexo" value="Domicilios Anexos" class="btnTraslado" /></td>
                            <td><input type="button" id="btnRealizacionProgramaciones" value="Realizaci&oacute;n / Programaciones" class="btnTraslado" /></td>
                		</tr>
                	</table>
                    </div>
				</div>
			</div>-->
		</div>
	</div>
	</div>


	<div id="dialogoValidoTel" class="modal message hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
			<h3>Validaci&oacute;n del Cliente</h3>
		</div>
		<div class="modal-body">
			<p id="msgValidoTel"></p>
		</div>
		<div class="modal-footer">
			<button id="btnAceptarPacienteTelefono" class="btn btnComun" >Aceptar</button>
			<button id="btnCancelarPacienteTelefono" class="btn btn-danger btnCancelar">Cancelar</button>
		</div>
	</div>

	<div id="dialogoValidoAfiliado" class="modal message hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
			<h3>Validaci&oacute;n del Afiliado</h3>
		</div>
		<div class="modal-body">
			<p>Afiliado inexistente. ¿Desea confirmar o buscar en el padr&oacute;n?</p>
		</div>
		<div class="modal-footer">
			<button id="btnConfirmarAfiliadoInexistente" class="btn btnComun">Confirmar</button>
			<button id="btnBuscarAfiliadoEnPadron" class="btn btn-danger btnCancelar">Buscar</button>
		</div>
	</div>
	
		<div id="dialogoValidoSintoma" class="modal message hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
			<h3>Validaci&oacute;n de S&iacute;ntoma</h3>
		</div>
		<div class="modal-body">
			<p>S&iacute;ntoma inexistente. ¿Desea confirmar o buscarlo en un listado?</p>
		</div>
		<div class="modal-footer">
			<button id="btnConfirmarSintomaInexistente" class="btn btnComun">Confirmar</button>
			<button id="btnBuscarSintoma" class="btn btn-danger btnCancelar" >Buscar</button>
		</div>
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

		<button class="win-command" id="btnGuardarIncidente" style="display:none" >
                  <span class="win-commandimage win-commandring">  &#xe1aa;</span>
                  <span class="win-label">Guardar</span>
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
<div id="loader"></div>
<script src="../scripts/spin.min.js"></script>
<script>
   
document.getElementById('tituloOpcion').innerHTML = "Operativa";

var opts = {
  lines: 13, // The number of lines to draw
  length: 20, // The length of each line
  width: 10, // The line thickness
  radius: 30, // The radius of the inner circle
  corners: 1, // Corner roundness (0..1)
  rotate: 0, // The rotation offset
  direction: 1, // 1: clockwise, -1: counterclockwise
  color: '#0088cc', // #rgb or #rrggbb
  speed: 1, // Rounds per second
  trail: 60, // Afterglow percentage
  shadow: false, // Whether to render a shadow
  hwaccel: false, // Whether to use hardware acceleration
  className: 'spinner', // The CSS class to assign to the spinner
  zIndex: 2e9, // The z-index (defaults to 2000000000)
  top: '150px', // Top position relative to parent in px
  left: 'auto' // Left position relative to parent in px
};
var target = document.getElementById('loader');
var spinner = new Spinner(opts).spin(target);

</script>

 <?php include_once ("_footer.php"); ?>
 
<script src="../scripts/jquery.blockUI.js"></script>
<script src="../scripts/fcsOperativa.js"></script>
<script>

var version = '<?php echo $_SESSION["v"]; ?>';

setInitialData(version);



</script>

</body>
</html>
