<?php
define("BASEDIR", __DIR__ . "/../../");
require_once(BASEDIR . "/include/script/Autoloader.php");
$baseAssetURL = Utility_Constants::URL_ASSET_BASE;

$css = <<<CSS
@charset "utf-8";
/* CSS Document */

html{
    padding:0;
    margin:0;
}

body{
    padding:0;
    font-family:Lato, Arial, sans-serif;
    font-size:10px;
}

input{
    background-color:#333;
    color:#DEDEDE;
    padding:8px;
    border:0;
    margin:0;
}

select{
    background:#333;
    color:#DEDEDE;
}

p{
    padding-bottom:0;
    margin-bottom:0;
}

table{
    font-size:1.2em;
}

.content{
    width:auto;
    min-width:0;
    max-width:none;
}

.text-left{
    text-align:left;
}

.text-right{
    text-align:right;
}

.text-center{
    text-align:center;
}

.offscreen{
    text-indent:-9999px;
}



/**
 * GRID STYLES
 */
.row{
    clear:both;
}

.column.end{
    margin:0;
    padding:0;
}



/**
 * GUI STYLES
 */
.button{
    font-weight:700;
    font-size:1.2em;
    color:#DEDEDE;
    position:relative;
}

.button:hover{
    cursor:pointer;
    color:#FFF;
}

input.button:hover{
    background-color:#b12f2c;
}

.button span{
    background:#333;
    padding:10px;
}

input.button{
    padding:10px;
    margin:0;
}

.js a.button span{
    padding-right:30px;
    display:inline-block;
}

.js .button .js-indicator{
    padding:0;
    background:none;
}

.submit:hover,
.cta{
    background-color:#b12f2c;
    color:#FFF;
    cursor:pointer;
}



/**
 * HEADER STYLES
 */
#header{
    padding:20px 10px;
    background-color:#333;
    color:#FFF;
}

.header-decoration{
    margin-top: 3px;
    color: #333;
    height: 2px;
    background-color: #333;
    border: 0;
}

#header .logo-block .logo{
    width:100px;
}



/**
 * CALENDAR STYLES
 */
.c{
    width:100%;
}

.c.full-day{
    padding-top:20px;
}

.c-e-disp .banner-container{
    max-height:200px;
    overflow:hidden;
}

.c-e-disp .banner{
    width:100%;
    display:block;
}

/* Calendar Sort Tool*/
.c .sort{
    display:none;
    border-top:1px solid #333;
    padding:20px 0 0 0;
    margin-bottom:20px;
}

.c .sort a.button{
    padding-right:20px;
    border-right:1px solid #333;
    margin-right:20px;
}

.js .sort .button.advanced .js-indicator{
    background:url("$baseAssetURL/image/gui/gui-sprite.png") no-repeat 0 0;
    width:12px;
    height:7px;
    display:block;
    position:absolute;
    right:30px;
    top:50%;
    margin-top:-4px;
}

.c .sort input.button{
    float:right;
}

.c .sort label{
    padding:10px;
    cursor:pointer;
    display: inline-block;
    font-size:1.2em;
    font-weight:700;
    margin-right:20px;
}

.js .c .sort input{
    display:none;
}

.c .sort label .js-indicator{
    background:url("$baseAssetURL/image/gui/gui-sprite.png") no-repeat;
    width:12px;
    height:12px;
    display:inline-block;
    margin-right:10px;
    position:relative;
    top:2px;
}

.c .sort label{
    background:#dedede;
    border:1px solid #999;
    color:#999999;
}

.c .sort label .js-indicator{
    background-position:-60px 0;
}

.c .sort label.milonga.checked .js-indicator{
    background-position:-12px 0;
}

.c .sort label.lesson.checked .js-indicator{
    background-position:-24px 0;
}

.c .sort label.practica.checked .js-indicator{
    background-position:-36px 0;
}

.c .sort label.show.checked .js-indicator{
    background-position:-48px 0;
}

/* Calendar Picker styles */
.c-picker-wrapper{
    margin-top:20px;
}

.c.picker{
    width:95px;
    float:left;
    margin-right: 30px;
    display:none;
}

.c.picker .cell.rowStart{
    clear:left;
}

.c.picker .preview{
    display:inline-block;
    cursor:pointer;
}

.c.picker .preview .cell{
    background:#CCC;
    border:1px solid #CCC;
    width:10px;
    height:10px;
    float:left;
    margin:0 1px 1px 0;
}

.c.picker .preview .cell.selected{
    border:2px solid #333;
    width:8px;
    height:8px;
}

.c.picker .preview .othMon{
    background:#FFF;
}

.c.picker .preview div span{
    display:none;
}

.c.picker .visualizer,
.js .c.picker:hover .visualizer{
    display:none;
    position:absolute;
    z-index:2;
    background:#fff;
    border:1px solid #333;
    padding:10px 29px;
    margin-top:10px;
    font-style:italic;
    font-size:1.3em;
    color:#333;
}

.c.picker:hover .visualizer{
    display:block;
}

.c.picker .visualizer h3{
    margin:0 0 10px 0;
    font-size:1.6em;
    text-align:center;
    font-weight:700;
}

.c.picker .visualizer .cell{
    text-align:center;
    width:25px;
    height:20px;
    padding-top:4px !important;
    display:inline-block;
    vertical-align:middle;
    float:left;
}

.c.picker .visualizer .header{
    background:#333;
    color:#CCC;
    padding:0;
    font-weight:700;
    border-bottom:1px solid #FFF;
}

.c.picker .visualizer .header .cell{
    border:1px solid #333;
    padding:1px;
}

.c.picker .visualizer .body{
    border-spacing:2px;
}

.c.picker .visualizer .body .cell{
    cursor:pointer;
    border:1px solid #CCC;
    margin:1px;
    color:#333;
}

.c.picker .visualizer .body .cell:hover{
    border:1px solid #333;
    background:#333 !important;
    color:#FFF;
}

.c.picker .visualizer .body .cell.selected{
    border:2px solid #333;
    width:23px;
    height:19px;
    padding-top:3px !important;
    margin:1px;
}

.c.picker .visualizer .body .cell.selected:hover{
    border:2px solid #333;
}

.c.picker .visualizer .body .cell.curMon{
    background:#CCC;
}

.c.picker .visualizer .body .othMonContainer:hover .cell{
    background:#333;
    border:1px solid #333;
}

.c.picker .visualizer .body .cell.othMon:hover span{
    visibility:visible;
}

.c.picker .visualizer .body .cell.othMon span{
    visibility:hidden;
}

.c.picker .visualizer .body .othMonContainer{
    height:26px;
    float:left;
}

.c.picker .visualizer .indicator{
    position:absolute;
    /* Extra padding and negative top position alleviates ghost-pixel spacing in IE, which drops the hover state if
    you move the mouse too slowly between the calendar preview and the visualizer. Since the preview presently has
    no functionality this is a great solution. */
    top:-20px;
    padding:10px 35px 0 35px;
    left:0;
}

.c.picker .visualizer .controls{
    position:absolute;
    left:0;
    top:0;
    height:0;
    width:100%;
}

.c.picker .visualizer .controls .previous,
.c.picker .visualizer .controls .next{
    display:block;
    background:url("$baseAssetURL/image/gui/gui-sprite.png") no-repeat center #333;
    top:57px;
    width:16px;
    height:16px;
}

.c.picker .visualizer .controls .previous{
    position:absolute;
    left:10px;
    background-position:-26px -15px;
}

.c.picker .visualizer .controls .previous:hover{
    background-position:-38px -15px;
}

.c.picker .visualizer .controls .next{
    position:absolute;
    right:10px;
    background-position:0 -15px;
}

.c.picker .visualizer .controls .next:hover{
    background-position:-12px -15px;
}

.c.d-disp{
    vertical-align: top;
    line-height:normal;
    padding:0 2em;
    text-align:center;
    margin:0 auto;
    width: 220px;
    text-align:center;
    color:#333;
    font-size:.8em;
}

.c.d-disp .d-content{
    float:left;
    width:100%;
}

.c.d-disp h2{
    font-family:"Vollkorn Bold Italic","Times New Roman",serif;
    margin-top: -.2em;
    font-size:4em;
}

.c.d-disp h3{
    margin-top:-.5em;
    font-size:1.75em;
    font-weight:100;
}

.c.d-disp .controls{
    position:relative;
    width:100%;
}

.c.d-disp .controls .next,
.c.d-disp .controls .previous{
    background:url("$baseAssetURL/image/gui/gui-sprite.png") no-repeat -55px -12px;
    width:10px;
    height:19px;
    display:block;
    position:absolute;
    top:.75em;
}

.c.d-disp .controls .next{
    right:-20px;
}

.c.d-disp .controls .previous{
    background-position: -65px -12px;
    left:-2em;
}



/* Calendar event full display styles */
.c-e-disp.full.loading{
    height:50px;
    background:url("$baseAssetURL/image/gui/gui-loading-333-16x16.gif") no-repeat center #333;
}

.c-e-disp.full h3{
    font-size:1.8em;
}

.c-e-disp.full h2{
    font-family:"Vollkorn Bold Italic",Lato,Arial,sans-serif;
    font-size:2.4em;
    line-height:1;
    padding:30px 20px;
    color:#FFF;
    background-color:#333;
}

.c-e-disp.full .social,
.c-e-disp.full .e-data{
    padding:20px;
}

.c-e-disp.full .e-data table{
    width:100%;
}

.c-e-disp.full .e-data td.label{
    width:25%;
}

.c-e-disp.full .e-data td.content{
    width:75%;
}

.c-e-disp.full .e-data .information{
    padding-bottom:20px;
}

.c-e-disp.full .e-data .description{
    margin-top:20px;
    overflow:hidden;
}

.c-e-disp.full .lesson,
.e.th.lesson.selected .container{
    background-color:#1f79e5;
    color:#ccefff;
}

.c-e-disp.full .lesson .information{
    border-bottom:1px solid #ccefff;
}

.c-e-disp.full .lesson .e-data{
    border-top:1px solid #ccefff;
}

.c-e-disp.full .milonga,
.e.th.milonga.selected .container{
    background-color:#b12f2c;
    color:#ffd2d2;
}

.c-e-disp.full .milonga .information{
    border-bottom:1px solid #ffd2d2;
}

.c-e-disp.full .milonga .e-data{
    border-top:1px solid #ffd2d2;
}

.c-e-disp.full .practica,
.e.th.practica.selected .container{
    background-color:#299428;
    color:#dbf7cc;
}

.c-e-disp.full .practica .information{
    border-bottom:1px solid #dbf7cc;
}

.c-e-disp.full .practica .e-data{
    border-top:1px solid #dbf7cc;
}

.c-e-disp.full .show,
.e.th.show.selected .container{
    background-color:#bf7b16;
    color:#fdeacc;
}

.c-e-disp.full .show .information{
    border-bottom:1px solid #fdeacc;
}

.c-e-disp.full .show .e-data{
    border-top:1px solid #fdeacc;
}

/* Calendar event thumbnail styles*/

.c .th-list{
    width:auto;
    position:relative;
}

.e.th{
    width:auto;
    margin-top:0;
}

.e.th,
.e.th a{
    display:block;
    color:inherit;
    font-weight:700;
    font-style:italic;
}

.e.th h3,
.e.th .time,
.e.th .col-price{
    font-size:1.3em;
}

.e.th .container{
    position:relative;
}

.e.th .content-padding{
    padding:5px;
}

.e.th .e-content{
    padding-left:60px;
    padding-right:55px;
    display:block;
}

.e.th .col-data{
    width:100%;
    float:right;
    position:relative;
}

.e.th .labels{
    position:absolute;
    width:100%;
    margin-top:5px;
}

.e.th .col-time{
    margin-left:18px;
    float:left;
}

.e.th .col-price{
    float:right;
    margin-right:5px;
    width:50px;
    text-align:right;

}

.e.th .details{
    padding-top:2px;
    clear:both;
    font-size:1.1em;
    font-weight:400;
    font-style:italic;
}

.e.th .organizer{
    padding-top:2px;
}

.e.th.lesson .container,
.sort label.lesson.checked{
    background-color:#ccefff;
    border:1px solid #1f79e5;
    color:#333;
}

.e.th.lesson .e-content{
    border-left:8px solid #1f79e5;
}

.e.th.lesson.selected .e-content{
    border-left:8px solid #ccefff;
}

.e.th.milonga .container,
.sort label.milonga.checked{
    background-color: #ffd2d2;
    border:1px solid #b12f2c;
    color:#333;
}

.e.th.milonga .e-content{
    border-left:8px solid #b12f2c;
}

.e.th.milonga.selected .e-content{
    border-left:8px solid #f7cccc;
}

.e.th.practica .container,
.sort label.practica.checked{
    background-color:#dbf7cc;
    border:1px solid #299428;
    color:#333;
}

.e.th.practica .e-content{
    border-left:8px solid #299428;
}

.e.th.practica.selected .e-content{
    border-left:8px solid #dbf7cc;
}

.e.th.show .container,
.sort label.show.checked{
    background-color:#fdeacc;
    border:1px solid #bf7b16;
    color:#333;
}

.e.th.show .e-content{
    border-left:8px solid #bf7b16;
}

.e.th.show.selected .e-content{
    border-left:8px solid #fdeacc;
}

.e.th.milonga .container,
.e.th.practica .container,
.e.th.lesson .container,
.e.th.show .container{
    border-bottom:0;
}

.c .th-list .e.th.milonga:last-child .container{
    border-bottom:1px solid #b12f2c;
}

.c .th-list .e.th.lesson:last-child .container{
    border-bottom:1px solid #1f79e5;
}

.c .th-list .e.th.practica:last-child .container{
    border-bottom:1px solid #299428;
}

.c .th-list .e.th.show:last-child .container{
    border-bottom:1px solid #bf7b16;
}



/**
 * Login module styles
 */

/* Calendar login styles */
.c .login{
    text-align:center;
    background-color:#dfdfdf;
    padding:30px 20px;
    border:1px solid #333;
}

.c .login .logo{
    max-width:100%;
}

.c .login form{
    padding-top:20px;
    padding-bottom:10px;
    color:#333;
}

.c .login .row input.submit{
    float:none;
}

.c .login h2,
.c .login h3{
    color:#b12f2c;
    background-color:transparent;
}

.c .login h2{
    margin-top:10px;
}

.c .login h3{
    font-style:italic;
    margin:20px 0 15px 0;
}

.c .login hr{
    height:1px;
    border:0;
    background-color:#333;
}

.c .login input{
    margin-bottom:10px;
}

.c .login label{
    display:block;
    padding:8px;
    height:16px;
    font-size:1.3em;
    font-style:italic;
}

.c .login .submit{
    cursor:pointer;
    font-weight:900;
    font-size: 1.4em;
}

.c .login .cta-container{
    padding:2px;
    border:1px solid #b12f2c;
    display:inline-block;
}

.c .login .cta{
    color:#FFF;
    font-weight:900;
    padding:8px;
    display:block;
    font-size: 1.4em;
}



/**
 * Alert styles
 */
.alerts{
    background:#b12f2c;
    color:#ffd2d2;
    font-size:1.4em;
    padding:1em 0;
}

.alerts .content{
    width:96%;
    padding:0 2%;
}

.alerts .alert .icon{
    display:inline-block;
    width:13px;
    height:13px;
    background:url("$baseAssetURL/image/gui/gui-sprite.png") no-repeat 0 -34px;
    margin-right:.35em;
    position:relative;
    top:1px;
}

.alerts .alert .dismiss{
    margin-left:.5em;
    color:#FFF;
    text-decoration:underline;
    font-size:.8em;
}

.alerts .dismiss{
    display:none;
}

.js .alerts .dismiss{
    display:inline-block;
}

/* LOCATION SELECTOR MODULE */
.lsel{
    color:#333;
    float:right
}

.lsel .location{
    font-size:1.3em;
    font-family:"Vollkorn Bold Italic","Times New Roman",serif;
    color:#333;
}

.lsel .location h3{
    font-size:1.2em;
}

.lsel .selector,
.js .lsel .change-location:hover .selector{
    display:none;
    position:absolute;
    background:#FFF;
    padding:10px;
    border:1px solid #333;
    margin-top:13px;
    z-index:9999;
    right:0;
    width:200px;
}

.lsel .change-location:hover .selector{
    display:block;
}

.js .lsel .selector .submit{
    display:none;
}

.lsel .change-location{
    font-size:1em;
    line-height:1;
    float:right;
    cursor:pointer;
    position:relative;
}

.lsel .change-location a{
    color:#333;
}

.lsel .indicator{
    background:url("$baseAssetURL/image/gui/gui-sprite.png") no-repeat -21px -38px;
    width:7px;
    height:4px;
    display:inline-block;
    position:relative;
    top:-1px;
    left:1px;
    cursor:pointer;
}

.lsel .selector .indicator{
    background:none;
    position: absolute;
    top: -20px;
    padding: 10px 35px 0 35px;
    right:0;
    left:auto;
    width:19px;
    height:10px;
}

.lsel .selector h3{
    font-family:"Vollkorn Italic","Times New Roman",serif;
    font-size:1.8em;
}

.lsel .selector label{
    font-size:1.4em;
    display:block;
    padding:7px 0 2px 5px;
}

.lsel .selector select{
    display:block;
    width:100%;
    padding:5px;
}

.lsel .selector option{
    padding:2px;
}

.lsel .selector select.city{
    margin-top:10px;
}

.lsel .selector .submit{
    display:block;
    margin-top:10px;
}



/**
 * Phone portrait small, and smaller phones in landscape ( width > 360 )
 */
@media only screen
and (min-width:360px){
    .col-1-2,
    .col-1-3,
    .col-2-3,
    .col-1-4,
    .col-3-4,
    .col-1-5,
    .col-2-5,
    .col-3-5,
    .col-4-5{
        float:left;
        margin-right:2%;
    }

    /* GRID STYLES */
    .col-1-2{
        width:48%;
    }

    .col-1-4{
        width:23.5%;
    }

    .col-1-5{
        width:18.4%;
    }

    .col-2-5{
        width:38%;
    }

    .col-3-5{
        width:58%;
    }

    .col-4-5{
        width:78%;
    }



    /* LOGIN MODULE */

    .c .login label{
        margin-bottom:0;
    }

    .c .login .row label{
        float:right;
    }

    .c .login .row input{
        float:left;
        min-width:25%;
        max-width:75%;
    }

    .c .login .row input.submit{
        min-width:0;
        max-width:100%;
    }

    /* Calendar Date Display module*/
    .c.d-disp{
        font-size:1em;
        width:255px;
    }

    /* Location selector module */
    .lsel .location h3{
        font-size:1.4em;
    }
}



/**
 * Phone Landscape
 */
@media only screen
and ( min-width:480px ){

    /* Header styles */
    #header .logo-block .logo{
        width:auto;
    }

    /* Event styles */
    .e.th.lesson .container{
        border:1px solid #1f79e5;
    }

    .e.th.milonga .container{
        border:1px solid #b12f2c;
    }

    .e.th.practica .container{
        border:1px solid #299428;
    }

    .e.th.show .container{
        border:1px solid #bf7b16;
    }
}



/**
 * Small tablet to tablet portriat
 */
@media only screen
and ( min-width:540px ){

    /* Location selector module */
    .lsel .location h3{
        font-size:1.6em;
    }
}



/**
 * Large phone to tablet portrait
 */
@media only screen
and (min-width:480px)
and (max-width:767px){
    .e.th,
    .c-e-disp.full{
        margin:10px 10px 0 10px;
    }

    .c-e-disp.full{
        margin-top:0;
    }
}



/**
 * Tablet portrait and above (Ipad and surface)
 */
@media only screen
and (min-width:768px){
    body{
        font-family:Lato, Arial, sans-serif;
        width:auto;
    }

    #header{
        padding:20px 0;
    }

    .content{
        max-width:1200px;
        margin:0 auto;
        padding:0 10px;
    }



    /*EVENT STYLES*/

    .e.th{
        cursor:pointer;
        margin-bottom:10px;
        width:auto;
    }

    .c .th-list .e.th .container{
        margin-right:10px;
    }

    /* CALENDAR EVENT STYLES */

    .c .th-list{
        min-height:650px;
    }

    .c-e-disp.full .e{
        height:650px;
    }

    .c .th-list .e.th{
        width:26%;
        float:left;
        clear:both;
    }

    .c-e-disp{
        width:74%;
        float:right;
    }

    .c-e-disp.full .e-data .col-left{
        width:73%;
        margin-right:2%;
        float:left;
    }

    .c-e-disp.full .e-data .col-right{
        width:25%;
        float:right;
    }

    .c .th-list .c-e-disp.full{
        float:none;
        position:absolute;
        top:0;
        right:0;
    }

    /* CALENDAR PICKER */
    .c.picker{
        display:block;
    }

    .c.d-disp{
        width:auto;
        float:left;
    }

    /* CALENDAR SORT TOOL*/
    .c .sort{
        display:block;
    }
}



/**
 * Tablet landscape ONLY (above 768 but below 1024
 */
@media only screen
and (min-width:768px)
and (max-width:1023px){
    .e.th .e-content{
        padding-right:10px;
    }

    .e.th .col-price{
        width:55px;
        float:left;
        clear:left;
        text-align:left;
        margin-right:0;
        margin-left:18px;
    }
}



/**
 * Tablet landscape and above
 */
@media only screen
and (min-width:768px){

    /* Calendar Picker Styles*/
    .c-picker-wrapper.clearfix{
        clear:none;
    }

    .c-picker-wrapper.clearfix:after {
        content: none;
        display: none;
        height: 0;
        clear: none;
    }
}



/**
 * Desktop styles (1024+)
 */
@media only screen
and (min-width:1024px){

    /* EVENT STYLES */

    .e.th.lesson:hover .container{
        background-color:#1f79e5;
        color:#ccefff;
    }

    .e.th.lesson:hover .e-content{
        border-left:8px solid #ccefff;
    }

    .e.th.milonga:hover .container{
        background-color:#b12f2c;
        color:#ffd2d2;
    }

    .e.th.milonga:hover .e-content{
        border-left:8px solid #f7cccc;
    }

    .e.th.practica:hover .container{
        background-color:#299428;
        color:#dbf7cc;
    }

    .e.th.practica:hover .e-content{
        border-left:8px solid #dbf7cc;
    }

    .e.th.show:hover .container{
        background-color:#bf7b16;
        color:#fdeacc;
    }

    .e.th.show:hover .e-content{
        border-left:8px solid #fdeacc;
    }

    /* Location selector module */
    .lsel .location h3{
        font-size:1.8em;
    }
}



/**
 * Desktop styles (above 1212)
 */
@media only screen
and (min-width:1212px){
    body{
        padding:0;
    }
}

#debug{
    clear:both;
    padding-top:50px;
    color:#666;
    font-size:1.2em;
}



/**
 * Complete Clear Fix
 */

/* IE5-6 */
* html .clearfix {
    height: 1%;
}

/* IE7 */
*+html .clearfix {
    display: inline-block;
}

/* All other browsers */
.clearfix:after {
    content: ".";
    display: block;
    height: 0;
    clear: both;
    visibility: hidden;
}
CSS;
header("Content-type: text/css");
echo $css;