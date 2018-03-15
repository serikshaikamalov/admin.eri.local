<?php
namespace common\repositories;
use common\entities\EventCategory;

class EventCategoryRepository
{
    /**
     * @param int $id
     * @return EventCategory
     */
    public function get($id): EventCategory
    {
        if (!$pc = EventCategory::findOne($id)) {
            throw new \DomainException('Tag is not found.');
        }
        return $pc;
    }


    /**
     * @param int $languageId
     * @return array ActiveRecord[]
     */
    public function getAll( int $languageId ): array {
        if( !$languageId ){
            throw new \DomainException('Tag is not found.');
        }

        $all = EventCategory::find()
            ->where([
                'LanguageId' => $languageId,
                'ParentId' => 0,
            ])
            ->all();

        return $all;
    }


    /**
     * @param int $ParentId
     * @return array
     */
    public function getChildren( int $ParentId ): array
    {
        $all = EventCategory::find()
            ->where(['ParentId' => $ParentId])
            ->all();
        return $all;
    }
}