<?php
namespace backend\controllers;
use common\entities\Language;
use common\entities\PublicationCategory;
use common\entities\PublicationMainTag;
use common\entities\PublicationType;
use common\entities\Staff;
use common\entities\Status;
use common\viewmodels\PublicationFormViewModel;
use Yii;
use common\entities\Publication;
use common\entities\publicationSearch;
use yii\helpers\ArrayHelper;
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
     * @param $id
     * @return string
     * @throws NotFoundHttpException
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
        $vm->model->tagIds = ArrayHelper::map( $vm->model->publicationTag, 'Id', 'Title');

        # DEFAULTS


        // For Test
        $vm->model->StatusId = 1;
        $vm->model->LanguageId = Yii::$app->language;

        # DICTIONARIES
        $vm->publicationTypeList = PublicationType::getPublicationTypeList();
        $vm->publicationCategoryList = PublicationCategory::getPublicationCategoryList();
        $vm->publicationMainTagList = PublicationMainTag::getPublicationMainTagList();
        $vm->statuses = Status::getStatusList();
        $vm->languages = Language::getLanguageList();
        $vm->staffList = Staff::getStaffList();


        // POST
        if ($vm->model->load(Yii::$app->request->post())) {
            $vm->model->save();
            #return $this->redirect(['view', 'id' => $vm->model->Id]);
            return $this->redirect(['create?languageId='.$this->languageId]);
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
        $vm = new PublicationFormViewModel();
        $vm->model = $this->findModel($id);

        # RELATIONS: Tags
        //$vm->model->tagIds = ArrayHelper::map( $vm->model->publicationTag, 'Id', 'Title');
        $vm->model->tagIds = $vm->model->publicationTag;

        # DEFAULTS

        # DICTIONARIES
        $vm->publicationTypeList = PublicationType::getPublicationTypeList();
        $vm->publicationCategoryList = PublicationCategory::getPublicationCategoryList();
        $vm->publicationMainTagList = PublicationMainTag::getPublicationMainTagList();
        $vm->statuses = Status::getStatusList();
        $vm->languages = Language::getLanguageList();
        $vm->staffList = Staff::getStaffList();

        # POST
        if ($vm->model->load(Yii::$app->request->post()))
        {
            $vm->model->save();
            return $this->redirect(['view', 'id' => $vm->model->Id]);
        }

        return $this->render('update', [
            'vm' => $vm,
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
