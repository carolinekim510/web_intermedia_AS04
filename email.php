<?php
/*
*********************************************************
Name: Caroline Kim
Assignment: 04
Purpose: Create a contact form with proper data validation
Notes: Part 2 Email error or success
*********************************************************
 */
function redirect($url) {
    ob_start();
    header('Location: ' . $url);
    ob_end_flush();
    die();
}

function main() {

    if (!empty($_POST)) {

        $to = "caroline.kim@g.austincc.edu";
        $name = substr(strip_tags(trim($_POST['full-name'])),0,64);
        $title = substr(strip_tags(trim($_POST['title'])),0,64);
        $msg = substr(strip_tags(trim($_POST['user-msg'])),0);

        //Validate both emails
        $from01 = filter_var($_POST['user-email01'], FILTER_VALIDATE_EMAIL);
        $from02 = filter_var($_POST['user-email02'], FILTER_VALIDATE_EMAIL);

        if ($from01 != $from02) {
            redirect('email-error.html');
        }

        if ($name && $from01 && $from02 && $title && $msg) {
            $headers = "From: $name\r\n";
            $headers .= "Reply-To: $from01\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-type: text/plain; charset=iso-8859-1\r\n";

            $checkmail = mail($to, $title . ' : ' . $name, $msg, $headers);

            if ($checkmail == true) {
                redirect('email-success.html');
            }

        } else {
            redirect('email-error.html');
        }

    }
}

main();

?>