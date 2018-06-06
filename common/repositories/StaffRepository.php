<?php
namespace common\repositories;
use common\entities\Staff;
use common\entities\Status;
use yii\data\ActiveDataProvider;
use yii\data\DataProviderInterface;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

class StaffRepository
{
    /**
     * @param int $Id
     * @return Staff | null
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
     * @param int $staffTypeId
     * @param string $searchQuery
     *
     * @return int
     */
    public function count(int $languageId,
                          int $staffTypeId = 0,
                          string $searchQuery = ''): int{

        $query = Staff::find()
            ->where([
                'StatusId' => Status::STATUS_PUBLISHED,
                'LanguageId' => $languageId
            ]  );

        # FILTER: Query
        $query->andWhere([
            'like','FullName', $searchQuery
        ]);

        # Filter: Staff Type
        if( $staffTypeId != 0 ){
            $query->andWhere([
                'StaffTypeId' => $staffTypeId
            ]);
        }

        return $query->count();
    }


    /**
     * @param int $languageId
     * @param int $offset
     * @param int $limit
     * @param int $staffTypeId
     * @param string $searchQuery
     *
     * @return array
     */
    public function getAll( int $languageId = 1,
                            int $offset,
                            int $limit = 10,
                            int $staffTypeId = 0,
                            string $searchQuery = ''): array
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
            ->orderBy(['OrderNumber' => SORT_ASC])
            ->offset($offset)
            ->limit($limit);

        # FILTER: Query
        $query->andWhere([
            'like','FullName', $searchQuery
        ]);


        # FILTER: Staff Type
        if( $staffTypeId != 0 ){
            $query->andWhere([
                'StaffTypeId' => $staffTypeId
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