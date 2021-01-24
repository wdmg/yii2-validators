var ReservedValidator;
(function ($) {
    "use strict";
    ReservedValidator = {
        addMessage: function (messages, message, value) {
            messages.push(message.replace(/\{value\}/g, value));
        },
        validate: function (value, messages, options) {
            $.each($.isArray(value) ? value : [value], function (i, v) {
                if (options.strict && $.inArray(v, options.stoplist) !== -1) {
                    yii.validation.addMessage(messages, options.message, value);
                    return false;
                } else {
                    $.each(options.stoplist, function (i, pattern) {
                        if (new RegExp("\\b" + pattern + "\\b").test(value)) {
                            yii.validation.addMessage(messages, options.message, value);
                            return false;
                        }
                    });
                }
                return true;
            });
        }
    };
})(window.jQuery);