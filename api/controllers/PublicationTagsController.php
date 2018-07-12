<?php
namespace api\controllers;
use common\entities\Language;
use common\repositories\PublicationTagRepository;

class PublicationTagsController extends ApiBaseController
{
    public $defaultAction = 'index';
    public $repo;
    public $pageNumber;
    public $limit;
    public $offset;
    public $totalCount;

    public function  __construct(string $id,
                                 $module,
                                 PublicationTagRepository $repo,
                                 array $config = []
    )
    {
        parent::__construct($id, $module, $config);
        $this->repo = $repo;
        $this->pageNumber = 1;
        $this->limit = 5;
        $this->offset = 10;
    }

    /**
     * @param $languageId
     * @param $pageNumber
     * @param $searchQuery
     *
     * @return mixed
     */
    public function actionIndex( int $languageId = Language::LANGUAGE_ENGLISH,
                                 int $pageNumber = 1,
                                 string $searchQuery = ''
)
    {
        # PAGINATION
        $this->pageNumber = $pageNumber;
        $this->offset = $this->limit * ($this->pageNumber - 1);

        # TOTAL COUNT
        $this->totalCount = $this->repo->count( $languageId, $searchQuery);

        # DATA
        $list = $this->repo->getAll( $languageId,
            $this->offset,
            $this->limit,
            $searchQuery );

        # VIEW MODEL
        $vmList = new \stdClass();
        $vmList->Page = $this->pageNumber;
        $vmList->TotalCount = $this->totalCount;
        $vmList->LanguageId = $languageId;

        if( count($list) > 0 ){
            foreach ($list as $one){

                $oneVM = new \StdClass();
                $oneVM->Id = $one->Id;

                switch ($languageId){
                    case Language::LANGUAGE_ENGLISH :
                    default:
                    $oneVM->Title = $one->Title;
                        break;
                    case Language::LANGUAGE_TURKISH :
                        $oneVM->Title = $one->TitleTR;
                        break;
                    case Language::LANGUAGE_RUSSIAN :
                        $oneVM->Title = $one->TitleRU;
                        break;

                    case Language::LANGUAGE_KAZAKH :
                        $oneVM->Title = $one->TitleKZ;
                        break;
                }


                $oneVM->StatusId = $one->StatusId;

                $vmList->Items[] = $oneVM;
            }
        }

        return $vmList;
    }
}