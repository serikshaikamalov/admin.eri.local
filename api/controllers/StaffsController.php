<?php
namespace api\controllers;
use api\viewmodels\StaffListVM;
use api\viewmodels\StaffVM;
use common\repositories\StaffRepository;
use Yii;

class StaffsController extends ApiBaseController
{
    public $defaultAction = 'index';
    public $repo;
    public $pageNumber;
    public $limit;
    public $offset;
    public $totalCount;

    public function  __construct(string $id,
                                 $module,
                                 StaffRepository $repo,
                                 array $config = []
                                 )
    {
        parent::__construct($id, $module, $config);
        $this->repo = $repo;
        $this->pageNumber = 1;
        $this->limit = 10;
        $this->offset = 10;

    }

    /*
     * @returns:  List of staffs
     */
    public function actionIndex( int $languageId = 1, int $pageNumber = 1 )
    {
        $this->pageNumber = $pageNumber;
        $this->offset = $this->limit * ($this->pageNumber - 1);
        $this->totalCount = $this->repo->count( $languageId );

        $staffVMList = new StaffListVM();
        $staffVMList->page = $this->pageNumber;
        $staffVMList->totalCount = $this->totalCount;
        $staffs = $this->repo->getAll( $languageId, $this->offset, $this->limit );

        if( count($staffs) > 0 ){
            foreach ($staffs as $staff){

                $staffVM = new StaffVM();
                $staffVM->Id = $staff->Id;
                $staffVM->FullName = $staff->FullName;
                $staffVM->ShortBiography = $staff->ShortBiography;
                $staffVM->FullBiography = $staff->FullBiography;
                $staffVM->PublicationMainTagId = $staff->PublicationMainTagId;
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
                $staffVM->PublicationMainTag = $staff->publicationMainTag ? $staff->publicationMainTag : null;
                $staffVMList->items[] = $staffVM;
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
            $staffVM->PublicationMainTagId = $staff->PublicationMainTagId;
            $staffVM->ImageId = $staff->ImageId;
            $staffVM->LanguageId = $staff->LanguageId;
            $staffVM->StatusId = $staff->StatusId;
            $staffVM->StaffTypeId = $staff->StaffTypeId;
            $staffVM->StaffPositionId = $staff->StaffPositionId;

            // Dictionaries
            $staffVM->ImageSrc = IMAGE_SERVER . '//media/images/' . Yii::$app->imagemanager->getImageByUrl($staff->ImageId, 400, 400,'inset');;
            $staffVM->Language = $staff->language ? $staff->language : null;
            $staffVM->StaffType = $staff->staffType ? $staff->staffType : null;
            $staffVM->StaffPosition = $staff->staffPosition ? $staff->staffPosition : null;
            $staffVM->Status = $staff->status ? $staff->status : null;
            $staffVM->PublicationMainTag = $staff->publicationMainTag ? $staff->publicationMainTag : null;
        }
        return $staffVM;
    }

}
