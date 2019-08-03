$(document).ready(function() {
        $('#formEvento').bootstrapValidator({
//        live: 'disabled',
        message: 'Este valor no es válido',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            
            nomevento: {
                message: 'EL nombre no es válido',
                validators: {
                    notEmpty: {
                        message: 'El nombre no puede estar vacío'
                    }
                }
            },
            fecha_evento: {
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