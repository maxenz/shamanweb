
	function agregarPlan() {
		
		$('#hidIdPlan').val(0);
		createPlanDefault();
		blanqueoForm();
		$('#txtCodPlan').focus();
		$('.ctToggle').toggle('slow');		
				
	}
	
	function blanqueoForm() {
		
		$('#txtCodPlan').val('');
		$('#txtDescPlan').val('');
		$('#txtAObsCobertura').val('');	
		$('#grdPlanes').jqxGrid({ source : [] });
		
	}
	
	function createPlanDefault() {
		
		$.ajax({
			type: 'GET',
			dataType: 'json',
			url:  'getSetPlanesCobertura.php?opt=1',
			success: function(datos){
				
				createDefaultGrid(datos);	
			}
		});
	}
	
	function createDefaultGrid(vGrados) {
	
		for (var i = 0; i < vGrados.length; i++) {
			
			row = generateRow(vGrados[i].ID,vGrados[i].AbreviaturaId,vGrados[i].ColorHexa);
			$('#grdPlanes').jqxGrid('addrow',null,row);	
			
		}

	}
	
	function deletePlan() {
		
		var rowData = getRowData('grdPlanesCobertura');
		var id = rowData.ID;
		
		$.ajax({
			type : 'GET',
			url : 'getSetPlanesCobertura.php?opt=3&id='+id,
			success : function(datos){
				
				setGrdPlanesCobertura();
				
					
			}	
		});	
	}
	
	function generateRow(gradoID,grado,color) {
             var row = {};
		var cGrado = grado;
		var cGradoId = gradoID;
             var cCub = 'SI';
             var cCoPago = 0;
		var cId = 0;
		var cColor = color;
		row["ID"] = cId;
		row["gOpId"] = cGradoId;
		row["Grado"] = cGrado;
		row["Cub"] = cCub;
		row["CoPago"] = cCoPago;
		row["ColorGrado"] = cColor;
             return row;
            }
	
	function initGrdPlanesCobertura() {

		$("#grdPlanesCobertura").jqxGrid({
			width:400,
			height:350,
			source: [],
			theme: 'metro',
			columns: [],
			altrows:true,
			showfilterrow: true,
			filterable: true,
	    });				
	}
	
	function setGrdPlanesCobertura() {
	
		sourcePlanesCobertura ={
        	datatype: "json",
        	datafields: [{ name: 'ID' },{ name: 'AbreviaturaId'}, {name: 'Descripcion'}, {name: 'Observaciones'}],
		 	url: 'getSetPlanesCobertura.php?opt=0'
   		 };	
		
		columnasPlanesCobertura = [
			{ text: 'ID', datafield: 'ID', hidden: true },
			{ text: 'Observaciones', datafield: 'Observaciones', hidden: true},
			{ text: 'C&oacute;digo', datafield: 'AbreviaturaId', width: '30%', cellsalign:'center', align: 'center'},
			{ text: 'Nombre del Plan', width:'70%', datafield: 'Descripcion', align: 'center'},
		];
		
		$('#grdPlanesCobertura').jqxGrid({ source: sourcePlanesCobertura, columns: columnasPlanesCobertura});
		$('#grdPlanesCobertura').jqxGrid('selectrow',0);
		$('#grdPlanesCobertura').jqxGrid('focus');
	
	}
	
	function initGrdPlanes() {
		
		 cellsRendererGrado = function (row, columnfield, value, defaulthtml, columnproperties) {
			var data = $('#grdPlanes').jqxGrid('getrowdata',row);
			var color = "#" + data["ColorGrado"];	  
			return '<div style="width:50px;height:27px;text-align:center;line-height:27px;background: ' + color + ';">'+ value + '</div>'; 
	   }
	   
	    var rowEditGral = function (row) {
       	 	return true;
		}
		
		columnasPlanes = [
			{ text: 'ID', datafield: 'ID', hidden: true },
			{ text: 'gOpId', datafield: 'gOpId', hidden: true},
			{ text: '', datafield: 'Grado', cellsrenderer: cellsRendererGrado, width: '20%', cellbeginedit: rowEditGral},
			{ text: 'Cub', datafield: 'Cub', width:'30%',columntype: 'dropdownlist', align:'center', cellsalign: 'center', createeditor: function (row, column, editor) {
                            var list = ['SI', 'NO'];
                            editor.jqxDropDownList({ source: list});
                        },cellbeginedit: rowEditGral},
			  { text: 'CoPago', datafield: 'CoPago', align: 'center', width:'50%', cellsalign: 'right', cellsformat: 'c2', columntype: 'numberinput',
                      validation: function (cell, value) {
                          if (value < 0 || value > 999) {
                              return { result: false, message: "El CoPago va de $0 a $999" };
                          }
                          return true;
                      },
                      createeditor: function (row, cellvalue, editor) {
                          editor.jqxNumberInput({ digits: 3 });
                      },cellbeginedit: rowEditGral
                  },
			{ text: 'ColorGrado', datafield: 'ColorGrado', hidden: true},	
		];
		

		$("#grdPlanes").jqxGrid({
			width:250,
			height:250,
			columnsresize: false,
			editable: true,
			selectionmode: 'singlecell',
			source: [],
			theme: 'metro',
			columns: columnasPlanes,
			altrows:true,
	    });				
	}
		
	function guardarPlan() {
		
		var id = $('#hidIdPlan').val();
		var rows = $('#grdPlanes').jqxGrid('getrows');
		var cod = $('#txtCodPlan').val();
		var desc = $('#txtDescPlan').val();
		var obs = $('#txtAObsCobertura').val();	

		$.ajax({
			type: "GET",
			url: "getSetPlanesCobertura.php?opt=2&cod="+cod+"&desc="+desc+"&obs="+obs+"&id="+id,
			data: { pArray : rows },
			success: function(datos){
						
				$('#ctOpcionesPlanes').toggle('slow',function(event){
					
					setGrdPlanesCobertura();
					$('#ctGrillaPlanes').toggle('slow');
				});
			}
	   });	   
		
	}
	
	function verGrilla() {
	
		$('.ctToggle').toggle('slow');
		$('#grdPlanesCobertura').jqxGrid('focus');
	
	}
	
	function editPlan() {
		
		var rowData = getRowData('grdPlanesCobertura');
		var id = rowData.ID;
		var cod = rowData.AbreviaturaId;
		var desc = rowData.Descripcion;
		var obs = rowData.Observaciones;
		
		$('#hidIdPlan').val(id);
		
		setDataPlan(id,cod,desc,obs);	
			
	}
	
	function setDataPlan(id,cod,desc,obs) {
		
		sourcePlanes ={
        	datatype: "json",
        	datafields: [{ name: 'ID' },{ name: 'Grado'}, {name: 'Cub'}, {name: 'CoPago', type: 'number'},{name: 'ColorGrado'}, {name: 'gOpId'}],
		 	url: 'getSetPlanesCobertura.php?opt=4&id='+id
   		};
		
		$('#txtCodPlan').val(cod);
		$('#txtDescPlan').val(desc);
		$('#txtAObsCobertura').val(obs);
		$('#grdPlanes').jqxGrid({ source : [] });
		
		$('#grdPlanes').jqxGrid({ source: sourcePlanes });
		
		$('.ctToggle').toggle('slow');
		
	}
	
	function setControles() {
	
		$("#menuGrillaPlanesCobertura").jqxMenu({ width: '400', height: '40px', mode: 'horizontal', theme: 'metro' });
		//$('#btnGuardarPlan').jqxButton({width:120, height:30, theme:'metro'});
		//$('#btnCancelarPlan').jqxButton({width:120, height:30, theme:'metro'});
	
	}
	
	function bindEventos() {
	
		$('#dialogoEliminar').on('hide',function(ev){
		
			$('#grdPlanesCobertura').jqxGrid('focus');
		
		});
	
		$('#grdPlanesCobertura').keydown(function(e) {
    
			if (e.which == 46) {
	
				setPopupEliminar();	
		
			}
	
			if (e.which == 45) {
		
				agregarPlan();	
			}
			
			if (e.which == 13) {
			
				editPlan();
			
			}
	
		});

		$('#grdPlanesCobertura').on('rowdoubleclick',function(ev){
	
			editPlan();
	
		});

		$('input[type="text"],textarea').keydown(function(e) {
			
			var id = $(this).attr("id");
			
			if (e.which == 13) {
				
				if (id == 'txtAObsCobertura') {
					
					e.preventDefault();		
				}
			
					$(this).focusNextInputField();			
			}	
		});	
	}

	function setPopupEliminar() {
		
		$('#dialogoEliminar').modal('show');
		
	}