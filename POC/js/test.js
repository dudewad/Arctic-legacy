/**
 * Created with IntelliJ IDEA.
 * User: layto_000
 * Date: 7/16/13
 * Time: 11:50 PM
 * To change this template use File | Settings | File Templates.
 */
this.name = "Window object";

var caller = function(){
    this.name = "caller";
};

caller.prototype = {
    callMe:function(closure){
        console.log("Called.");
        console.log("Pre-closure context is: " + this + " with name: " + this.name);
        if(typeof(closure) == "function")
            (closure)();
    }
};




var sender = function(caller){
    this.name = "sender";
    this.caller = caller;
};

sender.prototype = {
    makeBoundCall:function(){
        console.log("Making call...");
        console.log("Pre-call context is: " + this + " with name: " + this.name);
        var f = function(){
            console.log("Passed closure reached. Current context is:");
            console.log(this);
            console.log(this.name);
        };
        this.caller.callMe(f.bind(this));
    }
};


var c = new caller();
var s = new sender(c);
