$(document).ready(function() {
    $('#loginForm').submit(function(e) {
      e.preventDefault();
  
      var username = $('#username').val();
      var password = $('#password').val();
  
      $.ajax({
        type: 'POST',
        url: 'login.php',
        data: {
          username: username,
          password: password
        },
        dataType: 'json',
        success: function(response) {
          if (response.success) {
            // Redirect to home page
            window.location.href= 'home.php';
          } else {
            $('#message').text(response.message);
          }
        },
        error: function() {
          $('#message').text('An error occurred during login. Please try again.');
        }
      });
    });
  });
  