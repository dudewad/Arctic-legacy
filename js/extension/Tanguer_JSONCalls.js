;
/**
 * Created by Layton Miller
 * Date: 5/28/13
 * Time: 12:26 PM
 */

function Tanguer_JSONCalls(){}

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
                return this.baseJsonURL + "?t=gqe&eid=" + params.e;
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
            callback(data[0], ref);
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



    setBaseJsonURL:function(url){
        this.baseJsonURL = url;
    }
};