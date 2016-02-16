var FormValidator = (function () {
    function FormValidator() {
        this.init();
    }

    FormValidator.prototype.init = function () {
        this.form = document.querySelector("form");
        this.title = document.querySelector("input[name='title']");
        this.warning = document.querySelector('form #title-warning');
        if (this.form) {
            this.setupFormSubmitHandler();
            this.setupKeyUpTitleEventHandler();
            this.setupInvalidHandler();
            this.disableFireFoxRedBox();
        }
    };

    FormValidator.prototype.setupKeyUpTitleEventHandler = function () {
        if(this.title) {
            this.title.addEventListener('keyup', this.updateEditorMessage, false);
        }
    };

    FormValidator.prototype.updateEditorMessage = function () {
        var p = document.querySelector("#editor-message");
        p.innerHTML = "Changes not saved!";
    };

    FormValidator.prototype.setupFormSubmitHandler = function () {
        this.form.addEventListener("submit", this.validateTitle, false);
    };

    FormValidator.prototype.setupInvalidHandler = function () {
        var that = this;
        document.addEventListener("invalid", function (e) {
            that.validateTitle(e);
        }, true);
    };

    FormValidator.prototype.disableFireFoxRedBox = function () {
        document.styleSheets[0].insertRule('input:invalid  { box-shadow: none; }', 0);
    };

    FormValidator.prototype.validateTitle = function (event) {
        if (this.title.value === "") {
            event.preventDefault();
            this.warning.innerHTML = "* You must write a title for the entry";
        }
    };
    return FormValidator;
})();

document.addEventListener('DOMContentLoaded', function () {
    var formValidator = new FormValidator();
    if (tinymce) {
        tinymce.init({
            selector: 'textarea',
            plugins: 'image',
            setup: function (editor) {
                editor.on('change', function (e) {
                    formValidator.updateEditorMessage();
                });
            }
        });
    }

}, false);
