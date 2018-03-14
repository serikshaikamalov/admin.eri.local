<?php
namespace api\controllers;
use api\viewmodels\NewsListVM;
use api\viewmodels\NewsVM;
use common\repositories\NewsRepository;
use common\repositories\PublicationCategoryRepository;
use Yii;

class NewsController extends ApiBaseController
{
    public $defaultAction = 'index';
    public $repo;
    public $repoPublicationCategory;
    public $pageNumber;
    public $limit;
    public $offset;
    public $totalCount;

    public function  __construct(string $id,
                                 $module,
                                 NewsRepository $repo,
                                 PublicationCategoryRepository $repoPublicationCategory,
                                 array $config = []
                                 )
    {
        parent::__construct($id, $module, $config);
        $this->repo = $repo;
        $this->repoPublicationCategory = $repoPublicationCategory;
        $this->pageNumber = 1;
        $this->limit = 10;
        $this->offset = 10;
    }

    /**
     * @param int $languageId
     * @param int $pageNumber
     * @param int $limit
     * @param string $orderBy
     *
     * @return NewsListVM
     */
    public function actionIndex(
                                 int $languageId = 1,
                                 int $pageNumber = 1,
                                 int $limit = 10,
                                 string $orderBy = 'Id'
                                ): NewsListVM
    {

        $this->pageNumber = $pageNumber;
        $this->limit = $limit;
        $this->offset = $this->limit * ($this->pageNumber - 1);

        $resultVMList = new NewsListVM();
        $resultVMList->PageNumber = $this->pageNumber;
        $resultVMList->TotalCount = $this->repo->count( $languageId);

        // GET PUBLICATIONS FROM DB
        $all = $this->repo->getAll( $languageId,
                                    $this->offset,
                                    $this->limit,
                                    $orderBy
                                    );

        if( count($all) > 0 ){
            foreach ($all as $one){

                $oneVM = new NewsVM();
                $oneVM->Id = $one->Id;
                $oneVM->Title = $one->Title;
                $oneVM->ShortDescription = $one->ShortDescription;
                $oneVM->FullDescription = $one->FullDescription;
                $oneVM->ImageId = $one->ImageId;
                $oneVM->LanguageId = $one->LanguageId;
                $oneVM->StatusId = $one->StatusId;
                $oneVM->CreatedDate =  date('F j, Y', strtotime($one->CreatedDate) );
                $oneVM->NewsCategoryId = $one->NewsCategoryId;
                $oneVM->Hits = $one->Hits;

                // Dictionaries
                $oneVM->ImageSrc = IMAGE_SERVER . '/media/images/' . Yii::$app->imagemanager->getImageByUrl($one->ImageId, 400, 400,'inset');;
                $oneVM->Language = $one->language ? $one->language : null;
                $oneVM->Status = $one->status ? $one->status : null;

                $resultVMList->Items[] = $oneVM;
            }
        }

        return $resultVMList;
    }


    /*
     * @param int $Id
     * @returns:  NewsVM
     */
    public function actionView( int $id ): NewsVM
    {
        $one = $this->repo->get($id);
        $oneVM = new NewsVM();

        if( $one ){
            $oneVM->Id = $one->Id;
            $oneVM->Title = $one->Title;
            $oneVM->ShortDescription = $one->ShortDescription;
            $oneVM->FullDescription = $one->FullDescription;
            $oneVM->ImageId = $one->ImageId;
            $oneVM->LanguageId = $one->LanguageId;
            $oneVM->StatusId = $one->StatusId;
            $oneVM->CreatedDate = $one->CreatedDate;
            $oneVM->NewsCategoryId = $one->NewsCategoryId;
            $oneVM->Hits = $one->Hits;

            // Dictionaries
            $oneVM->ImageSrc = IMAGE_SERVER . '/media/images/' . Yii::$app->imagemanager->getImageByUrl($one->ImageId, 400, 400,'inset');;
            $oneVM->Language = $one->language ? $one->language : null;
            $oneVM->Status = $one->status ? $one->status : null;


            // Update Hits
            $this->repo->updateHits($one->Id);
        }
        return $oneVM;
    }

}
