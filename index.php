<?php  
 session_start();  
 $host = "localhost";  
 $username = "root";  
 $password = "";  
 $database = "users_db";  
 $message = "";  
 try  
 {    //connection to db 
      $connect = new PDO("mysql:host=$host; dbname=$database", $username, $password);  
      $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
      if(isset($_POST["login"]))  
      {    //check if all fields are filled in order to login

           if(empty($_POST["username"]) || empty($_POST["password"]))  
           {  
                $message = '<label>All fields are required</label>';  
           }  
           else  
           {  
      
                //query to check if the user is registered in our database
                //sql injection handling
               
                $statement = $connect->prepare("Select * from users where username= :username and  password= :password");  
                $statement->execute(  
                     array(  
                          'username'     =>     $_POST["username"],  
                          'password'     =>     sha1($_POST["password"])
                     )  
                );  
                $count = $statement->rowCount();  
                if($count > 0)  
                {  
                     //using sessions to pass the information through different pages
                     $_SESSION["username"] = $_POST["username"];  

                     header("location:login_success.php");  
                }  
                else  
                {  
                     $message = '<label>Please insert the correct credentials to login!</label>';  

                }  
           }  
      }  
 }  //Exception error 
 catch(PDOException $error)  
 {  
      $message = $error->getMessage();  
 }  
 ?>  
 <!DOCTYPE html>  
 <html>  
      <head>

           <title>Login</title>  
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" /> 
           <link rel="stylesheet" href="css/style.css" />  
      </head>  
      <body> 
        <div class="header">
            <h1>Homepage</h1>

            </div> 
            
           <br />  
           <div class="container">  
                <?php  
                if(isset($message))  
                {  
                     echo '<label class="text-danger">'.$message.'</label>';  
                }
                if(isset($message1)){
                     echo '<label class="text-success">'.$message1.'</label>';  
            } 
                ?>  
                <! –– Form containing our form to login ––>

                <h3 align="center">Login</h3><br />  
                <form method="post">  
                     <label>Username</label>  
                     <input type="text" name="username" class="form-control" />  
                     <br />  
                     <label>Password</label>  
                     <input type="password" name="password" class="form-control" />  
                     <br />  
                     <input type="submit" name="login" class="btn btn-info" value="Login" />  
                     <br /> <br />

                     <label>Don't have an account ?</label>
                    <a href="register.php">Register here</a>

                </form>  
           </div>  
           <br /> 
           <div class="footer">
            <h1>Muhammad Asim Javed </h1>
            <p>m.asimjaved@hotmail.com</p>
            </div>  
      </body>  
 </html>