$( function() {
    var _validFileExtensions = [".xlsx", ".xls"];    
    function Validate(oForm) {
        var arrInputs = $(oForm).find("input");
        for (var i = 0; i < arrInputs.length; i++) {
            var oInput = arrInputs[i];
            if ($(oInput).attr("type") == "file") {
                var sFileName = $(oInput).val();
                if (sFileName.length > 0) {
                    var blnValid = false;
                    for (var j = 0; j < _validFileExtensions.length; j++) {
                        var sCurExtension = _validFileExtensions[j];
                        if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
                            blnValid = true;
                            break;
                        }
                    }
                    
                    if (!blnValid) {
                        alert("Error, no es un archivo de tipo excel: " + _validFileExtensions.join(", "));
                        return false;
                    }
                }
            }
        }
      
        return true;
    }
    $("#btnCrearReporte").click(function(){

        if(Validate($("#formCrearReporte"))){
            if($("input[name=titulo]").val()!="" && $("input[name=numeroFilaInicio]").val()!=""){
              $("#formCrearReporte").submit();
            }else{
              alert("Los campos: Título y Datos a partir de la fila, son obligatorios.");
            }
        }
    });

    
  } );