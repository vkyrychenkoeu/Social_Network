$(document).ready(function(){

    //On click sign up, hide login and show registration form
    $("#signup").click(function(){
        $("#first").slideUp("slow", function(){
            $("#second").slideDown("slow");
        });
    });

    
    //On click sign up, hide registration form and show login form

    $("#signin").click(function(){
        $("#second").slideUp("slow", function(){
            $("#first").slideDown("slow");
        });
    });


});