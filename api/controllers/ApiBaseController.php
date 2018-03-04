<?php
namespace api\controllers;
use yii\rest\Controller;

class ApiBaseController extends Controller {

    public $enableCsrfValidation = false;

    public static function allowedDomains()
    {
        return [
            // '*',                        // star allows all domains
            'http://localhost:4200'
        ];
    }

    /*
     * Allow access to FrontEnd
     */
    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
            'corsFilter'  => [
                'class' => \yii\filters\Cors::className(),
                'cors'  => [
                    'Origin'                           => static::allowedDomains(),
                    'Access-Control-Request-Method'    => ['POST'],
                    'Access-Control-Allow-Credentials' => true,
                    'Access-Control-Max-Age'           => 3600,
                ],
            ],
        ]);
    }


}