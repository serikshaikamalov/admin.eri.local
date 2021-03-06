<?php
namespace common\repositories;
use common\entities\Infographic;
use common\entities\Status;

class InfographicRepository
{
    /**
     * @param int $languageId
     * @return int
     */
    public function count(int $languageId): int{

        $query = Infographic::find()
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
        $query = Infographic::find()
            ->where([
                'StatusId' => Status::STATUS_PUBLISHED,
                'LanguageId' => [$languageId, 0],
            ]  )
            ->offset($offset)
            ->limit($limit);


        ### Order
        $query->orderBy(['CreatedDate' => SORT_DESC]);

        return $query->all();
    }

}