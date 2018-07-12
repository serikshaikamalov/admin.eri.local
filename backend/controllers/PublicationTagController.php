<?php
namespace backend\controllers;

use common\entities\Language;
use common\entities\Status;
use Yii;
use common\entities\PublicationTag;
use common\entities\PublicationTagSearch;
use yii\web\NotFoundHttpException;


class PublicationTagController extends AdminBaseController
{
    /**
     * TAG: LIST
     */
    public function actionIndex()
    {
        $searchModel = new PublicationTagSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * TAG: CREATE
     */
    public function actionCreate()
    {
        $vm = new \StdClass();
        $vm->model = new PublicationTag();

        # DEFAULT
        $vm->model->StatusId = Status::STATUS_PUBLISHED;

        # DICTIONARIES
        $vm->statuses = Status::getStatusList();

        # POST
        if ($vm->model->load(Yii::$app->request->post())) {
            $vm->model->save();
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'vm' => $vm,
        ]);
    }

    /**
     * TAG: Edit
     */
    public function actionUpdate($id)
    {
        $vm = new \StdClass();
        $vm->model = $this->findModel($id);

        # DEFAULT

        # DICTIONARIES
        $vm->statuses = Status::getStatusList();

        # TEST
        $vm->publications = $vm->model->publication;

        # POST
        if ($vm->model->load(Yii::$app->request->post()) && $vm->model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'vm' => $vm,
        ]);
    }

    /**
     * TAG: Delete
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * TAG: FindOne
     */
    protected function findModel($id)
    {
        if (($model = PublicationTag::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
