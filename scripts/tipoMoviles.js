
	function inicioComponentes() {
	
		$('#panelTipoMovil').jqxPanel({width:'650',height:'363',theme:'metro'});
		$("#chkDespachable").jqxCheckBox({  boxSize:'28px', theme: 'metro' });
		$("#menuGrillaTipoMoviles").jqxMenu({ width: '500px', height: '40px', mode: 'horizontal', theme: 'metro' });
		var srcGrados =  { datatype: "json", datafields: [ { name: 'ID' },{ name: 'Descripcion' } ], url: 'getSetTipoMoviles.php?opt=1', id: 'ID'};
		var dAGrados = new $.jqx.dataAdapter(srcGrados);	
		$("#lstGrados").jqxListBox({source: dAGrados,displayMember: "Descripcion", valueMember: "ID", allowDrop: true, allowDrag: true, width: 300, height: 250, theme: 'metro' });
		$("#lstGradosSel").jqxListBox({ displayMember: "Descripcion", valueMember: "ID", allowDrop: true, allowDrag: true, source: [], width: 300, height: 250, theme: 'metro' });
		$('#btnAceptarGrados').jqxButton({width:120, height:30, theme:'metro'});
		$('#btnCancelarGrados').jqxButton({width:120, height:30, theme:'metro'});
		
	}
		
	function bindEventos() {
	
		$('#dialogoEliminar').on('shown',function(ev){

			$('#btnElimTipoMovil').focus();

		});

		$('#dialogoEliminar').on('hide',function(ev){

			$('#grdTipoMoviles').jqxGrid('focus');

		});
	
		$('#grdTipoMoviles').on('rowdoubleclick',function(e){
	
			//editTipoMovil();
	
		});
		
		$("#lstGrados, #lstGradosSel").on('dragEnd', function (event) {
			if (event.args.label) {
				var ev = event.args.originalEvent;
				var x = ev.pageX;
				var y = ev.pageY;
				if (event.args.originalEvent && event.args.originalEvent.originalEvent && event.args.originalEvent.originalEvent.touches) {
					var touch = event.args.originalEvent.originalEvent.changedTouches[0];
					x = touch.pageX;
					y = touch.pageY;
				}
			}
		});

		$('#grdTipoMoviles').keydown(function(e) {
    
			if (e.which == 13) {
		
				//editTipoMovil();	
			}
	
			if (e.which == 45) {
		
				//agregarTipoMovil();	
			}
	
			if (e.which == 46) {
			
				//setPopupEliminar();
			}
		
		});
	
	}
	
	function verGrilla() {
		
		$('.ctTipoMoviles').toggle('slow');	
		$('#grdTipoMoviles').jqxGrid('focus');
			
	}
	
	function elimTipoMovil() {
	
		var rowData = getRowData('grdTipoMoviles');
		var id = rowData.ID;
		procesoEliminarTipMov(id);	
		
	}

	function setPopupEliminar() {
		
		$('#dialogoEliminar').modal('show');
	
	}
	
	function procesoEliminarTipMov(id) {
		
		$.ajax({
			type: 'GET',
			url: 'getSetTipoMoviles.php?opt=2&id='+id,
			success: function(datos) {
				
				setGrdTipoMoviles();
				$('#dialogoEliminar').modal('hide');

		
			}
		});	
	}

	function setGrdTipoMoviles() {
	
		sourceTipoMoviles ={
			datatype: "json",
			datafields: [{ name: 'ID' },{ name: 'AbreviaturaId'}, {name: 'Descripcion'}, {name: 'flgDespachable'}],
			url: 'getSetTipoMoviles.php?opt=0&id=0'
		};	
			
		columnasTipoMoviles = [
			{ text: 'ID', datafield: 'ID', hidden: true },
			{ text: 'C&oacute;digo', datafield: 'AbreviaturaId', width: '30%', align: 'center', cellsalign:'center'},
			{ text: 'Tipo de M&oacute;vil', width:'70%', datafield: 'Descripcion', align: 'center'},
			{ text: 'flgDespachable', datafield: 'flgDespachable', hidden: true}
		];
			
		$('#grdTipoMoviles').jqxGrid({	source: sourceTipoMoviles, columns: columnasTipoMoviles});
		$('#grdTipoMoviles').jqxGrid('selectrow',0);
		$('#grdTipoMoviles').jqxGrid('focus');
	
	}

	function initGrdTipoMoviles() {

		$("#grdTipoMoviles").jqxGrid({
			width:500,
			height:300,
			columnsresize: true,
			autoshowfiltericon: true,
			source: [],
			theme: 'metro',
			columns: [],
			altrows:true,
			pagesize:8,
			pagesizeoptions: ['8','10','12'],
			pageable: true,
			filterable: true,
			sortable: true,
			showfilterrow: true
	    });				
	}
	
	function agregarTipoMovil() {
		
		$('#ctGrillaTipoMoviles').toggle('slow',function(event){
				
			$('#ctOpcionesTipoMoviles').toggle('slow');
			blanqueoForm();
			$('#hidIdTipoMovil').val(0);
			$('#txtCodTipMov').focus();	
			
		});	
	}
	
	function procesarNuevoTipMov() {

		var bValido = validoNuevoTipMov();
		
		if (bValido) {
			
			var vecNuevoTipMov = [];
			var flgDesp = 0;
			vecNuevoTipMov.push($('#txtCodTipMov').val());
			vecNuevoTipMov.push($('#txtDescTipMov').val());
			if ($('#chkDespachable').jqxCheckBox('checked')) flgDesp = 1;
			vecNuevoTipMov.push(flgDesp);
			
			var itmGrados = $('#lstGradosSel').jqxListBox('getItems');
			
			for (i = 0; i < itmGrados.length;i++) {
				
				var gId = itmGrados[i].value;
				vecNuevoTipMov.push(gId);	
				
			}
					
			if ($('#hidIdTipoMovil').val() == 0) {
				
				insertNuevoTipMov(vecNuevoTipMov,0,'');
					
			} else {
				var id = $('#hidIdTipoMovil').val();
				insertNuevoTipMov(vecNuevoTipMov,1,id);
					
			}
		}	
		
	}
	
	function editTipoMovil() {
		
			var rowData = getRowData('grdTipoMoviles');
		
			setDatosTipoMov(rowData);
			
	}
	
	function setDatosTipoMov(rowData) {
		
		var id = rowData.ID;
		var cod = rowData.AbreviaturaId;
		var desc = rowData.Descripcion;
		var flgD = rowData.flgDespachable;
		
		var srcGradosSel =  { datatype: "json", datafields: [ { name: 'ID' },{ name: 'Descripcion' } ], url: 'getSetTipoMoviles.php?opt=3&id='+id};
		var dAGrados = new $.jqx.dataAdapter(srcGradosSel);
		$('#lstGradosSel').jqxListBox({ source: dAGrados });
		var srcGradosNoSel =  { datatype: "json", datafields: [ { name: 'ID' },{ name: 'Descripcion' } ], url: 'getSetTipoMoviles.php?opt=4&id='+id};
		var dAGradosNoSel = new $.jqx.dataAdapter(srcGradosNoSel);
		$('#lstGrados').jqxListBox({ source: dAGradosNoSel });		
		$('#hidIdTipoMovil').val(id);
		$('#txtCodTipMov').val(cod);
		$('#txtDescTipMov').val(desc);
		if (flgD == 1) $('#chkDespachable').jqxCheckBox({ checked : true});
		$('.ctTipoMoviles').toggle('slow');
		$('#txtCodTipMov').focus();	
		
	}
	

	
	function validoNuevoTipMov() {
		
		var msgError = "";
		var bValido = true;
		
		if ($('#txtCodTipMov').val() == "") msgError = msgError +  "- Debe determinar el c&oacute;digo. <br />";
		if ($('#txtDescTipMov').val() == "") msgError = msgError +  "- Debe determinar la descripci&oacute;n. <br />";

		if (msgError != "") {
			
			$('#notif').notify({
				closable : false,
				fadeOut: { enabled: true, delay: 1000 },
				message: { html : true, text: msgError },
				type : 'alert alert-error',
				onClosed: $('#txtCodTipMov').focus()
			}).show();		

			bValido = false;	
			
		}
		
		return bValido;		
	}
	
	function blanqueoForm() {
		
		$('#txtCodTipMov').val('');
		$('#txtDescTipMov').val('');
		$('#chkDespachable').jqxCheckBox({ checked : false });
		$('#lstGradosSel').jqxListBox({ source : [] });
		var srcGrados =  { datatype: "json", datafields: [ { name: 'ID' },{ name: 'Descripcion' } ], url: 'getSetTipoMoviles.php?opt=1', id: 'ID'};
		var dAGrados = new $.jqx.dataAdapter(srcGrados);
		$('#lstGrados').jqxListBox({ source : dAGrados });
		
	}
	
	function insertNuevoTipMov(vecNuevoTipMov,optInsModif,id) {
	
		 $.ajax({
			type: "POST",
			url: "getSetTipoMoviles.php?opt=5&optInsModif="+optInsModif+"&id="+id,
			data: { pArray : vecNuevoTipMov },
			success: function(datos){		
				
				var mensaje = "";
				if (datos == 0) {
						mensaje = "El tipo de m&oacute;vil fue ingresado correctamente.";
				} else {
					
						mensaje = "El tipo de m&oacute;vil fue modificado correctamente.";	
				}	
					verGrilla();
					setGrdTipoMoviles();
					
				$('#notif').notify({
					closable : false,
					fadeOut: { enabled: true, delay: 1000 },
					message: { html : true, text: mensaje },
					type : 'alert alert-success',		
				}).show();	
			}
		});	
	}