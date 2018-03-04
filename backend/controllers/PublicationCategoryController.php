<?php
namespace backend\controllers;
use common\entities\Language;
use common\entities\Status;
use common\forms\PublicationCategoryForm;
use common\repositories\PublicationCategoryRepository;
use common\viewmodels\PublicationCategoryFormViewModel;
use common\viewmodels\PublicationFormViewModel;
use Yii;
use common\entities\PublicationCategory;
use common\entities\PublicationCategorySearch;
use yii\web\NotFoundHttpException;

class PublicationCategoryController extends AdminBaseController
{
    public $repo;

    public function __construct(string $id, $module, PublicationCategoryRepository $repo, array $config = [])
    {
        parent::__construct($id, $module, $config);

        $this->repo = $repo;
    }

    /**
     * Publication Category: List
     */
    public function actionIndex()
    {
        $searchModel = new PublicationCategorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Publication Category: View
     */
    public function actionView($id)
    {
        $model = $this->repo->getFull($id);

        return $this->render('view', [
            'model' =>$model,
        ]);
    }

    /**
     * Publication Category: Create
     * загружает справочники дважды
     * Не понятно валидация
     * Тестирование
     *
     */
    public function actionCreate()
    {
        $vm = new PublicationCategoryFormViewModel();
        $vm->form = new PublicationCategoryForm();

        // POST
        if( Yii::$app->request->isPost == true ){

            // Заполняем форму данными которые пришли
            if ($vm->form->load(Yii::$app->request->post())) {

                // VALIDATE
                if( $vm->form->validate() ){
                    $publicationCategory = $this->repo->save($vm->form);
                    return $this->redirect(['view', 'id' => $publicationCategory->Id]);
                }
            }
        }

        $vm->publicationCategoryList = PublicationCategory::getPublicationCategoryList();
        $vm->languages = Language::getLanguageList();
        $vm->statuses = Status::getStatusList();

        return $this->render('create', [
            'vm' => $vm,
        ]);
    }

    /**
     * Publication Category: Update
     */
    public function actionUpdate($id)
    {
        $vm = new PublicationCategoryFormViewModel();
        $vm->form = new PublicationCategoryForm();

        // POST
        if( Yii::$app->request->isPost == true ){

            // Заполняем форму данными которые пришли
            if ($vm->form->load(Yii::$app->request->post())) {

                // VALIDATE
                if( $vm->form->validate() ){
                    $publicationCategory = $this->repo->edit($id, $vm->form);
                    return $this->redirect(['view', 'id' => $publicationCategory->Id]);
                }
            }
        }

        $vm->publicationCategoryList = PublicationCategory::getPublicationCategoryList();
        $vm->languages = Language::getLanguageList();
        $vm->statuses = Status::getStatusList();


        return $this->render('update', [
            'vm' => $vm,
        ]);
    }

    /**
     * Publication Category: Delete
     */
    public function actionDelete($id)
    {
        $pc = $this->repo->get($id);
        $this->repo->delete($pc);

        return $this->redirect(['index']);
    }

    /**
     * Publication Category: FindOne
     */
    protected function findModel($id)
    {
        if (($model = PublicationCategory::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
