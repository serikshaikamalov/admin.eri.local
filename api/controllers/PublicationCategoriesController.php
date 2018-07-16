<?php
namespace api\controllers;
use app\viewmodels\PublicationCategoryVM;
use common\entities\Language;
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

    /**
     * @param int $languageId
     * @param int $publicationTypeId
     * @return array PublicationCategoryVM[] - Список категории публикации
     */
    public function actionIndex(int $languageId = 1,
                                int $publicationTypeId = 1){
        $result = array();

        if( $languageId )
        {
            $all = $this->repo->getAll( $languageId, $publicationTypeId );

            if( count($all) > 0 ){

                foreach ( $all as $one){

                    $publicationCategoryVM = new PublicationCategoryVM();
                    $publicationCategoryVM->Id = $one->Id;
                    $publicationCategoryVM->Title = $one->Title;
                    $publicationCategoryVM->Link = $one->Link;
                    $publicationCategoryVM->LanguageId = $one->LanguageId;
                    $publicationCategoryVM->StatusId = $one->StatusId;
                    $publicationCategoryVM->ParentId = $one->ParentId;

                    // Children
                    $children = $this->repo->getChildren( $one->Id );

                    $publicationCategoryVM->Children = $children;

                    $result[] = $publicationCategoryVM;
                }
            }
        }
        return $result;
    }


    public function actionGetByLink( string $link = '', int $languageId = Language::LANGUAGE_ENGLISH ){
        $one = $this->repo->getByLink($link, $languageId);
        return $one->Id;
    }
}