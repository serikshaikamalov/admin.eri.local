<?php
namespace api\controllers;
use \Yii;


class MailController extends ApiBaseController {

    public $subject;
    public $text;
    public $sendFrom;
    public $sendTo;


    public function actionSend(
        string $sendFrom = "",
        string $email = "",
        string $subject = "",
        string $text = ""
    ){

        $status = true;

        if( $sendFrom && $email && $subject && $text )
        {
            $body = '<p>User name: '.$sendFrom.'</p>';
            $body .= '<p>User email: '.$email.'</p>';
            $body .= '<p>Subject: '.$subject.'</p>';
            $body .= '<p>Text: '.$text.'</p>';

            Yii::$app->mail->compose()
                ->setFrom('info@gosmart.kz')
                ->setTo('serik.shaikamalov@gmail.com')
                ->setSubject( $subject )
                ->setTextBody($body)
                ->setHtmlBody($body)
                ->send();
        }

        return true;
    }


}