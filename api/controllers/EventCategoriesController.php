<?php
namespace api\controllers;
use api\viewmodels\EventCategoryVM;
use common\repositories\EventCategoryRepository;

class EventCategoriesController extends ApiBaseController
{
    public $defaultAction = 'index';
    public $repo;

    public function __construct(string $id,
                                $module,
                                EventCategoryRepository$repo,
                                array $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->repo = $repo;
    }

    /**
     * @param int $languageId
     * @return array
     */
    public function actionIndex(int $languageId = 1 ){
        $resultVM = array();

        if( $languageId )
        {
            $all = $this->repo->getAll( $languageId );

            if( count($all) > 0 ){

                foreach ( $all as $one){

                    $oneVM = new EventCategoryVM();
                    $oneVM->Id = $one->Id;
                    $oneVM->Title = $one->Title;
                    $oneVM->LanguageId = $one->LanguageId;
                    $oneVM->ParentId = $one->ParentId;

                    // Children
                    $children = $this->repo->getChildren( $one->Id );
                    $oneVM->Children = $children;

                    $resultVM[] = $oneVM;
                }
            }
        }
        return $resultVM;
    }
}