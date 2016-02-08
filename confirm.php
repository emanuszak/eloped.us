<?php
$invitee_encoded = $_GET['invitee'];
$invitee = unserialize(base64_decode($invitee_encoded));
$response = $_GET['response'];
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <link href='https://fonts.googleapis.com/css?family=Vollkorn' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Judson' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link href="css/style2.css" rel="stylesheet">
    <meta charset="UTF-8">
    <title>ellen + ning</title>
</head>
<body>
  <div class="container">
    <div class="row">
      <div class="col-xs-8 col-xs-offset-2">
        <h1>Hi <?php echo $invitee->name;?></h1>
        
        <?php 
            switch(strtolower($response)) {
            case 'yes': ?>
    
                <p>Yay! :) Will <?php echo $invitee->related ?> be joining as well?</p>
                <div class="col-sm-5 btn btn-lg btn-default">Yes, of course!</div>
                <div class="col-sm-5 col-xs-offset-1 btn btn-lg btn-default">Just me.</div>
                
           <?php break;
            case 'no': ?>
                 <p>Boo :( </p>  
               
            <?php break;
                default: ?>                   
                <p>Will you be joining Ning and Ellen on December 12 to celebrate their marriage?</p>
                <div class="col-sm-5 btn btn-lg btn-default">Yes, wouldn't miss it!</div>
                <div class="col-sm-5 col-xs-offset-1 btn btn-lg btn-default">Sadly can't make it</div>
                    
            <?php break;
            } ?>
                    
            
    
       
      </div>
    </div>
  </div>
</body>
</html>
