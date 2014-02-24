/**
 * Author: Ghost
 * Date: 2/5/14
 */

var Tanguer_AccountCreator = function(){
    //Requires the Tanguer_App module
    if(!Tanguer_App){
        console.warn("Tanguer_App module not detected. Cannot initialize the Tanguer_Calendar module.");
        return;
    }
    //Try to use the pre-selected common jquery selections first
    this._body = Tanguer_App.jSel._body || $("body");

    this.init();
}

Tanguer_AccountCreator.prototype = {

    /**
     * Init method- functionality comments are inline
     */
    init:function(){
        var _this = this;
        _this._body.on("click",".flow-start-ac",function(e){
            e.preventDefault();
            var settings = {
                target:"m-ac-start",
                hasBackground:"true"
            };
            Tanguer_App.modal.open(settings);
        });

        $("body").on("submit",".ac-start form",function(e){
            e.preventDefault();
            var form = $(this);
            var email = form.find("input[name='email']");
            var password = form.find("input[name='password']");
            var verifyPassword = form.find("input[name='verifyPassword']");

            var data = {
                email:email.val(),
                password:password.val(),
                verifyPassword:verifyPassword.val()
            };

            var modal = form.closest(".m");
            modal.showLoader();

            Tanguer_App.JSONCalls.postAccountCreationStart(data,_this.ajax_postAccountCreationStartHandler.bind(_this),{previousModal:modal});
        });
    },



    /**
     * Handles data returned when a user completes the first step of the account creation process via a modal.
     * @param e     Object      An object representation of the returned data, containing HTML of the object for viewing
     * @param ref   Object      A reference object passed by the original requester of the AJAX call that will contain
     *                          data such as instance IDs, etc.
     */
    ajax_postAccountCreationStartHandler:function(e,ref){
        if(e.error != "undefined"){
            //TODO establish proper error handling for this error
            console.log("Error in ajax_postAccountCreationStartHandler in Tanguer_AccountCreator.js with no error handler defined...")
        }
        ref.previousModal.hideLoader();
        Tanguer_App.modal.closeAll();
        Tanguer_App.modal.open({hasBackground:true}, e.html);
    }
}