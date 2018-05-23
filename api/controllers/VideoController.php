<?php
namespace api\controllers;

use api\viewmodels\VideoListVM;
use api\viewmodels\VideoVM;
use common\repositories\VideoRepository;

class VideoController extends ApiBaseController
{
    public $defaultAction = 'index';
    public $repo;
    public $pageNumber;
    public $limit;
    public $offset;
    public $totalCount;

    public function  __construct(string $id,
                                 $module,
                                 VideoRepository $repo,
                                 array $config = []
    )
    {
        parent::__construct($id, $module, $config);
        $this->repo = $repo;
        $this->pageNumber = 1;
        $this->limit = 8;
        $this->offset = 8;
    }

    /**
     * @param $languageId
     * @param $pageNumber
     * @return VideoListVM
     */
    public function actionIndex( int $languageId = 1,
                                 int $pageNumber = 1): VideoListVM
    {
        #sleep(1);
        $vmList = new VideoListVM();

        // PAGINATION
        $this->pageNumber = $pageNumber;
        $this->offset = $this->limit * ($this->pageNumber - 1);

        // GET TOTAL COUNT
        $this->totalCount = $this->repo->count($languageId);

        $vmList->page = $this->pageNumber;
        $vmList->totalCount = $this->totalCount;


        // REPO
        $videoList = $this->repo->getAll( $languageId,
            $this->offset,
            $this->limit);

        if( count($videoList) > 0 ){
            foreach ($videoList as $video){

                $oneVM = new VideoVM();
                $oneVM->Id = $video->Id;
                $oneVM->Title = $video->Title;
                $oneVM->Description = $video->Description;
                $oneVM->Url = $video->Url;
                $oneVM->StatusId = $video->StatusId;
                $oneVM->CDate = $video->CDate;
                $oneVM->LanguageId = $video->LanguageId;
                $oneVM->Hits = $video->Hits;

                $vmList->items[] = $oneVM;
            }
        }

        return $vmList;
    }


    /**
     * @param int $Id
     * @param int $languageId
     * @return VideoVM
     */
    public function actionView( int $id = 0, int $languageId = 1 ): VideoVM
    {
        $video = $this->repo->get($id, $languageId);
        $oneVM = new VideoVM();

        if( $video ){
            $oneVM->Id = $video->Id;
            $oneVM->Title = $video->Title;
            $oneVM->Description = $video->Description;
            $oneVM->Url = $video->Url;
            $oneVM->StatusId = $video->StatusId;
            $oneVM->CDate = $video->CDate;
            $oneVM->LanguageId = $video->LanguageId;
            $oneVM->Hits = $video->Hits;
        }
        return $oneVM;
    }
}