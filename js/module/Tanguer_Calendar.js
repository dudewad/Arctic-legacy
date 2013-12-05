;
/**
 * Author: Ghost
 * Date: 7/21/13
 */

var Tanguer_Calendar = function(){
    this._body = $("body");
    this.tabletBreakpoint = Tanguer_App.settings.display.BREAKPOINT_TABLET_PORTRAIT;
    this.displayMode = null;

    //Set up hiding on body click
    $("body").on("click",function(e){
        var el = $(e.target);
        //If the user clicked inside a picker element we won't want to hide that one.
        $(".c.picker .visualizer:visible").each(function(){
            if(!el.hasClass(".c.picker") && el.closest(".c.picker").length == 0)
                $(this).hide();
        })
    });

    this.init();
};

Tanguer_Calendar.prototype = {
    init:function(){
        var scope = this;
        //Set current display mode (mobile or desktop)
        this.displayMode = this.setDisplayMode();

        /**
         * Set up thumbnail click functionality
         */
        this._body.on("click","div.c .th-list a", function(e){
            e.preventDefault();
            var thumb = $(this).closest(".e.th");
            var eventID = thumb.data("event-id");
            var instance = $(this).closest(".c").attr("id");
            var data = {e:eventID};
            var ref = {scope:scope,instanceID:instance,eventID:eventID};
            var li = $("#" + instance).find("li.c-e-disp.full[data-event-id='" + eventID + "']");
            //Hide currently selected element on mobile, otherwise return false
            if(thumb.hasClass("selected")){
                if($(window).innerWidth() < scope.tabletBreakpoint){
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

        //Window resize event needs to have a few modifications
        $(window).resize(function(){
            //Handle any tasks associated from mobile to desktop version switch
            if($(window).innerWidth() >= scope.tabletBreakpoint && scope.displayMode == "mobile"){
                var selectedEID = $(".c .th.selected").eq(0).data("event-id");
                var selectedEvent = $(".c .c-e-disp.full[data-event-id='" + selectedEID + "']");
                selectedEvent.show();
            }
            scope.setDisplayMode();
        });

        //Add click events to the js version of the sorts
        this._body.on("click",".c .sort label",function(e){
                if(e.target.tagName.toLowerCase() !== 'input') {
                    var label = $(this);
                    label.hasClass("checked") ? label.removeClass("checked") : label.addClass("checked");

                    if(label.hasClass("milonga")){
                        label.closest(".c").find(".e.milonga").toggle();
                    }
                    else if(label.hasClass("lesson")){
                        label.closest(".c").find(".e.lesson").toggle();
                    }
                    else if(label.hasClass("practica")){
                        label.closest(".c").find(".e.practica").toggle();
                    }
                    else if(label.hasClass("show")){
                        label.closest(".c").find(".e.show").toggle();
                    }
                }
        });

        //Advanced sort options modal
        this._body.on("click",".c .sort .button.advanced", function(){
            Tanguer_App.modal($(this).closest("c").find(".sort.advanced"));
            return false;
        });

        $("body").on("click", ".c.picker .preview", function(){
            var visualizer = $(this).closest(".c.picker").find(".visualizer");
            console.log(visualizer);
            visualizer.toggle();
        });

        //Disable selection of sort options for aesthetic purposes
        $(".sort").disableSelection();
    },



    openQuickEvent:function(instance, eid){
        var cal = $("#" + instance);
        var content = cal.find("li.c-e-disp.full[data-event-id='" + eid + "']").eq(0);
        var thumb = cal.find("li.th[data-event-id='" + eid + "']").eq(0);
        var offsetTop = thumb.offset().top;
        //Animate in tablet mode and snap to the item
        if($(window).outerWidth(true) < this.tabletBreakpoint){
            $("body,html").animate({'scrollTop':offsetTop}, 400);
            content.slideDown();
        }
        else content.show();
    },



    createQuickEvent:function(e, data){
        var html = e.html;
        var thumb = $("li.e.th[data-event-id=" + data.eventID + "]");
        this._body.trigger("Tanguer_Calendar_Quick_Event_Load", this);
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
    },



    setDisplayMode:function(){
        this.displayMode = $(window).innerWidth() < this.tabletBreakpoint ? "mobile" : "desktop";
    }
};