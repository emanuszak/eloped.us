<?php
$invitee_encoded = $_GET['invitee'];
$invitee = unserialize(base64_decode($invitee_encoded));
$response = $_GET['response'];

if(empty($invitee) || empty($response)){
	header('Location: http://eloped.us');
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <link href='https://fonts.googleapis.com/css?family=Vollkorn' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Judson' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link href="/css/style2.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1"> 
    <title>ellen + ning</title>
</head>
<body>
  <div class="container">
    <div class="row choose-response">
      <div class="col-xs-8 col-xs-offset-2">
          <h1>Hi <span class="name"><?php echo $invitee->name;?></span>,</h1>
		  <?php 
            switch(strtolower($response)) {
            case 'yes': ?>
		          <p>We can't wait to see you on December 12! 
			       <?php if(!empty($invitee->related)){ 
				       
				       $related = $invitee->related;
			       ?>
			       Will <span class="name"><?php echo $invitee->related ?></span> be joining as well?</p>
			       <?php } else { 
				       $related = "mystery-guest";
			       ?>
			       <br/>Plus one?
			       
			       <?php } ?>
		          <div class="col-sm-5 center">
			          <a href="#" class="do-action" data-action="confirm" data-response="yes" data-invitee="<?php echo $invitee->name?>" data-related="<?php echo $related?>">Yes, of course!</a>
			      </div>
		          <div class="col-sm-5 col-sm-offset-1 center">
			          <a href="#" class="do-action" data-action="confirm" data-response="yes" data-invitee="<?php echo $invitee->name?>" data-related="just-me">I'll drink enough for two.</a>
			      </div>
                
           <?php break;
            case 'no': ?>
                 <p>We're sad that you won't be able to attend in person. <br/>Change Your RSVP?</p>  
                 <div class="col-sm-6 center">
			          <a href="#" class="do-action" data-action="confirm"  data-response="no" data-invitee="<?php echo $invitee->name?>" data-related="<?php echo $invitee->related?>">Celebrate another time!</a>
			      </div>
                 <div class="col-sm-6 center">
	                 <a href="?invitee=<?php echo $invitee_encoded;?>&response=yes" class="do-action" data-action="change">Change my RSVP.</a>
	             </div>
               
            <?php break;
                default: ?>                   
                <p>Will you be joining Ning and Ellen on December 12 to celebrate their marriage?</p>
				<div class="col-sm-5 center"><a href="#" class="do-action" data-action="prompt-name">Yes, wouldn't miss it!</a></div>
				<div class="col-sm-5 col-sm-offset-1 center"><a href="#" class="do-action" data-action="prompt-name">Sadly can't make it</a></div
                    
            <?php break;
            } ?>
                    
            <form id="confirmation" method="post" action="php/confirm-mailer.php">
            	<input type="hidden" id="response" name="response" value="<?php echo $response?>"/>
            	<input type="hidden" id="name" name="name" value="<?php echo $invitee->name?>"/>
            	<input type="hidden" id="last_name" name="last_name" value="<?php echo $invitee->last_name?>"/>
            	<input type="hidden" id="email" name="email" value="<?php echo $invitee->email?>"/>
            	<input type="hidden" id="related" name="related" value="<?php echo $invitee->related?>"/>
            	<input type="hidden" id="friend_of" name="friend_of" value="<?php echo $invitee->friend_of?>"/>
            </form>  
                   
      </div>
    </div>
               
    <div class="row yes-confirmation-message" style="display:none;">
        <div class="col-sm-6 col-sm-offset-3">
<!--
			<?php
				
			  $html = file_get_contents('php/email-confirm.html', FILE_USE_INCLUDE_PATH);
			  echo $html;
			  
			 ?>
-->
			 
			 <h1>Yay!</h1>
			 <p>The party is at 7pm at Livingston Manor, located at 42 Hoyt Street in Downtown Brooklyn, on December 12.</p>
			 <p>There will be plenty of food, cocktails, and cake.</p>
			 <p>No need to be formal&mdash;cocktail attire is just fine.</p>
             <p>We've sent you an email with the details. You can also check out more at <a href="http://www.eloped.us" target="_blank">eloped.us</a></p>
             <p style="font-size: 1.2em; margin-top: 5%;">Oh yeah, no gifts please. Your company is all we need.</p>
        </div>
    </div>
    
    <div class="row no-confirmation-message" style="display:none;">
        <div class="col-sm-8 col-sm-offset-2 sad-miles">
			<h1 style="padding-top: 25px;">Bummer.</h1>
			<h2>We'll celebrate another time soon.</h2>   
            <p class="inbound-link">Until then, see more at <a href="http://www.eloped.us" target="_blank">eloped.us</a></p>
        </div>
    </div>
    

  </div>
  <script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
  <script>
	  $(document).ready( function() {
			$(document).on('click', '.do-action', function(event, ui){
				var doNext = $(this).data('action');
				if(doNext == 'confirm'){
					$('#response').val($(this).data('response'));
					$('#related').val($(this).data('related'));
					
					$('#confirmation').submit();
				}
				
			});
			
			
			//Contact Form

		$(function() {
		
			// Get the form.
			var form = $('#confirmation');
		
			// Get the messages div.
			var formMessages = $('#form-messages');

				// Set up an event listener for the contact form.
				$(form).submit(function(e) {
					// Stop the browser from submitting the form.
					e.preventDefault();
					$('.choose-response').hide();

					// Serialize the form data.
					var formData = $(form).serialize();
			
					// Submit the form using AJAX.
					$.ajax({
						type: 'POST',
						url: $(form).attr('action'),
						data: formData
					})
					.done(function(response) {
						if($('#response').val()=='yes'){
							$('.yes-confirmation-message').fadeIn('slow');
						}else{
							$('.no-confirmation-message').fadeIn('slow');
						}
					})
					.fail(function(data) {
						// Make sure that the formMessages div has the 'error' class.
						$(formMessages).removeClass('success');
						$(formMessages).addClass('error');
			
						// Set the message text.
						if (data.responseText !== '') {
							$(formMessages).text(data.responseText);
						} else {
							$(formMessages).text('Oops! An error occurred and your message could not be sent.');
						}
					});
			
				});
			
			});
	  })
  </script>
  
<script src="//static.getclicky.com/js" type="text/javascript"></script>
<script type="text/javascript">try{ clicky.init(100889159); }catch(e){}</script>
<noscript><p><img alt="Clicky" width="1" height="1" src="//in.getclicky.com/100889159ns.gif" /></p></noscript>
</body>
</html>
