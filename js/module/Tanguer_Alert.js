/**
 * Author: Ghost
 * Date: 12/11/13
 *
 * This class handles front-end activity for the Tánguer Alert system.
 */

var Tanguer_Alert = function(){
    //Requires the Tanguer_App module
    if(!Tanguer_App){
        console.log("Tanguer_App module not detected. Cannot initialize the Tanguer_Calendar module.");
        return;
    }
    this.lastClosedAlert = null;
    this.init();
};

Tanguer_Alert.prototype = {

    /**
     * Init method- functionality comments are inline
     */
    init:function(){
        var scope = this;
        //Disable all dismiss anchor links, and
        $(".alerts").on("click","a.dismiss",function(e){
            e.preventDefault();
            var parent = $(this).closest(".alert");
            parent.addClass("dismissed");
            scope.lastClosedAlert = parent;
            var callback = function(){scope.close();};
            parent.slideUp(400,callback);
        });
    },



    /**
     * Checks all alert groupings to see if all of their alert objects are collapsed.
     * If they are, it will collapse the entire grouping as well.
     */
    close:function(){
        $(".alerts").each(function(){
            var parentContainer = $(this);
            if(parentContainer.find(".alert.dismissed").length == parentContainer.find(".alert").length){
                parentContainer.slideUp();
            }
        });
    }
};