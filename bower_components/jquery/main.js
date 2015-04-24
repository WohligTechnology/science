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


    $(".round1").hide();
    $(".round2").hide();
    $(".round3").hide();
    $(".round4").hide();
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