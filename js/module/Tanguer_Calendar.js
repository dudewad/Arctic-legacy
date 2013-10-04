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
        this.body.on("click","div.c .th-list a", function(e){
            e.preventDefault();
            var thumb = $(this).closest(".e.th");
            if(thumb.hasClass("selected"))
                return false;
            var instance = $(this).closest(".c").attr("id");
            var data = {e:thumb.data("event-id")};
            var ref = {scope:scope,instanceID:instance}

            thumb.siblings().removeClass("selected");
            thumb.addClass("selected");
            Tanguer_App.JSONCalls.getQuickEvent(data,scope.ajax_getQuickEventHandler,ref);
            return false;
        });
    },



    createQuickEvent:function(e){
        '<li class="e th lesson selected" data-event-id=" ' + e.id + '">
            <a href="#">
                <div class="container">
                    <div class="labels">
                        <div class="col-time">
                            <div class="time">
                            18:30 -
                            </div>
                        </div>
                        <div class="col-price">
                        $47
                        </div>
                    </div>
                    <div class="content-padding">
                        <div class="e-content clearfix">
                            <div class="col-data">
                                <div class="title">
                                Clase: Purple Haze
                                </div>
                                <div class="details">
                                    <div class="address">
                                    6143 45th Street
                                    </div>
                                    <div class="organizer">
                                        <strong>Profesor:</strong><br>Irene Jaime, Leandra Perón
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </li>';
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
        that.createQuickEvent(e);
    }
};