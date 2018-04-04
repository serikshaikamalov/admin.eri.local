<?php
namespace api\controllers;
use common\entities\PublicationMainTag;
use common\repositories\PublicationMainTagRepository;
use api\viewmodels\ResearchGroupVM;

class ResearchGroupsController extends ApiBaseController
{
    public $defaultAction = 'index';
    public $repo;

    public function  __construct(string $id,
                                 $module,
                                 PublicationMainTagRepository $repo,
                                 array $config = []
                                 )
    {
        parent::__construct($id, $module, $config);
        $this->repo = $repo;
    }


    /**
     * @param int $languageId
     * @return  PublicationMainTag[]
     */
    public function actionIndex( int $languageId = 1 )
    {
        $staffVMList = array();
        $researchGroups = $this->repo->getAll( $languageId );

        if( count($researchGroups) > 0 ){

            foreach ($researchGroups as $researchGroup){

                if( $researchGroup->ParentId == 0 ){
                    $oneVM = new ResearchGroupVM();
                    $oneVM->Id = $researchGroup->Id;
                    $oneVM->Title = $researchGroup->Title;
                    $oneVM->ParentId = $researchGroup->ParentId;
                    $oneVM->LanguageId = $researchGroup->LanguageId;
                    $oneVM->StatusId = $researchGroup->StatusId;
                    $oneVM->ImageId = $researchGroup->ImageId;
                    $oneVM->Description = $researchGroup->Description;

                    // Children
                    foreach ( $researchGroups as $rg ){
                        if( $rg->ParentId == $researchGroup->Id && $rg->ParentId != 0 ){
                            $oneVM->Children[] = $rg;
                        }
                    }

                    $staffVMList[] = $oneVM;
                }
            }
        }

        return $staffVMList;
    }
}
