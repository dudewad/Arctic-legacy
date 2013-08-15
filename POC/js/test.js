/**
 * Created with IntelliJ IDEA.
 * User: layto_000
 * Date: 7/16/13
 * Time: 11:50 PM
 * To change this template use File | Settings | File Templates.
 */

$("document").ready(function(){
    $("#debug").html($("html").attr("class"));

    //All onclick events for event objects
    $("body").on("click",".e",function(){
        if($(this).hasClass("th")){

        }
    })
});