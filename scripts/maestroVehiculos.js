	
	function initComponentes() {
	
		$('#panelVeh').jqxPanel({width:'650',height:'234',theme:'metro'});
		$("#menuGrillaMaestroVehiculos").jqxMenu({ width: '940px', height: '40px', mode: 'horizontal', theme: 'metro' });
		$('#btnAceptarVeh').jqxButton({width:120, height:30, theme:'metro'});
		$('#btnCancelarVeh').jqxButton({width:120, height:30, theme:'metro'});
	
	}
	
	function bindEventos() {
	
		$('#grdMaestroVehiculos').keydown(function(e) {
    
			if (e.which == 13) {
				
				//editVehiculo();	
			}
			
			if (e.which == 45) {
				
				//agregarVehiculo();	
			}
			
			if (e.which == 46) {
					
				//setPopupEliminar();
			}
		
		});
		
		$('#grdMaestroVehiculos').on('rowdoubleclick',function(ev){
		
			//editVehiculo();
		
		});
	
	}
	
	function verGrilla() {
		
		$('.ctMaestroVehiculos').toggle('slow');	
			
	}

	function setDropDown() {
		
		var sourceMarcaModelo =   { datatype: "json", datafields: [ { name: 'ID' },{ name: 'MarcaModelo' } ], url: 'getSetVehiculos.php?opt=2', async: false};
		var dAMarcaModelo = new $.jqx.dataAdapter(sourceMarcaModelo);	
		$("#dpDownMM").jqxDropDownList({ source: dAMarcaModelo,promptText:'Seleccione...' ,valueMember:'ID',displayMember:'MarcaModelo',
													  width: 300,height: 27, dropDownHeight:150, theme:'metro'});
													  
		var sourceSituacion = [ {label: "BAJA", value: 0}, {label: "ASIGNADO", value: 1},{label: "SIN ASIGNAR", value: 2},{label: "MULETO", value: 3} ];	
		$("#dpDownSit").jqxDropDownList({ source: sourceSituacion,promptText:'Seleccione...' ,valueMember:'value',displayMember:'label',
													  width: 220,height: 27, dropDownHeight:150, theme:'metro'});
													  
		var sourceComb = ["NFT","GSL","GNC"];
		$("#dpDownComb").jqxDropDownList({ source: sourceComb,promptText:'Seleccione...' ,width: 140,height: 27, dropDownHeight:150, theme:'metro'});																									
		
	}
	
	function elimBase() {
	
		var rowData = getRowData('grdMaestroVehiculos');
		var id = rowData.ID;
		procesoEliminarVeh(id);
			
	
	}
	
	function setPopupEliminar() {
		
		$('#dialogoEliminar').modal('show');
			
	}
	
	function procesoEliminarVeh(id) {
		
		$.ajax({
			
			type: 'GET',
			url: 'getSetVehiculos.php?opt=4&id='+id,
			success: function(datos) {	
			
				setGrdMaestroVehiculos();
				$('#dialogoEliminar').modal('hide');
				
			}
		});				
	}

	function setGrdMaestroVehiculos() {
	
		sourceVehiculos ={
			datatype: "json",
			datafields: [{ name: 'ID' },{ name: 'Dominio'}, {name: 'MarcaModelo'}, {name: 'Situacion'}],
			url: 'getSetVehiculos.php?opt=0&id=0'
		};	
			
		columnasVehiculos = [
			{ text: 'ID', datafield: 'ID', hidden: true },
			{ text: 'Dominio', datafield: 'Dominio', width: '218', align: 'center'},
			{ text: 'Marca y Modelo', width:'500', datafield: 'MarcaModelo', align: 'center'},
			{ text: 'Situaci&oacute;n', datafield: 'Situacion', width: '220', align: 'center' }
		];
			
		$('#grdMaestroVehiculos').jqxGrid({	source: sourceVehiculos, columns: columnasVehiculos});
		$('#grdMaestroVehiculos').jqxGrid('selectrow',0);
		$('#grdMaestroVehiculos').jqxGrid('focus');
	
	}

	function initGrdMaestroVehiculos() {

		$("#grdMaestroVehiculos").jqxGrid({
			width:940,
			height:385,
			columnsresize: false,
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
	
	function agregarVehiculo() {
		
		$('#ctGrillaMaestroVehiculos').toggle('slow',function(event){
				
			$('#ctOpcionesMaestroVehiculos').toggle('slow');
			blanqueoForm();
			$('#hidIdVeh').val(0);
			$('#txtDomVeh').focus();	
			
		});
		
	}
	
	function procesarNuevoVeh() {

		var bValido = validoNuevoVeh();
		
		if (bValido) {
			
			var vecNuevoVeh = [];
			$('#ctPanelVeh input[type="text"]').each(function(index, element) {
            
				var valor = $(this).val();
	
				vecNuevoVeh.push(valor);
		
        	});
			
			var itmMM = $('#dpDownMM').jqxDropDownList('getSelectedItem');
			var mm = itmMM.value;
			
			var itmComb = $('#dpDownComb').jqxDropDownList('getSelectedItem');
			var cmb = itmComb.label;
			
			var itmSit = $('#dpDownSit').jqxDropDownList('getSelectedItem');
			var sit = itmSit.value;
			
			vecNuevoVeh.push(mm);
			vecNuevoVeh.push(cmb);
			vecNuevoVeh.push(sit);
					
			if ($('#hidIdVeh').val() == 0) {
				
				insertNuevoVeh(vecNuevoVeh,0)
					
			} else {
				
				vecNuevoVeh.push($('#hidIdVeh').val());
				insertNuevoVeh(vecNuevoVeh,1);
					
			}
		}	
		
	}

	function editVehiculo() {
		
		var rowData = getRowData('grdMaestroVehiculos');
		var id = rowData.ID;
		
		setDatosVeh(id);
			
	}
	
	function setDatosVeh(id) {
			
		$.ajax({
			type: 'GET',
			dataType: 'json',
			url:  'getSetVehiculos.php?opt=0&id='+id,
			success: function(datos){
				
				console.log(datos);

					$('#hidIdVeh').val(id);
					$('#txtDomVeh').val(datos[0].Dominio);
					$('#txtAnioVeh').val(datos[0].Anio);
					$('#txtNumMotorVeh').val(datos[0].NroMotor);
					$('#txtNumChasisBase').val(datos[0].NroChasis);
					var mm = datos[0].MarcaModeloId;
					var cmb = datos[0].TipoCombustible;
					var sit = datos[0].Situacion;
					var vSit = getIdSituacion(sit);
					
					
					var itmMM = $('#dpDownMM').jqxDropDownList('getItemByValue',mm);
					$('#dpDownMM').jqxDropDownList('selectItem',itmMM);
					
					var itmCmb = $('#dpDownComb').jqxDropDownList('getItemByValue',cmb);
					$('#dpDownComb').jqxDropDownList('selectItem',itmCmb);
					
					var itmSit = $('#dpDownSit').jqxDropDownList('getItemByValue',vSit);
					$('#dpDownSit').jqxDropDownList('selectItem',itmSit);
					
					$('.ctMaestroVehiculos').toggle('slow');
					$('#txtDomVeh').focus();
					//$('#txtPropVeh').val(datos[0].Calle);
					//$('#txtMovVeh').val(datos[0].Altura);
					
												
			}		
		});	
	}
	
	function getIdSituacion(sit) {
		
		rSit = 0;
		
		switch (sit) {
			
			case 'ASIGNADO':
				rSit = 1;
			break;
			
			case 'SIN ASIGNAR':
				rSit = 2;
			break;
			
			case 'MULETO':
				rSit = 3;
			break;
				
			
		}
		
		return rSit;
		
		
	}
	
	function validoNuevoVeh() {
		
		var msgError = "";
		var bValido = true;
		
		if ($('#txtDomVeh').val() == "") msgError = msgError +  "- Debe determinar el dominio del veh&iacute;culo. <br />";
		if($('#dpDownMM').jqxDropDownList('getSelectedIndex') == -1)  msgError = msgError +  "- Debe determinar la Marca / Modelo del veh&iacute;culo <br />";
		if($('#dpDownComb').jqxDropDownList('getSelectedIndex') == -1)  msgError = msgError +  "- Debe determinar el tipo de combustible <br />";

		if (msgError != "") {
		
			$('#notif').notify({
				closable : false,
				fadeOut: { enabled: true, delay: 1000 },
				message: { html : true, text: msgError },
				type : 'alert alert-error',
				onClosed : $('#txtDomVeh').focus()		
			}).show();
	
			bValido = false;	
			
		}
		
		return bValido;		
	}
	
	function blanqueoForm() {
		
		$('#ctPanelVeh input[type="text"]').each(function(index, element) {
            
			$(this).val('');
			
        });	
		
		$('#dpDownComb').jqxDropDownList('clearSelection');
		$('#dpDownMM').jqxDropDownList('clearSelection');
		$('#dpDownSit').jqxDropDownList('clearSelection');
		
	}
	
	function insertNuevoVeh(vecNuevoVeh,optInsModif) {
	
		 $.ajax({
			type: "POST",
			url: "getSetVehiculos.php?opt=3&optInsModif="+optInsModif,
			data: { pArray : vecNuevoVeh },
			success: function(datos){		
				
				var mensaje = "";
				if (datos == 0) {
					mensaje = "El veh&iacute;culo fue ingresado correctamente.";
				} else {	
					mensaje = "El veh&iacute;culo fue modificado correctamente.";	
				}	
					verGrilla();
					setGrdMaestroVehiculos();
					$('#notif').notify({
						closable : false,
						fadeOut: { enabled: true, delay: 1000 },
						message: { html : true, text: mensaje },
						type : 'alert alert-success'		
					}).show();		
			}
		});	
	}