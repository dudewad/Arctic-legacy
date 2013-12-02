;
/**
 * Author: Ghost
 * Date: 12/2/13
 */

var Tanguer_LocationSelector = function(){
    this._body = $("body");
    this.init();
};

Tanguer_LocationSelector.prototype = {
    init:function(){
        var scope = this;
        $("body").on("click", ".lsel .change", function(e){
            e.preventDefault();
            $(this).closest(".change-location").find(".selector").toggle();
            return false;
        });

        //Submit form on change of dropdown
        $(".lsel .selector select").on("change", function(){
            $(this).closest("form").submit();
        });
    }
};