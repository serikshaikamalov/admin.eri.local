<?php
namespace api\controllers;
use api\viewmodels\StaffTypeVM;
use common\repositories\StaffTypeRepository;

class StaffTypesController extends ApiBaseController
{
    public $defaultAction = 'index';
    public $repo;

    public function __construct(string $id,
                                $module,
                                StaffTypeRepository $repo,
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

                    $oneVM = new StaffTypeVM();
                    $oneVM->Id = $one->Id;
                    $oneVM->Title = $one->Title;
                    $oneVM->LanguageId = $one->LanguageId;
                    $oneVM->StatusId = $one->StatusId;

                    $resultVM[] = $oneVM;
                }
            }
        }
        return $resultVM;
    }
}