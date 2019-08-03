$(document).ready(function() {
        $('#formFoto').bootstrapValidator({
//        live: 'disabled',
        message: 'Este valor no es válido',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            
            foto: {
                message: 'La foto no es válida',
                validators: {
                    notEmpty: {
                        message: 'La foto no puede estar vacía'
                    }
                }
            }
            
        }
    })
        
      });