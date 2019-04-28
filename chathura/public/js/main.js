// using pure js since libraries are not allowed ;-)

document.addEventListener('DOMContentLoaded', function() {
    CS.init();
});


var CS = {

    init : function ()
    {
        this.initFormSubmit();
    },

    initFormSubmit : function ()
    {
        var oThis = this;

        document.querySelector('body').addEventListener('click', function (event) {

            var oElement = event.target;

            if (oElement.tagName.toLowerCase() === 'input' &&
                oElement.type.toLowerCase() === 'button' &&
                oElement.value.toLowerCase() === 'submit') {

                oThis.submitForm();
            }
        });
    },

    submitForm : function () {

        var oFormComment = document.querySelectorAll('#iFormComment')[0];
        var oElements = oFormComment.querySelectorAll('input, textarea');
        var aComment = {};

        Array.prototype.forEach.call(oElements, function(oElement) {

            if (oElement.type === 'text' || oElement.type === 'textarea') {
                aComment[oElement.name] = oElement.value;
            }
        });

        var request = new XMLHttpRequest();
        request.open('POST', '/index/save', true);
        request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');

        request.onload = function () {
            if (request.status >= 200 && request.status < 400) {
                oFormComment.outerHTML = request.responseText;
            } else {
                oFormComment.outerHTML = 'error';
            }
        }

        request.onerror = function () {
            oFormComment.outerHTML = 'error';
        }

        request.send('comment=' + JSON.stringify(aComment));
    }

}