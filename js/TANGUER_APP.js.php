<?php
define("BASEDIR", __DIR__ . "/../");
require_once(BASEDIR . "/include/script/Autoloader.php");

//Application JS contants
$urlBase = constant("Utility_Constants::URL_MAIN");
$urlJSONBase = constant("Utility_Constants::URL_JSON_BASE");
$urlAssetBase = constant("Utility_Constants::URL_ASSET_BASE");
$jsBreakpointTabletPortrait = constant("Utility_Constants::JS_BREAKPOINT_TABLET_PORTRAIT");
$appEnvironment = constant("Utility_Constants::APP_ENVIRONMENT");

$js = <<<JS
;
/**
 * Define the application object
 * @constructor
 */
var Tanguer_App;
(function(){
    function TANGUER_APP(){}

    TANGUER_APP.prototype = {

        /**
         * Application settings
         */
        settings:{

            app:{
                environment:"$appEnvironment"
            },

            url:{
                URL_BASE:"$urlBase",
                URL_JSON_BASE:"$urlJSONBase",
                URL_ASSET_BASE:"$urlAssetBase",
                URL_IMAGE_BASE:"$urlAssetBase" + "image/"
            },

            display:{
                BREAKPOINT_TABLET_PORTRAIT:"$jsBreakpointTabletPortrait"
            },

            preload:[
                {
                    type:"image",
                    asset:"gui/gui-loading-333-16x16.gif"
                }
            ]
        },

        /**
         * Any pre-processing
         */
        initialize: function () {
            //jQuery selections that are available for all extensions to use- this increases efficiency of selecting it
            //only once and referencing the same object each time.
            this.jSel = {};
            this.jSel._window = $(window);
            this.jSel._body = $("body");

            this.ioc = new Tanguer_IOC();
            this.initIOC();
            //Upgrade GUI when JS capable
            this.extend("gui", this.ioc.build("gui"));
            //Add JSON call functionality
            this.extend("JSONCalls", this.ioc.build("JSONCalls"));
            //Add modal functionality
            this.extend("modal", this.ioc.build("modal"));
            this.JSONCalls.setBaseJsonURL(this.settings.url.URL_JSON_BASE);
            this.jqueryModPrototype();
            //Build all polyfill functionality
            this.polyfill();
            //Preload any items required by the dom
            this.preload();
        },


        /**
         * Register all IOC items (plugins, etc) here
         */
        initIOC: function () {
            var scope = this;

            this.ioc.register("tooltip", function(){
                return new Tanguer_Tooltip();
            });

            this.ioc.register("calendar", function(){
                return new Tanguer_Calendar();
            });

            this.ioc.register("locationSelector", function(){
                return new Tanguer_LocationSelector();
            });

            this.ioc.register("alert", function(){
                return new Tanguer_Alert();
            });

            //Extensions are singletons
            this.ioc.register("modal", function(){
                return scope.modal || new Tanguer_Modal();
            });

            //Extensions are singletons
            this.ioc.register("gui", function(){
                return scope.gui || new Tanguer_GUI();
            });

            //Extensions are singletons
            this.ioc.register("JSONCalls", function(){
                return scope.JSONCalls || new Tanguer_JSONCalls();
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
            /**
             * Disables text selection on an element. Good for fixing double-click form element selection, etc.
             */
            $.fn.disableSelection = function() {
                return this.attr('unselectable', 'on').css('user-select', 'none').on('selectstart', false);
            };



            /**
             * Validator for checking of us phone numbers
             */
            $.validator.addMethod("phoneUS", function(phone_number, element) {
                phone_number = phone_number.replace(/\s+/g, "");
                return this.optional(element) || phone_number.length > 9 &&
                    phone_number.match(/^(\+?1-?)?(\([2-9]\d{2}\)|[2-9]\d{2})-?[2-9]\d{2}-?\d{4}$/);
            }, "Please specify a valid phone number");



            /**
             * Creates a "loading" object that hovers over the targeted objects until a call to $.hideLoader() is made.
             * Includes window resize listener/calculation
             */
            $.fn.showLoader = function() {
                //Allows for layout refreshins on window resize
                var refreshLayout = function(parent, loader){
                    var w = parent.outerWidth() + "px";
                    var h = parent.outerHeight() + "px";
                    loader.css({width:w,height:h});
                };

                var t = $(this);
                //One loader at a time
                var loader = t.find(".dynamic-loader");
                if(!loader.length){
                    loader = "<div class='dynamic-loader' style='display:none'><span class='indicator'></span></div>";
                    t.prepend(loader);
                    loader = t.find(".dynamic-loader");
                }
                refreshLayout(t,loader);
                loader.fadeIn();
                loader.css({position:"absolute",zIndex:9999});
            };



            /**
             * Hides/removes a "loading" object that was created by $.showLoader().
             * Removes window resize listener created by $.showLoader()
             */
            $.fn.hideLoader = function(){
                var t = $(this);
                var loader = t.find(".dynamic-loader");
                loader.fadeOut(400);
            }
        },



        /**
         * Add any polyfills that we will need
         */
        polyfill:function(){
            if (!Date.now) {
                Date.now = function now() {
                    return new Date().getTime();
                };
            }
            //When console is unavailable, fail silently. If in test environment, fire alerts instead.
            if(!window.console && !window.console.log){
                window.console = {};
                if(this.settings.app.environment == "test"){
                    window.console.log = function(str){alert(str)};
                }
                else{
                    window.console.log = function(str){};
                }
            }
        },



        /**
         * Application asset preloader
         */
        preload:function(){
            var length = this.settings.preload.length;
            var env = this.settings.app.environment;
            var obj = null;
            var imageBase = this.settings.url.URL_IMAGE_BASE;
            for(var i = 0; i < length; i++){
                obj = this.settings.preload[i];
                //New img object for each loop
                switch(obj.type){
                    case "image":
                        var img = document.createElement("IMG");
                        img.src = imageBase + obj.asset;
                        //Unset each image after it loads
                        img.onload = function(){
                            img = null;
                        };
                        //Alert developer if an asset is broken
                        if(env === "test"){
                            img.onerror = function(){
                                console.log("Error loading auto-image at global app level: '" + this.src + "'. Check the url and try again.");
                            };
                        }
                        break;
                    default:
                        continue;
                        break;
                }
;           }
        }
    };



    //Initialize the app!
    $(document).ready(function(){
        Tanguer_App = new TANGUER_APP();
        //Initialize the app
        Tanguer_App.initialize();

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

        //All alerts should be handled; we may want to add alerts dynamically
        //so this needs to be on the page in any case.
        Tanguer_App.ioc.build("alert");
    });
}());
JS;
header("Content-type: text/javascript");
echo $js;