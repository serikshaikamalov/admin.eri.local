<?php
namespace backend\controllers;
use Yii;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use common\entities\Language;
use common\entities\Status;
use common\entities\DailyMonitor;
use common\entities\DailyMonitorSearch;
use common\viewmodels\DailyMonitorViewModel;
use common\viewmodels\DailyMonitorFormViewModel;



class DailyMonitorController extends AdminBaseController
{
    /**
     * Daily Monitor: List
     */
    public function actionIndex()
    {
        $searchModel = new DailyMonitorSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Daily Monitor: View
     */
    public function actionView($id)
    {
        // $model from DB
        $model = DailyMonitor::find()
                    ->where(['Id'=>$id])
                    ->with('language')
                    ->with('user')
                    ->with('status')
                    ->one();

        // ViewModel
        $vm = new DailyMonitorViewModel();
        $vm->Id = $model->Id;
        $vm->Title = $model->Title;
        $vm->Description = $model->Description;
        $vm->LanguageId = $model->LanguageId;
        $vm->Language = $model->language;
        $vm->CreatedBy = $model->CreatedBy;
        $vm->ImageId = $model->ImageId;
        $vm->Image = Yii::$app->imagemanager->getImagePath($model->ImageId, 400, 400,'inset');
        $vm->Author = $model->user;
        $vm->CreatedDate = $model->CreatedDate;
        $vm->Link = $model->Link;
        $vm->IsActive = $model->IsActive;
        $vm->Status = $model->status;

        
        return $this->render('view', [
            'vm' => $vm,
        ]);
    }

    /**
     * Daily Monitor: Create
     */
    public function actionCreate()
    {
        $vm = new DailyMonitorFormViewModel();
        $vm->model = new DailyMonitor();
        $vm->languages = Language::find()->all();
        $vm->languages = ArrayHelper::map($vm->languages, 'Id', 'Title');
        $vm->statuses = Status::find()->all();
        $vm->statuses = ArrayHelper::map($vm->statuses, 'Id', 'Title');

        // POST
        if ($vm->model->load(Yii::$app->request->post()))
        {
            $vm->model->CreatedBy = Yii::$app->user->id;
            $vm->model->CreatedDate = date('Y-m-d');

            $vm->model->save();
            return $this->redirect(['view', 'id' => $vm->model->Id]);
        }

        return $this->render('create', [
            'vm' => $vm,
        ]);
    }

    /**
     * Daily Monitor: Update
     */
    public function actionUpdate($id)
    {
        $vm = new DailyMonitorFormViewModel();
        $vm->model = $this->findModel($id);
        $vm->languages = Language::find()->all();
        $vm->languages = ArrayHelper::map($vm->languages, 'Id', 'Title');
        $vm->statuses = Status::find()->all();
        $vm->statuses = ArrayHelper::map($vm->statuses, 'Id', 'Title');

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
     * Daily Monitor: Delete
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Daily Monitor: Find one
     */
    protected function findModel($id)
    {
        if (($model = DailyMonitor::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
