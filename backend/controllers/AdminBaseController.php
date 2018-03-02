<?php
namespace backend\controllers;
use \yii\web\Controller;
use yii\filters\VerbFilter;

class AdminBaseController extends Controller{
    public $layout = 'main';

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

}