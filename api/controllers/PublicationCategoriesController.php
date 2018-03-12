<?php
namespace api\controllers;
use app\viewmodels\PublicationCategoryVM;
use common\repositories\PublicationCategoryRepository;

class PublicationCategoriesController extends ApiBaseController
{
    public $defaultAction = 'index';
    public $repo;
    public $pageNumber;
    public $limit;
    public $offset;
    public $totalCount;

    public function __construct(string $id, $module, PublicationCategoryRepository $repo , array $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->repo = $repo;
        $this->pageNumber = 1;
        $this->limit = 10;
        $this->offset = 10;
    }


    public function actionIndex(int $languageId = 1){

        $result = array();

        if( $languageId )
        {
            $all = $this->repo->getAll( $languageId );

            if( count($all) > 0 ){
                foreach ( $all as $one){

                    $publicationCategoryVM = new PublicationCategoryVM();
                    $publicationCategoryVM->Id = $one->Id;
                    $publicationCategoryVM->Title = $one->Title;
                    $publicationCategoryVM->LanguageId = $one->LanguageId;
                    $publicationCategoryVM->StatusId = $one->StatusId;

                    // Children
                    $children = $this->repo->getChildren( $one->Id );

                    $publicationCategoryVM->Children = $children;

                    $result[] = $publicationCategoryVM;
                }
            }
        }

        return $result;
    }
}