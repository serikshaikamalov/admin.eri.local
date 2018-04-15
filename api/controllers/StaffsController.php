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

    /**
<<<<<<< HEAD
     * @param $languageId
     * @param $pageNumber
     * @param $staffTypeId
=======
     * @param int $languageId
     * @param int $pageNumber
     * @param int $publicationMainTagId
>>>>>>> 51ed0953adec147d7dfbbba2a664b3bb787cd004
     * @return StaffListVM
     */
    public function actionIndex( int $languageId = 1,
                                 int $pageNumber = 1,
<<<<<<< HEAD
                                 int $staffTypeId = 0 ): StaffListVM
=======
                                 int $publicationMainTagId = 0 ): StaffListVM
>>>>>>> 51ed0953adec147d7dfbbba2a664b3bb787cd004
    {
        $this->pageNumber = $pageNumber;
        $this->offset = $this->limit * ($this->pageNumber - 1);

<<<<<<< HEAD
        // REPO
        $this->totalCount = $this->repo->count( $languageId,
                                                $staffTypeId );
=======
        // Total Count
        $this->totalCount = $this->repo->count( $languageId,
                                                $publicationMainTagId );
>>>>>>> 51ed0953adec147d7dfbbba2a664b3bb787cd004

        $staffVMList = new StaffListVM();
        $staffVMList->page = $this->pageNumber;
        $staffVMList->totalCount = $this->totalCount;

<<<<<<< HEAD
        // REPO
        $staffs = $this->repo->getAll( $languageId,
                                       $this->offset,
                                       $this->limit,
                                       $staffTypeId);
=======
        // Repo
        $staffs = $this->repo->getAll( $languageId,
                                       $this->offset,
                                       $this->limit,
                                       $publicationMainTagId );
>>>>>>> 51ed0953adec147d7dfbbba2a664b3bb787cd004

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
