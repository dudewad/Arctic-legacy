/**
 * Created by Layton Miller
 * Date: 5/28/13
 * Time: 12:50 PM
 */

function Tanguer_IOC(){}

Tanguer_IOC.prototype = {
    register:function(name, resolver){
        if(this.isRegistered(name)){
            console.warn("Class already registered: [" + name + "]. Skipping registration.");
            return;
        }
        this.registry[name] = resolver;
    },

    isRegistered:function(name){
        return typeof this.registry[name] != "undefined";
    },

    build:function(name){
        if(this.isRegistered(name)){
            name = this.registry[name]();
            return name;
        }
        console.warn("No class registered: [" + name + "]");
    },

    registry:{}
};


