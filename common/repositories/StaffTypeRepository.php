<?php
namespace common\repositories;
use common\entities\StaffType;

class StaffTypeRepository
{
    /**
     * @param int $id
     * @return StaffType
     */
    public function get($id): StaffType
    {
        if (!$pc = StaffType::findOne($id)) {
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

        $all = StaffType::find()
            ->where([
                'LanguageId' => $languageId
            ])
            ->all();

        return $all;
    }
}