<?php
namespace backend\controllers;
use common\entities\Language;
use common\entities\ResearchFellowCategory;
use common\entities\ResearchFellowType;
use common\entities\Status;
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
     * RESEARCH FELLOW: CREATE
     */
    public function actionCreate()
    {
        $vm = new \StdClass();
        $vm->model = new ResearchFellow();

        # DEFAULTS
        $vm->model->CreatedDate = date('Y-m-d');
        $vm->model->CreatedBy = Yii::$app->user->id;

        # DICTIONARY
        $vm->types = ResearchFellowType::getResearchFellowTypeList();
        $vm->categories = ResearchFellowCategory::getResearchFellowCategoryList();
        $vm->statuses = Status::getStatusList();
        $vm->languages = Language::getLanguageList();

        # POST
        if ($vm->model->load(Yii::$app->request->post())) {
            $vm->model->save();
            return $this->redirect(['/research-fellow/index']);
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
        $vm = new \StdClass();
        $vm->model = $this->findModel($id);

        # DICTIONARY
        $vm->types = ResearchFellowType::getResearchFellowTypeList();
        $vm->categories = ResearchFellowCategory::getResearchFellowCategoryList();
        $vm->statuses = Status::getStatusList();
        $vm->languages = Language::getLanguageList();

        # POST
        if ($vm->model->load(Yii::$app->request->post())) {
            $vm->model->save();
            return $this->redirect(['/research-fellow/index']);
        }

        return $this->render('update', [
            'vm' => $vm,
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
