;
/**
 * Created by Layton Miller
 * Date: 5/28/13
 * Time: 12:26 PM
 */

function Tanguer_JSONCalls(){
    //Requires the Tanguer_App module
    if(!Tanguer_App){
        console.warn("Tanguer_App module not detected. Cannot initialize the Tanguer_JSONCalls module.");
        return;
    }
}



Tanguer_JSONCalls.prototype = {

    /**
     * Set URLs and GET parameters
     * @param url       String          URL being requested
     *
     * @param params    JSON Object     An object of key/val pairs to add as the GET string
     *
     * @returns {string}
     */
    getURL:function(url, params){
        switch(url){
            //Requires:
            //e         The event id being requested
            case "getQuickEvent":
                return this.baseJsonURL + "?t=" + Tanguer_App.constants.get("REQUEST_TYPE.CALENDAR_GET_QUICK_EVENT") + "&eid=" + params.e;
                break;
            case "getSortFullDay":
                return this.baseJsonURL + "?t=" + Tanguer_App.constants.get("REQUEST_TYPE.CALENDAR_SORT_FULL_DAY") + "&d=" + params.d + "&sO=" + params.sO + "&p=" + params.param;
                break;
            case "getFullDay":
                return this.baseJsonURL + "?t=" + Tanguer_App.constants.get("REQUEST_TYPE.CALENDAR_FULL_DAY") + "&d=" + params.d;
                break;
            default:
                console.warn("Requested JSONCall URL does not exist.");
                return "";
        }
    },



    /**
     * Makes an AJAX call
     * @param url           String      The URL string (with parameters) to make a call
     *
     * @param callback      Closure     A callback method to use once the method is complete
     *
     * @param ref           Object      An additional data object to pass to the callback, if applicable
     */
    makeAjaxCall:function(url, callback, ref){
        $.getJSON(url + "&cb=?", null, function(data,status){
            if(status != "success"){
                //TODO: Come up with better error solution when ajax fails
                [callback]({"error":"There was an error retrieving the data. Please try refreshing the page or wait and try again later"});
            }

            //Tanguer in test mode will add a 1 second delay to simulate ajax calls happening.
            if(Tanguer_App.constants.get("APP.ENVIRONMENT") == "test"){
                setTimeout(function(){
                    callback(data[0], ref || {});
                },1000);
            }
            else{
                callback(data[0], ref || {});
            }
        });
    },



    /**
     * Gets an event with the specified ID
     * @param data      Required    The data to be used to build the query string
     *
     * @param callback  Required    The callback function used to respond when the response comes back
     *
     * @param ref       Optional    An additional data object to be passed to the callback. This is useful for targeting
     *                              the calling object, etc.
     */
    getQuickEvent:function(data, callback, ref){
        var url = this.getURL("getQuickEvent", data);
        this.makeAjaxCall(url, callback, ref);
    },



    /**
     * Gets a full day calendar view based off the date passed
     * @param data      Required    The data to be used to build the query string
     *
     * @param callback  Required    The callback function used to respond when the response comes back
     *
     * @param ref       Optional    An additional data object to be passed to the callback. This is useful for targeting
     *                              the calling object, etc.
     */
    getFullDay:function(data, callback, ref){
        var url = this.getURL("getFullDay", data);
        this.makeAjaxCall(url, callback, ref);
    },



    /**
     * Gets an event with the specified ID
     * @param data      Required    The data to be used to build the query string
     *
     * @param callback  Required    The callback function used to respond when the response comes back
     *
     * @param ref       Optional    An additional data object to be passed to the callback. This is useful for targeting
     *                              the calling object, etc.
     */
    getSortFullDay:function(data, callback, ref){
        var url = this.getURL("getSortFullDay", data);
        this.makeAjaxCall(url, callback, ref);
    },



    setBaseJsonURL:function(url){
        this.baseJsonURL = url;
    }
};