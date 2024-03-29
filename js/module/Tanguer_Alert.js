/**
 * Author: Ghost
 * Date: 12/11/13
 *
 * This class handles front-end activity for the Tánguer Alert system.
 */

var Tanguer_Alert = function(){
    //Requires the Tanguer_App module
    if(!Tanguer_App){
        console.warn("Tanguer_App module not detected. Cannot initialize the Tanguer_Alert module.");
        return;
    }
    this.init();
};

Tanguer_Alert.prototype = {

    /**
     * Init method- functionality comments are inline
     */
    init:function(){
        //Disable all dismiss anchor links, and
        $(".alerts").on("click","a.dismiss",function(e){
            e.preventDefault();
            var alert = $(this).closest(".alert");
            var parent = alert.closest(".alerts");
            alert.addClass("dismissed");
            alert.slideUp();
            if(parent.find(".alert.dismissed").length == parent.find(".alert").length){
                parent.slideUp();
            }
        });
    }
};