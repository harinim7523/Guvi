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
      url: '/Ajax/php/update.php',
      type: 'post',
      data: data,
      success:function(response){
        console.log(response);
        console.log("in reg");
        if(response==200)
        {
           alert(response);
            location.href="/Ajax/profile.html";

        }
        else{
            alert("Credentials not correct or empty");
            location.href='/Ajax/update.html';
        }
      }
    });
})

