/**
 * Author: Ghost
 * Date: 12/14/13
 */

var Tanguer_Modal = function(){
    //Requires the Tanguer_App module
    if(!Tanguer_App){
        console.warn("Tanguer_App module not detected. Cannot initialize the Tanguer_Modal module.");
        return;
    }

    //Try to use the pre-selected common jquery selections first
    this._body = Tanguer_App.jSel._body || $("body");
    this._window = Tanguer_App.jSel._window || $(window);
    this.currentID = 0;

    //Modal settings
    this.settings = {};

    //Empty content
    this.content = "";
};

Tanguer_Modal.prototype = {
    /**
     * Set constants here
     */
    constant:function(constant){
        switch(constant){
            case "idPrefix":
                return "m";
                break;
            case "transitionSpeed":
                return 200;
                break;
            case "modalClass":
                return "m";
                break;
            default:
                return null;
                break;
        }
    },



    /**
     * Opens a modal using the object settings specified by the constructor.
     * @return string   The DOM ID of the modal that was created so that it can be closed
     */
    open:function(params){
        var scope = this;
        this.setParams(params);
        var mid = this.getNextID();
        var wrapperClass = "m-wrapper";
        wrapperClass += this.settings.hasBackground ? " hasBG" : "";
        var html = "<div class='" + wrapperClass + "' id='" + mid + "'>" +
                        "<div class='" + this.constant("modalClass") + " clearfix'>" + this.content + "</div>" +
                    "</div>";
        this._body.append(html);
        var modal = $("#" + mid);
        //Need to know the height of the modal, so make sure it has height in the dom
        modal.css({display:"block",visibility:"hidden"})
        this.vCenterModal(mid);
        modal.css({display:"none",visibility:"visible"});
        modal.fadeIn(scope.constant("transitionSpeed"));

        //On click of the wrapper only, hide/remove the modal
        this._body.on("click.modal" + mid,"#" + mid + ".m-wrapper",function(e){
            if($(e.target).hasClass("m-wrapper") || $(e.target).hasClass("close")){
                scope.close(mid);
            }
        });

        //On window resize, re-center the modal
        this._window.on("resize.modal" + mid,function(){
            scope.vCenterModal(mid);
        });

        return mid;
    },



    close:function(mid){
        var modal = $("#" + mid);
        //Fade the modal out and then remove it from the DOM.
        modal.fadeOut(this.constant("transitionSpeed"), function(){
            $(this).remove()
        });
        //Remove listeners since it no longer applies
        this._body.off("click.modal" + mid);
        this._window.off("resize.modal" + mid);
    },



    /**
     * Centers the "target" vertically with regards to the "ref" (typically "target" will be a child of "ref")
     * @param mid   String      The DOM ID of the modal being centered
     */
    vCenterModal:function(mid){
        var modal = $("#" + mid + " .m");
        var winHeight = this._window.height();
        var modHeight = modal.outerHeight(true);
        var top;
        if(modHeight > winHeight - 20){
            top = "10px";
        }
        else{
            top = (winHeight * .5) - (modHeight * .5);
        }
        modal.css({position:"relative",top:top});
    },



    /**
     * Retrieves an ID for the form for a calendar form element that is being output to HTML. Auto-increments the
     * local static variable self::$formID
     * @return int
     */
    getNextID:function(){
        this.currentID++;
        return this.constant("idPrefix") + this.currentID;
    },



    /**
     * Set the object's parameters including content and other settings
     * @param params
     */
    setParams:function(params){
        if(params){
            var modal = $("#" + params.target).eq(0);
            this.content = $(modal).html() || null;
            this.settings.hasBackground = params.hasBackground || false;
        }
    }
};