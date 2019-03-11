function addFormValidation(userId) {
    addCustomValidationMethod();
    callValidate();

    function addCustomValidationMethod() {
        let erroMsg = 'Your Passwrod is not enough secure! It must containt at least one Captial Letter, one Lowercase Letter, one Number and must be longer than 7 characters';  
        $.validator.addMethod('validatePassword', function(currPassword, element) {
            let isMethodOptional = this.optional(element);
            let passwordValidationPattern = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.{8,}).*$/;

            return isMethodOptional || passwordValidationPattern.test(currPassword);
        }, erroMsg);
    }

    function callValidate() {
        console.log(userId);
        $('.profile-details-form').validate({
            rules : {
                email : {
                    email : true,
                    remote : {
                        url: '/account/is-email-reserved',
                        type: "post",
                        data: {
                            userId: function() {
                                return userId;
                            }
                        }
                    }
                },
                password : {
                    validatePassword : true,
                },
                passwordConf : {
                    equalTo: '#inputPassword'
                }
            },
            messages : {
                email : {
                    email : 'Please entere a valid email',
                    remote : 'This email is already reserved. Please choose an other one'
                },
                passwordConf : {
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
        });
    }
 }
