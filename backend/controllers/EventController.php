<?php
namespace backend\controllers;
use common\entities\EventCategory;
use common\entities\Language;
use common\entities\Status;

use mdm\admin\models\User;
use Yii;
use common\entities\Event;
use common\entities\EventsSearch;
use yii\web\NotFoundHttpException;
use common\viewmodels\EventViewModel;
use common\viewmodels\EventFormViewModel;

class EventController extends AdminBaseController
{

   /*
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

    /*
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
        $eventViewModel->StartDay = $model->StartDay;
        $eventViewModel->StartTime = $model->StartTime;
        // Language
        $eventViewModel->Language = Language::findOne(['Id' => $model->LangId]);
        $eventViewModel->Description = $model->Description;
        $eventViewModel->SpeakerFullName = $model->SpeakerFullName;
        $eventViewModel->Address = $model->Address;
        $eventViewModel->Link = $model->Link;
        $eventViewModel->CreatedBy = User::findOne($model->CreatedBy);
        $eventViewModel->CreatedDate = $model->CreatedDate;
        $eventViewModel->UpdatedDate = $model->UpdatedDate;

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


    /*
     * Event: Create
     * Создаем общий viewModel и туда закидывем модельку и все данные
     */
    public function actionCreate()
    {
        $eventFormViewModel = new EventFormViewModel();

        $eventFormViewModel->model = new Event();
        $eventFormViewModel->languages = Language::find()->all();
        $eventFormViewModel->eventCategories = EventCategory::find()->all();
        $eventFormViewModel->statuses = Status::find()->all();

        if ($eventFormViewModel->model->load(Yii::$app->request->post())) {

            $eventFormViewModel->model->CreatedBy = Yii::$app->user->id;
            $eventFormViewModel->model->CreatedDate = date('Y-m-d H:i:s');
            $eventFormViewModel->model->UpdatedDate = date('Y-m-d H:i:s');


            $eventFormViewModel->model->save();
            return $this->redirect(['view', 'id' => $eventFormViewModel->model->Id]);
        }

        return $this->render('create', [
            'eventFormViewModel' => $eventFormViewModel
        ]);
    }

    
    /*
     * Event: Update
     */
    public function actionUpdate($id)
    {
        $eventFormViewModel = new EventFormViewModel();
        $eventFormViewModel->model = $this->findModel($id);
        $eventFormViewModel->model->StartDay = date('Y-m-d', strtotime($eventFormViewModel->model->StartDay));
        $eventFormViewModel->languages = Language::find()->all();
        $eventFormViewModel->eventCategories = EventCategory::find()->all();
        $eventFormViewModel->statuses = Status::find()->all();


        // POST
        if ($eventFormViewModel->model->load(Yii::$app->request->post())) {

            $eventFormViewModel->model->UpdatedDate = date('Y-m-d H:i:s');

            $eventFormViewModel->model->save();
            return $this->redirect(['view', 'id' => $eventFormViewModel->model->Id]);
        }

        return $this->render('update', [
            'eventFormViewModel' => $eventFormViewModel
        ]);
    }

    /*
     * Event: Delete
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /*
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