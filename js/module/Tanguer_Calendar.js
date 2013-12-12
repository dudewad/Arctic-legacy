;
/**
 * Author: Ghost
 * Date: 7/21/13
 *
 * This module handles all calendar functionality for the Tánguer Calendar system
 */

var Tanguer_Calendar = function(){
    //Requires the Tanguer_App module
    if(!Tanguer_App){
        console.log("Tanguer_App module not detected. Cannot initialize the Tanguer_Calendar module.");
        return;
    }
    this._body = $("body");
    this._window = $(window);
    this.breakpointTabletPortrait = Tanguer_App.settings.display.BREAKPOINT_TABLET_PORTRAIT;
    this.displayMode = null;

    //Set up hiding on body click
    this._body.on("click",function(e){
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

    /**
     * Init method- functionality comments are inline
     */
    init:function(){
        var scope = this;
        //Set current display mode (mobile or desktop)
        this.displayMode = this.setDisplayMode();

        //Set up thumbnail click functionality
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
                if(scope._window.innerWidth() < scope.breakpointTabletPortrait){
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
            //Needs to create and fill a "loading" area for the new event
            scope.hideCurrentQuickEvent(instance);
            scope.createQuickEventLoadingPlaceholder(thumb,eventID);
            scope.openQuickEvent(instance,eventID);
            //Test environment is too fast. Add 1 second delay for "ajax simulation" purposes
            Tanguer_App.JSONCalls.getQuickEvent(data,scope.ajax_getQuickEventHandler,ref);
            return false;
        });

        //Window resize event needs to have a few modifications
        this._window.resize(function(){
            //Handle any tasks associated from mobile to desktop version switch
            if(scope._window.innerWidth() >= scope.breakpointTabletPortrait && scope.displayMode == "mobile"){
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

        this._body.on("click", ".c.picker .preview", function(){
            var visualizer = $(this).closest(".c.picker").find(".visualizer");
            visualizer.toggle();
        });

        //Disable selection of sort options for aesthetic purposes
        $(".sort").disableSelection();
    },


    /**
     * Handles data returned when a "quick event" is requested
     * @param e     Object      An object representation of the event, containing HTML of the object for viewing
     * @param ref   Object      A reference object passed by the original requester of the AJAX call that will contain
     *                          data such as scope and any other reference variables needed by the receiving method.
     */
    ajax_getQuickEventHandler:function(e,ref){
        if(e.error != undefined){
            //TODO: Handle error here
            console.log("getQuickEvent error in Tanguer_Calendar.js. Error handler not specified...")
        }
        var that = ref.scope;
        that.hideCurrentQuickEvent(ref.instanceID);
        that.createQuickEvent(e,ref);
    },



    /**
     * Creates a placeholder "event" that displays "loading" while the currently selected event is coming in via AJAX,
     * if this is applicable. Events that have already loaded will skip this entirely.
     * @param thumb     jQuery Selection        A jQuery selection of the original thumb that was clicked
     * @param eventID   Integer                 The event ID of the thumbnail that was clicked
     */
    createQuickEventLoadingPlaceholder:function(thumb,eventID){
        var li = $("<li>");
        li.addClass("c-e-disp full loading");
        li.attr("data-event-id",eventID);
        thumb.after(li);
        li.hide();
    },


    /**
     * Adds a full event to the calendar view system. A "quick event" is an event that lives in the single-day view
     * calendar and is intended to be quickly retrieved/viewed.
     * @param e     Object      The object containing the quick event data, under a e.html variable
     * @param ref   Object      A reference object passed by the original requester of the AJAX call that will contain
     *                          data such as scope and any other reference variables needed by the receiving method.
     */
    createQuickEvent:function(e, ref){
        var html = e.html;
        var li = $("li.c-e-disp.full[data-event-id=" + ref.eventID + "]");
        li.removeClass("loading");
        li.html(html);
        ref.scope.openQuickEvent(ref.instanceID, ref.eventID);
    },


    /**
     * Once a quick event has loaded it needs to be opened for display. This method handles that, along with any special
     * handling required across layout sizes (mobile vs desktop, etc)
     * @param instanceID    String      The DOM ID of the calendar instance that is being targeted
     * @param eid           String      The event ID of the event that is being opened
     */
    openQuickEvent:function(instanceID, eid){
        var cal = $("#" + instanceID);
        var content = cal.find("li.c-e-disp.full[data-event-id='" + eid + "']").eq(0);
        var thumb = cal.find("li.th[data-event-id='" + eid + "']").eq(0);
        //Animate in tablet mode and snap to the item
        if(this._window.outerWidth(true) < this.breakpointTabletPortrait){
            var offsetTop = thumb.offset().top;
            $("body,html").animate({'scrollTop':offsetTop}, 400);
            content.slideDown();
        }
        else content.fadeIn(200);
    },



    /**
     * Hides the currently displaying quick event so that the space can be used to display something else
     * @param instanceID    String      The DOM ID of the quick event being displayed
     */
    hideCurrentQuickEvent:function(instanceID){
        var c = $("#" + instanceID);
        c.find(".c-e-disp.full").hide();
    },



    /**
     * Sets whether or not the display mode is "mobile" or "desktop" so that quick events know how to act
     */
    setDisplayMode:function(){
        this.displayMode = this._window.innerWidth() < this.breakpointTabletPortrait ? "mobile" : "desktop";
    }
};