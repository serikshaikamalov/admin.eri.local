<?php
namespace common\repositories;
use common\entities\StaffType;
use common\entities\Status;

class StaffTypeRepository
{
    /*
     * @return StaffType[]
     */
    public function getAll( int $languageId): array
    {
        return StaffType::find()
            ->where([
                'StatusId' => Status::STATUS_PUBLISHED,
                'LanguageId' => $languageId
            ]  )
            ->all();
    }
}