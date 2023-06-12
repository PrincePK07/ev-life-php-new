$(function(){
    $("#first-error").hide();
    $("#phone-error").hide();
    $("#password-error1").hide();
    $("#password-error2").hide();
    $("#email-error").hide();
    $("#comment-error").hide();
    

      var firstnameError = false;
      var phoneError = false;
      var passwordError1 = false;
      var passwordError2 = false;
      var emailError = false;
      var commentError = false;

      $("#first-name").focusout(function(){
        check_firstname();
       });

      $("#phoneNumber").focusout(function(){
        check_phone();
       });

       $("#password1").focusout(function(){
        check_password();
       });

       $("#password2").focusout(function(){
        check_password2();
       });

       $("#email1").focusout(function(){
        check_email();
       });


       function check_firstname() {
        var firstname_length = $("#first-name").val().length;

        if( firstname_length < 5 || firstname_length > 20 ){
            $("#first-error").html("username should be between 5 to 20 characters ");
            $("#first-error").show();
            firstnameError = true;
        } else{
            $("#first-error").hide();
        }

       }

       function check_phone() {
        var phone_length = $("#phoneNumber").val().length;

        if( phone_length < 9 ||  phone_length > 11 ){
          $("#phone-error").html("Invalid Phone Number");
          $("#phone-error").show();
          phoneError = true;
        }else{
          $("#phone-error").hide();
        }

        }

       function check_password() {
        var password_length = $("#password1").val().length;

        if( password_length <=7){
          $("#password-error1").html("Password should have more than 8 character");
          $("#password-error1").show();
           passwordError1 = true;
        }else{
          $("#password-error1").hide();
        }

        }
       function check_password2(){
        var confirmPassword = $("#password2").val();
        var validatePassword = $("#password1").val();

        if(confirmPassword != validatePassword){
          $("#password-error2").html("password should be same");
          $("#password-error2").show();
          passwordError2 = true;
        }else{
          $("#password-error2").hide();
        }
      }

      function check_email(){
        var emailPattern = RegExp(/^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i);

        if(emailPattern.test($("#email1").val())){
          $("#email-error").hide()
         }else{
            $("#email-error").html("Invalid Email Address");
            $("#email-error").show();
             emailError = true;
          }
        
      }

      $("#masterForm").submit(function(){
         firstnameError = false;
         phoneError = false;
         passwordError1 = false;
         passwordError2 = false;
         emailError = false;

         check_firstname();
         check_phone();
         check_password();
         check_password2();
         check_email();

         if(firstnameError == false && phoneError == false && passwordError1 == false && passwordError2 == false && emailError == false){
          alert( "Registration Success!! Please wait for admin approval to login into the account");
          return true;
          
         }else{
          alert( "Please fill all required fields");
          return false;
         }

        })


      
       


});
