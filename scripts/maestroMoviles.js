
	function bindEventos() {
	
			$('#txtDomMov').keydown(function(e) {
		
				if (e.which == 13) {
				
				buscoVehiculo();
				$('#dpDownTipoMov').jqxDropDownList('focus');	
				
			}
			
		});

		$('#dpDownTipoMov').on('close',function(ev){
			
			var itm = $('#dpDownTipoMov').jqxDropDownList('getSelectedItem');
			var idx = itm.index;
			if (idx != -1) {
					
				var tipMovId = itm.value;	
				buscoGdosCobertura(tipMovId);
				$('#dpDownBaseOp').jqxDropDownList('focus');
				
			}
			
		});

		$('#txtMov').keydown(function(e) {
			
			if (e.which == 13) {
				
				$('#txtDomMov').focus();
				
			}
		});

		$('#dpDownMoviles').on('close',function(e){
			
			actualizarGrd();
			
		});

		$('#grdMaestroMoviles').keydown(function(e) {
			
			if (e.which == 13) {
				
				editMovil();	
			}
			
			if (e.which == 45) {
				
				agregarMovil()();	
			}
			
			if (e.which == 46) {
					
				setPopupEliminar();
			}
				
		});
		
		$('#grdMaestroMoviles').on('rowdoubleclick',function(e){
		
			editMovil();
		});

		$('#chkActivo').on('checked',function(e){
			
			actualizarGrd();
			
		});

		$('#chkActivo').on('unchecked',function(e){
			
			actualizarGrd();
			
		});

	}
	
	function initComponentes() {
	
		$("#lstCob").jqxListBox({source: [],displayMember: "Localidad", valueMember: "ID", allowDrop: true, allowDrag: true, width: 300, height: 260, theme: 'metro' });
		$("#lstCobSel").jqxListBox({source: [],displayMember: "Localidad", valueMember: "ID" ,allowDrop: true, allowDrag: true, width: 300, height: 260, theme: 'metro' });
		$('#panelMovil').jqxPanel({width:660,height:304,theme:'metro'});
		$('#btnAceptarMov').jqxButton({width:120, height:30, theme:'metro'});
		$('#btnCancelarMov').jqxButton({width:120, height:30, theme:'metro'});
		$('#chkActivo').jqxCheckBox({ width:25, height:40, theme: 'metro', boxSize: '25' });
		$("#menuGrillaMaestroMoviles").jqxMenu({ width: '940px', height: '40px', mode: 'horizontal', theme: 'metro' });
		var sourceMov = [ {label: "&nbsp;", value: -1}, {label: "M&oacute;viles", value: 0},{label: "Prestadores", value: 1},{label: "Profesionales", value: 2} ];	
		$("#dpDownMoviles").jqxDropDownList({ source: sourceMov ,valueMember:'value',displayMember:'label',
															  width: 220,height: 23, dropDownHeight:100,selectedIndex:0, theme:'metro'});

		var srcTipoMoviles = { datatype: "json", datafields: [ { name: 'ID' },{ name: 'Descripcion' } ], url: 'getSetTipoMoviles.php?opt=0&id=0'};
		var dATipoMov = new $.jqx.dataAdapter(srcTipoMoviles);	
		$("#dpDownTipoMov").jqxDropDownList({source: dATipoMov,displayMember: "Descripcion", valueMember: "ID", promptText:'Seleccione...', width: 280, height: 27, theme: 'metro' });

		var srcBasesOp = { datatype: "json", datafields: [ { name:'ID'},{name: 'Descripcion'} ], url: 'getSetBasesOperativas.php?opt=0'};
		var dABasesOp = new $.jqx.dataAdapter(srcBasesOp);
		$('#dpDownBaseOp').jqxDropDownList({ source: dABasesOp, displayMember: "Descripcion", valueMember: "ID", promptText:'Seleccione...',width:280,height:27,theme:'metro' });
	
	}
	
	function initTab() {
	
		$('#tabsMoviles').jqxTabs({ width: 665, height: 343, position: 'top', theme: 'metro' });
	
	}
	
	function setLista(idMov,bSel,lista) {
		
		var srcCob = { datatype: "json", datafields: [ { name: 'ID' },{ name: 'Localidad' } ], url: 'getSetMoviles.php?opt=4&idMov='+idMov+"&sel="+bSel};
		var dACob = new $.jqx.dataAdapter(srcCob);	
		$("#"+lista).jqxListBox({source: dACob});	
		
	}

	function setGrdMaestroMoviles(act,ftr) {
	
		sourceMoviles ={
			datatype: "json",
			datafields: [{ name: 'ID' },{ name: 'Movil'}, {name: 'descTipMov'}, {name: 'Dominio'},{name: 'MM'},{name: 'sitMov'}],
			url: 'getSetMoviles.php?opt=0&act='+act+"&filtro="+ftr
		};	
			
		columnasMoviles = [
			{ text: 'ID', datafield: 'ID', hidden: true },
			{ text: 'M&oacute;vil', datafield: 'Movil', width: '15%', align: 'center'},
			{ text: 'Tipo de M&oacute;vil', width:'35%', datafield: 'descTipMov', align: 'center'},
			{ text: 'Dom', datafield: 'Dominio', width: '15%', align: 'center' },
			{ text: 'Marca y Modelo', datafield: 'MM', width: '35%', align: 'center' },
			{ text: 'Situacion', datafield: 'sitMov', hidden: true}
		];
			
		$('#grdMaestroMoviles').jqxGrid({ source: sourceMoviles, columns: columnasMoviles});
		$('#grdMaestroMoviles').jqxGrid('selectrow',0);
		$('#grdMaestroMoviles').jqxGrid('focus');
	
	}
	
	function verGrilla() {
		
		$('.ctMaestroMoviles').toggle('slow');
		$('#btnVerGrilla,#btnGuardarMovil').css("display","none");
		
	}
	
	function buscoGdosCobertura(id) {
		
		$.ajax({
			type: 'GET',
			url: 'getSetMoviles.php?opt=7&idTipMov='+id,
			success: function(datos) {
				
				$('#txtGradosCob').val(datos);	
			}
			
		});
		
	}
	
	function buscoVehiculo() {
		
		var dom = $('#txtDomMov').val();
		
		$.ajax({	
			type: 'GET',
			dataType: 'json',
			url: 'getSetMoviles.php?opt=6&dom='+dom,
			success : function(datos){
				
				var marca = datos[0];
				var modelo = datos[1];
				var prop = datos[2];
				var idVeh = datos[3];
				
				$('#txtMarcaMov').val(marca);
				$('#txtModeloMov').val(modelo);
				$('#txtPropMov').val(prop);	
				$('#hidIdVeh').val(idVeh);
			}	
		});	
	}

	function initGrdMaestroMoviles() {

		$("#grdMaestroMoviles").jqxGrid({
			width:940,
			height:385,
			columnsresize: true,
			autoshowfiltericon: true,
			source: [],
			theme: 'metro',
			columns: [],
			altrows:true,
			pagesize:12,
			pagesizeoptions: ['10','12','17'],
			pageable: true,
			filterable: true,
			sortable: true,
			showfilterrow: true
	    });				
	}
	
	
	function initGrdHistorialMovil() {

		$("#grdHistorialMovil").jqxGrid({
			width:645,
			height:120,
			columnsresize: true,
			source: [],
			theme: 'metro',
			columns: [],
			altrows:true,
			pagesize:10,
			pagesizeoptions: ['10','12','17'],
			filterable: true,
	    });				
	}
	
	function setGrdHistorialMovil(id) {
			
		sourceHistorialMovil ={
			datatype: "json",
			datafields: [{ name: 'ID' },{ name: 'Desde'}, {name: 'Hasta'}, {name: 'Movil'},{name: 'TipoMovil'},{name: 'Dominio'}],
			url: 'getSetMoviles.php?opt=2&id='+id
		};	
			
		columnasHistorialMovil = [
			{ text: 'ID', datafield: 'ID', hidden: true },
			{ text: 'Desde', datafield: 'Desde', width: '13%', align: 'center'},
			{ text: 'Hasta', width:'13%', datafield: 'Hasta', align: 'center'},
			{ text: 'M&oacute;vil', datafield: 'Movil', width: '15%', align: 'center' },
			{ text: 'Tipo de M&oacute;vil', datafield: 'TipoMovil', width: '40%', align: 'center' },
			{ text: 'Dominio', datafield: 'Dominio', width:'19%', align: 'center'}
		];
			
		$('#grdHistorialMovil').jqxGrid({ source: sourceHistorialMovil, columns: columnasHistorialMovil});
		$('#grdHistorialMovil').jqxGrid('selectrow',0);
		$('#grdHistorialMovil').jqxGrid('focus');	
				
	}

	function editMovil() {
		
		$('#tabsMoviles').jqxTabs('enableAt', 1);
		$('#tabsMoviles').jqxTabs({ selectedItem: 0 });
		var rowData = getRowData('grdMaestroMoviles');
		var id = rowData.ID;
		$('#hidIdMovil').val(id);
		$('#btnVerGrilla,#btnGuardarMovil').css("display","inline-block");
		setDataMovil(id);
		
	}
	
	function setDataMovil(id) {
		
		$('#ctGrillaMaestroMoviles').toggle('slow',function(e){
		
		
			
		$.ajax({
			type: 'GET',
			dataType: 'json',
			url: 'getSetMoviles.php?opt=3&id='+id,
			success : function(datos) {
				
					var movil = datos[1];
					var tipoMov = datos[2];
					var dominio = datos[3];
					var marca = datos[4];
					var modelo = datos[5];
					var baseOp = datos[6];
					var gdosCob = datos[7];
					var prop = datos[8];
					var vehId = datos[9];
					
					$('#txtMov').val(movil);
					$('#txtDomMov').val(dominio);
					$('#txtMarcaMov').val(marca);
					$('#txtModeloMov').val(modelo);
					$('#txtPropMov').val(prop);
					$('#txtGradosCob').val(gdosCob);
					$('#hidIdVeh').val(vehId);
					
					var itmBaseOp = $('#dpDownBaseOp').jqxDropDownList('getItemByValue',baseOp);
					$('#dpDownBaseOp').jqxDropDownList('selectItem',itmBaseOp);
					
					var itmTipoMov = $('#dpDownTipoMov').jqxDropDownList('getItemByValue',tipoMov);
					$('#dpDownTipoMov').jqxDropDownList('selectItem',itmTipoMov);
					
					setGrdHistorialMovil(id);
					setLista(id,0,'lstCob');
					setLista(id,1,'lstCobSel');
				
				}
			});	
			
			$('#ctOpcionesMaestroMoviles').toggle('slow');	
		});
	}
	
	function setPopupEliminar() {
		
		 $("#dialogoEliminar").dialog({
				resizable: false,
				hide: 'slide',
				show: 'slide',
				height:160,
				modal: true,
				buttons: {
					"Eliminar": function() {
						var rowData = getRowData('grdMaestroMoviles');
						var id = rowData.ID;
						procesoEliminarMovil(id);		
					$( this ).dialog( "close" );
				},
					"Cancelar": function() {
					$( this ).dialog( "close" );
				}
			}
		});			
		
		
	}
	
	function procesoEliminarMovil(id) {
		
		$.ajax({
			
			type: 'GET',
			url: 'getSetMoviles.php?opt=1&id='+id,
			success: function(datos) {
				
				actualizarGrd();	
	
				var mensaje = 'El m&oacute;vil se ha eliminado correctamente.';	
				 $('#msgDialogo').html(mensaje);
						 $("#dialogo").dialog({
							modal: true,
							show: 'slide',
							hide: 'slide',
							open: function(event, ui){
								setTimeout("$('#dialogo').dialog('close')",1500);
							}
					});		
				}
			});	
	
		}
		
	function agregarMovil() {
		
		$('#tabsMoviles').jqxTabs('disableAt', 1);
		$('#tabsMoviles').jqxTabs({ selectedItem: 0 });
		$('#hidIdMovil').val(0);
		$('#ctGrillaMaestroMoviles').toggle('slow',function(e){
		
			$('#btnVerGrilla,#btnGuardarMovil').css("display","inline-block");
			blanqueoForm();
			$('#ctOpcionesMaestroMoviles').toggle('slow');
			$('#txtMov').focus();
			
		});	
	}
	
	function blanqueoForm() {
		
		$('#ctPanelMovil input[type="text"]').each(function(index, element) {
            
			$(this).val('');
			
        });	
		
		$('#dpDownBaseOp').jqxDropDownList('clearSelection');
		$('#dpDownTipoMov').jqxDropDownList('clearSelection');
		$('#grdHistorialMovil').jqxGrid({ source: [] });
		
	}
	
	function procesarNuevoMov() {

		var bValido = validoNuevoMov();
		
		if (bValido) {
			
			var vecNuevoMov = [];
			
			vecNuevoMov.push($('#txtMov').val());
			vecNuevoMov.push($('#hidIdVeh').val());
			
			var itmTipoMov = $('#dpDownTipoMov').jqxDropDownList('getSelectedItem');
			var tipoMov = itmTipoMov.value;
			
			var itmBase = $('#dpDownBaseOp').jqxDropDownList('getSelectedItem');
			var base = itmBase.value;

			vecNuevoMov.push(tipoMov);
			vecNuevoMov.push(base);
					
			if ($('#hidIdMovil').val() == 0) {
				
				vecNuevoMov.push(0);
				insertNuevoMov(vecNuevoMov,0)
					
			} else {
				
				vecNuevoMov.push($('#hidIdMovil').val());
				var itmLoc = $('#lstCobSel').jqxListBox('getItems');
			
				for (i = 0; i < itmLoc.length;i++) {
				
					var locId = itmLoc[i].value;
					vecNuevoMov.push(locId);	
				
				}
					insertNuevoMov(vecNuevoMov,1);
					
			}
		}	
		
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
	
	
	function validoNuevoMov() {
		
		var msgError = "";
		var bValido = true;
		
		if ($('#txtMov').val() == "") msgError = msgError +  "- Debe determinar el n&uacute;mero del m&oacute;vil. <br />";
		if ($('#txtDomMov').val() == "") msgError = msgError +  "- Debe determinar el dominio del m&oacute;vil. <br />";
		if ($('#txtMarcaMov').val() == "") msgError = msgError +  "- Debe determinar la marca del veh&iacute;culo. <br />";
		if ($('#txtModeloMov').val() == "") msgError = msgError +  "- Debe determinar el modelo del veh&iacute;culo. <br />";

		if (msgError != "") {
		
			setMessage('error',2000,msgError,'txtMov');
			bValido = false;	
			
		}
		
		return bValido;		
	}
	
	function insertNuevoMov(vecNuevoMov,optInsModif) {
	
		 $.ajax({
			type: "POST",
			url: "getSetMoviles.php?opt=5&optInsModif="+optInsModif,
			data: { pArray : vecNuevoMov },
			success: function(datos){	
                                console.log(datos);
				var mensaje = "";
				if (datos == 0) {
						mensaje = "El m&oacute;vil fue ingresado correctamente.";
				} else {
					
						mensaje = "El m&oacute;vil fue modificado correctamente.";	
				}
					verGrilla();
					setGrdMaestroMoviles(0,-1);
					setMessage('success',1000,mensaje,'');
	
				}
			});	
	}
	
	
	function actualizarGrd() {
		
		var ftr = getFiltro();
		
		if ($('#chkActivo').jqxCheckBox('checked')) {
			
			setGrdMaestroMoviles(0,ftr);
					
		} else {
			
			setGrdMaestroMoviles(1,ftr);
			
		}	
		
	}
	
	function getFiltro() {
		
		var itm = $('#dpDownMoviles').jqxDropDownList('getSelectedItem');
		var val = itm.value;
		return val;	
				
	}