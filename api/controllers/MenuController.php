<?php
namespace api\controllers;
use api\viewmodels\MenuItemVM;
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
        $menuVM = new \StdClass();

        $optionalMenuList = array();
        $mainMenuList = array();

        $menuList = $this->repo->getAll( $languageId );

        if( count($menuList) > 0 ){
            foreach ($menuList as $menu){

                $menuItem = new MenuItemVM();
                $menuItem->Id = $menu->Id;
                $menuItem->Title = $menu->Title;
                $menuItem->Link = $menu->Link;
                $menuItem->LanguageId = $menu->LanguageId;
                $menuItem->ParentId = $menu->ParentId;
                $menuItem->MenuTypeId = $menu->MenuTypeId;
                $menuItem->StatusId = $menu->StatusId;
                $menuItem->IsDefault = $menu->IsDefault;
                $menuItem->Icon = $menu->Icon;

                // Dictionaries
                $menuItem->Language = $menu->language ? $menu->language : null;
                $menuItem->Status = $menu->status ? $menu->status : null;
                $menuItem->Children = $this->repo->getChildren( $languageId, $menu->Id );

                if( $menu->IsOptional == true ){
                    $optionalMenuList[] = $menuItem;
                }else{
                    $mainMenuList[] = $menuItem;
                }
            }
        }

        $menuVM->OptionalMenu = $optionalMenuList;
        $menuVM->MainMenu = $mainMenuList;

        return $menuVM;
    }

}
