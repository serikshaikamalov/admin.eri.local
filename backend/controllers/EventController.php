<?php
namespace backend\controllers;
use Yii;
use mdm\admin\models\User;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use common\entities\EventCategory;
use common\entities\Language;
use common\entities\Status;
use common\entities\Event;
use common\entities\EventsSearch;
use common\viewmodels\EventViewModel;
use common\viewmodels\EventFormViewModel;

class EventController extends AdminBaseController
{
   /**
    * Event: List
    */
    public function actionIndex()
    {
        $searchModel = new EventsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Event: View
     */
    public function actionView($id)
    {
        // Model from db
        $model = $this->findModel($id);

        // $viewModel to View
        $eventViewModel = new EventViewModel();
        $eventViewModel->Id = $model->Id;
        $eventViewModel->Title = $model->Title;
        $eventViewModel->StartDate = $model->StartDate;

        $eventViewModel->Language = Language::findOne(['Id' => $model->LanguageId]);
        $eventViewModel->ShortDescription = $model->ShortDescription;
        $eventViewModel->FullDescription = $model->FullDescription;
        $eventViewModel->SpeakerFullName = $model->SpeakerFullName;
        $eventViewModel->Address = $model->Address;
        $eventViewModel->Link = $model->Link;
        $eventViewModel->CreatedBy = User::findOne($model->CreatedBy);
        $eventViewModel->CreatedDate = $model->CreatedDate;

        //Image
        $eventViewModel->Image = Yii::$app->imagemanager->getImagePath($model->ImageId, 400, 400,'inset');

        // Status
        $eventViewModel->Status = Status::findOne(['Id' => $model->StatusId ]);

        // Event Category
        $eventViewModel->EventCategory = EventCategory::findOne(['Id'=> $model->EventCategoryId ]);

        return $this->render('view', [
            'eventViewModel' => $eventViewModel
        ]);
    }

    /**
     * Event: Create
     * Создаем общий viewModel и туда закидывем модельку и все данные
     */
    public function actionCreate()
    {
        $eventFormViewModel = new EventFormViewModel();

        $eventFormViewModel->model = new Event();

        // Default Values
        $eventFormViewModel->model->LanguageId = Yii::$app->language;
        $eventFormViewModel->model->StatusId = 1;

        // Dictionaries
        $eventFormViewModel->eventCategories = EventCategory::find()->where(['LanguageId' => \Yii::$app->language] )->all();

        $eventFormViewModel->languages = Language::find()->all();
        $eventFormViewModel->languages[] = ["Id" => 0, "Title" => "Neutral Language"];
        $eventFormViewModel->languages = ArrayHelper::map($eventFormViewModel->languages, 'Id', 'Title');

        $eventFormViewModel->statuses = Status::find()->all();

        // Post
        if ($eventFormViewModel->model->load(Yii::$app->request->post())) {

            $eventFormViewModel->model->CreatedBy = Yii::$app->user->id;
            $eventFormViewModel->model->CreatedDate = date('Y-m-d H:i:s');

            // Save
            $eventFormViewModel->model->save();

            // Redirect
            return $this->redirect(['view', 'id' => $eventFormViewModel->model->Id]);
        }

        // Form View
        return $this->render('create', [
            'eventFormViewModel' => $eventFormViewModel
        ]);
    }

    
    /**
     * Event: Update
     */
    public function actionUpdate($id)
    {
        $eventFormViewModel = new EventFormViewModel();
        $eventFormViewModel->model = $this->findModel($id);

        #$eventFormViewModel->model->LanguageId = Yii::$app->language;
        $eventFormViewModel->model->StartDate = date('Y-m-d', strtotime($eventFormViewModel->model->StartDate));

        // Dictionaries
        $eventFormViewModel->eventCategories = EventCategory::find()->where(['LanguageId' => \Yii::$app->language] )->all();

        $eventFormViewModel->languages = Language::find()->all();
        $eventFormViewModel->languages[] = ["Id" => 0, "Title" => "Neutral Language"];
        $eventFormViewModel->languages = ArrayHelper::map($eventFormViewModel->languages, 'Id', 'Title');

        $eventFormViewModel->statuses = Status::find()->all();

        // POST
        if ($eventFormViewModel->model->load(Yii::$app->request->post())) {

            $eventFormViewModel->model->save();
            return $this->redirect(['view', 'id' => $eventFormViewModel->model->Id]);
        }

        return $this->render('update', [
            'eventFormViewModel' => $eventFormViewModel
        ]);
    }

    /**
     * Event: Delete
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Event: Find one
     */
    protected function findModel($id)
    {
        if (($model = Event::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}