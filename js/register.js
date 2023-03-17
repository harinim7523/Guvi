$("#reg").on('click',function()
{
  console.log("in register.js");
  $(document).ready(function(){
    
    var data = {
      name: $("#name").val(),
      username: $("#username").val(),
      password: $("#password").val(),
      dob:$('#dob').val(),
      phno:$('#phno').val(),
      action: $("#action").val(),
    };
    
    $.ajax({
      url: '/Guvi/php/register.php',
      type: 'post',
      data: data,
      success:function(response){
        alert(response);
            var res=jQuery.parseJSON(response);
            
            if(res.code==200)
            {
                console.log(response);
                localStorage.removeItem("username");
                location.href="/Guvi/login.html"
            }
            else{
              location.href="/Guvi/register.html";
            }
      }
     
    });
  });

})

