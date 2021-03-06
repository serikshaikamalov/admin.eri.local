<?php
namespace backend\controllers;
use common\entities\Language;
use common\entities\Status;
use Yii;
use common\entities\News;
use common\entities\NewsSearch;
use yii\web\NotFoundHttpException;

class NewsController extends AdminBaseController
{
    /**
     * News: List
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new NewsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * News: View
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * News: Create
     */
    public function actionCreate()
    {
        $vm = new \StdClass();
        $vm->model = new News();

        # DEFAULTS
        $vm->model->NewsCategoryId = 1;
        $vm->model->StatusId = 1;
        $vm->model->CreatedDate = date('Y-m-d');

        # DICTIONARY
        $vm->statuses = Status::getStatusList();
        $vm->languages = Language::getLanguageList();

        # POST
        if ($vm->model->load(Yii::$app->request->post())) {
            $vm->model->save();
            return $this->redirect(['view', 'id' => $vm->model->Id]);
        }

        return $this->render('create', [
            'vm' => $vm,
        ]);
    }

    /**
     * News: Update
     */
    public function actionUpdate($id)
    {
        $vm = new \StdClass();
        $vm->model = $this->findModel($id);

        # DEFAULTS
        $vm->model->NewsCategoryId = 1;

        # DICTIONARY
        $vm->statuses = Status::getStatusList();
        $vm->languages = Language::getLanguageList();

        # POST
        if ($vm->model->load(Yii::$app->request->post())) {
            $vm->model->save();
            return $this->redirect(['view', 'id' => $vm->model->Id]);
        }

        return $this->render('update', [
            'vm' => $vm,
        ]);
    }

    /**
     * News: Delete
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * News: FindOne
     */
    protected function findModel($id)
    {
        if (($model = News::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}