<?php
namespace api\controllers;
use api\viewmodels\StaffVM;
use common\repositories\StaffRepository;
use Yii;

class StaffsController extends ApiBaseController
{
    public $defaultAction = 'index';
    public $repo;

    public function  __construct(string $id, $module, StaffRepository $repo, array $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->repo = $repo;
    }

    /*
     * @returns:  List of staffs
     */
    public function actionIndex( int $languageId = 1 )
    {
        $staffVMList = array();
        $staffs = $this->repo->getAll( $languageId );

        if( count($staffs) > 0 ){
            foreach ($staffs as $staff){

                $staffVM = new StaffVM();
                $staffVM->Id = $staff->Id;
                $staffVM->FullName = $staff->FullName;
                $staffVM->ShortBiography = $staff->ShortBiography;
                $staffVM->FullBiography = $staff->FullBiography;
                $staffVM->ResearchGroupId = $staff->ResearchGroupId;
                $staffVM->ImageId = $staff->ImageId;
                $staffVM->LanguageId = $staff->LanguageId;
                $staffVM->StatusId = $staff->StatusId;
                $staffVM->StaffTypeId = $staff->StaffTypeId;
                $staffVM->StaffPositionId = $staff->StaffPositionId;

                // Dictionaries
                $staffVM->ImageSrc = IMAGE_SERVER . '/media/images/' . Yii::$app->imagemanager->getImageByUrl($staff->ImageId, 400, 400,'inset');;
                $staffVM->Language = $staff->language ? $staff->language : null;
                $staffVM->StaffType = $staff->staffType ? $staff->staffType : null;
                $staffVM->StaffPosition = $staff->staffPosition ? $staff->staffPosition : null;
                $staffVM->Status = $staff->status ? $staff->status : null;
                $staffVM->ResearchGroup = $staff->researchGroup ? $staff->researchGroup : null;
                $staffVMList[] = $staffVM;
            }
        }

        return $staffVMList;
    }


    /*
     * @returns:  List of staffs
     */
    public function actionView( int $id )
    {
        $staff = $this->repo->get($id);
        $staffVM = new StaffVM();

        if( $staff ){
            $staffVM->Id = $staff->Id;
            $staffVM->FullName = $staff->FullName;
            $staffVM->ShortBiography = $staff->ShortBiography;
            $staffVM->FullBiography = $staff->FullBiography;
            $staffVM->ResearchGroupId = $staff->ResearchGroupId;
            $staffVM->ImageId = $staff->ImageId;
            $staffVM->LanguageId = $staff->LanguageId;
            $staffVM->StatusId = $staff->StatusId;
            $staffVM->StaffTypeId = $staff->StaffTypeId;
            $staffVM->StaffPositionId = $staff->StaffPositionId;

            // Dictionaries
            $staffVM->ImageSrc = IMAGE_SERVER . '/web/assets/media/' . Yii::$app->imagemanager->getImageByUrl($staff->ImageId, 400, 400,'inset');;
            $staffVM->Language = $staff->language ? $staff->language : null;
            $staffVM->StaffType = $staff->staffType ? $staff->staffType : null;
            $staffVM->StaffPosition = $staff->staffPosition ? $staff->staffPosition : null;
            $staffVM->Status = $staff->status ? $staff->status : null;
            $staffVM->ResearchGroup = $staff->researchGroup ? $staff->researchGroup : null;
        }
        return $staffVM;
    }

}
