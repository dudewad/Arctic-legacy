;
/**
 * Created by Layton Miller
 * Date: 5/28/13
 * Time: 12:26 PM
 */

function Tanguer_JSONCalls(){
    this.baseJsonURL = "http://localhost/tanguer/jsonRequest.php";
}

Tanguer_JSONCalls.prototype = {

    /**
     * Set URLs and GET parameters
     * @param url       String          URL being requested
     * @param params    JSON Object     An object of key/val pairs to add as the GET string
     * @returns {string}
     */
    getURL:function(url, params){
        switch(url){
            //Requires:
            //e         The event id being requested
            case "getEvent":
                return this.baseJsonURL + "?t=ge&eid=" + params.e;
                break;
            default:
                console.warn("Requested JSONCall URL does not exist.");
                return "";
        }
    },



    /**
     * Makes an AJAX call
     * @param url           String      The URL string (with parameters) to make a call
     * @param callback      Closure     A callback method to use once the method is complete
     */
    makeAjaxCall:function(url, callback){
        console.log(url);
        $.getJSON(url + "&callback=?", null, function(data,status){
            console.log(status);
            if(status != "success"){
                //TODO: Come up with better error solution when ajax fails
                [callback]({"error":"There was an error retrieving the data. Please try refreshing the page or wait and try again later"});
            }
            callback(data);
        });
    },


    /**
     * Gets an event with the specified ID
     */
    getEvent:function(data, callback){
        var url = this.getURL("getEvent", data);
        this.makeAjaxCall(url, callback);
    }




     /**
      * TODO: delete this once a real call is in place
      * The following is an example call


    getGAQModels:function(data, callback){
        var url = this.getURL("getGAQModels", {makeID:data.selectedID});
        this.makeAjaxCall(url, callback);
    }


      */
};