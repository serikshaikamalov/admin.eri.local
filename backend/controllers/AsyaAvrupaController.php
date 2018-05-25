<?php
namespace backend\controllers;
use Yii;
use common\entities\AsyaAvrupa;
use common\entities\AsyaAvrupaSearch;
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
        $model = new AsyaAvrupa();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->Id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * AsyaAvrupa: Update
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
