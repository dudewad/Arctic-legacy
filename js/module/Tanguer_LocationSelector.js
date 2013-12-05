;
/**
 * Author: Ghost
 * Date: 12/2/13
 */

var Tanguer_LocationSelector = function(){
    this._body = $("body");
    //Set up hiding on body click
    $("body").on("click",function(e){
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
    init:function(){
        var scope = this;
        $("body").on("click", ".lsel .change", function(e){
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