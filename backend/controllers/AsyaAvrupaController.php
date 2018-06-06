<?php
namespace backend\controllers;
use common\entities\Language;
use common\entities\Status;
use Yii;
use common\entities\AsyaAvrupa;
use common\entities\AsyaAvrupaSearch;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;

class AsyaAvrupaController extends AdminBaseController
{

    /**
     * AsyaAvrupa: List
     */
    public function actionIndex()
    {
        $searchModel = new AsyaAvrupaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * AsyaAvrupa: View
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * AsyaAvrupa: Create
     */
    public function actionCreate()
    {
        $vm = new \stdClass();
        $vm->model = new AsyaAvrupa();

        # Defaults
        $vm->model->CreatedDate = date('Y-m-d');
        $vm->model->StatusId = 1;

        # Dictionaries
        $vm->statuses = Status::getStatusList();
        #$vm->languages = Language::getLanguageList();
        $vm->languages = Language::find()->all();
        $vm->languages[] = ["Id" => 0, "Title" => "Neutral Language"];
        $vm->languages = ArrayHelper::map($vm->languages, 'Id', 'Title');

        # POST
        if ($vm->model->load(Yii::$app->request->post()) && $vm->model->save()) {
            return $this->redirect(['view', 'id' => $vm->model->Id]);
        }

        return $this->render('create', [
            'vm' => $vm,
        ]);
    }

    /**
     * AsyaAvrupa: Update
     */
    public function actionUpdate($id)
    {
        $vm = new \stdClass();
        $vm->model = $this->findModel($id);


        # Dictionaries
        $vm->statuses = Status::getStatusList();
        $vm->languages = Language::find()->all();
        $vm->languages[] = ["Id" => 0, "Title" => "Neutral Language"];
        $vm->languages = ArrayHelper::map($vm->languages, 'Id', 'Title');

        # POST
        if ($vm->model->load(Yii::$app->request->post()) && $vm->model->save()) {
            return $this->redirect(['view', 'id' => $vm->model->Id]);
        }

        return $this->render('update', [
            'vm' => $vm,
        ]);
    }

    /**
     * AsyaAvrupa: Delete
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * AsyaAvrupa: GetOne
     */
    protected function findModel($id)
    {
        if (($model = AsyaAvrupa::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
