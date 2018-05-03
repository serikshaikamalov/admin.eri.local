<?php

namespace backend\controllers;
use Yii;

class LanguageSwitcherController extends AdminBaseController {


    public function actionSetLanguage( string $languageTag ){
        $session = Yii::$app->session;

        //$language = $session->get('languageId') ? $session->get('languageId') : 1;

        $session->set('languageTag', $languageTag);


        return $this->goBack();
    }

}