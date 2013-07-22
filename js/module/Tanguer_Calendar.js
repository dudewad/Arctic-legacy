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
        $("div.c.full-day a").on("click",function(e){

            e.preventDefault();
            return false;
        });
    },

    displayEvent:function(){

    }
};