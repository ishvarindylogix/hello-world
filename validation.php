<?php
    $site_name = 'Next Hop';
    $admin_email = 'testfordemo2014@gmail.com';

	#echo '<pre>'; print_r($_POST); exit;

    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $company = trim($_POST['company']);
    $message = trim($_POST['message']);

    $errors = array();

    if($name == '' || $email == '' ) {
        $response = array('status' => 'error', 'message' => 'Please fill all the required fields.');
        echo json_encode($response);
        exit;
    }
    else {

        // Remove all illegal characters from email
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);

        // Validate email
        if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            $errors[] = 'Please enter valid email.';
        } 
       
        $errors = array_filter($errors);

        if (!empty($errors)) { // check if it contains any error
            $message = implode("<br>", $errors);
            $response = array('status' => 'error', 'message' => $message );
            echo json_encode($response);
            exit;    
        }
        else { // send the mail
    		$mailsubject = "Contact Form Details - ".$site_name;
			$sendmessage = "<br /><br />		
				<b>Name:</b> $name<br /><br />
				<b>Email:</b> $email<br /><br />
                <b>Company:</b> $company <br /><br />
                <b>Message:</b> $message <br /><br />
            <br />";
			$mail_str = "";
			$mail_str = '<html><head><link href="https://fonts.googleapis.com/css?family=M+PLUS+1p:300,400,500,700,800,900" rel="stylesheet" type="text/css"></head><body style="max-width: 600px; margin: 0 auto; font-family: \'M PLUS 1p\', sans-serif; font-size: 15px; line-height: 20px;">	<table style="border:1px solid #000000" width="95%" align="center" cellspacing="0" cellpadding="0">	<tbody><tr style="background-color:#ffd200;"><td style="padding: 10px; "><a href="#" style="color: #fff; font-weight: bold; font-size: 40px; text-decoration: none; display: block; line-height: normal;">'.$site_name.'</a></td></tr><tr style="background-color:#ffffff"><td style="padding: 10px; ">'.$sendmessage.' </td></tr><tr style="background-color:#ffd200; color: #fff;"><td style="padding: 10px; ">Thanks! - '.$site_name.'</td></tr></tbody></table></body></html>';                
			
			// To send HTML mail, the Content-type header must be set
            $headers[] = 'MIME-Version: 1.0';
            $headers[] = 'Content-type: text/html; charset=iso-8859-1';

            // Additional headers
            $headers[] = sprintf('From: %s <%s>', $name, $email);
            
			$headers = implode("\r\n", $headers);
			
			#echo "<hr/>"; echo $to_mail;echo "<hr/>";echo $mailsubject;echo $mail_str; echo $headers; exit;    
					
			$emailsend = mail($admin_email, $mailsubject, $mail_str, $headers);

			if($emailsend) {
				$response = array('status' => 'success', 'message' => sprintf('Thank you for contacting.'), 'email_sent' => $emailsend);
                echo json_encode($response);
                exit;
            }
            else {
                $response = array('status' => 'error', 'message' => 'Some error occured. Please try again.', 'email_sent' => $emailsend);
                echo json_encode($response);
                exit;
            }
        }
    }
	
    #---------------Mail For Admin (Ends)--------------------------------------------------

	//header("Location:thank-you.html");
	exit;
?>