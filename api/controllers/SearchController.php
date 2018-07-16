<?php
namespace api\controllers;

use api\viewmodels\search\SearchEntityVM;
use common\repositories\PublicationRepository;
use api\viewmodels\search\SearchVM;

class SearchController extends ApiBaseController
{
    public $publicationRepo;


    public function  __construct(string $id,
                                 $module,
                                 PublicationRepository $publicationRepo,
                                 array $config = []
    )
    {
        parent::__construct($id, $module, $config);
        $this->publicationRepo = $publicationRepo;
    }

    /**
     * @param string $query
     * @param int $languageId
     * @param string $section
     * @param int $pageNumber
     * @param int $limit
     * @param int $publicationTagId
     * 
     * @return SearchVM
     */
    public function actionIndex(
        string $query = '',
        int $languageId = 1,
        string $section = 'all',
        int $pageNumber = 1,
        int $limit = 10,
        int $publicationTagId = 0
    ): SearchVM{
        
        $result = new SearchVM();

        if( strlen($query) > 0 ){

            switch ( $section ){
                case 'all':
                    $offset = $limit * ($pageNumber - 1);

                    # FIND Publications
                    $publications = $this->publicationRepo->getAll(
                        1,
                        $languageId,
                        $offset,
                        $limit,
                        [],
                        0,
                        'CreatedDate',
                        [],
                        "",
                        $query
                    );

                    # FIND: Total count
                    $totalCount =  $this->publicationRepo->count(
                        $languageId,
                        1,
                        [],
                        0,
                        [],
                        "",
                        $query
                    );

                    $result->publications = new SearchEntityVM();
                    $result->publications->items = $publications;
                    $result->publications->pageNumber = $pageNumber;
                    $result->publications->totalCount = $totalCount;
                    break;
                case 'publications':
                    $offset = $limit * ($pageNumber - 1);

                    # PUBLICATIONS
                    $publications = $this->publicationRepo->getAllByQuery(
                        $query,
                        1,
                        $languageId,
                        $offset,
                        $limit,
                        $publicationTagId
                        );

                    // VIEW MODEL
                    $result->publications = new SearchEntityVM();
                    $result->publications->items = $publications;
                    $result->publications->pageNumber = $pageNumber;

                    break;
            }

        }
        
        return $result;
    }

}