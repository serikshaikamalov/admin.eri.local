<?php
namespace common\repositories;
use common\entities\StaffType;
<<<<<<< HEAD

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
=======
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
>>>>>>> c268d3b051d605dea6475cec9895757ee3c2a28e
    }
}