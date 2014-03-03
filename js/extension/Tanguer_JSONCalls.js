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
     * Base JSON URL builder (requires type attribute be requested)
     *
     * @param type       String          URL being requested
     *
     * @returns {string}
     */
    getURL:function(type){
        if(Tanguer_App.constants.get(type) === null)
            throw new Error("Invalid request type.");
        return Tanguer_App.constants.get("URL.JSON_BASE") + "?t=" + Tanguer_App.constants.get(type);
    },



    /**
     * Makes an AJAX call
     * @param url           String      The URL string (with parameters) to make a call
     *
     * @param callback      Closure     A callback method to use once the method is complete
     *
     * @param ref           Object      An additional data object to pass to the callback, if applicable
     *
     * @param type          String      Post or Get. Defaults to Get.
     *
     * @param postData      Object      An object containing data to post in the event that "type" is set to "Post".
     *                                  Defaults to an empty object.
     */
    call:function(url, callback, ref, type, postData){
        var successHandler = function(data, status){
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
        };

        var failureHandler = function(jqXHR, textStatus, errorThrown){
            //TODO: Handle $.post errors with actual application level handling
            console.log("json Post error. Following is the relevant data.");
            console.log(textStatus);
            console.log(errorThrown);
            //callback("<p>Oh my... there was a serious error. We apologize, but we have absolutely no idea what happened. We assure you: we're looking into it. Sorry for the inconvenience.</p>", ref || {});
        };

        //Perform the get or post call
        if(typeof type != "undefined" && type.toLowerCase() != "post")
            $.getJSON(url + "&cb=?", null, successHandler).fail(failureHandler);
        else{
            console.log("sending post");
            $.post(url + "&cb=?", (postData || {}), successHandler, "json").fail(failureHandler);

        }
    },



    /**
     * Performs a GET request
     *
     * @param type      REQUIRED    The type of get request being made. This determines the URL to be called.
     *
     * @param data      REQUIRED    The data to be used to build the query string as key/val pairs
     *
     * @param callback  REQUIRED    The callback function used to respond when the response comes back
     *
     * @param ref       REQUIRED    An additional data object to be passed to the callback.
     */
    get:function(type, data, callback, ref){
        try{
            var url = this.getURL(type);
        }
        catch(e){
            if(typeof callback == "function"){
                //TODO fix this string...
                callback("<p>Oh my... there was a serious error. We apologize. We assure you: we're looking into it. Sorry for the inconvenience.</p>", ref || {});
            }
            else{
                this.callbackFail();
            }
        }
        for(param in data){
            url += "&" + param + "=" + data[param];
        }

        $.getJSON(  url + "&cb=?",
                    null,
                    this.success.bind(this,callback,ref)
        ).fail(this.failure.bind(this,callback,ref));
    },



    /**
     * Performs a GET request
     *
     * @param type      REQUIRED    The type of get request being made. This determines the URL to be called.
     *
     * @param data      REQUIRED    The data to be used to build the query string as key/val pairs
     *
     * @param callback  REQUIRED    The callback function used to respond when the response comes back
     *
     * @param ref       REQUIRED    An additional data object to be passed to the callback.
     */
    post:function(type, data, callback, ref){
        try{
            var url = this.getURL(type);
        }
        catch(e){
            if(typeof callback == "function"){
                //TODO fix this string...
                callback("<p>Oh my... there was a serious error. We apologize. We assure you: we're looking into it. Sorry for the inconvenience.</p>", ref || {});
            }
            else{
                this.callbackFail();
            }
        }

        $.post( url,
                data || {},
                this.success.bind(this,callback,ref)
        ).fail(this.failure.bind(this,callback,ref));
    },



    success:function(callback, ref, data, status){
        //Make sure there's actually a callback
        if(typeof callback != "function")
            this.callbackFail();
        ref = ref ? ref : {};

        if(status != "success"){
            //TODO fix this string...
            callback("<p>Oh my... there was a serious error. We apologize. We assure you: we're looking into it. Sorry for the inconvenience.</p>", ref);
            return;
        }

        //Tanguer in test mode will add a 1 second delay to simulate ajax calls happening.
        if(Tanguer_App.constants.get("APP.ENVIRONMENT") == "test"){
            setTimeout(function(){
                callback(data.html ? data : data[0], ref);
            },1000);
        }
        else{
            callback(data.html ? data : data[0], ref);
        }
    },



    failure:function(callback, ref, data, status){
        //TODO: Handle the errorz
        console.log("Ajax failure.");
        console.log("Status: " + status);
        console.log("Data following...");
        console.log(data);
    },



    /**
     * Handler for when callbacks are invalid
     */
    callbackFail:function(){
        //TODO: Handle callback failure
        alert("There was a horrible error on our end, and we can't complete your request right now. We're working on it, though! We apologize, please stick with us through these tough times.");
    },



    setBaseJsonURL:function(url){
        this.baseJsonURL = url;
    }
};