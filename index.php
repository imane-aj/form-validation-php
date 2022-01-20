<?php
      $user = $mail = $phone = $msg = $userError = $mailError = $phoneError = $msgError = '';
      $issucces = false;
  
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
          $user  = checkInput($_POST['username']) ;
          $mail  = checkInput($_POST['mail']) ;
          $phone = checkInput($_POST['phone']) ;
          $msg   = checkInput($_POST['msg']) ;
           $issucces = true;
           
           if(strlen($user)<4){
                $userError = 'The UserName can\'t be less than <strong>4</strong> characteres ';
                
           }if(!isEmail($mail)){
                $mailError = 'Write the <strong> correct </strong> Email';
           }if(!isPhone($phone)){
                $phoneError = 'Write the <strong> correct </strong> Cell phone';
           }if(strlen($msg)<10){
                $msgError = 'The message must contains at less than <strong>10</strong> characteres';
           }
           if(isset($_POST['form'])){
             if(empty($userError) and empty($mailError) and empty($phoneError) and empty($msgError)){
                  
                  $headrs  = 'From: ' . $mail . '\r\n';
                  $myEmail = 'soufiane.dareen@gmail.com';
                  $subject = "Contact Form";
                  mail($myEmail, $subject, $msg ,$headrs);
                  $issucces = true;
                  $user = '';
                  $mail = '';
                  $phone = '';
                  $msg = '';
                   
                  $succes = '<div class="alert alert-success"> We have recieved your message </div>';
             }
           }
      }
                       function checkInput($data){
                          $data = trim($data) ;
                          $data = stripslashes($data) ;
                          $data = htmlspecialchars($data) ;
                          return $data;}
                       function isPhone($var){
                            return preg_match('/^[0-9 ]*$/',$var);}
                       function isEmail($var){
                            return filter_var($var,FILTER_VALIDATE_EMAIL);}
             



?>


<!DOCTYPE html>
<html lang='en'>
     <head>
       <title>VALIDATION FORM WITH PHP</title>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <link rel='stylesheet'  href='boot/bootstrap.css'>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
        <link href="https://fonts.googleapis.com/css2?family=STIX+Two+Math&display=swap" rel="stylesheet">
        <link rel='stylesheet' href='form.css'>
     </head>
     <body>
         
           <div class='container'>
          
               <h1 class='text-center'>contact me</h1>
               <form class='contact-form' method='post' action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>'>
                    
                  <input class='form-control' requerd type='text' name='username' placeholder='Type Your Username' value='<?php if(isset($user)){ echo $user;}?>'> 
                    <i class="fa fa-user fa-fw"></i>
                    <span class='errorMsg'><?php echo $userError; ?></span>
                    
                  <input class='form-control' type='text' name='mail' placeholder='Type Your Email' value='<?php if(isset($mail)){ echo $mail;}?>'>
                    <i class="fa fa-envelope fa-fw"></i>
                    <span class='errorMsg'><?php echo $mailError; ?></span>
                    
                  <input class='form-control' type='phone' name='phone' placeholder='Type Your Cell Phone' value='<?php if(isset($phone)){ echo $phone;}?>'>
                    <i class="fa fa-phone fa-fw"></i>
                    <span class='errorMsg'><?php echo $phoneError; ?></span>
                  <textarea class='form-control' name='msg' placeholder='Your Message' value='<?php if(isset($msg)){ echo $msg;}?>'></textarea>
                    <span class='errorMsg'><?php echo $msgError; ?></span>
                   
                  <input class='btn btn-success' type='submit' name='form' value='Send Message'> 
                    <i class="fa fa-paper-plane fa-fw"></i>
                    <p><?php if(isset($succes)){ echo $succes;}?></p>
               </form>
       
          </div>
          
          
          
          
          
          
      
           <script src='boot/jquery-3.6.0.min.js'></script>
          <script src='boot/bootstrap.min.js'></script>
     </body>

</html>