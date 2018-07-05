<?php
namespace common\repositories;
use common\entities\Status;
use common\entities\Video;
use yii\db\ActiveRecord;

class VideoRepository
{
    /**
     * VIDEO: ONE
     * @param int $Id
     * @param int $LanguageId
     * @return Video
     */
    public function get($Id = 0, $LanguageId = 1): ActiveRecord {

        $query = Video::find()
            ->with('language')
            ->with('status')
            ->where([
                'StatusId' => Status::STATUS_PUBLISHED,
                'LanguageId' => $LanguageId
            ])
            ->orderBy(['Id' => SORT_DESC ]);

        if( $Id != 0 ){
            $query = $query->andWhere(['Id' => $Id]);
        }

        return $query->one();
    }


    /**
     * VIDEO: LIST
     * @param int $languageId
     * @param int $offset
     * @param int $limit
     * @return array
     */
    public function getAll( int $languageId = 1,
                            int $offset,
                            int $limit = 10): array
    {
        $query = Video::find()
            ->with('language')
            ->with('status')
            ->where([
                'StatusId' => Status::STATUS_PUBLISHED,
                'LanguageId' => $languageId
            ]  )
            ->orderBy(['Id' => SORT_DESC])
            ->offset($offset)
            ->limit($limit);


        # ORDER BY
        $query->orderBy(['CDate' => SORT_DESC]);


        return $query->all();
    }

    /**
     * VIDEO: COUNT
     * @param int $languageId
     * @return int
     */
    public function count(int $languageId): int{

        $query = Video::find()
            ->where([
                'StatusId' => Status::STATUS_PUBLISHED,
                'LanguageId' => $languageId
            ]  );

        return $query->count();
    }
}