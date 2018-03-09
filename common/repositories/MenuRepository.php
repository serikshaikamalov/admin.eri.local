<?php
namespace common\repositories;
use common\entities\Menu;
use common\entities\Status;

class MenuRepository
{
    public function getAll( int $languageId ): array
    {
        return Menu::find()
            ->with('language')
            ->with('status')
            ->where([
                'StatusId' => Status::STATUS_PUBLISHED,
                'LanguageId' => $languageId
            ]  )
            ->all();
    }

    /**
     * @param int $languageId
     * @param int $parentId
     * @return array
     */
    public function getChildren( int $languageId, int $parentId ): array
    {
        if( $parentId == 0 ) {
            return [];
        }

        return Menu::find()
            ->with('language')
            ->with('status')
            ->where([
                'StatusId' => Status::STATUS_PUBLISHED,
                'LanguageId' => $languageId,
                'ParentId' => $parentId
            ]  )
            ->all();
    }
}