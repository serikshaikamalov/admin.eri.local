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
     * @return Video
     */
    public function get($Id): ActiveRecord {

        $video = Video::find()
            ->with('language')
            ->with('status')
            ->where([
                'StatusId' => Status::STATUS_PUBLISHED,
                'Id' => $Id
            ])->one();

        if(!$video){
            throw new \DomainException('Id not found!');
        }

        return $video;
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
            ->offset($offset)
            ->limit($limit);

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