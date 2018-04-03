<?php
namespace api\controllers;
<<<<<<< HEAD
use api\viewmodels\StaffTypeVM;
use common\repositories\StaffTypeRepository;
=======
use api\viewmodels\StaffListVM;
use api\viewmodels\StaffTypeVM;
use api\viewmodels\StaffVM;
use common\repositories\StaffTypeRepository;
use Yii;
>>>>>>> c268d3b051d605dea6475cec9895757ee3c2a28e

class StaffTypesController extends ApiBaseController
{
    public $defaultAction = 'index';
    public $repo;
<<<<<<< HEAD

    public function __construct(string $id,
                                $module,
                                StaffTypeRepository $repo,
                                array $config = [])
=======
    public $pageNumber;
    public $limit;
    public $offset;
    public $totalCount;

    public function  __construct(string $id,
                                 $module,
                                 StaffTypeRepository $repo,
                                 array $config = []
                                 )
>>>>>>> c268d3b051d605dea6475cec9895757ee3c2a28e
    {
        parent::__construct($id, $module, $config);
        $this->repo = $repo;
    }

<<<<<<< HEAD
    /**
     * @param int $languageId
     * @return array
=======
    /*
     * @returns:  StaffTypes[]
>>>>>>> c268d3b051d605dea6475cec9895757ee3c2a28e
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
<<<<<<< HEAD
                    $oneVM->LanguageId = $one->LanguageId;
                    $oneVM->StatusId = $one->StatusId;

=======
                    $oneVM->StatusId = $one->StatusId;
                    $oneVM->LanguageId = $one->LanguageId;
>>>>>>> c268d3b051d605dea6475cec9895757ee3c2a28e
                    $resultVM[] = $oneVM;
                }
            }
        }
        return $resultVM;
    }
<<<<<<< HEAD
}
=======

}
>>>>>>> c268d3b051d605dea6475cec9895757ee3c2a28e
