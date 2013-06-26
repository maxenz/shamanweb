// JavaScript Document

	function doEvents() {
		
		//CAPTO EL EVENTO DE LA LISTA DE INCIDENTES ACTUALES O PROGRAMADOS		
	
$('#dropDownTipoIncidentes').on('select', function (event) {
    var args = event.args;
    if (args) {            
        var index = args.index;
		flgIncTras = index;
		refreshDataInc(flgIncTras);
		setLogIncidentes(flgIncTras);
  	  }                        
	});			

//****************************************************************************************************************************************************
		
//CAPTO EL SELECT EN LA DROPDOWN DE GRADOS, Y CAMBIO EL GRAFICO DE TIEMPOS OPERATIVOS SEGUN GRADO		
$('#jqxSelGradoChart').on('select', function (event) {
    var args = event.args;
    if (args) {
               
        var args = event.args;
        var item = $('#jqxSelGradoChart').jqxDropDownList('getItem', args.index);
		var idGrado = item.value;
		setDataOnChartOperativos(idGrado);
		
 
  	 		 }                        
});	

//****************************************************************************************************************************************************
		
//CAPTO EL EVENTO DOBLE CLICK EN LA GRILLA DE INCIDENTES PARA QUE ME CAMBIE DE TAB Y ME MUESTRE LOS DATOS DEL INCIDENTE
$('#grdIncidentes').on('rowdoubleclick', function (event) 
{
	var args = event.args;
	var idxRow = args.rowindex;
	var idRow = $('#grdIncidentes').jqxGrid('getrowid',idxRow);  //OBTENGO ID DEL INCIDENTE SELECCIONADO

  clearControlesRecepcion();		//LIMPIO LOS CONTROLES DEL FORMULARIO DE RECEPCION	
  inhabilitoControlesRecepcion(); //DISABLEO LOS CONTROLES DEL FORMULARIO DE RECEPCION
  setHistorial(idRow);			  //CARGO GRILLA DE HISTORIAL DEL INCIDENTE
  setProgramacion(idRow);		  //CARGO GRILLA DE PROGRAMACION DEL INCIDENTE
  setDataPacienteRecepcion(idRow);		//BUSCO INFORMACION DEL INCIDENTE EN LA BASE DE DATOS
  $('#jqxTabsOperativa').jqxTabs('select', 1);
   
	});
	
//****************************************************************************************************************************************************	
  
//SETEO VALOR MAXIMO DEL CATEGORIZADOR PARA QUE ME DE ROJO  	
  

//SETEO FUNCIONES DE MENU DE RECEPCION

	$('#itmAgregar').click(function(e) {
    
		clearControlesRecepcion();		//LIMPIO FORMULARIO DE RECEPCION
	
		var today = new Date();
		var dd = today.getDate();
		var dy = today.getFullYear();
		var dm = today.getMonth();
	
		$('#dropDownGrados, #dropDownIVA, #dropDownSexo').jqxDropDownList({ disabled: false });
		$('#jqxPanelRecepcion :input').attr('disabled',false);
		$('#jqxDateIncidente').jqxDateTimeInput('setDate', new Date(dy,dm,dd));
		//$('#jqxDateIncidente').jqxDateTimeInput({ disabled: true, readonly:true });
		$('#txtLoc,#txtPartido,#txtDiagnostico,#txtCierre,#txtPacienteDerivado').attr('disabled',true);
		$('#txtNroIncidente').val("001");
		$('#txtNroIncidente').attr('readonly',true);
		$('#txtTelefono').focus();
	
	});
	
	
		
	$('#itmCancelar').click(function(e) {
            
		inhabilitoControlesRecepcion();
		clearControlesRecepcion();
					
     });
	 
	 $('#itmEditar').click(function(e) {
        
		if ($('#txtNroIncidente').val() != "") {
		$('#dropDownGrados, #dropDownIVA, #dropDownSexo').jqxDropDownList({ disabled: false });
		$('#jqxPanelRecepcion :input').attr('disabled',false);
		$('#txtLoc,#txtPartido,#txtDiagnostico,#txtCierre,#txtPacienteDerivado').attr('disabled',true);
		$('#txtNroIncidente').attr('readonly',true);
		$('#txtTelefono').focus(); 
		} else {
			
			alert('No hay ningún incidente seleccionado');	
		}
		
    });
					
//SETEO VALIDACION DEL CLIENTE	
	$("#txtCliente").keydown(function(ev) {
  		
		if (ev.which == 13) {		//SI TOCO ENTER
			
			var cliente = $(this).val().toString();
								
			buscarCliente(cliente,'txtNroAfiliado');		//BUSCO EL CLIENTE EN LA BASE DE DATOS
		}
});
//SETEO VALIDACION DEL CLIENTE TRASLADO
	$("#txtClienteTraslado").keydown(function(ev) {
  		
		if (ev.which == 13) {		//SI TOCO ENTER
			
			var cliente = $(this).val().toString();
								
			buscarCliente(cliente,'txtNroAfiliadoTraslado');		//BUSCO EL CLIENTE EN LA BASE DE DATOS
		}
});


	$('#grdClientes').on('rowdoubleclick',function(event) {	
				
			setDataCliente();
							
	});
	
	
	$('#grdClientes').keydown(function(ev) {
		
			if (ev.which == 13) {
				
				setDataCliente();
			}
		
	});
	
	
//SETEO VALIDACION TELEFONICA

		
	$("#txtTelefono").keydown(function(ev) {
  		
		if (ev.which == 13) {
			
			if ($('#txtTelefono').val().length > 5 ) {
			
				var tel = $('#txtTelefono').val();
				validoTelefonoCliente(tel);
				flgTel = 0;
	
			} else {
				
				$('#txtCliente').focus();
				
			}
			
			
		}
		
	});
	
	$("#txtTelefonoTraslado").keydown(function(ev) {
  		
		if (ev.which == 13) {
			
			if ($('#txtTelefonoTraslado').val().length > 5 ) {
			
				var tel = $('#txtTelefonoTraslado').val();
				validoTelefonoCliente(tel);
				flgTel = 1;
	
			} else {
				
				$('#txtPacienteTraslado').focus();
				
			}
			
			
		}
		
	});

					
	$('#btnAceptarPacienteTelefono').keydown(function(e) {
                
				var idControl = $(this).attr("id");
				
				if ( e.which == 37 | e.which == 39) {
						
					$('#'+idControl).removeClass('btnPopup');
					$('#btnCancelarPacienteTelefono').focus();
					$('#btnCancelarPacienteTelefono').addClass('btnPopup');
								
				}

            });			
			
	$('#btnCancelarPacienteTelefono').keydown(function(e) {
                
		var idControl = $(this).attr("id");
				
		if ( e.which == 37 | e.which == 39) {
						
			$('#'+idControl).removeClass('btnPopup');
			$('#btnAceptarPacienteTelefono').focus();
			$('#btnAceptarPacienteTelefono').addClass('btnPopup');
								
		}

     });
			
	$('#popupValidoTelefono').on('close',function(event) {
		
		$('#btnAceptarPacienteTelefono').removeClass('btnPopup');
		$('#btnCancelarPacienteTelefono').removeClass('btnPopup');
		
	});
		
	$('#btnAceptarPacienteTelefono').click(function(e) {
        
		switch (flgTel) {
								
			case 0:		
				$('#txtAviso').focus();
			break;
								
			case 1:		
				$('#txtPacienteTraslado').focus();
			break;
					
		}
						
		setTextBoxSegunTelefono();
			
    });	
	
	$('#btnCancelarPacienteTelefono').click(function(e) {
        	
		switch (flgTel) {
				
			case 0:
				$('#txtCliente').focus();
			break;
				
			case 1:
				$('#txtPacienteTraslado').focus();
			break;	
				
		}
			
		$('#popupValidoTelefono').jqxWindow('close');
			
			
    });	
	
	
	//SETEO VALIDACION LOCALIDAD
	
	$('#txtAbrLoc,#txtLocAbrDerivacion,#txtAbrLocTrasladoOrigen,#txtAbrLocTrasladoDestino').keydown(function(ev) {
				
		if (ev.which == 13) {
			
		var idControl = $(this).attr("id");
		
		switch (idControl) {
			
			case 'txtAbrLoc':
					flgLoc = 0;
			break;	
			
			case 'txtLocAbrDerivacion':
					flgLoc = 1;
			break;
			
			case 'txtAbrLocTrasladoOrigen':
					flgLoc = 2;
			break;
			
			case 'txtAbrLocTrasladoDestino':
					flgLoc = 3;
			break;
			
		}
		
		var loc = $(this).val().toString();
		
		validoLocalidad(loc)
						
		}
		
	});
	

			
	$('#grdLocalidades').keydown(function(ev) {
		
		if (ev.which == 13) {
				
			setLocalidadElegida();
				
		}
		
	});	
	
	$('#grdLocalidades').on('rowdoubleclick',function(ev) {
		
		setLocalidadElegida();
					
	});
	

	$('#txtNroAfiliado').keydown(function(ev) {

    if (ev.which == 13) {

        var nroAfiliado = $('#txtNroAfiliado').val();
        validoAfiliado(nroAfiliado);
        flgAfiliado = 0;

    	}

	});
	
	$('#txtNroAfiliadoTraslado').keydown(function(ev) {
		
		if (ev.which == 13) {		
			
			var nroAfiliado = $('#txtNroAfiliadoTraslado').val();
			validoAfiliado(nroAfiliado);	
			flgAfiliado = 1;
			
		}
	});
	
//SETEO VALIDACION DE AFILIADO

	$('#btnBuscarAfiliadoEnPadron').keydown(function(e) {
                
		var idControl = $(this).attr("id");
							
		if ( e.which == 37 | e.which == 39) {
				
			$('#'+idControl).removeClass('btnPopup');
			$('#btnConfirmarAfiliadoInexistente').focus();
			$('#btnConfirmarAfiliadoInexistente').addClass('btnPopup');
								
		}

      });
			
	$('#btnConfirmarAfiliadoInexistente').keydown(function(e) {
                
		var idControl = $(this).attr("id");
	
		if ( e.which == 37 | e.which == 39) {
					
			$('#'+idControl).removeClass('btnPopup');
			$('#btnBuscarAfiliadoEnPadron').focus();
			$('#btnBuscarAfiliadoEnPadron').addClass('btnPopup');
								
		}

     });
			
	$('#btnBuscarSintoma').keydown(function(e) {
                
		var idControl = $(this).attr("id");
							
		if ( e.which == 37 | e.which == 39) {
				
			$('#'+idControl).removeClass('btnPopup');
			$('#btnConfirmarSintomaInexistente').focus();
			$('#btnConfirmarSintomaInexistente').addClass('btnPopup');
								
		}
    });
			
	$('#btnConfirmarSintomaInexistente').keydown(function(e) {
                
		var idControl = $(this).attr("id");
	
		if ( e.which == 37 | e.which == 39) {
					
			$('#'+idControl).removeClass('btnPopup');
			$('#btnBuscarSintoma').focus();
			$('#btnBuscarSintoma').addClass('btnPopup');						
		}
     });
	
	$('#btnConfirmarAfiliadoInexistente').click(function(e) {
        
		$('#popupValidoAfiliado').jqxWindow('close');
		
		switch (flgAfiliado) {
			
			case 0:
				$('#txtAviso').focus();	
			break;
			
			case 1:
				$('#txtTelefonoTraslado').focus();
		}
		
    });
	
	$('#popupValidoAfiliado').on('close',function(event) {
		
			$('#btnConfirmarAfiliadoInexistente').removeClass('btnPopup');
			$('#btnBuscarAfiliadoEnPadron').removeClass('btnPopup');
		
	});
	
	$('#btnBuscarAfiliadoEnPadron').click(function(e) {
        
		buscoAfiliadoEnPadron();
		
    });
	
	$('#btnBuscarAfiliadoEnPadron').keydown(function(e) {
        
		if (e.which == 13) {
			
			buscoAfiliadoEnPadron();	
			
		}
		
    });
	
	
	$('#grdAfiliados').keydown(function(ev) {
		
		if (ev.which == 13) {		
			
			setAfiliadoElegido();	
			
		}
	});
	
	$('#grdAfiliados').on('rowdoubleclick', function(ev) {
		
			setAfiliadoElegido();
		
	});
	

	//SETEO VALIDACION DE SINTOMAS
	
	$('#txtSintomas').keydown(function(e) {
        
		if (e.which == 13) {
			
			var idControl = $(this).attr("id");
			var pSint;
			
			switch(idControl) {
				
				case 'txtSintomas':
						flgSintomas = 0;
						pSint = $('#txtSintomas').val();
						
				break;
								
			}
			
			validoSintoma(pSint);
						
		}
				
    });
	
	$('#contentCategorizador').on('change','.dpDownCateg',function(event) {
	
		acumCategorizador = 0;
		
		for (var i = 0; i < vecPreguntas.length; i++) {
			
			var item = $('#'+vecPreguntas[i]).jqxDropDownList('getSelectedItem');
			var valor = item.value;
			acumCategorizador = acumCategorizador + valor;	
			
		}
		
		
		
		if (acumCategorizador >= flgMaxEmergencia) {
			
			$(this).jqxDropDownList('close');
			$('#btnGuardarCateg').focus();
				   
	   }
									  
				$.ajax({
				 type: "GET",
				 dataType: "json",
				 url: "getOpcionesCategorizacion.php?opt=3&acum="+acumCategorizador,
				 success: function(vecGrado){
						
						var grado = vecGrado[0];
						var color = vecGrado[1];
						
						$('#btnGradoCateg').css("background-color",'#'+color);
						$('#btnGradoCateg').val(grado);
						
						
						
									}
							   });   
							});	
			
		$('#contentCategorizador').on('click','#btnGuardarCateg',function(event) {
			
			var grado = $('#btnGradoCateg').val();
			
			var itemsGrado = $("#dropDownGrados").jqxDropDownList('getItems');
			var indexToSelect = -1;
			$.each(itemsGrado, function (index) {
   				 if (this.label == grado) {
        			indexToSelect = index;
       				 return false;
    				}
				});
				
			$("#dropDownGrados").jqxDropDownList({ selectedIndex: indexToSelect });
			$('#popupCategorizador').jqxWindow('close');
			$('#txtPaciente').focus();
			
			
        });	
		
		$('#contentCategorizador').on('click','#btnCancelarCateg',function(event) {
            
			$('#popupCategorizador').jqxWindow('close');
			$('#dropDownGrados').jqxDropDownList('focus');
					
        });
		
		
	$('#popupValidoSintoma').on('close',function(event) {
		
		$('#btnBuscarSintoma').removeClass('btnPopup');
		$('#btnConfirmarSintomaInexistente').removeClass('btnPopup');
		
	});
	
		
	$('#btnConfirmarSintomaInexistente').click(function(e) {
        
		$('#dropDownGrados').jqxDropDownList('focus');
		$('#popupValidoSintoma').jqxWindow('close');
		
    });
	
	$('#btnBuscarSintoma').click(function(e) {
        
		$('#popupValidoSintoma').jqxWindow('close');
		$('#grdSintomas').jqxGrid('selectrow',0);
		$('#popupBuscoSintoma').jqxWindow('focus');
		$('#grdSintomas').jqxGrid('focus');
		$('#popupBuscoSintoma').jqxWindow('open');
			
    });
	
	$('#popupBuscoSintoma').on('open',function(ev){
		
		setGrillaSintomas();
		
	});
	
	$('#popupBuscoLocalidades').on('open',function(ev){
		
		setGrillaBusquedaLocalidades();
		
	});
	
	
	$('#itmCtxPreasignar').click(function(e) {
       		
			$('#txtMovEmpresa').val('');
			$('#txtEstNombre').val('');
			$('#txtTipoMovCob').val('');
			$('#dpDownDespacharPreDespIncidente').jqxDropDownList({	selectedIndex : 0   });
			$('#accionPreDesp').addClass('escondoElemento');
			$('#txtEstNombre').css("width","285px");
			$('#txtTipoMovCob').css("width","290px");
			setDataDespachoPreasigno();
			
	});
	
	$('#itmCtxReclamos').click(function(e) {
		
		$('#popupObservaciones').jqxWindow('open');	
		
	});
	
	$('#popupObservaciones').on('open',function(e) {
		
		var vecObserv = getDataIncidenteForPopup();
		
		$('#dtFechaIncObservaciones').jqxDateTimeInput('setDate', vecObserv[0]);
		$('#panelObservacionesIncidente :input').attr("disabled",true);
		$('#txtNroIncObservaciones').val(vecObserv[1]);
		$('#txtGdoObservaciones').val(vecObserv[2]);
		$('#txtGdoObservaciones').css("background-color","#"+vecObserv[3]);
		$('#txtPacienteObservaciones').val(vecObserv[4]);
		$('#txtAreaObservacionesRecl').focus();
		
		
	});
	
	$('#popupAvisos').on('open',function(e) {
		
		var vecAvisos = getDataIncidenteForPopup();
		
		$('#dtFechaAviso').jqxDateTimeInput('setDate', vecAvisos[0]);
		$('#txtNroIncAviso').val(vecAvisos[1]);
		$('#txtGdoAviso').val(vecAvisos[2]);
		$('#txtGdoAviso').css("background-color","#"+vecAvisos[3]);
		$('#txtPacienteAviso').val(vecAvisos[4]);
		$('#popupAvisos').jqxWindow('focus');
		$('#txtTipAviso').focus();
			
	});
	
	$('#btnCancelarAviso').click(function(e) {
        
		$('#popupAvisos').jqxWindow('close');
			
    });
	
	
	
	
	$('#itmCtxDespachar').click(function(e) {
        
			$('#txtMovEmpresa').val('');
			$('#txtEstNombre').val('');
			$('#txtTipoMovCob').val('');
			$('#dpDownDespacharPreDespIncidente').jqxDropDownList({	selectedIndex : 0   });
			$('#txtEstNombre').css("width","230px");
			$('#txtTipoMovCob').css("width","230px");
			$('#accionPreDesp').removeClass('escondoElemento');
			setDataDespachoPreasigno();
		
    });
	
	$('#btnCancelarPreDesp').click(function(e) {
        
		$('#popupPreasignoDespacho').jqxWindow('close');
		
    });
	
	$('#btnCancelarObservacionesRec').click(function(e) {
        
		$('#popupObservaciones').jqxWindow('close');
		
    });
	
	$('#txtAbrLugarDerivacion,#txtNosocomioTrasladoOrigen,#txtNosocomioTrasladoDestino').keydown(function(e) {
        
		if (e.which == 13) {
			
			var idControl = $(this).attr("id");
			var sanatorio;
			
			switch (idControl) {
				
				case 'txtAbrLugarDerivacion':
						flgSanatorio = 0;
						sanatorio = $('#txtAbrLugarDerivacion').val();
						
				break;	
				
				case 'txtNosocomioTrasladoOrigen':
						flgSanatorio = 1;
						sanatorio = $('#txtNosocomioTrasladoOrigen').val();
				break;
				
				case 'txtNosocomioTrasladoDestino':
						flgSanatorio = 2;
						sanatorio = $('#txtNosocomioTrasladoDestino').val();
				break;
				
			}
					
				validoLugarDerivacion(sanatorio);
			
		}
	
    });
	

	$('#panelCierreIncidente :input').attr("disabled","true");
	$('#panelAvisos :input').not("#txtTipAviso").attr("disabled","true");
	$('#txtLugarDerivacion,#txtLocDerivacion,#txtDiagnosticoDerivacion').attr("disabled","true");
	
	$('#popupEstablecerCierre').on('open',function(event) {
		
			$('#txtLugarDerivacion,#txtAbrLugarDerivacion,#txtDomicilioDerivacion,#txtAlturaDerivacion,#txtPisoDerivacion,#txtDeptoDerivacion,#txtNombreLugarDerivacion,#txtDiagnosticoAbrDerivacion,#txtDiagnosticoDerivacion,#txtObservacionesDerivacion').val('');
			$('#dtFechaHorSalCierre').jqxDateTimeInput('focus');		
		
	});
	

	
	$('#txtDiagnosticoAbrDerivacion').keydown(function(e) {
        
		if (e.which == 13) {
			
				validoDiagnosticos();
			
		}
	
    });
	

	
	$('#grdDiagnosticos').on('bindingcomplete',function(e) {
		
		 $('#popupDiagnosticos').jqxWindow('open');
		 $('#grdDiagnosticos').jqxGrid('selectrow',0);
		 $('#popupDiagnosticos').jqxWindow('focus');
		 $('#grdDiagnosticos').jqxGrid('focus');
		 
	});
	
	$('#grdDiagnosticos').keydown(function(e) {
        
		if (e.which == 13) {
			
			setDiagnosticoInForm()			
			
		}
		
    });
	
	$('#grdDiagnosticos').on('rowdoubleclick',function(e) {
		
		setDiagnosticoInForm();
		
	});
	
	
	
	$('#btnCancelarCierre').click(function(e) {
        
		$('#popupEstablecerCierre').jqxWindow('close');
		
    });
	
	
	$('#grdSanatorios').keydown(function(e) {
        
		if (e.which == 13) {
			
			setSanatorioInFormulario();	
		}
		
    });
	
	$('#grdSanatorios').on('rowdoubleclick',function(e) {
		
			setSanatorioInFormulario();
		
	});
	
	
	
	$('#grdSugerenciaMovilesEmpresas').on('rowdoubleclick',function(event){
		
			var rowindex = $('#grdSugerenciaMovilesEmpresas').jqxGrid('getselectedrowindex');	
			var rowData = $('#grdSugerenciaMovilesEmpresas').jqxGrid('getrowdata',rowindex);
			
			var movEmpresa = "";
			var estNombre = "";
			var tipMovCob = "";
			
			var idxDropDown = $('#dpDownDespacharPreDespIncidente').jqxDropDownList('getSelectedIndex');
				
			if ( idxDropDown == 0) {
				
				movEmpresa = rowData.Movil;
				estNombre = rowData.EstMovil;
				tipMovCob = rowData.TipoMovil;	
				
			} else {
				
				movEmpresa = rowData.AbreviaturaId;
				estNombre = rowData.RazonSocial;
				tipMovCob = rowData.TipoCobertura;			
				
			}
			
				$('#txtMovEmpresa').val(movEmpresa);
				$('#txtEstNombre').val(estNombre);
				$('#txtTipoMovCob').val(tipMovCob);
			
	});
	
	$('#dpDownDespacharPreDespIncidente').on('change',function(event) {
		
		var opt = $('#dpDownDespacharPreDespIncidente').jqxDropDownList('getSelectedIndex');
		var loc = $('#txtDomAbrIncPreDespIncidente').val();
		var gdo = $('#txtGdoIncPreDespIncidente').val();
		
		setTitulosPanelMovilEmpresa(opt);
		
		setDataGrillaSugerencias(opt,loc,gdo);
			
	});
	
	
			
	$('#panelPreDespIncidente :input').attr("disabled","true");
			
	
	$('#itmCtxCierre').click(function(e) {
        	
			var rowindex = $('#grdIncidentes').jqxGrid('getselectedrowindex');
			var data = $('#grdIncidentes').jqxGrid('getrowdata',rowindex);
			var fechaInc = data["FechaIncidente"];
			var gdo = data["Grado"];
			var colGdo = data["ColorGrado"];
			var dom = data["Domicilio"];
			var loc = data["Localidad"];
			var nroInc = data["NroIncidente"];
					
			$('#txtNroIncCierre').val(nroInc);
			$('#txtGdoCierre').val(gdo);
			$('#txtDomCierre').val(dom);
			$('#txtDomAbrCierre').val(loc);
			$('#txtGdoCierre').css("background-color","#"+colGdo);
			fechaInc = fechaInc.substring(0,10);
			fechaInc = strDateToJavascriptDate(fechaInc);
			$('#dtFechaCierre').jqxDateTimeInput('setDate', fechaInc);
			
			$('#popupEstablecerCierre').jqxWindow('open');
			
    });
	
	
	
	$('#itmCtxTips').click(function(e) {
        
		$('#popupAvisos').jqxWindow('open');
		
    });
	
	$('#txtTipAviso').keydown(function(e) {
        
		if (e.which == 13) {
			e.preventDefault(); 
			$('#btnAceptarAviso').focus();
		}
		
    });
	
	$('#btnAceptarObservacionesRec').click(function(e) {
        
		setObservReclamos();
		
    });
	
	$('#btnAceptarObservacionesRec').keydown(function(e) {
        
		if (e.which == 13) {
			e.preventDefault();
			setObservReclamos();
		}
		
    });
	
	$('#txtAreaObservacionesRecl').keydown(function(e) {
        
		if (e.which == 13) {
				
			e.preventDefault();
			$('#btnAceptarObservacionesRec').focus();
		}
		
    });
	
	$('#btnAceptarAviso').bind('click',function() {
        
		setAviso();	
					
    });

	
	$('#btnAceptarAviso').keydown(function(e) {
        
		if (e.which == 13) {
			e.preventDefault();
			setAviso();	
		}
		
    });
	
	$('#grdSintomas').keydown(function(ev) {
		
		if (ev.which == 13) {		
			
			setSintomaElegido();	
			
		}
	});
	
	$('#grdSintomas').on('rowdoubleclick',function(ev) {
		
			setSintomaElegido();
			
	});
	
	
	$('#txtPacienteTraslado').keydown(function(e) {
        
		if (e.which == 13) {
			
			$('#dpDownSexoTraslado').jqxDropDownList('focus');	
				
		}
		
    });
	
	$('#dpDownSexoTraslado').on('close',function(event) {
				
			 $('#txtEdadTraslado').focus();	
	
	});
	
	
	
//SETEO MENU CONTEXTUAL PARA GRILLA DE INCIDENTES	
	
	$("#grdIncidentes").on('rowclick', function (event) {

                   if (event.args.rightclick) {
					   
					    var rowindex = $('#grdIncidentes').jqxGrid('getselectedrowindex');
					    var data = $('#grdIncidentes').jqxGrid('getrowdata',rowindex);
						var nroInc = data["NroIncidente"];
						$('#itmCtxIncidente').text('Incidente ' + nroInc);
                        var scrollTop = $(window).scrollTop();
                        var scrollLeft = $(window).scrollLeft();
                        menuContextualGrillaInc.jqxMenu('open', parseInt(event.args.originalEvent.clientX) + 5 + scrollLeft, parseInt(event.args.originalEvent.clientY) + 5 + scrollTop);
                        return false;
                    }
                });
				
	$("#grdMoviles").on('rowclick', function (event) {

                   if (event.args.rightclick) {
					   
					    var rowindex = $('#grdMoviles').jqxGrid('getselectedrowindex');
					    var data = $('#grdMoviles').jqxGrid('getrowdata',rowindex);
						var nroMov = data["Movil"];
						$('#itmCtxMovil').text('Móvil ' + nroMov);
                        var scrollTop = $(window).scrollTop();
                        var scrollLeft = $(window).scrollLeft();
                        menuContextualGrillaMov.jqxMenu('open', parseInt(event.args.originalEvent.clientX) + 5 + scrollLeft, parseInt(event.args.originalEvent.clientY) + 5 + scrollTop);
                        return false;
                    }
                });				

                
				window.oncontextmenu = function() {
					 return false
				 };

	
	$('.itmInput').keydown(function(ev) {
		
		idControl = $(this).attr("id");
		
		if (ev.which == 13) {
			
			 if ( idControl == 'txtPaciente') {
			
					$('#dropDownIVA').jqxDropDownList('focus');
			
			} else if ( idControl == 'txtReferencias') {
				
					$('#dropDownSexo').jqxDropDownList('focus');
		
		    } else if (idControl == 'txtCoPago') {
				
					$('#txtObservaciones').focus();
				
			} else {
				
					$(this).focusNextInputField();			
			}
						
		}
	});
	
	$('#dropDownSexo').on('close',function(event) {
		
		$('#txtEdad').focus();
		
	});
	
	$('#dropDownIVA').on('close',function(event) {
		
		$('#txtPlan').focus();
		
	});
	
	
	$('#tabRecepcion').click(function(e){
		
		flgAccionF10 = 0;
		
	});
	
	$('#tabTraslado').click(function(e){
		
		flgAccionF10 = 1;
		
	});
	
	$('body').keydown(function(e){ 
	
		var boolValidacion;
		if (e.which == 121) {
	
		switch(flgAccionF10) {
			
			case 0 :
							
			var itemSexo = $("#dropDownSexo").jqxDropDownList('getSelectedItem');
			if (itemSexo != null) var sexo = itemSexo.value;
			
			var itemGrado = $("#dropDownGrados").jqxDropDownList('getSelectedItem');
			if (itemGrado != null) var grado = itemGrado.label;
			
			var itemIVA = $("#dropDownIVA").jqxDropDownList('getSelectedItem');
			if (itemIVA != null) var iva = itemIVA.label;
			
			var datosIncidente = [];
				datosIncidente.push($('#jqxDateIncidente').jqxDateTimeInput('getText'));
				datosIncidente.push($('#txtNroIncidente').val());
				datosIncidente.push($('#txtTelefono').val());
				datosIncidente.push($('#txtCliente').val());
				datosIncidente.push($('#txtNroAfiliado').val());
				datosIncidente.push($('#txtAviso').val());
				datosIncidente.push($('#txtAbrLoc').val());
				datosIncidente.push($('#txtLoc').val());
				datosIncidente.push($('#txtPartido').val());
				datosIncidente.push($('#txtCalle').val());
				datosIncidente.push($('#txtAltura').val());
				datosIncidente.push($('#txtPiso').val());
				datosIncidente.push($('#txtDepartamento').val());
				datosIncidente.push($('#txtEntreCalle1').val());
				datosIncidente.push($('#txtEntreCalle2').val());
				datosIncidente.push($('#txtReferencias').val());
				datosIncidente.push(sexo);
				datosIncidente.push($('#txtEdad').val());
				datosIncidente.push($('#txtSintomas').val());
				datosIncidente.push(grado);
				datosIncidente.push($('#txtPaciente').val());
				datosIncidente.push(iva);
				datosIncidente.push($('#txtPlan').val());
				datosIncidente.push($('#txtCoPago').val());
				datosIncidente.push($('#txtObservaciones').val());
				datosIncidente.push(user);
				
				boolValidacion = validoGuardarIncidente();
			
				 if (boolValidacion) {
					 
					 $.ajax({
						type: "POST",
						url: "setIncidente.php",
						data: { pArray : datosIncidente },
						success: function(datos){		
							
						if (datos == '') {
							$.msg({ 
					
					  		content: '<span style="color:white;font-weight:bold;font-size:16px;font-family: "segoe ui", arial,sans-serif;">El servicio fue guardado correctamente.</span>',
					 		 css : {
   								 background : 'black',
   								 border : '2px solid white'
  								  } ,
					  bgPath: '../images/'
					           });
							refreshDataInc(flgIncTras);	
						} else { 

							alert('Error: ' + datos);
						}
					  }
				    });	
						
				 } else {
					 	
					$.msg({ 
					
					  content: '<span style="color:white;font-weight:bold;font-size:16px;font-family: "segoe ui", arial,sans-serif;">Complete todos los campos necesarios!</span>',
					  css : {
   								 background : 'red',
   								 border : '2px solid white'
  								  } ,
					  bgPath: '../images/'
					           });
				
				}
							 	
			break;
			
			case 1:
				alert('guardoTraslado');
			break;	
			
			}
		
		}
	
	});
	
	$('#popupSanatorios').on('open',function(ev){
		
		setGrillaSanatorios();
		
	});


	$('#dropDownGrados,#dpDownGradosTraslados').on('change', function (event) {     
    var args = event.args;
    if (args) {
                      
        var index = args.index;
        var item = args.item;
        var color = item.value;
		
		$(this).css("background-color",'#'+color);

   		 }
	 });
	 
	 
	 $('#txtSintomasTraslado').keydown(function(e) {
        
		if (e.which == 13) {
			
			$('#chkTrasladoConRetorno').jqxCheckBox('focus');
		}
		
    });
	
	$('#chkTrasladoConRetorno').on('checked',function(event) {
		
			$('#dpDownGradosTraslados').jqxDropDownList('focus');
		
	});
	
	$('#chkTrasladoConRetorno').keydown(function(e) {
        
			if (e.which == 13) {
				
		   		 $('#chkTrasladoConRetorno').jqxCheckBox('check');
			 	
			}
		
    });
	
	$('#dpDownGradosTraslados').on('close', function(event) {
		
			$('#dpDownIVATraslado').jqxDropDownList('focus');
		
	});
	
	$('#dpDownIVATraslado').on('close',function(event) {
		
			$('#txtPlanTraslado').focus();
		
	});
	
	$('#txtObservTraslado').keydown(function(e) {
		
		if (e.which == 13) {
        
		$('#txtNosocomioTrasladoOrigen').focus();
		
		}
		
    });
	
	$('#txtReferenciasTrasladoOrigen').keydown(function(e) {
		
		if (e.which == 13) {
        
		$('#dtFechaHoraDomTrasladoOrigen').jqxDateTimeInput('focus');
		
		}
		
    });
	
	$('#dtFechaHoraDomTrasladoOrigen').keydown(function(e) {
		
		if (e.which == 13) {
        
		$('#txtNosocomioTrasladoDestino').focus();
		
		}
		
    });
	
	$('#txtReferenciasTrasladoDestino').keydown(function(e) {
		
		if (e.which == 13) {
        
		$('#dtFechaHoraDomTrasladoDestino').jqxDateTimeInput('focus');
		
		}
		
    });
	
	$('#dtFechaHoraDomTrasladoDestino').keydown(function(e) {
		
		if (e.which == 13) {
		
			$('#dtFechaHoraRetornoTrasladoDestino').jqxDateTimeInput('focus');
			
		}
	
    });
	
	$('#dropDownGrados').on('close',function(event) {
		
		$('#txtPaciente').focus();
			
	});
	
	$('#itmAgregarTraslado').click(function(e) {
        
		habilitoControlesTraslado();
		$('#txtClienteTraslado').focus();
		
    });
	
	$('#itmCancelarTraslado').click(function(e) {
        
		inhabilitoControlesTraslado();
		
    });
	
	$('#btnDomicilioAnexo').click(function(e) {
        
		$('#panelTrasladosOrigen,#panelTrasladosDestino').removeClass('escondoElemento');
		$('#grillasRealizacionProgramaciones').addClass('escondoElemento');
		$('#tdPartidoTrasladoDestino').removeClass('escondoElemento');
		$('#tdFecHoraRetorno').addClass('escondoElemento');
		$('#tituloPanelTrasladosOrigen').text("Anexo I");
		$('#tituloPanelTrasladosDestino').text("Anexo II");	
			
    });
	
	$('#btnDomicilioOrigenDestino').click(function(e) {
        
		$('#panelTrasladosOrigen,#panelTrasladosDestino').removeClass('escondoElemento');
		$('#grillasRealizacionProgramaciones').addClass('escondoElemento');
		$('#tdPartidoTrasladoDestino').addClass('escondoElemento');
		$('#tdFecHoraRetorno').removeClass('escondoElemento');
		$('#tituloPanelTrasladosOrigen').text("Origen");
		$('#tituloPanelTrasladosDestino').text("Destino");
			
    });
	
	$('#btnRealizacionProgramaciones').click(function(e) {
        
		$('#panelTrasladosOrigen,#panelTrasladosDestino').addClass('escondoElemento');
		$('#grillasRealizacionProgramaciones').removeClass('escondoElemento');
			
    });
	
	$('#btnAceptarPreDesp').click(function(e) {
        
		var bPreasignar = validoPreasignacion();
		
		if (bPreasignar) {
			
			preasignoIncidente();
				
		} else {
			
			alert('Complete todos los campos para preasignar');	
		}
    });
	
	$('#popupClientes').on('open',function(ev){
		
		setGrillaClientes();
		
	});
	
//FUNCION PARA FOCUSEAR EL NEXT INPUT		
$.fn.focusNextInputField = function() {
    return this.each(function() {
        var fields = $(this).parents('form:eq(0),body').find('button,input,textarea,select');
        var index = fields.index( this );
        if ( index > -1 && ( index + 1 ) < fields.length ) {
            fields.eq( index + 1 ).focus();
        }
        return false;
    });
   };		
			 	 							

		
	}