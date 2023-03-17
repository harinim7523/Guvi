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
    
    // if(data.name==null || data.username==null || data.password==null || data.dob==null || data.phno==null)
    // {
    //   alert("data should not be empty");
    // }

    $.ajax({
      url: '/Ajax/php/register.php',
      type: 'post',
      data: data,
      success:function(response){
        alert(response);
            var res=jQuery.parseJSON(response);
            
            if(res.code==200)
            {
                console.log(response);
                localStorage.removeItem("username");
                location.href="/Ajax/login.html"
            }
            else{
              location.href="/Ajax/register.html";
            }
      }
     
    });
  });

})

