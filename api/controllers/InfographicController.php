<?php
namespace api\controllers;
use api\viewmodels\AsyaAvrupaListVM;
use api\viewmodels\AsyaAvrupaVM;
use api\viewmodels\InfographicListVM;
use api\viewmodels\InfographicVM;
use common\repositories\AsyaAvrupaRepository;
use common\repositories\InfographicRepository;
use dpodium\filemanager\components\FilemanagerHelper;

class InfographicController extends ApiBaseController
{
    public $defaultAction = 'index';
    public $repo;
    public $pageNumber;
    public $limit;
    public $offset;
    public $totalCount;

    public function  __construct(string $id,
                                 $module,
                                 InfographicRepository $repo,
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
     * @return InfographicListVM
     * @throws
     */
    public function actionIndex( int $languageId = 1,
                                 int $pageNumber = 1): InfographicListVM
    {
        $this->pageNumber = $pageNumber;
        $this->offset = $this->limit * ($this->pageNumber - 1);

        # REPO
        $this->totalCount = $this->repo->count( $languageId);

        $vmList = new InfographicListVM();
        $vmList->page = $this->pageNumber;
        $vmList->totalCount = $this->totalCount;

        # REPO
        $list = $this->repo->getAll( $languageId,
            $this->offset,
            $this->limit);

        if( count($list) > 0 ){
            foreach ($list as $one){

                $oneVM = new InfographicVM();
                $oneVM->Id = $one->Id;
                $oneVM->Title = $one->Title;
                $oneVM->StatusId = $one->StatusId;
                $oneVM->LanguageId = $one->LanguageId;
                $oneVM->CreatedDate = $one->CreatedDate;

                # Image
                $oneVM->ImageSrc = IMAGE_SERVER . '/media/images/' . \Yii::$app->imagemanager->getImageByUrl($one->ImageId, 400, 400,'inset');;

                $vmList->items[] = $oneVM;
            }
        }

        return $vmList;
    }
}
