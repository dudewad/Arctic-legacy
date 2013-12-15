/**
 * Author: Ghost
 * Date: 11/1/13
 */

var Tanguer_GUI = function(){
    this.init();
};

Tanguer_GUI.prototype = {
    init:function(){
        this.refresh("");
    },



    /**
     * Upgrades all items that are marked to have indicators when JS is enabled
     * @param parent    String      The jquery selection of the outermost element (the parent element)
     */
    indicators:function(parent){
        var span = $("<span>");
        span.addClass("js-indicator");
        $(parent + " .hasIndicator").prepend(span);
    },



    /**
     * Upgrades all buttons that need js indicators to have them.
     * @param parent    String      The jquery selection of the outermost element (the parent element)
     */
    buttons:function(parent){
        var span = $("<span>");
        span.addClass("js-indicator");
        console.log(parent + " a.button");
        $(parent + " a.button").prepend(span);
    },


    /**
     * Refreshes the GUI and upgrades all non-js controls to have js styles.
     * For dynamically loaded items, the GUI will need a refresh on specific parts only. Call this and pass the ID of
     * the outer element and it will refresh just that piece of the UI.
     * @param parent    String      The jquery selection of the outermost element (the parent element)
     */
    refresh:function(parent){
        this.buttons(parent);
        this.indicators(parent);
    }
};