$("#log").on('click',function()
{
    var data = {
      username: $("#username").val(),
      password: $("#password").val(),
      action: $("#action").val(),
    };
    
    $.ajax({
      url: '/Guvi/php/login.php',
      type: 'post',
      data: data,
      success:function(response){
          
            var expires=(new Date(Date.now()+1000*86000)).toUTCString();
            document.cookie="username=" + data.username+ ";expires=" + expires+";path=/;";
            localStorage.setItem("username", data.username);
            alert(data.username+" Login successful");
            console.log("hel"); 
            location.href="/Guvi/profile.html";
      }
    });
})

