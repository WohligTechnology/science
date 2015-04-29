$(document).ready(function () {
    $(".section").css("min-height", $(window).height());
    $(window).resize(function () {
        $(".section").css("min-height", $(window).height());
    });


    $('.landing').hide(5510);

    $("#hides, #hides1, #hides2, #hides3, #hides4, #hides5, #hides6, #hides7, #hides8, #hides9, #hides10, #hides11").click(function () {
        $(".tab_content").hide(1000);
        $(".read-set").show();

    });

    $("#sum-img").click(function () {

        $(".read-set").hide();
        $(".tab_content").show(1000);
    });


    $(".circle1").click(function () {
        $(".we-txt").hide(500);
        $(".round1").show();
    });
     $(".circle2").click(function () {
//          $(this).toggle();
        $(".we-txt").hide(500);
        $(".round2").show();
    });
     $(".circle3").click(function () {
        $(".we-txt").hide(500);
        $(".round3").show();
    });
     $(".circle4").click(function () {
        $(".we-txt").hide(500);
        $(".round4").show();
    });
    
    $("#shw").click(function () {
        $(".round1").hide();
        $(".we-txt").show(500);
    });
      $("#shw2").click(function () {
        $(".round2").hide();
        $(".we-txt").show(500);
    });
     $("#shw3").click(function () {
        $(".round3").hide();
        $(".we-txt").show(500);
    });
     $("#shw4").click(function () {
        $(".round4").hide();
        $(".we-txt").show(500);
    });

    
    
    $("#cl1").click(function () {
        $("#pro-set").hide(500);
        $("#pro-set2").show();
    });
     $("#cl2").click(function () {
//          $(this).toggle();
        $("#pro-set").hide(500);
        $("#pro-set3").show();
    });
     $("#cl3").click(function () {
        $("#pro-set").hide(500);
        $("#pro-set4").show();
    });
     $("#cl4").click(function () {
        $("#pro-set").hide(500);
        $("#pro-set5").show();
    });
    
        $("#op1").click(function () {
        $("#pro-set2").hide();
        $("#pro-set").show(500);
    });
      $("#op2").click(function () {
        $("#pro-set3").hide();
        $("#pro-set").show(500);
    });
     $("#op3").click(function () {
        $("#pro-set4").hide();
        $("#pro-set").show(500);
    });
     $("#op4").click(function () {
        $("#pro-set5").hide();
        $("#pro-set").show(500);
    });


    $(".round1").hide();
    $(".round2").hide();
    $(".round3").hide();
    $(".round4").hide();
    
       $("#pro-set2").hide();
    $("#pro-set3").hide();
    $("#pro-set4").hide();
    $("#pro-set5").hide();
    
    $("#tabs li").click(function () {
        //  First remove class "active" from currently active tab
        $("#tabs li").removeClass('active');

        //  Now add class "active" to the selected/clicked tab
        $(this).addClass("active");

        //  Hide all tab content
        $(".tab_content").hide();

        //  Here we get the href value of the selected tab
        var selected_tab = $(this).find("a").attr("href");

        //  Show the selected tab content
        $(selected_tab).fadeIn();

        //  At the end, we add return false so that the click on the link is not executed
        return false;
    });
    
    $("#circle1").click(function() {
        $(".round1").show();
    });


});