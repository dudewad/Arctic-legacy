;
/**
 * Define the application object
 * @constructor
 */
var TANG_APP;
(function () {
    function TANGUER_APP(){
        //Application settings go here
        this.settings = {};
        //All ajax requests will go to this url
        this.settings.jsonRequest = TANGUER_JSEnvVars.jsonRequest;
        //Access to other images (error, etc)
        this.settings.baseImageDir = "images/";
        //Set up the app object (auto-constructor)
        this.initialize();
    };

    TANGUER_APP.prototype = {

        /**
         * Any pre-processing
         */
        initialize:function(){
            this.ioc = new TANGUER_IOC();
            this.initIOC();
        },


        /**
         * Register all IOC items (plugins, etc) here
         */
        initIOC:function(){
            this.ioc.register("tooltip", function(){
                var t = new TANGUER_Tooltip();
                return t;
            });

            this.ioc.register("JSONCalls", function(){
                var j = new TANGUER_JSONCalls();
                return j;
            });
        },


        /**
         * Extending the actual prototype at runtime is not possible in a safe cross-browser way so we are simply
         * assigning functionality to object properties.
         * @param name  String      The name that the new property will have
         * @param obj   Object      The object that contains all the desired functionality (must be an object);
         */
        extend:function(name, obj){
            if(typeof this[name] != "undefined"){
                console.warn("Cannot extend application using name " + name + " - it is already in the namespace.");
                return;
            }
            this[name] = obj;
        }
    }


    //Initialize the app!
    $(window).on('load', function(){
        TANG_APP = new TANGUER_APP();

        //Build all required objects via IOC and create extensions
        //Only fire tooltip construction if there are tooltips on the page
        if($("[data-tooltip]").length > 0)
            TANG_APP.ioc.build("tooltip");

        //Add JSON call functionality
        TANG_APP.extend("JSONCalls", TANG_APP.ioc.build("JSONCalls"));

        //Search results page requires customizer component
        if($("html.results").length > 0)
            TANG_APP.ioc.build("customizer");

        //Vehicle picker initialization
        if($("[data-plugin=picker]").length > 0)
            TANG_APP.ioc.build("picker");

        //Validation additions
        //TODO:Refactor this... this is a sloppy place for this to go
        $.validator.addMethod("phoneUS", function(phone_number, element) {
            phone_number = phone_number.replace(/\s+/g, "");
            return this.optional(element) || phone_number.length > 9 &&
                phone_number.match(/^(\+?1-?)?(\([2-9]\d{2}\)|[2-9]\d{2})-?[2-9]\d{2}-?\d{4}$/);
        }, "Please specify a valid phone number");
    });
}());