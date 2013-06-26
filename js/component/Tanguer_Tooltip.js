/**
 * Created by Layton Miller
 * Date: 5/7/13
 * Time: 3:31 PM
 */


/**
 * See accompanying readme file for usage information
 * REQUIRES JQUERY
 * @constructor
 */
function Tanguer_Tooltip(){
    this.initialize();
}

Tanguer_Tooltip.prototype = {
    initialize:function(){
        var scope = this;
        //Require jQuery
        if(typeof $ == "undefined"){
            throw new Error("jQuery not detected. Tooltips will not function normally.");
        }

        //Add mouseover and mouseout events to all tooltips on the page
        $("[data-tooltip]").on("mouseover",function(){scope.toggle(this, "over")}).on("mouseout", function(){scope.toggle(this, "out")});
    },

    toggle:function(target, state){
        var tooltip = $("#" + $(target).data("tooltip"));
        //Add a class to the trigger specifying that it has been hovered
        if($(target).hasClass("tooltip-trigger-hover")){
            $(target).removeClass("tooltip-trigger-hover");
        }
        else{
            $(target).addClass("tooltip-trigger-hover");
        }

        switch($(target).data("tooltip-type")){
            case "frame":
                tooltip.css(this.calculatePosition(target));
                break;
            case "popout":
                tooltip.css(this.calculatePosition(target));
                break;
            default:
                console.warn("Unknown tooltip type!");
                break;
        }


        //Cannot use tooltip.toggle() because if the mouse is over a tooltip when the page loads,
        //its visibility states will be inverted (visible on mouseout, hidden on mouseover)
        if(state == "over")
            tooltip.show();
        else
            tooltip.hide();
    }, //End toggle

    /**
     * Calculates the position for popout tooltips.
     *
     * @param target    DOM ELEMENT     REQUIRED    The element that the tooltip will be "pointing to" or referencing
     *
     * @returns {}  An object describing the CSS properties of the position containing "top" and "left" in absolute
     *              position terms
     */
    calculatePosition:function(target){
        var type = $(target).data("tooltip-type").toLowerCase();
        var position = $(target).data("tooltip-position").toLowerCase();
        var tooltip = $("#" + $(target).data("tooltip"));

        //Make sure the proper positioning and type strings were supplied
        if(type == "frame"){
            //Get the frame content box now (needed before changes occur)
            var frameContent;
            frameContent = $("#" + $(target).data("tooltip") + " .tooltip-frame-content")
            if(position.length != 1 && position != "auto"){
                console.warn("Invalid position parameter for tooltip. Tooltip will not work properly. Be sure to set data-tooltip-position to either 'auto' or a one-character spec string as outlined in the readme.");
                return {left:0,top:0};
            }
            //Frame types use a different target, set that here
            if($(target).data("tooltip-target")){
                target = $("#" + $(target).data("tooltip-target"));
            }
        }
        else if(type == "popout"){
            if(position.length != 6 && position != "auto"){
                console.warn("Invalid position parameter for tooltip. Tooltip will not work properly. Be sure to set data-tooltip-position to either 'auto' or a six-character spec string as outlined in the readme.");
                return {left:0,top:0};
            }
        }
        else{
            console.warn("Tooltip-type attribute set to invalid value. Review readme for correct values.");
            return {left:0,top:0};
        }

        //Add a class to the target specifying that it has been hovered
        if($(target).hasClass("tooltip-target-active")){
            $(target).removeClass("tooltip-target-active");
        }
        else{
            $(target).addClass("tooltip-target-active");
        }

        var targetPos = $(target).position();
        var targetWidth = $(target).outerWidth();
        var targetHeight = $(target).outerHeight();
        var tooltipWidth = tooltip.outerWidth();
        var tooltipHeight = tooltip.outerHeight();
        var hOffset = targetPos.left + parseInt($(target).css("marginLeft"));
        var vOffset = targetPos.top + parseInt($(target).css("marginTop"));
        var css = {};

        //Reset position parameters automatically for auto
        if(position =="auto"){
            var winHCenter = $(window).width() * .5;
            var winVCenter = $(window).height() * .5;
            if(type == "frame"){
                position = (vOffset + (targetHeight *.5)) < winVCenter ? "b" : "t";
            }
            else{
                var horizontalParameter = (vOffset + (targetWidth *.5)) > winHCenter ? "hrr" : "hll";
                var verticalParameter = (hOffset + (targetHeight *.5)) < winVCenter ? "vbt" : "vtb";
                position = horizontalParameter + verticalParameter;
            }
        }

        //Handles frame positioning
        if(type == "frame"){
            frameContent.css({margin:0});
            vOffset -= parseInt((tooltip.css("border-top-width")));
            hOffset -= parseInt((tooltip.css("border-left-width")));
            switch(position){
                case "t":
                    //We have to set the tooltip width now because otherwise the width
                    //will change after we have set the vertical positioning, which can
                    //change height and require a re-calculation
                    tooltip.css({width:targetWidth});
                    vOffset = vOffset - tooltip.outerHeight();
                    frameContent.css({marginBottom:targetHeight});
                    css = {top:vOffset,left:hOffset};
                    break;
                case "r":
                    frameContent.css({marginLeft:targetWidth, height:targetHeight - frameContent.innerHeight()});
                    css = {top:vOffset,left:hOffset, height:targetHeight};
                    break;
                case "b":
                    frameContent.css({marginTop:targetHeight});
                    css = {top:vOffset,left:hOffset, width:targetWidth};
                    break;
                case "l":
                    frameContent.css({marginRight:targetWidth, height:targetHeight - frameContent.innerHeight()});
                    hOffset = hOffset - targetWidth - (parseInt(frameContent.css("padding")) * 2);
                    css = {top:vOffset,left:hOffset, height:targetHeight};
                    break;
                default:
                    console.warn("Invalid position provided for frame popup. Consult the readme for acceptable values.");
                    return {};
                    break;
            }
            return css;
        }
        //Handles popout positioning
        else{
            var hSpec = position.substring(position.indexOf("h"), position.indexOf("h") + 3);
            var vSpec = position.substring(position.indexOf("v"), position.indexOf("v") + 3);
            var hRef = hSpec[1];
            var vRef = vSpec[1];
            var hSide = hSpec[2];
            var vSide = vSpec[2];

            //No left or top cases needed
            switch(hRef){
                case "c":
                    hOffset = hOffset + (targetWidth * .5);
                    break;
                case "r":
                    hOffset = hOffset + targetWidth;
                    break;
            }
            switch(vRef){
                case "c":
                    vOffset = vOffset + (targetHeight * .5);
                    break;
                case "b":
                    vOffset = vOffset + targetHeight;
                    break;
            }
            switch(hSide){
                case "c":
                    hOffset = hOffset - (tooltipWidth * .5);
                    break;
                case "r":
                    hOffset = hOffset - tooltipWidth;
                    break;
            }
            switch(vSide){
                case "c":
                    vOffset = vOffset - (tooltipHeight * .5);
                    break;
                case "b":
                    vOffset = vOffset - tooltipHeight;
                    break;
            }
            css = {left:hOffset,top:vOffset};
            console.log(css);
            //If the popout has an arrow, utilize it
            var arrow = $("#" + $(target).data("tooltip") + " .tooltip-arrow");
            if(arrow.length){
                var arrowLeft;
                var arrowTop;
                var arrowWidth = arrow.outerWidth();
                var arrowHeight = arrow.outerHeight();
                var arrowCSS = {};
                tooltip.removeClass("has-arrow-left");
                tooltip.removeClass("has-arrow-top");
                tooltip.removeClass("has-arrow-right");
                tooltip.removeClass("has-arrow-bottom");
                //Tooltip is to the right of target
                if(hSpec == "hlr"){
                    tooltip.addClass("has-arrow-right");
                    arrow.addClass("tooltip-arrow-right");
                    arrowLeft = tooltipWidth;
                    arrowTop = tooltipHeight * .5 - arrowHeight * .5;
                    arrowCSS = {top:arrowTop,left:arrowLeft};
                }
                //Tooltip is to the right of target
                else if(hSpec == "hrl"){
                    tooltip.addClass("has-arrow-left");
                    arrow.addClass("tooltip-arrow-left");
                    arrowLeft = -10;
                    arrowTop = tooltipHeight * .5 - arrowHeight * .5;
                    arrowCSS = {top:arrowTop,left:arrowLeft};
                }
                //Tooltip is above target
                else if(vSpec == "vtb"){
                    tooltip.addClass("has-arrow-bottom");
                    arrow.addClass("tooltip-arrow-bottom");
                    arrowLeft = tooltipWidth * .5 - arrowWidth * .5;
                    arrowTop = tooltipHeight;
                    arrowCSS = {top:arrowTop,left:arrowLeft};
                }
                //Tooltip is below target
                else if(vSpec == "vbt"){
                    tooltip.addClass("has-arrow-top");
                    arrow.addClass("tooltip-arrow-top");
                    arrowLeft = tooltipWidth * .5 - arrowWidth * .5;
                    arrowTop = -arrowHeight;
                    arrowCSS = {top:arrowTop,left:arrowLeft};
                }
                arrow.css(arrowCSS);
            }

            return css;
        }
    } //End Calculate Position
}