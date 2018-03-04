<?php
namespace backend\controllers;
use common\viewmodels\PublicationFormViewModel;
use Yii;
use common\entities\publication;
use common\entities\publicationSearch;
use yii\web\NotFoundHttpException;

class PublicationController extends AdminBaseController
{

    /**
     * Publication: List
     */
    public function actionIndex()
    {
        $searchModel = new publicationSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Publication: View
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Publication: Create
     */
    public function actionCreate()
    {
        $vm = new PublicationFormViewModel();
        $vm->model = new Publication();

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
     * Publication: Update
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->Id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Publication: Delete
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Publication: findOne
     */
    protected function findModel($id)
    {
        if (($model = publication::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
