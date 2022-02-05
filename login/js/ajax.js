$(document).ready(function(){
    $('#signin').click(function(e){
        $(".error-block").remove();
        $(".alert").remove();
          e.preventDefault();
          var username = $('#username').val();
          var password = $('#password').val();
          $.ajax({	
            url: "app_logic.php",
            type: "POST",				
              data:{
              'login': 1,
              'username': username,
              'password': password
            },
            beforeSend: function(){
                  $('#signin').html("signing in...");
            },
            success: function(data){
                var data = JSON.parse(data);
                if(data.status != "success"){
                  if(data.errors.username){
                    $("#username-input").append('<div class="error-block" style="color:red;">'+data.errors.username+'</div>');
                  }
                  if(data.errors.password){
                    $("#password-input").append('<div class="error-block" style="color:red;">'+data.errors.password+'</div>');
                  }
                  $('#error').html('<div class="alert alert-danger">'+data.message+'</div>');
                  $('#signin').html("sign in");
                }else{
                  $('#error').html('<div class="alert alert-success">'+data.message+'</div>');
                  location.href = "profile.html";	
                }
              }
          });
      });
  });
  $(document).ready(function(){
    $('#signup').click(function(e){
        $(".error-block").remove();
        $(".alert").remove();
          e.preventDefault();
        var name = $('#name').val();
        var username = $('#username').val();
        var email = $('#email').val();
        var password = $('#password').val();
        var cpassword = $('#cpassword').val();
        $.ajax({
            url:'app_logic.php',
            type: 'POST',
            data:{
                'register': 1,
                'name': name,
                'username': username,
                'email': email,
                'password': password,
                'cpassword': cpassword
            },
            beforeSend: function(){
                 $('#signup').html("signing up...");
            },
            success:function(data){
              var data = JSON.parse(data);
              if(data.status != "success"){
                if(data.errors.name){
                    $("#name-input").append('<div class="error-block" style="color:red;">'+data.errors.name+'</div>');
                }
                if(data.errors.username){
                    $("#username-input").append('<div class="error-block" style="color:red;">'+data.errors.username+'</div>');
                }	
                if(data.errors.unique_username){
                    $("#username-input").append('<div class="error-block" style="color:red;">'+data.errors.unique_username+'</div>');
                }
                if(data.errors.email){
                    $("#email-input").append('<div class="error-block" style="color:red;">'+data.errors.email+'</div>');
                }
                if(data.errors.password){
                    $("#password-input").append('<div class="error-block" style="color:red;">'+data.errors.password+'</div>');
                }
                if(data.errors.cpassword){
                    $("#cpassword-input").append('<div class="error-block" style="color:red;">'+data.errors.cpassword+'</div>');
                }
                if(data.errors.passwords){
                    $("#password-input").append('<div class="error-block" style="color:red;">'+data.errors.passwords+'</div>');
                }
                $('#error').html('<div class="alert alert-danger">'+data.message+'</div>');
                $('#signup').html("sign up");
              }else{
                $('#error').html('<div class="alert alert-success">'+data.message+'</br>'+'Redirecting to the login page...</div>');
                $('#signup').html("sign up");
                setTimeout(function(){location.href = 'index.html';}, 3000);
              }
            }
        });
    });
});

$(document).ready(function(){
  if (window.location.href.indexOf('login/profile.html') > 0) {
    $.ajax({
          url: 'app_logic.php',
          type: 'POST',
          data: {
              'fetch': 1
          },
          success: function(data){
              var data = JSON.parse(data);
              if(data.status == 'success'){
                  $('#username').html(data.username);
                  $('#name').html(data.name);
                  $('#email').html(data.email);
                  if(data.age > 0){
                  $('#age').val(data.age);}
                  $('#dob').val(data.dob);
                  if(data.phone > 0){
                  $('#phone').val(data.phone);}
              }else{
                  $('#error').html('<div class="alert alert-danger">'+data.message+'</div>');
                  setTimeout(function(){location.href = 'index.html';}, 3000);
              }
          }
      });
    }
  });
    $('#update').click(function(e){
      $(".error-block").remove();
      $(".alert").remove();
      e.preventDefault();
      var age = $('#age').val();
      var dob = $('#dob').val();
      var phone = $('#phone').val();
      $.ajax({
          url: 'app_logic.php',
          type: 'POST',
          data: {
              'update': 1,
              'age': age,
              'dob': dob,
              'phone': phone
          },
          beforeSend: function(){
              $('#update').html("updating...");
          },
          success: function(data){
              var data = JSON.parse(data);
              if(data.status != "success"){
                  if(data.errors.age){
                    $("#age-input").append('<div class="error-block" style="color:red;">'+data.errors.age+'</div>');
                  }
                  if(data.errors.phone){
                    $("#phone-input").append('<div class="error-block" style="color:red;">'+data.errors.phone+'</div>');
                  }
                $('#error').html('<div class="alert alert-danger">'+data.message+'</div>');
                $('#update').html("update");
              }else{
                $('#update').html("update");
                $('#error').html('<div class="alert alert-success">'+data.message+'</div>');
              }
          }
      });
  });
  