
function Validator(options) {
    function getParent(element, selector) {
        while(element.parentElement) {
            if(element.parentElement.matches(selector)) {
                return element.parentElement;
            }
            element = element.parentElement;
        }
    }

    var selectorRules = {};
    var formElement = document.querySelector(options.form);
    function Validate(inputElement, rule) {
        var errorElement = getParent(inputElement, options.formGroupSelector).querySelector(options.errorSelector);
        var erorrMessage;

        var rules = selectorRules[rule.selector];
        for(var i = 0; i < rules.length; ++i) {
            switch(inputElement.type) {
                case 'radio':
                case 'checkbox':
                    erorrMessage = rules[i](formElement.querySelector(rule.selector + ':checked'));
                    break;
                default:
                    erorrMessage = rules[i](inputElement.value);
            }
            if(erorrMessage) break;
        }

        if(erorrMessage) {
            errorElement.innerText = erorrMessage;
            getParent(inputElement, options.formGroupSelector).classList.add('invalid')
        } else {
            errorElement.innerText = '';
            getParent(inputElement, options.formGroupSelector).classList.remove('invalid');
        }

        return !erorrMessage;
    }

    if(formElement) {
        formElement.onsubmit = function(e) {
            e.preventDefault();

            var isFormValid = true;
            options.rules.forEach(function(rule) {
                
                var inputElement = formElement.querySelector(rule.selector);
                var isValid = Validate(inputElement, rule);
                if(!isValid) {
                    isFormValid = false;
                }
            });
            
            if(isFormValid) {
                if(typeof options.onSubmit === 'function') {
                    var enableInput = formElement.querySelectorAll('[name]'); // trả về nodeList các ô input có name và không disable
                    var formValues = Array.from(enableInput).reduce(function(values, input) {
                        switch(input.type) {
                            case 'radio':
                                values[input.name] = formElement.querySelector('input[name="' + input.name + '"]:checked').value;
                                break;
                            case 'checkbox':
                                if(!input.matches(':checked')) {
                                    values[input.name] = '';
                                    return values;
                                }
                                if(!Array.isArray(values[input.name])) {
                                    values[input.name] = [];
                                }
                                values[input.name].push(input.value);
                                break;
                            case 'file': 
                                values[input.name] = input.files;
                                break;
                            default:
                                values[input.name] = input.value;

                        }
                        return  values;
                    }, {}); // convert nodeList về array rồi lấy ra giá trị của input
                    options.onSubmit(formValues);
                } else {
                    formElement.method = "POST";
                    formElement.submit();
                }
            }
        }


        options.rules.forEach(function(rule) {
            if(Array.isArray(selectorRules[rule.selector])) {
                selectorRules[rule.selector].push(rule.test);
            } else {
                selectorRules[rule.selector] = [rule.test];
            }
            var inputElement = formElement.querySelector(rule.selector);
            if(inputElement) {
                inputElement.onblur = function() {
                    Validate(inputElement, rule)
                }

                inputElement.oninput = function() {
                    var errorElement = getParent(inputElement, options.formGroupSelector).querySelector(options.errorSelector);
                    errorElement.innerText = '';
                    getParent(inputElement, options.formGroupSelector).classList.remove('invalid');
                }
            }
        })
    }
}

Validator.isRequired = function(selector) {
    return {
        selector: selector,
        test: function(value) {
            //trim()-Loại bỏ tất cả các dấu cách
            return value.trim() ? undefined : 'Vui lòng nhập trường này'
        }
    };
}

Validator.checkSpace = function(selector) {
    return {
        selector: selector,
        test: function(value) {
            if(value) {
                return !value.includes(" ") ? undefined : 'Trường này không được có ký tự khoảng trắng'
            }
        }
    };
}

Validator.isEmail = function(selector, message) {
    return {
        selector: selector,
        test: function(value) {
            if(value) {
                var regex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
                return regex.test(value) ? undefined : 'Trường này phải là email';
            } else {
                return message;
            }
        }
    };
}

Validator.minLength = function(selector, min, message) {
    return {
        selector: selector,
        test: function(value) {
            if(value) {
            return value.length >= min ? undefined : `Vui lòng nhập tối thiểu ${min} ký tự`;
            } else {
                return message;
            }
        }
    }
}

Validator.isConfirmed = function(selector, getConfirmValue, message) {
    return {
        selector: selector,
        test: function(value) {
            if(getConfirmValue()) {
                if(value) {
                    return value === getConfirmValue() ? undefined : 'Mật khẩu không chính xác';
                } else {
                    return message;
                }
            } else {
                return message;
            }
        }
    }
}



Validator.isPhone = function(selector, message) {
    return {
        selector: selector,
        test: function(value) {
            if(value) {
                var numberPattern = /^[0-9]+$/;
                return numberPattern.test(value.trim()) ? undefined : 'Vui lòng nhập đúng số điện thoại';
            } else {
                return message;
            }
        }
    };
}

Validator.lengthPhone = function(selector, message) {
    return {
        selector: selector,
        test: function(value) {
            if(value) {
                return value.length >= 10 ? undefined : 'Số điện thoại phải có 10 số';
            } else {
                return message;
            }
        }
    };
}