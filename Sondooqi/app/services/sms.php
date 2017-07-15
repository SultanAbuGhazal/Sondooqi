<?php

class SmsService extends Model{
    function sendConfirmationCode($mobile, $code){
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
    }
}