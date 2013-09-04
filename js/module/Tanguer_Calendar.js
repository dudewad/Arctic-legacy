;
/**
 * Author: Ghost
 * Date: 7/21/13
 */

var Tanguer_Calendar = function(){
    this.init();
};

Tanguer_Calendar.prototype = {
    init:function(){
        var scope = this;
        $("body").on("click","div.c .th-list a", function(e){
            var thumb = $(this).closest(".e.th");
            thumb.siblings().removeClass("selected");
            thumb.addClass("selected");
            e.preventDefault();
            return false;
        });
    },

    displayEvent:function(){

    }
};