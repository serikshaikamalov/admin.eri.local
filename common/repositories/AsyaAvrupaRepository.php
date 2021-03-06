<?php
namespace common\repositories;

use common\entities\AsyaAvrupa;
use common\entities\Status;

class AsyaAvrupaRepository
{
    /**
     * @param int $languageId
     * @return int
     */
    public function count(int $languageId): int{

        $query = AsyaAvrupa::find()
            ->where([
                'StatusId' => Status::STATUS_PUBLISHED,
                'LanguageId' => [$languageId, 0],
            ]  );

        return $query->count();
    }


    /**
     * @param int $languageId
     * @param int $offset
     * @param int $limit
     * @return array
     */
    public function getAll( int $languageId = 1,
                            int $offset,
                            int $limit = 10): array
    {
        $query = AsyaAvrupa::find()
            ->where([
                'StatusId' => Status::STATUS_PUBLISHED,
                'LanguageId' => [$languageId, 0],
            ]  )
            ->orderBy(['Id' => SORT_DESC])
            ->offset($offset)
            ->limit($limit);


        ### Order

        return $query->all();
    }

}