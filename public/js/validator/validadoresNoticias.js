$(document).ready(function() {
        $('#formNoticia').bootstrapValidator({
//        live: 'disabled',
        message: 'Este valor no es válido',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            
            titulo: {
                message: 'EL título no es válido',
                validators: {
                    notEmpty: {
                        message: 'El título no puede estar vacío'
                    }
                }
            },
            fecha_creación: {
                message: 'La fecha no es válida',
                validators: {
                    notEmpty: {
                        message: 'La fecha no puede estar vacía'
                    }
                }
            }
            
        }
    })
        
      });