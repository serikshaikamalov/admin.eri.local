<?php
namespace backend\controllers;
use common\entities\Language;
use common\entities\Status;
use Yii;
use common\entities\Infographic;
use common\entities\InfographicSearch;
use yii\web\NotFoundHttpException;

class InfographicController extends AdminBaseController
{
    /**
     * Infographic: List
     */
    public function actionIndex()
    {
        $searchModel = new InfographicSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Infographic: Create
     */
    public function actionCreate()
    {
        $vm = new \StdClass();

        $vm->model = new Infographic();

        # DEFAULTS
        $vm->model->CreatedDate = date('Y-m-d');
        $vm->model->CreatedBy = Yii::$app->user->id;
        $vm->model->StatusId = 1;

        # DICTIONARIES
        $vm->statuses = Status::getStatusList();
        $vm->languages = Language::getLanguageList();

        # POST
        if ($vm->model->load(Yii::$app->request->post())) {
            $vm->model->save();
            return $this->redirect('/infographic/index');
        }

        return $this->render('create', [
            'vm' => $vm,
        ]);
    }

    /**
     * Infographic: Update
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

            $vm->model->save();
            return $this->redirect('/infographic/index');
        }

        return $this->render('update', [
            'vm' => $vm,
        ]);
    }

    /**
     * Infographic: Delete
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Infographic: FindOne
     */
    protected function findModel($id)
    {
        if (($model = Infographic::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
