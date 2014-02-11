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
        this._body.on("click",".flow-start-ac",function(e){
            e.preventDefault();
            var settings = {
                target:"ac-start",
                hasBackground:"true"
            };
            Tanguer_App.modal.open(settings);
        });
    }
}