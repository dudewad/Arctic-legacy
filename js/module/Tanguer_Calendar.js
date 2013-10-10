;
/**
 * Author: Ghost
 * Date: 7/21/13
 */

var Tanguer_Calendar = function(){
    this.body = $("body");
    this.init();
};

Tanguer_Calendar.prototype = {
    init:function(){
        var scope = this;
        /**
         * Set up thumbnail click functionality
         */
        this.body.on("click","div.c .th-list a", function(e){
            e.preventDefault();
            var thumb = $(this).closest(".e.th");
            var eventID = thumb.data("event-id");
            var instance = $(this).closest(".c").attr("id");
            var data = {e:eventID};
            var ref = {scope:scope,instanceID:instance,eventID:eventID};
            var li = $("#" + instance).find("li.c-e-disp.full[data-event-id='" + eventID + "']");
            //Hide currently selected element on mobile, otherwise return false
            if(thumb.hasClass("selected")){
                if($(window).outerWidth(true) < Tanguer_App.settings.display.BREAKPOINT_TABLET_PORTRAIT){
                    if(li.is(":visible"))
                        li.slideUp();
                    else
                        li.slideDown();
                }
                return false;
            }
            thumb.siblings().removeClass("selected");
            thumb.addClass("selected");
            //If the newly selected thumb has been selected already, show it and don't make a request.
            if(li.length > 0){
                scope.hideCurrentQuickEvent(instance);
                scope.openQuickEvent(instance, eventID);
                return false;
            }
            //All checks passed, we have to make the call.
            Tanguer_App.JSONCalls.getQuickEvent(data,scope.ajax_getQuickEventHandler,ref);
            return false;
        });
    },



    openQuickEvent:function(instance, eid){
        var content = $("#" + instance).find("li.c-e-disp.full[data-event-id='" + eid + "']").eq(0);
        var thumb = $("#" + instance).find("li.th[data-event-id='" + eid + "']").eq(0);
        var offsetTop = thumb.offset().top;
        //Animate in tablet mode and snap to the item
        if($(window).outerWidth(true) < Tanguer_App.settings.display.BREAKPOINT_TABLET_PORTRAIT){
            $("body,html").animate({'scrollTop':offsetTop}, 400);
            content.slideDown();
        }
        else content.show();
    },



    createQuickEvent:function(e, data){
        var html = e.html;
        var calendar = $("#" + data.instanceID);
        var thumb = $("li.e.th[data-event-id=" + data.eventID + "]");
        this.body.trigger("Tanguer_Calendar_Quick_Event_Load", this);
        var li = $("<li>");
        li.addClass("c-e-disp full");
        li.attr("data-event-id",data.eventID);
        li.html(html);
        thumb.after(li);
        li.hide();
        data.scope.openQuickEvent(data.instanceID, data.eventID);
    },



    hideCurrentQuickEvent:function(instanceID){
        var c = $("#" + instanceID);
        c.find(".c-e-disp.full").hide();
    },



    ajax_getQuickEventHandler:function(e,ref){
        if(e.error != undefined){
            //TODO: Handle error here
        }
        var that = ref.scope;
        that.hideCurrentQuickEvent(ref.instanceID);
        that.createQuickEvent(e,ref);
    }
};