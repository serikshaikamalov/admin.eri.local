<?php
namespace common\repositories;
use common\entities\Staff;
use common\entities\Status;
use yii\data\ActiveDataProvider;
use yii\data\DataProviderInterface;
use yii\db\ActiveQuery;

class StaffRepository
{
//    public $pageNumber;
//    public $limit;
//    public $offset;
//    public $totalCount;
//
//    public function __construct( $pageNumber, $limit, $offset, $totalCount )
//    {
//        $this->pageNumber = 1;
//        $this->limit = 10;
//        $this->offset = $this->limit * ($this->pageNumber - 1);
//    }

    /*
     * @return Event
     */
    public function get($Id): Staff {

        $staff = Staff::find()
            ->with('language')
            ->with('status')
            ->with('staffType')
            ->with('staffPosition')
            ->with('publicationMainTag')
            ->where([
                'StatusId' => Status::STATUS_PUBLISHED,
                'Id' => $Id
            ])
            ->one();

        if(!$staff){
            throw new \DomainException('Id not found!');
        }
        return $staff;
    }


    /**
     * @param int $languageId
     * @param int $publicationMainTagId
     *
     * @return int Staff[] - count
     */
    public function count(int $languageId, int $publicationMainTagId = 0): int{
        $query = Staff::find()
            ->where([
                'StatusId' => Status::STATUS_PUBLISHED,
                'LanguageId' => $languageId
            ]  );


        // Filter
        if( $publicationMainTagId != 0 ){
            $query->andWhere([
                'PublicationMainTagId' => $publicationMainTagId
            ]);
        }

        return $query->count();
    }


    /**
     * @param int $languageId
     * @param int $offset
     * @param int $limit
     * @param int $publicationMainTagId
     *
     * @return array
     */
    public function getAll( int $languageId,
                            int $offset,
                            int $limit,
                            int $publicationMainTagId = 0 ): array
    {
         $query = Staff::find()
            ->with('language')
            ->with('status')
            ->with('staffType')
            ->with('staffPosition')
            ->with('publicationMainTag')
            ->where([
                'StatusId' => Status::STATUS_PUBLISHED,
                'LanguageId' => $languageId
            ]  )
            ->offset($offset)
            ->limit($limit);


         if( $publicationMainTagId != 0 ){
            $query->andWhere([
                'PublicationMainTagId' => $publicationMainTagId
            ]);
        }


         return $query->all();
    }


    /*
     * @return Latest Events
     */
    public function getLatest(): array
    {
        return Staff::find()
            ->with('user')
            ->orderBy(['Id' => SORT_DESC])->all();
    }


    private function getProvider(ActiveQuery $query): ActiveDataProvider
    {
        return new ActiveDataProvider([
            'query' => $query,
            'sort' => false,
        ]);
    }


}