// JavaScript Document

	var sourceMaestroClientes, sourceContactosCliente, sourceIntegrantes, sourcePlanes = [];
	var columnasMaestroClientes, columnasContactoCliente, columnasIntegrantes, columnasPlanes = [];
	var flgLoc = 0;
	var flgInsModifContacto = 0;
	var flgInsModifCliente = 0;

	function initMenuClientes() {
		
		$("#menuGrillaClientes").jqxMenu({ width: '940px', height: '40px', mode: 'horizontal', theme: 'metro' });
		$("#menuGrillaIntegrantes").jqxMenu({ width: '940px', height: '40px', mode: 'horizontal', theme: 'metro' });
		$("#menuContactosCliente").jqxMenu({ width: '938px', height: '25px', mode: 'horizontal', theme: 'metro' });
		
	}
	
	function bindEventos() {
	
		$('#btnAceptarCliente').keydown(function(ev){
				
			if (ev.which == 13) {
										
				procesarNuevoCliente();
				ev.preventDefault();
				ev.stopPropagation();	
						
			}
		});
	
		$('#dpDownRubroTit').on('close',function(event) {
		
			$('#chkCategorizacionPropia').jqxCheckBox('focus');
	
		});

		$('#chkCategorizacionPropia').on('keydown',function(ev) {
		
			if (ev.which == 13) {
				$('#txtAbrLocTit').focus();		
			}		
		});
	
	}
	
	function setGrdMaestroClientes() {
	
		sourceMaestroClientes ={
        	datatype: "json",
        	datafields: [{ name: 'ID' },{ name: 'Codigo'}, {name: 'RazonSocial'}, {name: 'Rubro'},{name: 'Domicilio'},{name: 'Localidad'},{name: 'PlanId'},{name: 'Observ'}],
		 	url: 'getSetClientes.php?opt=1'
   		 };	
		 	

		columnasMaestroClientes = [
			{ text: 'ID', datafield: 'ID', hidden: true },
			{ text: 'PlanId', datafield: 'PlanId', hidden: true },
			{ text: 'Observ', datafield: 'Observ', hidden: true },
			{ text: 'Código', datafield: 'Codigo', width: 100, align: 'center'},
			{ text: 'Razón Social', width:250, datafield: 'RazonSocial', align: 'center'},
			{ text: 'Rubro', datafield: 'Rubro', width: 200, align: 'center' },
			{ text: 'Domicilio', datafield: 'Domicilio',width: 270, align: 'center'},
			{ text: 'Localidad', datafield: 'Localidad',width: 120, align: 'center', cellsalign: 'center'},
		];
		
		$('#grdMaestroClientes').jqxGrid({	source: sourceMaestroClientes, columns: columnasMaestroClientes });
		$('#grdMaestroClientes').jqxGrid('selectrow',0);
		$('#grdMaestroClientes').jqxGrid('focus');
	
	}
	
	function setGrdIntegrantes(cliente) {
	
		sourceIntegrantes ={
        	datatype: "json",
        	datafields: [{ name: 'ID' },{ name: 'NroAf'}, {name: 'TipInt'}, {name: 'Ape'},{name: 'Nom'}],
		 	url: 'getSetClientesIntegrantes.php?opt=0&cliente='+cliente
   		 };	
		
		columnasIntegrantes = [
			{ text: 'ID', datafield: 'ID', hidden: true },
			{ text: 'Nro. Afiliado', datafield: 'NroAf', width: 190, align: 'center'},
			{ text: 'Tipo Int.',  datafield: 'TipInt', width: 150,align: 'center'},
			{ text: 'Apellido', datafield: 'Ape', width: 300, align: 'center' },
			{ text: 'Nombre', datafield: 'Nom', width:300, align: 'center'},
		];
		
		$('#grdIntegrantes').jqxGrid({	source: sourceIntegrantes, columns: columnasIntegrantes});
		$('#grdIntegrantes').jqxGrid('selectrow',0);
		$('#grdIntegrantes').jqxGrid('focus');
	
	}
	
	function initGrdMaestroClientes() {

		$("#grdMaestroClientes").jqxGrid({
			width:960,
			height:390,
			columnsresize: false,
			autoshowfiltericon: true,
			source: [],
			theme: 'metro',
			columns: [],
			altrows:true,
			pagesize:17,
			pagesizeoptions: ['10','12','17'],
			pageable: true,
			filterable: true,
			sortable: true,
			showfilterrow: true
	    });				
	}
	
	function initGrdIntegrantes() {
		$('#grdIntegrantes').jqxGrid({
			width:940,
			height:349,
			columnsresize: false,
			autoshowfiltericon: true,
			source: [],
			theme: 'metro',
			columns: [],
			altrows:true,
			pagesize:17,
			pagesizeoptions: ['10','12','17'],
			pageable: true,
			filterable: true,
			sortable: true,
			showfilterrow: true
	    });				
	}
	
	function initGrdPlanes() {

		$("#grdPlanes").jqxGrid({
			width:250,
			height:200,
			columnsresize: false,
			editable: true,
			selectionmode: 'singlecell',
			source: [],
			theme: 'metro',
			columns: columnasPlanes,
			altrows:true,
	    });				
	}
	
	function setGrdPlanes(boolEditCoPago,sourcePlanes) {
	
			 cellsRendererGrado = function (row, columnfield, value, defaulthtml, columnproperties) {
			var data = $('#grdPlanes').jqxGrid('getrowdata',row);
			var color = "#" + data["ColorGrado"];	  
			return '<div style="width:50px;height:27px;text-align:center;line-height:27px;background: ' + color + ';">'+ value + '</div>'; 
	   }
		 
		  var rowEditGral = function (row) {
       	 	return true;
		}
		
		  var rowEditCoPago = function (row) {
       	 	return boolEditCoPago;
		}
		
		columnasPlanes = [
			{ text: 'ID', datafield: 'ID', hidden: true },
			{ text: 'gOpId', datafield: 'gOpId', hidden: true},
			{ text: '', datafield: 'Grado', cellsrenderer: cellsRendererGrado, width: '20%', cellbeginedit: true},
			{ text: 'Cub', datafield: 'Cub', width:'30%',columntype: 'dropdownlist', align:'center', cellsalign: 'center', createeditor: function (row, column, editor) {
                            var list = ['SI', 'NO'];
                            editor.jqxDropDownList({ source: list});
                        },cellbeginedit: boolEditCoPago},
			  { text: 'CoPago', datafield: 'CoPago', align: 'center', width:'50%', cellsalign: 'right', cellsformat: 'c2', columntype: 'numberinput',
                      validation: function (cell, value) {
                          if (value < 0 || value > 999) {
                              return { result: false, message: "El CoPago va de $0 a $999" };
                          }
                          return true;
                      },
                      createeditor: function (row, cellvalue, editor) {
                          editor.jqxNumberInput({ digits: 3 });
                      },cellbeginedit: boolEditCoPago
                  },
			{ text: 'ColorGrado', datafield: 'ColorGrado', hidden: true},	
		];
		
		$('#grdPlanes').jqxGrid({ source: sourcePlanes, columns: columnasPlanes });	
	}
	
	
	
	function setGrdContactosCliente(id) {
	
		sourceContactosCliente ={
        	datatype: "json",
        	datafields: [{ name: 'ID' },{ name: 'Nombre'}, {name: 'Email'}, {name: 'Telefono'}],
		 	url: 'getSetContactosCliente.php?opt=0&id='+id
   		 };	
		
		columnasContactosCliente = [
			{ text: 'ID', datafield: 'ID', hidden: true },
			{ text: 'Nombre', datafield: 'Nombre', width: '40%', align: 'center'},
			{ text: 'Email', datafield: 'Email', width:'40%', align: 'center'},
			{ text: 'Teléfono', datafield: 'Telefono', width: '20%', align: 'center' },	
		];
		
		$('#grdContactosCliente').jqxGrid({	source: sourceContactosCliente, columns: columnasContactosCliente });
		
		//$('#grdContactosCliente').jqxGrid('selectrow',0);
//		$('#grdContactosCliente').jqxGrid('focus');
//	
	}
	
	
	
	function initGrdContactosCliente() {

		$("#grdContactosCliente").jqxGrid({
			width:938,
			height:143,
			columnsresize: false,
			source: [],
			theme: 'metro',
			columns: [],
			altrows:true,
			filterable: true,
			sortable: true
	    });		
			
	}
	
	function initPanelOpcionesCliente() {
		
		$('#panelDatosTitular').jqxPanel({width:940,height:410,theme:'metro'});
		$('#panelIntegrante').jqxPanel({width:940,height:430,theme:'metro'});
		$('#panelAgregoContactoCliente').jqxPanel({width:400,height:250,theme:'metro'});		
		
	}
	
	function initTabOpcionesClientes() {
	
		$('#tabsOpcionesClientes').jqxTabs({ width: 942, height: 430, position: 'top', theme: 'metro' });
	
	}
	
	function initToolTip() {
		
		$('#verGrilla').jqxTooltip({ position: 'bottom', content: 'Ver Grilla de Clientes', theme:'metro'});
			
	}
	
	function initDropDown() {
		
		var sourceDropDownRubro =   { datatype: "json", datafields: [ { name: 'ID' },{ name: 'Descripcion' } ], url: 'getRubrosClientes.php', async: false};
		var dataAdapterRubro = new $.jqx.dataAdapter(sourceDropDownRubro);	
		$("#dpDownRubroTit").jqxDropDownList({ source: dataAdapterRubro,promptText:'Seleccione...' ,valueMember:'ID',displayMember:'Descripcion',
													  width: 370,height: 27, dropDownHeight:120, theme:'metro'});
													  
		var sourceTipoInt = ["DOM","PER"];											  
		$("#dpDownTipoInt").jqxDropDownList({ source: sourceTipoInt, promptText:'Seleccione...', width: 150,height: 27, dropDownHeight:50, theme:'metro'});	
		
		var sourceDropDownTipoDoc = { datatype: "json", datafields: [ { name: 'ID' },{ name: 'Tipo' } ], url: 'getTipoDoc.php', async: false};
		var dataAdapterTipoDoc = new $.jqx.dataAdapter(sourceDropDownTipoDoc);	
		$("#dpDownTipoDocInt").jqxDropDownList({ source: dataAdapterTipoDoc,promptText:'Seleccione...' ,valueMember:'ID',displayMember:'Tipo',
													  width: 100,height: 27, dropDownHeight:75, theme:'metro'});
													  
		var sourceSexoInt = ["M","F"];
		$("#dpDownSexoInt").jqxDropDownList({ source: sourceSexoInt, promptText:'Seleccione...', width: 100,height: 27, dropDownHeight:50, theme:'metro'});
		
		var sourceCobertura = ["Cobertura por Plan","Cobertura Propia"];
		$('#dpDownCobertura').jqxDropDownList({ source: sourceCobertura, promptText:'Seleccione Tipo de Cobertura', width:250, height:27, dropDownHeight:50, theme:'metro'	});	
		
		var sourcePlan =  { datatype: "json", datafields: [ { name: 'ID' },{ name: 'Descripcion' } ], url: 'getPlanes.php', async: false};
		var dataAdapterPlan = new $.jqx.dataAdapter(sourcePlan);	
		$("#dpDownPlan").jqxDropDownList({ source: dataAdapterPlan,promptText:'Seleccione Plan' ,valueMember:'ID',displayMember:'Descripcion',disabled:true,
													  width: 250,height: 27, dropDownHeight:100, theme:'metro'});						  
	}
	
	function initCheckbox() {
		
		$("#chkCategorizacionPropia").jqxCheckBox({ boxSize:'27px', theme: 'metro' });	
		
	}
	
	function initButtons() {
	
		$('#btnAceptarContacto').jqxButton({width:120, height:30, theme:'metro'});
		$('#btnCancelarContacto').jqxButton({width:120, height:30, theme:'metro'});
		$('#btnAcepElimCli').jqxButton({width:120, height:30, theme:'metro'});
		$('#btnCancelElimCli').jqxButton({width:120, height:30, theme:'metro'});
		$('#btnOKEliminoCliente').jqxButton({width:120, height:30, theme:'metro'});
		$('#btnNOEliminoCliente').jqxButton({width:120, height:30, theme:'metro'});
		$('#btnOKEliminoContacto').jqxButton({width:120, height:30, theme:'metro'});
		$('#btnNOEliminoContacto').jqxButton({width:120, height:30, theme:'metro'});
		$('#btnGrabarIntegrante').jqxButton({width:120, height:30, theme:'metro'});
		$('#btnGrabarModifCobertura').jqxButton({width:120, height:30, theme:'metro'});
		

	}
	
	function initDateTime() {
		
		$("#dtFecNacInt").jqxDateTimeInput({ width: 130, height: 27, theme: 'metro', textAlign: 'left'});
		$("#dtFecIngInt").jqxDateTimeInput({ width: 130, height: 27, theme: 'metro', textAlign: 'left'});	
		
	}
	
	function abrirPopupContacto() {
		
		$('#dialogoNuevoContacto').modal('show');
		$('#txtNomSectorContacto').focus();	
		
	}
	
	function agregarContacto() {
		
		var nombreSector = $('#txtNomSectorContacto').val();
		var email = $('#txtEmailContacto').val();
		var tel = $('#txtTelContacto').val();	
		var id = $('#hidIdCliente').val();	
		var bValido = validarContacto();
		
		if (bValido) {
			
			procesarContacto(nombreSector,email,tel,id);
			
		} else {
			
			setMessage('error',2000,'Fall&oacute; la validaci&oacute;n','');	
			
		}
		
	}
	
	function blanqueoFormContacto() {
		
		$('#ctPanelAgregoContacto input[type="text"]').each(function(index, element) {
            
			$(this).val('');
			
        });	
		
		
	}
	
	function procesarContacto(nom,email,tel,id) {
		
		if (flgInsModifContacto == 0) {
			
			$.ajax({
				type: "GET",
				url: "getSetContactosCliente.php?opt=1&nom="+nom+"&email="+email+"&tel="+tel+"&id="+id,
				success: function(datos){
					
					setGrdContactosCliente(id);
					$('#dialogoNuevoContacto').modal('hide');
					var mensaje = 'El contacto se agreg&oacute; correctamente';
					setMessage('success',1000,mensaje,'');
					
				}
			});
			
		} else {
			
			var idCt = $('#idContactoCliente').val();
			
			$.ajax({
				type: "GET",
				url: "getSetContactosCliente.php?opt=3&nom="+nom+"&email="+email+"&tel="+tel+"&idCt="+idCt,
				success: function(datos){
					
					setGrdContactosCliente(id);
					$('#dialogoNuevoContacto').modal('hide');
					var mensaje = 'El contacto se modifi&oacute; correctamente';
					setMessage('success',1000,mensaje,'');					
					
				}
			});
			
		}
		
		
	}
	
	function validarContacto() {
		
		var bVal = true;
		$('#ctPanel').each(function(index, element) {
            
			if ($(this).val == '') bVal = false;
			
        });
		
		return bVal;
		
	}
	

	
	function setDatosCliente(id) {
		
		
		$.ajax({
			type: 'GET',
			dataType: 'json',
			url:  'getSetClientes.php?opt=1&cli='+id,
			success: function(datos){
					
					$('#hidIdCliente').val(id);
					$('#txtCodTit').val(datos[0].Codigo);
					$('#txtRzSocTit').val(datos[0].RazonSocial);
					$('#txtAbrLocTit').val(datos[0].Localidad);
					$('#txtLocalidadTit').val(datos[0].DescLoc);
					$('#txtCalleTit').val(datos[0].Calle);
					$('#txtAltTit').val(datos[0].Altura);
					$('#txtPisoTit').val(datos[0].Piso);
					$('#txtDeptoTit').val(datos[0].Depto);
					$('#txtCodigoPostalTit').val(datos[0].CodigoPostal);
					$('#txtEntreCalle1Tit').val(datos[0].EntreCalle1);
					$('#txtEntreCalle2').val(datos[0].EntreCalle2);
					$('#txtRefTit').val(datos[0].Referencia);			
					var itemRubro = $("#dpDownRubroTit").jqxDropDownList('getItemByValue', datos[0].RubroId);	
					$('#dpDownRubroTit').jqxDropDownList('selectItem',itemRubro);
					
					setGrdContactosCliente(id);						
			}		
		});	
	}
	
	function eliminarCliente() {
			
		var rowindex = $('#grdMaestroClientes').jqxGrid('getselectedrowindex');	
		var rowData = $('#grdMaestroClientes').jqxGrid('getrowdata',rowindex);
		var id = rowData.ID;
				
		 $.ajax({
				type: "GET",
				url: "getSetClientes.php?opt=3&id="+id,
				success: function(datos){
					
					setGrdMaestroClientes();
					$('#dialogoEliminarCliente').modal('hide');

				}
		 });
		
	}
	
	function abroDecisionEliminarCliente() {
		
		$('#dialogoEliminarCliente').modal('show');
		
	}
	
	function abroDecisionEliminarContacto() {
		
		$('#dialogoEliminarContacto').modal('show');	
	
	}
	
	function bindDecisionEliminar() {
	
		$('#dialogoEliminarCliente').on('shown',function(ev){
		
			$('#btnElimCliente').focus();
			
		});
		
		$('#dialogoEliminarCliente').on('hide',function(ev){
		
			$('#grdMaestroClientes').jqxGrid('focus');
		
		});
		
		$('#dialogoEliminarContacto').on('shown',function(ev){
		
			$('#btnElimContacto').focus();
		
		});
		
		$('#dialogoEliminarIntegrante').on('shown',function(ev){
		
			$('#btnElimIntegrante').focus();
		
		});
			
		$('#grdMaestroClientes').keydown(function(e){
			
			if (e.which == 46) {
			
				//abroDecisionEliminarCliente();	
			}
			
		});
		
		$('#grdContactosCliente').keydown(function(e){
			
			if (e.which == 46) {
				
				abroDecisionEliminarContacto();	
			}
			
		});
		
		$('#btnElimContacto').click(function(e) {
            
			eliminarContacto();
			
		});
		
		$('#btnElimIntegrante').keydown(function(e){
		
			if (e.which == 13) {
			
				elimIntegrante();
			
			}
		
		});
		
		$('#btnElimIntegrante').click(function(e){
		
			elimIntegrante();
		
		});
		
		$('#btnElimCliente').keydown(function(e) {
		
			if(e.which == 13) { 
			
				//e.die();
				eliminarCliente();
				
			}
		});
		
		$('#btnElimCliente').on('click',function(e){
		
			eliminarCliente();
		
		});
		
		$('#btnElimContacto').keydown(function(e) {
			if (e.which == 13) {	
				eliminarContacto();
				//e.die();
			}			
		});
		
	}
	
	function bindMenuContactosCliente() {
		
		$('#rowAgregarContacto').bind('click',function(event){
			
			clearPopupAgregoContacto();
			abrirPopupContacto();
			flgInsModifContacto = 0;
				
		});
		
		$('#rowEliminarContacto').bind('click',function(event){
			
			abroDecisionEliminarContacto();
			
		});
		
		$('#rowEditarContacto').bind('click',function(event){
			
			editarContacto();
			abrirPopupContacto();
			flgInsModifContacto = 1;
			
		});
		
		$('#rowActualizarContacto').bind('click',function(event){
			
			actualizarContactos();
			
		});
		
		$('#grdContactosCliente').on('rowdoubleclick',function(ev){

			editarContacto();
			abrirPopupContacto();
			flgInsModifContacto = 1;
		});
		
		$('#grdContactosCliente').on('keydown',function(ev){
			if (ev.which == 13) {
			editarContacto();
			abrirPopupContacto();
			flgInsModifContacto = 1;
			}
		});
			
	}
	
	function disableMenuContactosCliente() {
		
		$('#rowAgregarContacto').unbind('click');
		$('#rowEliminarContacto').unbind('click');
		$('#rowEditarContacto').unbind('click');
		$('#rowActualizarContacto').unbind('click');
		
		$("#menuContactosCliente").jqxMenu('disable', 'rowAgregarContacto', true);
		$("#menuContactosCliente").jqxMenu('disable', 'rowEliminarContacto', true);
		$("#menuContactosCliente").jqxMenu('disable', 'rowEditarContacto', true);
		$("#menuContactosCliente").jqxMenu('disable', 'rowActualizarContacto', true);
		
	};
	
	function enableMenuContactosCliente() {
		
		bindMenuContactosCliente();
		$("#menuContactosCliente").jqxMenu('disable', 'rowAgregarContacto', false);
		$("#menuContactosCliente").jqxMenu('disable', 'rowEliminarContacto', false);
		$("#menuContactosCliente").jqxMenu('disable', 'rowEditarContacto', false);
		$("#menuContactosCliente").jqxMenu('disable', 'rowActualizarContacto', false);	
		
	};
	
	function agregarCliente() {
		
		$('#hidIdCliente').val(0);
		$('.ctCliente').slideToggle('slow');
		blanqueoFormularioCliente();
		disableMenuContactosCliente();
		$('#btnVerGrilla,#btnGuardarCliente').css("display","inline-block");
		$('#tabsOpcionesClientes').jqxTabs('select',0);
		$('#tabsOpcionesClientes').jqxTabs('disableAt', 1);
		$('#tabsOpcionesClientes').jqxTabs('disableAt', 2);
		$('#txtCodTit').focus();		
	}
	
	function blanqueoFormularioCliente() {
	
		$('#ctPanelDatosTitular input').each(function(index, element) {
            
			$(this).val('');
			
        });	
		
		$('#dpDownRubroTit').jqxDropDownList('clearSelection');
		$('#chkCategorizacionPropia').jqxCheckBox('uncheck');
		$('#grdContactosCliente').jqxGrid({	source:[] });
		
	}
	
	function toggleDivs() {
		
			$('.ctCliente').slideToggle('slow');
			$('#btnVerGrilla,#btnGuardarCliente').css("display","none");
				
		
	}
	
	function verGrilla() {
		
		toggleDivs();
		$('#grdMaestroClientes').jqxGrid('focus');	
	}
	
	function clearPopupAgregoContacto() {
		
		$('#panelAgregoContactoCliente input[type="text"]').each(function(index, element) {
			
			$(this).val('');
			
		 });	
		
	}
	
	function cerrarPopupContacto() {
		
		$('#popupContactoCliente').jqxWindow('close');	
		
	}
	
	function bindGrillaClientes() {
		
		$('#grdMaestroClientes').on('rowdoubleclick', function(event) {
			
			//readonly
			//editShowCliente();
			
		});	
		
		
		$('#grdMaestroClientes').on('keydown',function(event) {
			
			if (event.which == 13) {
				//readonly	
				//editShowCliente();
			
			}
			
		});
		
	}

// 
	
	function editShowCliente() {
		
		$('#tabsOpcionesClientes').jqxTabs('enableAt', 1);
		$('#tabsOpcionesClientes').jqxTabs('enableAt', 2);
		enableMenuContactosCliente();
		$('#btnVerGrilla,#btnGuardarCliente').css("display","inline-block");
		var rowindex = $('#grdMaestroClientes').jqxGrid('getselectedrowindex');	
		var rowData = $('#grdMaestroClientes').jqxGrid('getrowdata',rowindex);
		$('#ctGrillaClientes').slideToggle('slow',function(){
			$('#tabsOpcionesClientes').jqxTabs('select',0);
			setDatosCliente(rowData.ID);
			setGrdIntegrantes(rowData.ID);
			setDatosCobertura(rowData.ID,rowData.PlanId,rowData.Observ);
			$('#txtCodTit').focus();
					
		});
	
		$('#ctOpcionesClientes').slideToggle('slow');
				
	}
	
	function setDatosCobertura(id,plan,observ) {
		
		$('#txtAObsCobertura').val(observ);
		
		 if (plan == 0) {
				
			setClienteCobPropia(id);
					
		} else {
				
			setClienteCobPlan(id,plan);
		}
		
		
	}
	
	function setClienteCobPlan(id,plan) {
		
		$("#dpDownCobertura").jqxDropDownList('selectIndex',0);
		
		var itemPlan = $("#dpDownPlan").jqxDropDownList('getItemByValue',plan); 
		
		$("#dpDownPlan").jqxDropDownList('selectItem', itemPlan );	
			
	}
	
	function setClienteCobPropia(id) {
		
		$('#dpDownCobertura').jqxDropDownList('clearSelection');
		$("#dpDownCobertura").jqxDropDownList('selectIndex',1);	
		
	}

	function procesarNuevoCliente() {
		
		var bValido = validoNuevoCliente();
		
		if (bValido) {
			
		var vecNuevoCliente = [];
		$('#ctPanelDatosTitular input').not('#hidIdCliente').each(function(index, element) {
            
			var valor = $(this).val();

			vecNuevoCliente.push(valor);
		
        });
		
			if ($('#hidIdCliente').val() == 0) {
				
				insertNuevoCliente(vecNuevoCliente,0)
					
			} else {
				
				vecNuevoCliente.push($('#hidIdCliente').val());
				insertNuevoCliente(vecNuevoCliente,1);
				setCoberturaCliente();
				
			}
		}
	}
	
	function setCoberturaCliente() {
		
			var idxCob = $("#dpDownCobertura").jqxDropDownList('getSelectedIndex');
						
			if (idxCob != -1) {
			
				if (idxCob == 0) {
				
					setCoberturaPlan();
						
				} else {
					
					setCoberturaPropia();
					
				}
			}
		
		
		}
	
	function setCoberturaPlan() {
		
		var cli = $('#hidIdCliente').val();
		var obs = $('#txtAObsCobertura').val();
		
		var idxPlan = $("#dpDownPlan").jqxDropDownList('getSelectedIndex');			
		
		if (idxPlan != -1) {
			
			var itemPlan = $("#dpDownPlan").jqxDropDownList('getSelectedItem');
			var plan = itemPlan.value;
				
			$.ajax({
				type : 'GET',
				url : 'getSetClientes.php?opt=4&id='+cli+'&plan='+plan+'&obs='+obs		
			});
		
		} 
		
	}
	
	function setCoberturaPropia() {
		
		var obs = $('#txtAObsCobertura').val();
		var cli = $('#hidIdCliente').val();
		
		$.ajax({
				type : 'GET',
				url : 'getSetClientes.php?opt=4&id='+cli+'&plan=0&obs='+obs		
			});	
			
		guardarCliCobertura(0);
		
	}
	
	function insertNuevoCliente(vecNuevoCliente,optInsModif) {
	
				 $.ajax({
					type: "POST",
					url: "getSetClientes.php?opt=2&optInsModif="+optInsModif,
					data: { pArray : vecNuevoCliente },
					success: function(datos){
						
						var mensaje = "";
						if (datos == 0) {
								mensaje = "El cliente fue ingresado correctamente.";
						} else {
							
								mensaje = "El cliente fue modificado correctamente.";	
						}
						
							verGrilla();
							setGrdMaestroClientes();
							setMessage('success',1000,mensaje,'');
		
						}
					});	
				}
	
	function validoNuevoCliente() {
		
		var msgError = "";
		var bValido = true;
		
		if ($('#txtCodTit').val() == "") msgError = msgError +  "- Debe determinar el código de cliente. <br />";
		if ($('#txtRzSocTit').val() == "") msgError = msgError +  "- Debe determinar la razón social del cliente. <br />";
		if ($('#txtCalleTit').val() == "") msgError = msgError + "- Debe determinar el domicilio del cliente. <br />";
		if ($('#txtAbrLocTit').val() == "") msgError = msgError + "- Debe determinar la localidad del cliente. <br />";	
		
		if (msgError != "") {
		
			setMessage('error',2000,mensaje,'txtCodTit');
			bValido = false;	
			
		}
		
		return bValido;		
	}
	
	function actualizarGrdClientes() {
		
		setGrdMaestroClientes();	
		
	}
	
	function eliminarContacto() {
		
		var rowindex = $('#grdContactosCliente').jqxGrid('getselectedrowindex');	
		var rowData = $('#grdContactosCliente').jqxGrid('getrowdata',rowindex);
		var id = rowData.ID;
		var idCli = $('#hidIdCliente').val();
		
			$.ajax({
				type: "GET",
				url: "getSetContactosCliente.php?opt=2&ctId="+id,
				success: function(datos){
						
						setGrdContactosCliente(idCli);
						$('#dialogoEliminarContacto').modal('hide');
				}
			});	
		}
		
	function editarContacto() {
		
		var rowindex = $('#grdContactosCliente').jqxGrid('getselectedrowindex');	
		var rowData = $('#grdContactosCliente').jqxGrid('getrowdata',rowindex);	
		
		var idCt = rowData.ID;
		var nom = rowData.Nombre;
		var email = rowData.Email;
		var tel = rowData.Telefono;
		$('#idContactoCliente').val(idCt);
		$('#txtNomSectorContacto').val(nom);
		$('#txtEmailContacto').val(email);
		$('#txtTelContacto').val(tel);
	
	}
	
	function actualizarContactos(){
		
		var idCli = $('#hidIdCliente').val();
		setGrdContactosCliente(idCli);	
		
	}
	
	function agregarIntegrante() {
		
		blanqueoFormIntegrante();
		$('#hidIdIntegrante').val(0);
		$('.ctIntegrante').toggle('slow',function(event){
			
			
			$('#txtNroAfInt').focus();
			
		});
	
	}
	
	function blanqueoFormIntegrante() {
		
		$('#ctPanelIntegrante input[type="text"],#ctPanelIntegrante textarea').each(function(index, element) {
            
			$(this).val('');
			
        });	
		
		$('#dtFecNacInt').jqxDateTimeInput('setDate',null);
		$('#dtFecIngInt').jqxDateTimeInput('setDate',null);
		$('#dpDownTipoInt').jqxDropDownList('clearSelection');
		$('#dpDownTipoDocInt').jqxDropDownList('clearSelection');
		$('#dpDownSexoInt').jqxDropDownList('clearSelection');
		
	}
	
	function verGrillaIntegrantes() {
		
		$('.ctIntegrante').toggle('slow');	
		
	}
	
	function bindGrillaIntegrantes() {
		
		$('#grdIntegrantes').on('rowdoubleclick',function(event) {
			
			editShowIntegrante();
			
		});
		
		$('#grdIntegrantes').on('keydown',function(event) {
			
			if (event.which == 13 ) {
				
				editShowIntegrante();	
				
			}
			
			if (event.which == 46) {
				
				abroDecisionEliminarIntegrante();	
			}
			
		});
			
		
	}
	
	function actualizarGrillaIntegrantes(){
		
		setGrdIntegrantes($('#hidIdCliente').val());
		
	}
	
	function getRowData(grilla) {
		
		var rowindex = $('#'+grilla).jqxGrid('getselectedrowindex');	
		var rowData = $('#'+grilla).jqxGrid('getrowdata',rowindex);	
		return rowData;
		
	}
	

	
	function abroDecisionEliminarIntegrante() {
		 
		$('#dialogoEliminarIntegrante').modal('show');
		
			
	}
	
	function elimIntegrante() {
	
		var rowData = getRowData('grdIntegrantes');
		var id = rowData.ID;
		procesoEliminarIntegrante(id);
	
	}
	
	function procesoEliminarIntegrante(id) {
		
		$.ajax({
			
			type: 'GET',
			url: 'getSetClientesIntegrantes.php?opt=3&id='+id,
			success: function(datos) {	
			
				actualizarGrillaIntegrantes();
				$('#dialogoEliminarIntegrante').modal('hide');	
				
			}
		});
		
	}
	
	function editShowIntegrante() {
		
		var rowData = getRowData('grdIntegrantes');
		var id = rowData.ID;
		
		
		$('#ctGrillaIntegrantes').toggle('slow',function(){
			
			setInfoIntegrante(id);
			$('#txtNroAfInt').focus();		
		
		});
		
		$('#ctOpcionesIntegrantes').toggle('slow');
	
	}
	
	function setInfoIntegrante(id) {
		
		$.ajax({
			
			type: 'GET',
			dataType: 'json',
			url: 'getSetClientesIntegrantes.php?opt=1&id='+id,
			success: function(datos) {
					$('#hidIdIntegrante').val(id);
					$('#txtNroAfInt').val(datos[0].NroAf);
					$('#txtApeInt').val(datos[0].Ape);
					$('#txtNomInt').val(datos[0].Nom);
					$('#txtAbrLocInt').val(datos[0].AbrLoc);
					$('#txtLocInt').val(datos[0].Localidad);
					$('#txtCalleInt').val(datos[0].Calle);
					$('#txtAltInt').val(datos[0].Altura);
					$('#txtPisoInt').val(datos[0].Piso);
					$('#txtDeptoInt').val(datos[0].Depto);
					$('#txtCodPostInt').val(datos[0].CodigoPostal);
					$('#txtECalle1Int').val(datos[0].EntreCalle1);
					$('#txtECalle2Int').val(datos[0].EntreCalle2);
					$('#txtRefInt').val(datos[0].Ref);
					$('#txtNroDocInt').val(datos[0].NroDoc);
					$('#txtTelefono1Int').val(datos[0].Telefono1);
					$('#txtTelefono2Int').val(datos[0].Telefono2);
									
					var itemTipoInt = $("#dpDownTipoInt").jqxDropDownList('getItemByValue', datos[0].TipInt);	
					$('#dpDownTipoInt').jqxDropDownList('selectItem',itemTipoInt);
					
					var itemSexoInt = $("#dpDownSexoInt").jqxDropDownList('getItemByValue', datos[0].Sexo);	
					$('#dpDownSexoInt').jqxDropDownList('selectItem',itemSexoInt);
					
					var itemTipoDoc = $("#dpDownTipoDocInt").jqxDropDownList('getItemByValue', datos[0].TipoDoc);	
					$('#dpDownTipoDocInt').jqxDropDownList('selectItem',itemTipoDoc);
					
					var fecIngreso = datos[0].FecIngreso.toString();
					var fecNac = datos[0].FecNac.toString();
					
					fecIngreso = fecIngreso.substring(0,10);
					fecNac = fecNac.substring(0,10);
					
					fecIngreso = strDateToJavascriptDate(fecIngreso);
					fecNac = strDateToJavascriptDate(fecNac);
				
					$('#dtFecNacInt').jqxDateTimeInput('setDate',fecNac);
					$('#dtFecIngInt').jqxDateTimeInput('setDate',fecIngreso);
	
			}	
		});
		
	}
	
			
	function strDateToJavascriptDate(fecha) {
		
		var anio  = parseInt(fecha.substring(0,4));
		var mes   = parseInt(fecha.substring(5,7));
		var dia   = parseInt(fecha.substring(8,10));
		var fechaJs = new Date(anio, mes-1, dia);
		return fechaJs;
		
	}
	
	function grabarIntegrante() {
		
		var bValido = validoNuevoIntegrante();
		
		if (bValido) {
			
			var vecNuevoIntegrante = [];
			$('#ctPanelIntegrante input,#ctPanelIntegrante textarea').not('#hidIdIntegrante,#ctPanelIntegrante input[type="button"]').each(function(index, element) {
						
				var valor = $(this).val();
	
				vecNuevoIntegrante.push(valor);
			
			});
			
			vecNuevoIntegrante.push($('#hidIdCliente').val());
			
			if ($('#hidIdIntegrante').val() == 0) {
					
				insertNuevoIntegrante(vecNuevoIntegrante,0);
					
			} else {
				
				vecNuevoIntegrante.push($('#hidIdIntegrante').val());
				insertNuevoIntegrante(vecNuevoIntegrante,1);
					
			}
	
		}			
		
	}
	
	function insertNuevoIntegrante(vecNuevoIntegrante,optInsModif) {
		
			 $.ajax({
				type: "POST",
				url: "getSetClientesIntegrantes.php?opt=2&optInsModif="+optInsModif,
				data: { pArray : vecNuevoIntegrante },
				success: function(datos){		
					var mensaje = "";
					if (datos == 0) {
						mensaje = "El integrante fue ingresado correctamente.";
					} else {	
						mensaje = "El integrante fue modificado correctamente.";	
					}
					
					verGrillaIntegrantes();
					actualizarGrillaIntegrantes();
							
					setMessage('success',1000,mensaje,'');
		
				}
			});	
		}	
		
	function setMessage(typeMsg,timeDelay,msg,txtToFocus) {
	
		$('#notif').notify({
			closable : false,
			fadeOut: { enabled: true, delay: timeDelay },
			message: { html : true, text: msg },
			type : 'alert alert-'+typeMsg,		
		}).show();
		
		if (txtToFocus != '') $('#notif').notify({ onClosed: $('#'+txtToFocus).focus()}) ;
	
	}
	function validoNuevoIntegrante() {
		
		var msgError = "";
		var bValido = true;
		
		if ($('#txtNroAfInt').val() == "") msgError = msgError +  "- Debe determinar el Nro. de Afiliado del integrante. <br />";
		if ($('#txtApeInt').val() == "") msgError = msgError +  "- Debe determinar el apellido del integrante. <br />";
		if ($('#txtNomInt').val() == "") msgError = msgError + "- Debe determinar el nombre del integrante. <br />";

		if (msgError != "") {
			
			setMessage('error',2000,mensaje,'txtNroAfInt');
			bValido = false;	
			
		}
		
		return bValido;			
		
	}
	
	function bindComportamientoForm() {
		
		$('#dpDownTipoInt').on('close',function(event){
			
			$('#txtApeInt').focus();
			
		});
		
		$('#dpDownTipoDocInt').on('close',function(event){
			
			$('#txtNroDocInt').focus();
			
		});
		
		$('#dpDownSexoInt').on('close',function(event){
			
			$('#dtFecNacInt').jqxDateTimeInput('open');
			
		});
		
	//	$('#dtFecIngInt').on('close',function(event){
//			
//			$('#txtAObsInt').focus();
//		});
		
		//$('#dtFecNacInt').on('close',function(ev){
//
//			//$('#ctPanelIntegrante').focus();
//		$('#txtTelefono1Int').focus();
//		});

		//$('#dtFecNacInt').on('close',function(event){
//	
//			
//			$('#txtTelefono1Int').focus();
//	
//	
//	
//		});
		
		$('input[type="text"],textarea').keydown(function(ev){
		
		id = $(this).attr("id");
		
		if(ev.which == 13) {
			
			switch (id) {
				
				case 'txtRzSocTit':
					$('#dpDownRubroTit').jqxDropDownList('focus');
				break;
				
				case 'txtAbrLocTit':			
					var abrLocTit = $('#txtAbrLocTit').val();
					$('#hidAbrLoc').val(0);
					validoLocalidad(abrLocTit);	
				break;
				
				case 'txtAbrLocInt':
					var abrLocInt = $('#txtAbrLocInt').val();
					$('#hidAbrLoc').val(1);
					validoLocalidad(abrLocInt);
				break;
					
				case 'txtRefTit':
					ev.preventDefault();
					$('#btnAceptarCliente').focus();
				break;
				
				case 'txtTelContacto':
					ev.preventDefault();
					$('#btnAceptarContacto').focus();
				break;
				
				case 'txtNroAfInt':
					$('#dpDownTipoInt').jqxDropDownList('focus');
				break;
				
				case 'txtRefInt':
					$('#dpDownTipoDocInt').jqxDropDownList('focus');
				break;
				
				case 'txtNroDocInt':
					$('#dpDownSexoInt').jqxDropDownList('focus');
				break;
				
				case 'txtTelefono2Int':
					$('#dtFecIngInt').jqxDateTimeInput('open');
				break;
				
				case 'txtAObsInt':
					ev.preventDefault();
					$('#btnGrabarIntegrante').focus();
				break;
						
				default:
					$(this).focusNextInputField();
				break;
			}
		}		
	});				
  }
  
	function bindEventosDialogos() {

		$('#dialogoNuevoContacto').on('shown',function(e){
		
			$('#txtNomSectorContacto').focus();
		
		});
		
	

	}
  
  function bindControlsCobertura() {
  
	  $('#dpDownCobertura').on('select',function(ev){
		  
		 	var itemCobertura = $("#dpDownCobertura").jqxDropDownList('getSelectedItem');	
			if (itemCobertura.value == 'Cobertura por Plan') {
			
					$('#dpDownPlan').jqxDropDownList({ disabled: false });
					$('#btnGrabarModifCobertura').jqxButton({disabled: true});
					$('#grdPlanes').jqxGrid({ source: [] });
				
			} else {
				
					$('#dpDownPlan').jqxDropDownList('clearSelection');
					$('#dpDownPlan').jqxDropDownList({ disabled: true });
					$('#btnGrabarModifCobertura').jqxButton({disabled: false});
					makeGridCobertura();
			}
		  
	  });
	  
	  $('#btnGrabarModifCobertura').jqxButton({disabled: true});
	  
	  $('#dpDownPlan').on('select',function(ev){
		 
		 	var itemPlan = $("#dpDownPlan").jqxDropDownList('getSelectedItem'); 
			makeGridPlan(itemPlan.value);

	  });
	    
  }
  
  function makeGridPlan(idPlan) {

		sourcePlanes ={
        	datatype: "json",
        	datafields: [{ name: 'ID' },{ name: 'Grado'}, {name: 'Cub'}, {name: 'CoPago', type: 'number'},{name: 'ColorGrado'},{name: 'gOpId'}],
		 	url: 'getPlanesGradosOperativos.php?id='+idPlan
   		 };
		 
		 setGrdPlanes(true,sourcePlanes);
	
  }
  
  function makeGridCobertura() {
	 
	 
	var rowData = getRowData('grdMaestroClientes'); 
	var idCli = rowData.ID;

	sourcePlanes ={
        	datatype: "json",
        	datafields: [{ name: 'ID' },{ name: 'Grado'}, {name: 'Cub'}, {name: 'CoPago', type: 'number'},{name: 'ColorGrado'}, {name: 'gOpId'}],
		 	url: 'getSetClientesGradosOperativos.php?opt=0&cli='+idCli
   	};
		 
	setGrdPlanes(false,sourcePlanes); 
	  
  }
  
	function guardarCliCobertura(pMsg) {
	  
		var idCli = $('#hidIdCliente').val();
	  
		var rows = $('#grdPlanes').jqxGrid('getrows');
	  
		$.ajax({
			type: "GET",
			url: "getSetClientesGradosOperativos.php?opt=1&cli="+idCli,
			data: { pArray : rows },
			success: function(datos){
				if (pMsg == 1) {
					var mensaje = 'Modificaci&oacute;n correcta';
					setMessage('success',1000,mensaje,'');

				}			
			}
		});	   
	}
	
	
	