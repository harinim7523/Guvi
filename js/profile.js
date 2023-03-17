$("#logout").on('click',function()
{
    var username=localStorage.getItem("username");
    var data={
        username:username
    }
    $.ajax({
        type:"POST",
        url:"/Ajax/php/logout.php",
        data:data,
        success:(response)=>
        {
            console.log(response);
            if(response==200)
            {
                console.log(response);
                localStorage.removeItem("username");
                location.href="/Ajax/login.html"
            }
        }
    })
});

$(document).ready(()=>
{
    var username=localStorage.getItem("username");
    // var username=getCookie("username");
    console.log(username);
    if(username==null)
    {
        location.href="/Ajax/login.html";
    }
    else{
        var dataset={
            username:username,
            profile:true
        }
        $.ajax({
            type:"POST",
            url:"/Ajax/php/profile.php",
            data:dataset,
            success:(response)=>
            {
                
                console.log(response);
                var res=jQuery.parseJSON(response);
                if(res.code=="404")
                {
                    console.log(res.code);
                }
                else if(res.code=="200")
                {
                    printdata(res.user);
                }
  
            }

        })
        const printdata=(response)=>
        {
            $("#main").html(`  
            <table>
            <tr>
                <th><h3>Email:</h3></th>
                <td> <h4>${response.username} </h4></td>
            </tr>
            <tr>
                <th><h3>Date of Birth:</h3></th>
                <td> <h4>${response.dob}</h4></td>
            </tr>
            <tr>
                <th><h3> Phone No:  </h3></th>
                <td> <h4>${response.phno}</h4></td>
            </tr>
            </table> 
            `);
        }
        
    }
    
})

function getCookie(cname) {
    let name = cname + "=";
    let decodedCookie = decodeURIComponent(document.cookie);
    let ca = decodedCookie.split(';');
    for(let i = 0; i <ca.length; i++) {
      let c = ca[i];
      while (c.charAt(0) == ' ') {
        c = c.substring(1);
      }
      if (c.indexOf(name) == 0) {
        return c.substring(name.length, c.length);
      }
    }
    return "";
}