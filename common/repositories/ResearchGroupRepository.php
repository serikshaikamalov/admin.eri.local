<?php
namespace common\repositories;
use common\entities\ResearchGroup;
use common\entities\Status;

class ResearchGroupRepository
{
    /*
     * @return ResearchGroup[]
     */
    public function getAll( int $languageId ): array
    {
        return ResearchGroup::find()
            ->where([
                'StatusId' => Status::STATUS_PUBLISHED,
                'LanguageId' => $languageId
            ]  )
            ->all();
    }
}