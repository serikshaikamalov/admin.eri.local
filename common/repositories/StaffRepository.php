<?php
namespace common\repositories;
use common\entities\Staff;
use yii\data\ActiveDataProvider;
use yii\data\DataProviderInterface;
use yii\db\ActiveQuery;

class StaffRepository
{

    /*
     * @return Event
     */
    public function get($Id): Staff {

        $staff = Staff::find()
            ->with('language')
            ->with('status')
            ->with('staffType')
            ->with('staffPosition')
            ->with('researchGroup')
            ->where([
                'StatusId' => Staff::STATUS_PUBLISHED,
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
    public function count(): int{
        return Staff::find()->count();
    }


    /*
     * @return Event[]
     */
    public function getAll( int $languageId ): array
    {
        return Staff::find()
            ->with('language')
            ->with('status')
            ->with('staffType')
            ->with('staffPosition')
            ->with('researchGroup')
            ->where([
                'StatusId' => Staff::STATUS_PUBLISHED,
                'LanguageId' => $languageId
            ]  )
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