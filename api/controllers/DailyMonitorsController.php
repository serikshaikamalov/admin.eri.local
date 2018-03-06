<?php
namespace api\controllers;
use api\viewmodels\DailymonitorVM;
use common\repositories\DailyMonitorRepository;
use Yii;

class DailyMonitorsController extends ApiBaseController
{
    public $defaultAction = 'index';
    public $repo;

    public function  __construct(string $id, $module, DailyMonitorRepository $repo, array $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->repo = $repo;
    }

    /*
     * Daily Monitor: List
     */
    public function actionIndex( int $languageId = 1 )
    {
        $dailyMonitorVMList = array();
        $dailyMonitors = $this->repo->getAll( $languageId );

        if( count($dailyMonitors) > 0 ){
            foreach ($dailyMonitors as $dailyMonitor){

                $dailyMonitorVM = new DailymonitorVM();
                $dailyMonitorVM->Id = $dailyMonitor->Id;
                $dailyMonitorVM->Title = $dailyMonitor->Title;
                $dailyMonitorVM->Description = $dailyMonitor->Description;
                $dailyMonitorVM->Link = $dailyMonitor->Link;
                $dailyMonitorVM->StatusId = $dailyMonitor->StatusId;
                $dailyMonitorVM->LanguageId = $dailyMonitor->LanguageId;
                $dailyMonitorVM->ImageId = $dailyMonitor->ImageId;

                // Dictionaries
                $dailyMonitorVM->ImageSrc = IMAGE_SERVER . '/media/images/' . Yii::$app->imagemanager->getImageByUrl($dailyMonitor->ImageId, 400, 400,'inset');;
                $dailyMonitorVM->Language = $dailyMonitor->language ? $dailyMonitor->language : null;
                $dailyMonitorVM->Status = $dailyMonitor->status ? $dailyMonitor->status : null;
                $dailyMonitorVMList[] = $dailyMonitorVM;
            }
        }

        return $dailyMonitorVMList;
    }


    /*
     * Daily Monitor: View
     */
    public function actionView( int $id )
    {
        $dailyMonitor = $this->repo->get($id);
        $dailyMonitorVM = new DailyMonitorVM();

        if( $dailyMonitor ){
            $dailyMonitorVM->Id = $dailyMonitor->Id;
            $dailyMonitorVM->Title = $dailyMonitor->Title;
            $dailyMonitorVM->Description = $dailyMonitor->Description;
            $dailyMonitorVM->Link = $dailyMonitor->Link;
            $dailyMonitorVM->StatusId = $dailyMonitor->StatusId;
            $dailyMonitorVM->LanguageId = $dailyMonitor->LanguageId;
            $dailyMonitorVM->ImageId = $dailyMonitor->ImageId;

            // Dictionaries
            $dailyMonitorVM->ImageSrc = IMAGE_SERVER . '/media/images/' . Yii::$app->imagemanager->getImageByUrl($dailyMonitor->ImageId, 400, 400,'inset');;
            $dailyMonitorVM->Language = $dailyMonitor->language ? $dailyMonitor->language : null;
            $dailyMonitorVM->Status = $dailyMonitor->status ? $dailyMonitor->status : null;
        }
        return $dailyMonitorVM;
    }

}
