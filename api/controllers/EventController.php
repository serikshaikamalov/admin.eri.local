<?php
namespace app\modules\api\controllers;

use Yii;
use app\modules\api\models\EventVM;


class EventController extends ApiBaseController
{
    /*
     * @returns:  List of staffs
     */
    public function actionList()
    {
        $eventVMList = array();

        // Find Staffs
        $events = Events::find()->all();

        if( count($events) > 0 ){
            for ( $i=0; $i < count($events); $i++){
                $eventsVM = new EventVM();
                $eventsVM->Id = $events[$i]->Id;

                $eventsVM->Title = $events[$i]->Title;
                $eventsVM->StartTime = $events[$i]->StartTime;
                $eventsVM->EndTime = $events[$i]->EndTime;
                $eventsVM->Description = $events[$i]->Description;
                $eventsVM->EventCategoryId = $events[$i]->EventCategoryId;
                $eventsVM->LangId = $events[$i]->LangId;
                $eventsVM->SpeakerFullName = $events[$i]->SpeakerFullName;
                $eventsVM->CreatedBy = $events[$i]->CreatedBy;
                $eventsVM->IsActive = $events[$i]->IsActive;

                $eventVMList[] = $eventsVM;
            }
        }
        $response = Yii::$app->response;
        $response->format = 'json';
        $response->data = $eventVMList;
        return $response;
    }


    /*
     * @return staff by Id
     */
    public function actionOne( $Id )
    {
        if( $Id ){

            $event = Events::findOne($Id);
            $response = Yii::$app->response;
            $response->format = 'json';
            $response->data = $event;
            return $response;
        }
    }
}
