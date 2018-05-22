<?php
namespace backend\controllers;

use common\entities\Language;
use Yii;
use common\entities\Video;
use common\entities\VideoSearch;
use yii\web\NotFoundHttpException;

// Models
use common\viewmodels\VideoFormViewModel;
use common\entities\Status;

class VideoController extends AdminBaseController
{
    /**
     * VIDEO: LIST
     */
    public function actionIndex()
    {
        $searchModel = new VideoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * VIDEO: VIEW
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * VIDEO: CREATE
     */
    public function actionCreate()
    {
        $vm = new  VideoFormViewModel();
        $vm->model = new Video();

        // DEFAULT VALUES
        $vm->model->LanguageId = Yii::$app->language;
        $vm->model->StatusId = Status::STATUS_PUBLISHED;


        // DICTIONARIES
        $vm->statuses = Status::getStatusList();
        $vm->languages = Language::getLanguageList();


        // POST
        if ($vm->model->load(Yii::$app->request->post())) {
            $vm->model->save();
            return $this->redirect(['view', 'id' => $vm->model->Id]);
        }

        return $this->render('create', [
            'vm' => $vm,
        ]);
    }

    /**
     * VIDEO: UPDATE
     */
    public function actionUpdate($id)
    {
        $vm = new  VideoFormViewModel();
        $vm->model = $this->findModel($id);

        // DICTIONARIES
        $vm->statuses = Status::getStatusList();
        $vm->languages = Language::getLanguageList();


        // POST
        if ($vm->model->load(Yii::$app->request->post())) {
            $vm->model->save();
            return $this->redirect(['view', 'id' => $vm->model->Id]);
        }

        return $this->render('update', [
            'vm' => $vm,
        ]);
    }

    /**
     * VIDEO: DELETE
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * VIDEO: GET ONE
     */
    protected function findModel($id)
    {
        if (($model = Video::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
