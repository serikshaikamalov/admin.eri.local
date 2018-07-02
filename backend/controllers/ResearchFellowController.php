<?php
namespace backend\controllers;
use common\entities\ResearchFellowCategory;
use common\entities\ResearchFellowType;
use Yii;
use common\entities\ResearchFellow;
use common\entities\ResearchFellowSearch;
use yii\web\NotFoundHttpException;

class ResearchFellowController extends AdminBaseController
{
    /**
     * RESEARCH FELLOW: LIST
     */
    public function actionIndex()
    {
        $searchModel = new ResearchFellowSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * RESEARCH FELLOW: View
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * RESEARCH FELLOW: CREATE
     */
    public function actionCreate()
    {
        $vm = new \StdClass();
        $vm->model = new ResearchFellow();

        # DEFAULTS

        # DICTIONARY
        $vm->types = ResearchFellowType::getResearchFellowTypeList();
        $vm->categories = ResearchFellowCategory::getResearchFellowCategoryList();

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
     * RESEARCH FELLOW: UPDATE
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
     * RESEARCH FELLOW: DELETE
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * RESEARCH FELLOW: FindModel
     */
    protected function findModel($id)
    {
        if (($model = ResearchFellow::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
