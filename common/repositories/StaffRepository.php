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


    /*
     * @return Event count
     */
    public function count(int $languageId): int{
        return Staff::find()
            ->where([
                'StatusId' => Status::STATUS_PUBLISHED,
                'LanguageId' => $languageId
            ]  )
            ->count();
    }


    /*
     * @return Event[]
     */
    public function getAll( int $languageId, int $offset, int $limit ): array
    {
        return Staff::find()
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
            ->limit($limit)
            ->all();
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