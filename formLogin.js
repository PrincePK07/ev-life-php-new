$(function () {
  $("#login-error").hide();
  $("#login-error").hide();
 
  var emailError = false;
  var passwordError = false;

  $("#email").submit(function () {
    check_email();
  });

  $("#password1").submit(function () {
    check_password();
  });


  function check_email() {
    var emailPattern = RegExp(/^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i);

    if (emailPattern.test($("#email").val())) {
      $("#login-error").hide();
    } else {
      $("#login-error").html("Invalid Email Address or Password");
      $("#login-error").show();
     emailError = true;
    }
  }
  function check_password() {
    var password_length = $("#password1").val().length;

    if (password_length <= 7) {
      $("#login-error").html("Invalid Email Address or Password");
      $("#login-error").show();
       passwordError = true;
    } else {
      $("#login-error").hide();
    }
  }
  $("#masterLogin").submit(function (){
    emailError = false;
    passwordError = false;

    check_email();
    check_password();

    if(emailError === false && passwordError === false){
      return true;
    } else{
      alert("Please fill all required fields");
      return false;
    }
  });

});

  

// news carousal style starts here
jQuery(document).ready(function($) {
  "use strict";
  $('#customers-testimonials').owlCarousel({
      loop: true,
      center: true,
      items: 3,
      margin: 0,
      autoplay: true,
      dots:true,
      autoplayTimeout: 2000,
      smartSpeed: 500,
      responsive: {
        0: {
          items: 1
        },
        768: {
          items: 2
        },
        1170: {
          items: 3
        }
      }
  });
});

// text editor plugin




