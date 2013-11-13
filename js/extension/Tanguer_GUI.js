/**
 * Author: Ghost
 * Date: 11/1/13
 */

var Tanguer_GUI = function(){
    this.init();
};

Tanguer_GUI.prototype = {
    init:function(){
        this.buttons();
        this.indicators();
    },

    indicators:function(){
        var span = $("<span>");
        span.addClass("js-indicator");
        $(".hasIndicator").prepend(span);
    },

    buttons:function(){
        var span = $("<span>");
        span.addClass("js-indicator");
        $("a.button").prepend(span);
    }
};