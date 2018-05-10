<?php
namespace backend\controllers;
use common\entities\Language;
use common\viewmodels\PostFormViewModel;
use Yii;
use common\entities\Article;
use common\entities\ArticleSearch;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;

class PostController extends AdminBaseController
{
    /**
     * Post: Delete
     */
    public function actionIndex()
    {
        $searchModel = new ArticleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Post: View
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Post: Create
     */
    public function actionCreate()
    {
        $vm = new PostFormViewModel();
        $vm->model = new Article();

        // Dictionaries
        $vm->languages = Language::getLanguageList();

        // POST
        if ($vm->model->load(Yii::$app->request->post())) {

            $vm->model->UserId = Yii::$app->user->id;
            if($vm->model->save()){
                return $this->redirect(['view', 'id' => $vm->model->Id]);
            }
        } else {
            return $this->render('create', [
                'vm' => $vm,
            ]);
        }
    }

    /**
     * Post: Update
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->Id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }


    /**
     * Post: Delete
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }


    /**
     * Post: Find one
     */
    protected function findModel($id)
    {
        if (($model = Article::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
