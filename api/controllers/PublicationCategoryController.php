<?php
namespace api\controllers;
use app\viewmodels\PublicationCategoryVM;
use common\repositories\PublicationCategoryRepository;
use \yii\rest\Controller;


class PublicationCategoryController extends Controller
{
    public $repo;

    public function __construct(string $id, $module, PublicationCategoryRepository $repo , array $config = [])
    {
        parent::__construct($id, $module, $config);

        $this->repo = $repo;
    }


    public function actionGetAll(){

        $publicationCategoriesVM = array();

        if(!$all = $this->repo->getAll()){
            throw new NotFoundHttpException('The requested page does not exist.');
        }


        if( count($all) > 0 ){
            foreach ( $all as $pc){

                $publicationCategoryVM = new PublicationCategoryVM();
                $publicationCategoryVM->Id = $pc->Id;
                $publicationCategoryVM->Title = $pc->Title;
                $publicationCategoryVM->LanguageId = $pc->LanguageId;
                $publicationCategoryVM->StatusId = $pc->StatusId;

                // Children
                $children = $this->repo->getChildren( $pc->Id );

                $publicationCategoryVM->Children = $children;


                $publicationCategoriesVM[] = $publicationCategoryVM;
            }
        }


        return $publicationCategoriesVM;
    }
}