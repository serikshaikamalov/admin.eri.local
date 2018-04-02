<?php
namespace api\controllers;
use api\viewmodels\StaffListVM;
use api\viewmodels\StaffTypeVM;
use api\viewmodels\StaffVM;
use common\repositories\StaffTypeRepository;
use Yii;

class StaffTypesController extends ApiBaseController
{
    public $defaultAction = 'index';
    public $repo;
    public $pageNumber;
    public $limit;
    public $offset;
    public $totalCount;

    public function  __construct(string $id,
                                 $module,
                                 StaffTypeRepository $repo,
                                 array $config = []
                                 )
    {
        parent::__construct($id, $module, $config);
        $this->repo = $repo;
    }

    /*
     * @returns:  StaffTypes[]
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
                    $oneVM->StatusId = $one->StatusId;
                    $oneVM->LanguageId = $one->LanguageId;
                    $resultVM[] = $oneVM;
                }
            }
        }
        return $resultVM;
    }

}
