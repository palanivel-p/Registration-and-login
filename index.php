<?php 
    $conn="conn.php"
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>registration page</title>
    <link rel = "stylesheet" href = "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"/>
</head>
<body>
    <style>   
        body {  
          font-family: Calibri, Helvetica, sans-serif;  
          background-color: rgb(13, 172, 145);  
        }  
        button {   
               background-color: #df7219;   
               width: 150px;  
                color: black;   
                padding: 10px;   
                margin: 20px 60px 10px 90px;   
                border: none;   
                cursor: pointer;   
                font-size:20px;
                font-family:fantacy;
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
                border: 2px solid rgb(131, 7, 131);   
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
                border: 1px solid #1fd154; 
                border-radius:5px;
                
            }   
            .lab{
                width: 100%;
                font-size: 20px;
                padding-top: 15px;
            }
            #head{
                font-family: fantasy;
                text-shadow:1px 1px  #f00e77 ;
            }
            @media only screen and (max-width: 600px) {
                input[type=text], input[type=password]
                {
                    width: 100px;
                }
             .container{
                      width:100px;
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
            <h1 id="head"> REGISTRATION FORM </h1>  
            <form id="log">  
                  
                    <label for="email" class="lab">EMAIL ID : </label>   
                    <input type="email" placeholder="Enter email id" name="email" id="email">  <br>
        
                    <label for="pwd" class="lab">PASSWORD : </label>   
                    <input type="password" placeholder="Enter Password" name="password"  id="pwd">  <br>

                    <label for="pwd1" class="lab">RE-ENTER PASSWORD : </label>   
                    <input type="password" placeholder="Re-Enter Password" name="password"  id="pwd1">  <br>
        
                    <button type="button" id="btn" onclick="register()">REGISTER</button>   <br>   
            </form> 
            </div>   
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>

                function register() {
            
                    var email = document.getElementById("email").value;
                    var password = document.getElementById("pwd").value;
                    var password1 = document.getElementById("pwd1").value;
                    
                    if(email != "") {
                        if(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email)) {

                         if (password != "") {
                           
                            if(password == password1)  {   
                                      
                        
                                        //$("#btn").html("<i class=\"fa fa-spinner fa-spin\"></i> Loading...");
                        
                                            $.ajax({
                                                type: "POST",
                                                url: "registration_ajax.php",
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
                                                        .then(() => {
                                                            window.location.href="login.php";
                                                        });
                                                    }
                        
                                                    else if(res.status=='failure')
                                                    {                      
                                                        Swal.fire(
                                                            {
                                                                title: "failure",
                                                                text: res.msg,
                                                                icon: "warning",
                                                                button: "OK",
                                                                allowOutsideClick: false,
                                                                allowEscapeKey: false,
                                                                closeOnClickOutside: false,
                                                                heightAuto: false,
                        
                                                            }
                                                        )}
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
                        {
                            title: "failure",
                            text: "password_mismatch",
                            icon: "warning",
                            button: "OK",
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            closeOnClickOutside: false,
                            heightAuto: false,

                        })
                }
                         }
                         else{
                            Swal.fire(
                            {
                                title: "failure",
                                text: "please enter password",
                                icon: "warning",
                                button: "OK",
                                allowOutsideClick: false,
                                allowEscapeKey: false,
                                closeOnClickOutside: false,
                                heightAuto: false,

                            }
                        )
                         }
                        }
                        else{
                            Swal.fire(
                                {
                                    title: "failure",
                                    text: "please enter valid email format",
                                    icon: "warning",
                                    button: "OK",
                                    allowOutsideClick: false,
                                    allowEscapeKey: false,
                                    closeOnClickOutside: false,
                                    heightAuto: false,

                                }
                            )
                        }
                    }else{
                        Swal.fire(
                        {
                            title: "failure",
                            text: "please enter email id",
                            icon: "warning",
                            button: "OK",
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            closeOnClickOutside: false,
                            heightAuto: false,

                        }
                    )
                    }

                }
                //enter key
                $("#pwd1").keyup(function(event) {
                    if (event.keyCode === 13) {
                        register();
                    }
                });
            </script>
            </body>
</html>