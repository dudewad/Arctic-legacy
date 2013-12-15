;
/**
 * Author: Ghost
 * Date: 12/2/13
 *
 * This module handles location selection (user can se their city/country, etc)
 */

var Tanguer_LocationSelector = function(){
    //Requires the Tanguer_App module
    if(!Tanguer_App){
        console.log("Tanguer_App module not detected. Cannot initialize the Tanguer_LocationSelector module.");
        return;
    }
    //Try to use the pre-selected common jquery selections first
    this._body = Tanguer_App.jSel._body || $("body");
    //Set up hiding on body click
    this._body.on("click",function(e){
        var el = $(e.target);
        //If the user clicked inside a selector element we won't want to hide that one.
        $(".lsel .selector:visible").each(function(){
            if(!el.hasClass("selector") && el.closest(".selector").length == 0)
                $(this).hide();
        })
    });
    this.init();
};

Tanguer_LocationSelector.prototype = {

    /**
     * Init method- functionality comments are inline
     */
    init:function(){
        var scope = this;

        //Change the "change location" button to have fly-out functionality when clicked rather than when hovered
        this._body.on("click", ".lsel .change", function(e){
            e.preventDefault();
            var selector = $(this).closest(".change-location").find(".selector");
            selector.toggle();
            return false;
        });

        //Submit form on change of dropdown
        $(".lsel .selector select").on("change", function(){
            $(this).closest("form").submit();
        });
    }
};