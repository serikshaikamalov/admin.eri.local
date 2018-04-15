<?php
namespace backend\controllers;
use \yii\web\Controller;
use yii\filters\VerbFilter;

class AdminBaseController extends Controller{
    public $layout = 'main';
    public $languageId = 1;

    public function __construct(string $id, $module, array $config = [])
    {
        parent::__construct($id, $module, $config);

        // INPUT
        $this->languageId = (\Yii::$app->request->get('languageId') > 0) ? \Yii::$app->request->get('languageId') : 1;
    }


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