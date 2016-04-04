var adminurl = "http://wohlig.co.in/science/admin/";
var apiurl = adminurl + "index.php/json/";


var allstories = [];

$(window).load(function() {

  //  $('.footer').hide();
});


function hideAll() {
  $(".section.homes").hide();
  $(".section.webl").hide();
  $(".section.stlarn").hide();
  $(".section.pros").hide();
  $(".section.curriculums").hide();
  $(".section.labs").hide();
  $(".section.stori").hide();
  $(".section.contacts").hide();
  $(".section.who").hide();

  var isMenuOn = $("body").hasClass("show-menu");
  console.log(isMenuOn);
  if (isMenuOn) {
    $("#close-button5").trigger("click");
  }

}

$(document).ready(function() {


  $(".section").css("min-height", $(window).height());
  $(window).resize(function() {
    $(".section").css("min-height", $(window).height());
  });


  $('.landing').hide(4010);
  $('.footer').hide(0);
  $('.ups').hide(0);


  $('.footer').delay(4500).fadeIn(300);
  $('.ups').delay(4500).fadeIn(300);
  $('.homes').delay(4500).fadeIn(300);
  //    $('.who').delay(5500).fadeIn(500);
  //    $('.who-set').delay(5500).fadeIn(500);






  $("#hides, #hides1, #hides2, #hides3, #hides4, #hides5, #hides6, #hides7, #hides8, #hides9, #hides10, #hides11").click(function() {
    $(".tab_content").hide(800);
    $(".read-set").show();

  });

  $("#sum-img").click(function() {

    $(".read-set").hide();
    $(".tab_content").show(800);
  });


  $(".circle1").click(function() {
    $(".we-txt").hide(0);
    $(".round1").fadeIn();
  });
  $(".circle2").click(function() {
    //          $(this).toggle();
    $(".we-txt").hide(0);
    $(".round2").fadeIn();
  });
  $(".circle3").click(function() {
    $(".we-txt").hide(0);
    $(".round3").fadeIn();
  });
  $(".circle4").click(function() {
    $(".we-txt").hide(0);
    $(".round4").fadeIn();
  });

  $("#shw").click(function() {
    $(".round1").hide();
    $(".we-txt").fadeIn(0);
  });
  $("#shw2").click(function() {
    $(".round2").hide();
    $(".we-txt").fadeIn(0);
  });
  $("#shw3").click(function() {
    $(".round3").hide();
    $(".we-txt").fadeIn(0);
  });
  $("#shw4").click(function() {
    $(".round4").hide();
    $(".we-txt").fadeIn(0);
  });

  $("#sl").click(function() {
    $("#stud-set").show();
    $("#stud-set1").hide(500);
  });
  $("#sl1").click(function() {
    $("#stud-set").hide(500);
    $("#stud-set1").show();
  });

  $("#cl1").click(function() {
    $("#pro-set").hide(500);
    $("#pro-set2").show();
  });
  $("#cl2").click(function() {
    //          $(this).toggle();
    $("#pro-set").hide(500);
    $("#pro-set3").show();
  });
  $("#cl3").click(function() {
    $("#pro-set").hide(500);
    $("#pro-set4").show();
  });
  $("#cl4").click(function() {
    $("#pro-set").hide(500);
    $("#pro-set5").show();
  });

  $("#op1").click(function() {
    $("#pro-set2").hide();
    $("#pro-set").fadeIn(500);
  });
  $("#op2").click(function() {
    $("#pro-set3").hide();
    $("#pro-set").fadeIn(500);
  });
  $("#op3").click(function() {
    $("#pro-set4").hide();
    $("#pro-set").fadeIn(500);
  });
  $("#op4").click(function() {
    $("#pro-set5").hide();
    $("#pro-set").fadeIn(500);
  });


  $(".round1").hide();
  $(".round2").hide();
  $(".round3").hide();
  $(".round4").hide();

  $("#pro-set2").hide();
  $("#pro-set3").hide();
  $("#pro-set4").hide();
  $("#pro-set5").hide();

  $("#stud-set1").hide();

  $(".homes").hide();
  $(".who-set").hide();
  $("#who").hide();
  $("#we").hide();
  $("#student").hide();
  $("#pro").hide();
  $("#curriculum").hide();
  $("#lab").hide();
  $("#stories").hide();
  $("#contact").hide();

  //    ******page show query******


  $("a.whoweare").click(function() {

    hideAll();
    $(".section.who").fadeIn(800);

  });

  $("a.webels").click(function() {
    hideAll();

    $(".section.webl").fadeIn(800);

  });

  $("a.student").click(function() {
    hideAll();

    $(".section.stlarn").fadeIn(800);

  });

  $("a.pro").click(function() {
    hideAll();
    $(".section.pros").fadeIn(800);

  });

  $("a.curriculum").click(function() {
    console.log("Curriculum is Also Clicked");
    hideAll();
    $(".section.curriculum").fadeIn(800);

  });

  $("a.lab").click(function() {
    hideAll();
    $(".section.lab").fadeIn(800);

  });

  $("a.stories").click(function() {
    hideAll();
    $(".section.stori").fadeIn(800);

  });

  $("a.contact").click(function() {
    hideAll();
    $(".section.contact").fadeIn(800);

  });



  $(".ups").click(function() {

    hideAll();
    $(".section.homes").fadeIn(800);

  });




  //    *******end*********

  $('.txt-set').hover(function() {
    $('.hee').fadeIn(500);
  }, function() {
    $('.hee').fadeOut(500);
  });

  $('.content-txt').hover(function() {
    $('.hello').fadeIn(500);
  }, function() {
    $('.hello').fadeOut(500);
  });

  $(".hee").hide();
  $(".hello").hide();

  $("#tabs li").click(function() {
    //  First remove class "active" from currently active tab
    $("#tabs li").removeClass('active');

    //  Now add class "active" to the selected/clicked tab
    $(this).addClass("active");

    var filter = $(this).children("a").attr("data-filter");
    console.log(filter);
    switch (filter) {

      case "all":
        {
          $(".teacherrow").show();
          $(".studentrow").show();
        }
        break;
      case "student":
        {
          $(".teacherrow").hide();
          $(".studentrow").show();
        }
        break;
      case "teacher":
        {
          $(".teacherrow").show();
          $(".studentrow").hide();
        }
        break;
    }

    return false;
  });

  $("#circle1").click(function() {
    $(".round1").show();
  });

  function getWords(string) {
    return string.split(/\s+/).slice(0, 10).join(" ");
  }

  function addvaluestostories(classname, story) {
    console.log(classname);
    $(classname + " .storyimage1").attr("src", adminurl + "uploads/" + story.image1);
    $(classname + " .storyimage2").attr("src", adminurl + "uploads/" + story.image2);
    $(classname + " .storyreadmore").attr("data-storyid", story.id);
    $(classname + " .storytitle").html(story.title);
    $(classname + " .storybodymin").html(getWords(story.content));
  }

  function addtostories(data) {
    var filterclass = "";
    for (var i = 0; i < data.length; i++) {
      if (data[i].status == "2") {
        if (data[i].image2 === "") {
          filterclass = ".studentrow .singleimage";
        } else {
          filterclass = ".studentrow .doubleimage";
        }
      } else if (data[i].status == "1") {
        if (data[i].image2 === "") {
          filterclass = ".teacherrow .singleimage";
        } else {
          filterclass = ".teacherrow .doubleimage";
        }
      }
      addvaluestostories(filterclass, data[i]);
    }
  }

  function addimageslider(src) {
    var src2 = "";
    if (src && src !== "" && src.image !== "" && src.image) {
      src2 = '<li class="js_slide" style="text-align:center;width: auto;height: 312px;"><img style="text-align:center;width: auto;height: 312px;" src="' + adminurl + "uploads/" + src.image + '"><p>' + src.bottomtext + '</p></li>';
    }
    return src2;
  }

  function changestorydetailcontent(story) {
    $(".readmorepage .fullstorytitle").html(story.title);
    $(".readmorepage .fullstorybody").html(story.content);
    $(".readmorepage .fullstoryimages ul").html("");
    //        $(".readmorepage .fullstoryimages ul").append(addimageslider(story.image1));
    //        $(".readmorepage .fullstoryimages ul").append(addimageslider(story.image2));
    console.log(story.images);
    for (var i = 0; i < story.images.length; i++) {
      $(".readmorepage .fullstoryimages ul").append(addimageslider(story.images[i]));
    }
    $(".readmorepage .fullstoryimages ul img").load(function() {
      var variableWidth = document.querySelector('.js_variablewidth');
      lory(variableWidth, {
        rewind: true
      });
    });
  }

  function createstorydetailfromid(storyid) {
    for (var i = 0; i < allstories.length; i++) {
      console.log(allstories[i].id);
      if (allstories[i].id == storyid) {
        changestorydetailcontent(allstories[i]);
      }
    }
  }

  $(".storyreadmore").click(function() {
    var storyid = $(this).attr("data-storyid");
    createstorydetailfromid(storyid);
    console.log(storyid);

  });

  $.getJSON(apiurl + "getallstories", function(data) {
  //  data =[];
    if (data.length > 0) {
      $(".storiesContent").show();
      $(".noStoriesContent").hide();
    } else {
      $(".storiesContent").hide();
      $(".noStoriesContent").show();
    }
    allstories = data;
    addtostories(data);
    console.log(data);
  });
});
