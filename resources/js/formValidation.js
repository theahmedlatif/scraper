jQuery.validator.addMethod("checkSpaces", function(value, element) {
    return value == '' || value.trim().length != 0;
}, "No space please and don't leave it empty");


var $formValidator = $('#formAddWebsite');
if($formValidator.length) {
    $form.validate({
        rules:{
            websiteName:{
                required: true,
            },
            url:{
                required: true,
                checkSpaces: true
            },
            titleDOM:{
                required: true,
                checkSpaces: true
            },
            excerptDOM:{
                required: true,
                checkSpaces: true
            },
            urlDOM:{
                required: true,
                checkSpaces: true
            }
        },
        messages:{
            websiteName:{
                required: "Website name is required.",
            },
            url:{
                required: "Website URL is required.",
            },
            titleDOM:{
                required: "Article title selector is required.",
            },
            excerptDOM:{
                required: "Article excerpt selector is required.",
            },
            urlDOM:{
                required: "Article URL selector is required.",
            }
        },
        errorPlacement: function(error, element){
            error.insertAfter( element );
        }
    });
}
