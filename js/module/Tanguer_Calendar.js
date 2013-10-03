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
            var eData = {e:thumb.data("event-id")};
            thumb.siblings().removeClass("selected");
            thumb.addClass("selected");
            e.preventDefault();
            Tanguer_App.JSONCalls.getEvent(eData,scope.ajax_getEventHandler);
            return false;
        });
    },

    displayEvent:function(){

    },



    ajax_getEventHandler:function(e){
        if(e.error != undefined){
            //TODO: Handle error here
        }

        console.log(e);
    }
};