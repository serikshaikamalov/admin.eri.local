<?php
namespace backend\controllers;

use common\entities\Language;
use common\entities\Status;
use Yii;
use common\entities\EriInPress;
use common\entities\EriInPressSearch;
use yii\web\NotFoundHttpException;

class EriInPressController extends AdminBaseController
{
    /**
     * ERI In Press: List
     */
    public function actionIndex()
    {
        $searchModel = new EriInPressSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * ERI In Press: Create
     */
    public function actionCreate()
    {
        $vm = new \StdClass();
        $vm->model = new EriInPress();

        # DEFAULTS
        $vm->model->StatusId = 1;
        $vm->model->CreatedDate = date('Y-m-d');

        # DICTIONARIES
        $vm->statuses = Status::getStatusList();
        $vm->languages = Language::getLanguageList();

        # POST
        if ($vm->model->load(Yii::$app->request->post())) {
            if($vm->model->save()){
                Yii::$app->session->setFlash('success', "'".$vm->model->Title."' successfully saved!");
                return $this->redirect(['index']);
            }
        }

        return $this->render('create', [
            'vm' => $vm,
        ]);
    }

    /**
     * ERI In Press: Update
     */
    public function actionUpdate($id)
    {
        $vm = new \StdClass();
        $vm->model = $this->findModel($id);

        # DICTIONARIES
        $vm->statuses = Status::getStatusList();
        $vm->languages = Language::getLanguageList();

        # POST
        if ($vm->model->load(Yii::$app->request->post())) {
            if( $vm->model->save( )){
                Yii::$app->session->setFlash('success', "'".$vm->model->Title."' successfully saved!");
                return $this->redirect(['index']);
            }
        }

        return $this->render('update', [
            'vm' => $vm,
        ]);
    }

    /**
     * ERI In Press: Delete
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * ERI In Press: Find One
     */
    protected function findModel($id)
    {
        if (($model = EriInPress::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
