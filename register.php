<?php 
// registeration page  
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
      if(isset($_POST["register"]))  
      {   //check if all fields are filled in order to register
           if(empty($_POST["username"]) || empty($_POST["email"]) || empty($_POST["password"]))  
           {  
                $message = '<label>All fields are required</label>';  
           }  
           else  
           {   

                //query to insert user to database
                $statement = $connect->prepare("INSERT INTO `users` (`username`, `password`,`email`) VALUES  
                (:username,:password,:email);");  
                $statement->execute(  
                     array( 
                           
                          'username'     =>     $_POST["username"],  
                          'password'     =>     sha1($_POST["password"]),
                           'email'     =>     $_POST["email"]   
                     )  
                );  
                $count = $statement->rowCount();  
                //check query result and display relevant message
                if($count > 0)  
                {  
                     $_SESSION["username"] = $_POST["username"]; 
                     $message1 = '<label>User registered successfully! </label><a href="index.php" align="center"> Click here to Login</a>'; 


                }  
                else  
                {  
                     $message = '<label>Error: User not registered!</label>';  

                }  
           }  
      }  
 } //exception error 
 catch(PDOException $error)  
 {  
      $message = $error->getMessage();  
 }  
 ?>  
 <!DOCTYPE html>  
 <html>  
      <head>  

           <title>Registeration</title> 
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" /> 
           <link rel="stylesheet" href="css/style.css" />  

      </head>  
      <body> 
      <div class="header">
            <h1>Registeration </h1>
     </div>  
           <br />  
           <div class="container"
           >  
                <?php  
                if(isset($message))  
                {  
                     echo '<label class="text-danger">'.$message.'</label>';  
                }
                if(isset($message1))  
                {  
                     echo '<label class="success">'.$message1.'</label>';  
                }
                ?>  
                 <! –– Form containing our form to register ––>
                <h3 align="center">Sign up</h3><br />  
                <form method="post">  
                     <label>Username</label>  
                     <input type="text" name="username" class="form-control" />  
                     <br />
                     <label>Email</label>  
                     <input type="email" name="email" class="form-control" />  
                     <br />   
                     <label>Password</label>  
                     <input type="password" name="password" class="form-control" />  
                     <br />  
                     <input type="submit" name="register" class="btn btn-info" value="Register" />  
                     <br /> <br />


                </form>  
           </div>  
           <br />  
           <div class="footer">
            <h1>Muhammad Asim Javed</h1>
            <p>m.asimjaved@hotmail.com</p>
            </div>  
      </body>  
 </html>