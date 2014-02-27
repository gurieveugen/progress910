<?php
include('../../../wp-blog-header.php');

if(isset($_POST["user_email"]))
{
	if(isset($_POST["user_name"]))
	{
		$name = trim($_POST["user_name"]);
	}
	else
	{
		$name = "";
	}

	$mail = trim($_POST["user_email"]);
	if(preg_match('|([a-z0-9_\.\-]{1,20})@([a-z0-9\.\-]{1,20})\.([a-z]{2,4})|is', $mail))
	{
		$to      = 'info@progress910.com';
		$subject = 'New subscriber';
		$message = "Hello, this letter came from the site ".get_bloginfo("home")."\n"
				  ."You have a new subscriber:";
		if(!empty($name))
		{
			$message.= " ".$name;
		}	

		$message.= " ".$mail;

		mail($to, $subject, $message);

		header("Location: /thank-you-for-subscribing"); /* Redirect browser */
		exit;
	}	
}
header("Location: /wrong-subscribe-data"); /* Redirect browser */
exit;