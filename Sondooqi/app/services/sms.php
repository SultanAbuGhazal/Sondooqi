<?php

class SmsService extends Model{
    function sendConfirmationCode($mobile, $code){
        $message = "You Sondooqi confirmation code is $code. Thank you for using Sondooqi.";
        $myfile = fopen("sms-messages.txt", "w") or die("Unable to open file!");
        fwrite($myfile, $message);
        fwrite($myfile, "\n");
        fclose($myfile);
        /*
        //to be tested when migrated to hosting server

        $to = $mobile;
        $subject = 'Sondooqi Account Confirmation';
        $headers[] = 'MIME-Version: 1.0';
        $headers[] = 'Content-type: text/html; charset=utf-8';
        $headers[] = 'From: Sondooqi-noreply <noreply@sondooqi.com>';


        mail(
            $to, 
            $subject, 
            "Your confirmation code is $code, Thank you and happy Shipping!", 
            implode("\r\n", $headers)
        );
        */
    }
}