<?php
namespace api\controllers;
use api\viewmodels\MenuVM;
use common\repositories\MenuRepository;

class MenuController extends ApiBaseController
{
    public $defaultAction = 'index';
    public $repo;

    public function  __construct(string $id, $module, MenuRepository $repo, array $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->repo = $repo;
    }

    /**
     * Menu: List
     * @param int $languageId
     *
     * @return mixed
     */
    public function actionIndex( int $languageId = 1 )
    {
        $menuVMList = array();
        $menuList = $this->repo->getAll( $languageId );

        if( count($menuList) > 0 ){
            foreach ($menuList as $menu){

                $menuVM = new MenuVM();
                $menuVM->Id = $menu->Id;
                $menuVM->Title = $menu->Title;
                $menuVM->Link = $menu->Link;
                $menuVM->LanguageId = $menu->LanguageId;
                $menuVM->ParentId = $menu->ParentId;
                $menuVM->MenuTypeId = $menu->MenuTypeId;
                $menuVM->StatusId = $menu->StatusId;
                $menuVM->IsDefault = $menu->IsDefault;

                // Dictionaries
                $menuVM->Language = $menu->language ? $menu->language : null;
                $menuVM->Status = $menu->status ? $menu->status : null;
                $menuVM->Children = $this->repo->getChildren( $languageId, $menu->Id );
                $menuVMList[] = $menuVM;
            }
        }

        return $menuVMList;
    }

}
