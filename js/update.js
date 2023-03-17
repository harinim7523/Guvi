$("#upd").on('click',function()
{
    console.log("in update.js");
    var data = {
      username:$('#username').val(),
      dob:$('#dob').val(),
      phno:$('#phno').val(),
      action:$('action').val(),
    };
    $.ajax({
      url: '/Guvi/php/update.php',
      type: 'post',
      data: data,
      success:function(response){
        console.log(response);
        console.log("in reg");
        if(response==200)
        {
           alert(response);
            location.href="/Guvi/profile.html";

        }
        else{
            alert("Credentials not correct or empty");
            location.href='/Guvi/update.html';
        }
      }
    });
})

