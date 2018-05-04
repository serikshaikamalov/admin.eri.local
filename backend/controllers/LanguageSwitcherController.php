<?php

namespace backend\controllers;
use Yii;

class LanguageSwitcherController extends AdminBaseController {

    /**
     * @param int $languageId
     * @return \yii\web\Response
     */
    public function actionSetLanguage( int $languageId ){

        $session = Yii::$app->session;
        $session->set('languageId', $languageId);

        #Yii::$app->language = $language;
        #print_r( Yii::$app->language );
        #return $this->goBack();

        if(Yii::$app->request->referrer){
            return $this->redirect(Yii::$app->request->referrer);
        }else{
            return $this->goHome();
        }

    }

}