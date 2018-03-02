<?php
namespace backend\controllers;
use Yii;
use common\entities\Language;
use common\entities\Status;
use common\viewmodels\StaffTypeFormViewModel;
use common\entities\staffType;
use common\entities\staffTypeSearch;
use yii\web\NotFoundHttpException;

class StaffTypeController extends AdminBaseController
{
    /**
     * Staff Type: List
     */
    public function actionIndex()
    {
        $searchModel = new staffTypeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Staff Type: View
     */
    public function actionView($id)
    {
        $model = StaffType::getFullStaffType($id);

        return $this->render('view', [
            'model' => $model
        ]);
    }

    /**
     * Staff Type: Create
     */
    public function actionCreate()
    {
        $vm = new StaffTypeFormViewModel();
        $vm->model = new StaffType();
        $vm->statuses = Status::getStatusList();
        $vm->languages = Language::getLanguageList();

        if ($vm->model->load(Yii::$app->request->post())) {

            $vm->model->save();
            return $this->redirect(['view', 'id' => $vm->model->Id]);
        }

        return $this->render('create', [
            'vm' => $vm,
        ]);
    }

    /**
     * Staff Type: Update
     */
    public function actionUpdate($id)
    {
        $vm = new StaffTypeFormViewModel();
        $vm->model = $this->findModel($id);
        $vm->statuses = Status::getStatusList();
        $vm->languages = Language::getLanguageList();


        if ($vm->model->load(Yii::$app->request->post())) {
            $vm->model->save();
            return $this->redirect(['view', 'id' => $vm->model->Id]);
        }

        return $this->render('update', [
            'vm' => $vm,
        ]);
    }

    /**
     * Staff Type: Delete
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Staff Type: Find model
     */
    protected function findModel($id)
    {
        if (($model = staffType::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
