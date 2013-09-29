;
/**
 * Define the application object
 * @constructor
 */
var Tanguer_App;
(function () {
    function Tanguer_App(){
        //Application settings go here
        this.settings = {};
        //Access to other images (error, etc)
        this.settings.baseImageDir = "images/";
        //Set up the app object (auto-constructor)
        this.initialize();
    };

    Tanguer_App.prototype = {

        /**
         * Any pre-processing
         */
        initialize:function(){
            this.ioc = new Tanguer_IOC();
            this.initIOC();
        },


        /**
         * Register all IOC items (plugins, etc) here
         */
        initIOC:function(){
            this.ioc.register("tooltip", function(){
                var t = new Tanguer_Tooltip();
                return t;
            });

            this.ioc.register("JSONCalls", function(){
                var j = new Tanguer_JSONCalls();
                return j;
            });

            this.ioc.register("calendar", function(){
                var c = new Tanguer_Calendar();
                return c;
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
    $(document).ready(function(){
        Tanguer_App = new Tanguer_App();

        //Build all required objects via IOC and create extensions
        //Only fire tooltip construction if there are tooltips on the page
        if($("[data-tooltip]").length > 0)
            Tanguer_App.ioc.build("tooltip");

        //Add calendar to the page, if applicable
        if($(".c").length > 0)
            var cal = Tanguer_App.ioc.build("calendar");

        //Add JSON call functionality
        //Tanguer_App.extend("JSONCalls", TANG_APP.ioc.build("JSONCalls"));

        //Validation additions
        //TODO:Refactor this... this is a sloppy place for this to go
        $.validator.addMethod("phoneUS", function(phone_number, element) {
            phone_number = phone_number.replace(/\s+/g, "");
            return this.optional(element) || phone_number.length > 9 &&
                phone_number.match(/^(\+?1-?)?(\([2-9]\d{2}\)|[2-9]\d{2})-?[2-9]\d{2}-?\d{4}$/);
        }, "Please specify a valid phone number");
    });
}());