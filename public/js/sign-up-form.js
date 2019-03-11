(function () {
    console.log('majom');
    $(document).ready(() => {
        addCustomValidationMethod();
        callValidate();
    })

    function addCustomValidationMethod() {
        let erroMsg = 'Your Passwrod is not enough secure! It must containt at least one Captial Letter, one Lowercase Letter, one Number and must be longer than 7 characters';  
        $.validator.addMethod('validatePassword', function(currPassword, element) {
            let isMethodOptional = this.optional(element);
            let passwordValidationPattern = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.{8,}).*$/;

            return isMethodOptional || passwordValidationPattern.test(currPassword);
        }, erroMsg);
    }

    function callValidate() {
        $('.sign-up-form').validate({
            rules : {
                name : {
                    required : true,
                },
                email : {
                    required : true,
                    email : true,
                    remote : {
                        url: '/account/is-email-reserved',
                        type: "post"
                    }
                },
                password : {
                    required : true,
                    validatePassword : true,
                },
                passwordConf : {
                    required : true,
                    equalTo: '#inputPassword'
                },
            },
            messages : {
                name : {
                    required : 'A name is required',
                },
                email : {
                    required : 'Please enter an email address',
                    email : 'Please entere a valid email',
                    remote : 'This email is already reserved. Please choose an other one'
                },
                password : {
                    required : 'A password is required',
                },
                passwordConf : {
                    required : 'Please confirm your password',
                    equalTo: 'The confirmation doesn`t match your password'
                }
            },
            errorClass: "invalid2",
            wrapper: "label",
            highlight: function(element, errorClass) {
                $(element).css({'border' : '4px solid red'});
            },
            unhighlight: function(element, errorClass) {
                $(element).css({'border-width' : '2px', 'border-style' : 'inset', 'border-color' : 'initial'});
            }

            // further useful keys: ¶errorPlacement
        });
    }
}());
