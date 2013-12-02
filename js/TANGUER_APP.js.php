<?php
define("BASEDIR", __DIR__ . "/../");
require_once(BASEDIR . "/include/script/Autoloader.php");

//Application JS contants
$urlJSONBase = constant("Utility_Constants::URL_JSON_BASE");
$jsBreakpointTabletPortrait = constant("Utility_Constants::JS_BREAKPOINT_TABLET_PORTRAIT");

$js = <<<JS
;
/**
 * Define the application object
 * @constructor
 */
var Tanguer_App;
(function () {
    function TANGUER_APP(){
        //Application settings go here
        this.settings = {};
        this.settings.url = {};
        this.settings.url.URL_JSON_BASE = "$urlJSONBase";
        this.settings.display = {};
        this.settings.display.BREAKPOINT_TABLET_PORTRAIT = "$jsBreakpointTabletPortrait";
        //Access to other images (error, etc)
        this.settings.baseImageDir = "images/";
        //Set up the app object (auto-constructor)
        this.initialize();
    }

    TANGUER_APP.prototype = {

        /**
         * Any pre-processing
         */
        initialize: function () {
            this.ioc = new Tanguer_IOC();
            this.initIOC();
            //Upgrade GUI when JS capable
            this.extend("gui", this.ioc.build("gui"));
            //Add JSON call functionality
            this.extend("JSONCalls", this.ioc.build("JSONCalls"));
            this.JSONCalls.setBaseJsonURL(this.settings.url.URL_JSON_BASE);
            this.jqueryModPrototype();
        },


        /**
         * Register all IOC items (plugins, etc) here
         */
        initIOC: function () {
            this.ioc.register("tooltip", function () {
                return new Tanguer_Tooltip();
            });

            this.ioc.register("JSONCalls", function () {
                return new Tanguer_JSONCalls();
            });

            this.ioc.register("calendar", function () {
                return new Tanguer_Calendar();
            });

            this.ioc.register("gui", function () {
                return new Tanguer_GUI();
            });

            this.ioc.register("locationSelector", function () {
                return new Tanguer_LocationSelector();
            });
        },



        /**
         * Extending the actual prototype at runtime is not possible in a safe cross-browser way so we are simply
         * assigning functionality to object properties.
         * @param name  String      The name that the new property will have
         * @param obj   Object      The object that contains all the desired functionality (must be an object);
         */
        extend: function (name, obj) {
            //Don't allow overrides
            if (typeof this[name] != "undefined") {
                console.warn("Cannot extend application using name " + name + " - it is already in the namespace.");
                return;
            }
            this[name] = obj;
        },



        /**
        * Upgrade jQuery to allow us to do extra things that weren't initially possible
        */
        jqueryModPrototype:function(){
            //Disables text selection on an element. Good for fixing double-click form element selection, etc.
            $.fn.disableSelection = function() {
                return this.attr('unselectable', 'on').css('user-select', 'none').on('selectstart', false);
            };

            //Validator for checking of us phone numbers
            $.validator.addMethod("phoneUS", function(phone_number, element) {
                phone_number = phone_number.replace(/\s+/g, "");
                return this.optional(element) || phone_number.length > 9 &&
                    phone_number.match(/^(\+?1-?)?(\([2-9]\d{2}\)|[2-9]\d{2})-?[2-9]\d{2}-?\d{4}$/);
            }, "Please specify a valid phone number");
        }
    };



    //Initialize the app!
    $(document).ready(function(){
        Tanguer_App = new TANGUER_APP();

        //Build all required objects via IOC and create extensions
        //Only fire tooltip construction if there are tooltips on the page
        if($("[data-tooltip]").length > 0)
            Tanguer_App.ioc.build("tooltip");

        //Add calendar to the page, if applicable
        if($(".c").length > 0)
            Tanguer_App.ioc.build("calendar");

        //If any location selector modules are present, add them to the page
        if($(".lsel").length > 0)
            Tanguer_App.ioc.build("locationSelector");
    });
}());
JS;
header("Content-type: text/javascript");
echo $js;