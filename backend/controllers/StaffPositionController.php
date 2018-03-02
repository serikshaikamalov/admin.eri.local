<?php
namespace backend\controllers;
use common\entities\Language;
use common\entities\Staff;
use common\entities\Status;
use common\viewmodels\StaffPositionFormViewModel;
use Yii;
use common\entities\StaffPosition;
use common\entities\StaffPositionSearch;
use yii\web\NotFoundHttpException;

class StaffPositionController extends AdminBaseController
{
    /**
     * Staff Position: List
     */
    public function actionIndex()
    {
        $searchModel = new StaffPositionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Staff Position: View
     */
    public function actionView($id)
    {
        $model = StaffPosition::getFullStaffPosition($id);

        return $this->render('view', [
            'model' => $model
        ]);
    }

    /**
     * Staff Position: Create
     */
    public function actionCreate()
    {
        $vm = new StaffPositionFormViewModel();
        $vm->model = new StaffPosition();
        $vm->languages = Language::getLanguageList();
        $vm->statuses = Status::getStatusList();


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
     * Staff Position: Update
     */
    public function actionUpdate($id)
    {
        $vm = new StaffPositionFormViewModel();
        $vm->model = $this->findModel($id);
        $vm->languages = Language::getLanguageList();
        $vm->statuses = Status::getStatusList();


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
     * Staff Position: Delete
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Staff Position: Find One
     */
    protected function findModel($id)
    {
        if (($model = StaffPosition::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
