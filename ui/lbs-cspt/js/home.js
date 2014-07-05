/**
 * Created with JetBrains WebStorm.
 * User: neilsenchan
 * Date: 5/29/13
 * Time: 11:59 PM
 * To change this template use File | Settings | File Templates.
 */
$(document).ready(function(){
//    $("#div_content").load("login.html");
//    $("#div_content").load("manage.html");
});

$("#li_cspt_entry").click(function(){
    $("#div_content").load("login.html");
    $("#li_home").removeClass("active");
    $("#li_cspt").addClass("active");
});
$("#li_cspt_manage").click(function(){
    $("#div_content").load("manage.html");
    $("#li_home").removeClass("active");
    $("#li_cspt").removeClass("active");
});