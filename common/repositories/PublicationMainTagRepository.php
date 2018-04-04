<?php
namespace common\repositories;
use common\entities\PublicationMainTag;
use common\entities\Status;

class PublicationMainTagRepository
{
    /**
     * @param int $languageId
     * @return array PublicationMainTag[]
     */
    public function getAll( int $languageId ): array
    {
        return PublicationMainTag::find()
            ->where([
                'StatusId' => Status::STATUS_PUBLISHED,
                'LanguageId' => $languageId
            ]  )
            ->all();
    }

    /**
     * @param int $parentId
     * @return array PublicationMainTag[]
     */
    public function getChildren( int $parentId ): array
    {
        $all = PublicationMainTag::find()
            ->where(['ParentId' => $parentId])
            ->all();
        return $all;
    }
}