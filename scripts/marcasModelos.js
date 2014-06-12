	
	function setFocusGrid() {
	
		$('#grdMarcasModelos').jqxGrid('selectrow',0);
		$('#grdMarcasModelos').jqxGrid('focus');	
			
	}
	
	function elimMarcaModelo() {
	
		 var rowData = getRowData('grdMarcasModelos');
		 var id = rowData.ID;
		 setPopupEliminar(id);     
	
	}
	
	function initGrdMarcasModelos() {
		
		columnas = [
			{ text: 'ID', datafield: 'ID', hidden: true },
			{ text: 'Marca', datafield: 'Marca', width: '50%', align: 'center'},
			{ text: 'Modelo', datafield: 'Modelo', width:'50%', align: 'center'}	
		];
		
		$("#grdMarcasModelos").jqxGrid({
			width:400,
			height:400,
			columnsresize: false,
			autoshowfiltericon: true,
			editable: true,
			editmode: 'dblclick',
			source: [],
			theme: 'metro',
			columns: columnas,
			handlekeyboardnavigation: function (event) {
				var rowData = getRowData('grdMarcasModelos');
				var id = rowData.ID;
				var key = event.charCode ? event.charCode : event.keyCode ? event.keyCode : 0;
				switch (key) {				
					case 46:
						setPopupEliminar(id);
						return true;
					break;
						
					case 45:
						setPopupAgregar();
						return true;
					break;
						
					case 13:
						return false;
					break;	
						
				}
			},
			altrows:true,
			filterable: true,
			sortable: true,
			showfilterrow: true
		});				
	}
		
		
		function deleteMarcaModelo(id){
		
			$.ajax({
				type: 'GET',
				url : 'getSetMarcasModelos.php?opt=1&id='+id,
				success: function(datos) {
					
					setGrdMarcasModelos();
					setFocusGrid();
					
				}	
			});
		
	}
			
	function setGrdMarcasModelos() {
		
		sourceMarcasModelos ={
        	datatype: "json",
        	datafields: [{ name: 'ID' },{ name: 'Marca'}, {name: 'Modelo'}],
		 	url: 'getSetMarcasModelos.php?opt=0'
   		 };	
		$('#grdMarcasModelos').jqxGrid({ source: sourceMarcasModelos });
	}
	
	
	function setPopupEliminar(id) {
	
		$('#dialogoEliminar').modal('show');
		
		$('#btnElimMarcaModelo').on('click',function(ev){
		
			deleteMarcaModelo(id);
			$('#dialogoEliminar').modal('hide');
		
		});
		
		$('#btnElimMarcaModelo').keydown(function(ev){
			if (ev.which == 13) {
				deleteMarcaModelo(id);
				$('#dialogoEliminar').modal('hide');
			}
		
		});
					
	}
	
	function procesoMarcaModelo() {
	
		var marca = $('#txtMarca').val();
		var modelo = $('#txtModelo').val();
		agregoMarcaModelo(marca,modelo);
	
	}
	
	function actualizarGrd() {
	
		setGrdMarcasModelos();
		$('#grdMarcasModelos').jqxGrid('focus');
	
	}
	
	function setPopupAgregar() {
	
		$('#dialogoAgregar').modal('show');
					
	}
	
	function bindEventos() {
	
	$('#dialogoEliminar').on('shown',function(ev){
	
		$('#btnElimMarcaModelo').focus();
	
	});
	
	$('#dialogoEliminar').on('hide',function(ev){
	
		setFocusGrid();
	
	});
	
	$('#dialogoAgregar').on('hide',function(ev){
	
		setFocusGrid();
	
	});
	
	$('#dialogoAgregar').on('shown',function(ev){
	
		$('#txtMarca').focus();
	
	});
	
	$('#grdMarcasModelos').keydown(function(ev){
	
		if (ev.which == 46) {
		
			elimMarcaModelo();
			
		}
	
	});
		
		$('#txtMarca').keydown(function(ev){
			
			if (ev.which == 13) {
				
				$('#txtModelo').focus();	
			}
			
		});
		
		$('#txtModelo').keydown(function(event){
			
			if (event.which == 13) {
				
				$('#btnAceptarMarcaModelo').focus();
				event.preventDefault();
					
			}
			
		});
		
		$('#grdMarcasModelos').on('cellendedit',function(ev){
				
			var column = args.datafield;
			var value = args.value;
			var row = args.rowindex;
			updateCampo(row,value,column);
			
		});
				
	}
	
	function updateCampo(row,value,column) {
		
		var rowData = getRowData('grdMarcasModelos');	
		var id = rowData.ID;

		$.ajax({
			type: 'GET',
			url : 'getSetMarcasModelos.php?opt=3&campo='+column+'&value='+value+'&id='+id
		});
	}
	
	function agregoMarcaModelo(marca,modelo) {	
		
		$.ajax({
			type : 'GET',
			url : 'getSetMarcasModelos.php?opt=2&marca='+marca+'&modelo='+modelo,
			success : function(datos) {
				console.log(datos);
				setGrdMarcasModelos();
				$('#dialogoAgregar').modal('hide');

				
			}	
		});
			
	}