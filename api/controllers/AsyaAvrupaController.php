<?php
namespace api\controllers;
use api\viewmodels\AsyaAvrupaListVM;
use api\viewmodels\AsyaAvrupaVM;
use common\repositories\AsyaAvrupaRepository;
use dpodium\filemanager\components\FilemanagerHelper;

class AsyaAvrupaController extends ApiBaseController
{
    public $defaultAction = 'index';
    public $repo;
    public $pageNumber;
    public $limit;
    public $offset;
    public $totalCount;

    public function  __construct(string $id,
                                 $module,
                                 AsyaAvrupaRepository $repo,
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
     * @param $languageId
     * @param $pageNumber
     *
     * @return AsyaAvrupaListVM
     */
    public function actionIndex( int $languageId = 1,
                                 int $pageNumber = 1): AsyaAvrupaListVM
    {
        $this->pageNumber = $pageNumber;
        $this->offset = $this->limit * ($this->pageNumber - 1);

        // REPO
        $this->totalCount = $this->repo->count( $languageId);

        $vmList = new AsyaAvrupaListVM();
        $vmList->page = $this->pageNumber;
        $vmList->totalCount = $this->totalCount;

        # REPO
        $list = $this->repo->getAll( $languageId,
            $this->offset,
            $this->limit);

        if( count($list) > 0 ){
            foreach ($list as $one){

                $oneVM = new AsyaAvrupaVM();
                $oneVM->Id = $one->Id;
                $oneVM->Title = $one->Title;
                $oneVM->TitleSecond = $one->TitleSecond;
                //$vmList->FileId = $one->FullBiography;
                $oneVM->InteractiveSrc = $one->InteractiveSrc;
                $oneVM->StatusId = $one->StatusId;
                $oneVM->LanguageId = $one->LanguageId;

                // File
                if( $one->FileId ){
                    $file = FilemanagerHelper::getFile($one->FileId, "file_identifier");
                    $oneVM->FileSrc = FILE_SERVER . $file['img_src'];
                }

                # Image
                $oneVM->ImageSrc = IMAGE_SERVER . '/media/images/' . \Yii::$app->imagemanager->getImageByUrl($one->ImageId, 400, 400,'inset');;

                $vmList->items[] = $oneVM;
            }
        }

        return $vmList;
    }
}
