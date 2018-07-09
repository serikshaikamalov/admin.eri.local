<?php
namespace common\repositories;
use common\entities\Infographic;
use common\entities\ResearchFellow;
use common\entities\Status;
use yii\db\ActiveRecord;

class ResearchFellowRepository
{
    /**
     * @param int $languageId
     * @param int $researchFellowTypeId
     * @param int $researchFellowCategoryId
     * @return int
     */
    public function count(int $languageId,
                          int $researchFellowTypeId = 1,
                          int $researchFellowCategoryId = 1 ): int{

        $query = ResearchFellow::find()
            ->where([
                'LanguageId' => $languageId,
                'ResearchFellowTypeId' => $researchFellowTypeId,
                'ResearchFellowCategoryId' => $researchFellowCategoryId
            ]  );

        return $query->count();
    }


    /**
     * @param int $languageId
     * @param int $researchFellowTypeId
     * @param int $researchFellowCategoryId
     * @param int $offset
     * @param int $limit
     * @return array
     */
    public function getAll( int $languageId = 1,
                            int $researchFellowTypeId = 1,
                            int $researchFellowCategoryId = 1,
                            int $offset,
                            int $limit = 10): array
    {
        $query = ResearchFellow::find()
            ->where([
                'LanguageId' => [$languageId],
                'ResearchFellowTypeId' => $researchFellowTypeId,
                'ResearchFellowCategoryId' => $researchFellowCategoryId
            ]  )
            ->offset($offset)
            ->limit($limit);


        # ORDER
        $query->orderBy(['CreatedDate' => SORT_DESC]);

        return $query->all();
    }



    /**
     * @param int $Id
     *
     * @return mixed
     */
    public function get( int $Id ): ActiveRecord
    {
        return  ResearchFellow::findOne($Id);
    }

}