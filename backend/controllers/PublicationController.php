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

        // For Test
        $vm->model->StatusId = 1;
        $vm->model->LanguageId = $this->languageId;

        // Dictionaries
        $vm->publicationTypeList = PublicationType::getPublicationTypeList();
        $vm->publicationCategoryList = PublicationCategory::getPublicationCategoryList( $this->languageId);
        $vm->publicationMainTagList = PublicationMainTag::getPublicationMainTagList( $this->languageId );
        $vm->statuses = Status::getStatusList();
        $vm->languages = Language::getLanguageList();
        $vm->staffList = Staff::getStaffList( $this->languageId );


        // POST
        if ($vm->model->load(Yii::$app->request->post())) {
            $vm->model->save();
            #return $this->redirect(['view', 'id' => $vm->model->Id]);
            return $this->redirect(['create?languageId=4']);
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

        $vm->publicationTypeList = PublicationType::getPublicationTypeList();
        $vm->publicationCategoryList = PublicationCategory::getPublicationCategoryList( $this->languageId);
        $vm->publicationMainTagList = PublicationMainTag::getPublicationMainTagList( $this->languageId );
        $vm->statuses = Status::getStatusList();
        $vm->languages = Language::getLanguageList();
        $vm->staffList = Staff::getStaffList( $this->languageId );

        // POST
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
