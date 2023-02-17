<?php 
    $conn="conn.php"
    ?>
<!DOCTYPE html>   
<html>   
<head>  
<meta name="viewport" content="width=device-width, initial-scale=1">  
<title> Login Page </title>  
<style>   
Body {  
  font-family: Calibri, Helvetica, sans-serif;  
  background-color: pink;  
}  
button {   
       background-color: #4CAF50;   
       width: 150px;  
        color: black;   
        padding: 10px;   
        margin: 20px 60px 10px 90px;   
        border: none;   
        cursor: pointer;   
        font-size:20px;
         }   
 /* form {   
        border: 3px solid #f1f1f1;  
        width: 500px; 
        margin-left:500px;
    }    */
 input[type=email], input[type=password] {   
        width: 200px;   
        margin: 8px 0;  
        padding: 12px 20px;   
        /* display: inline-block;    */
        border: 2px solid green;   
        box-sizing: border-box;   
    }  
 button:hover {   
        opacity: 0.7;   
    }   
   
     
 .container {   
        padding: 0 35px 35px 35px;   
        background-color: lightblue;
        margin:100px 300px 0 400px;  
        width:400px;
        border: 1px solid #123456; 
        border-radius:5px;
        
    }   
    .head{
        font-size:45px;
        font-family: fantasy;
        text-shadow:1px 1px  #f00e77 ;
    }
    @media screen and (max-width: 600px) {
            .container{
              width:100%;
                      } 
            .button{
            width: 100%;
                    }
}



.error{
    color: red;
}

</style>   
</head>    
<body>   
<div class="container"> 
    <h1 class="head">  LOGIN FORM </h1>  
    <form id="log">  
          
            <label for="email">EMAIL ID : </label>   
            <input type="email" placeholder="Enter email id" name="email" id="email"><br>
            <label for="pwd">PASSWORD : </label>   
            <input type="password" placeholder="Enter Password" name="password"  id="pwd">  <br>

            <button type="button" id="btn" onclick="login()">Login</button>   <br>   
    </form> 
    </div>    

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <script>

        function login() {
    
            var email = document.getElementById("email").value;
            var password = document.getElementById("pwd").value;
    
            // if(email != "") {
    
            //     if (password != "") {
    
                   if(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email)) {
    
                        $("#btn").html("<i class=\"fa fa-spinner fa-spin\"></i> Loading...");
    
                        $.ajax({
                            type: "POST",
                            url: "login_ajax.php",
                            data: $.param({email: email, password: password}),
                            dataType: "json",
    
                            success: function(res){
                                if(res.status=='success')
                                {
                                    //display the another page
                                    // window.location.href = '../dashboard/';
                                    Swal.fire(
                                        {
                                            title: res.msg,
                                            text: "Good vibes start",
                                            icon: "success",
                                            button: "OK",
                                            allowOutsideClick: false,
                                            allowEscapeKey: false,
                                            closeOnClickOutside: false,
                                            heightAuto: false,
    
                                        }
                                    )
                                    // 
                                    .then(() => {
                                        window.location.href="https://www.skynavgps.com/contact/";
                                        });
                                }
    
                                else if(res.status=='failure')
                                {
    
    
                                    Swal.fire(
                                        {
                                            title: res.msg,
                                            text: "OOPS...",
                                            icon: "warning",
                                            button: "OK",
                                            allowOutsideClick: false,
                                            allowEscapeKey: false,
                                            closeOnClickOutside: false,
                                            heightAuto: false,
    
                                        }
                                    )
                                        .then((value) => {
                                            $("#btn").html("Sign In");
                                        });
    
                                }
                            },
    
                            error: function() {
                                Swal.fire('Check your network connection')
    
                                document.getElementById("btn").disabled = true;
                                $("#btn").html("<span class=\"text\">Sign In</span>");
                            }
    
                        });
                   }
                   else{
                    Swal.fire(
                  'email required',
                  'email cannot be empty',
                  'warning')
                   }
    
            //     }
    
            //     else {
            //         //password
            //         Swal.fire(
            //             'password required',
            //             'password cannot be empty',
            //             'warning')
            //     }
    
            // }
            // else {
            //     //email
            //     Swal.fire(
            //         'email required',
            //         'email cannot be empty',
            //         'warning')
            // }
    
        }
    
        //enter key
        $("#pwd").keyup(function(event) {
            if (event.keyCode === 13) {
                login();
            }
        });
    </script>


</script>
</body>     
</html>

