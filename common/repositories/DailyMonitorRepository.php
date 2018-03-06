<?php
namespace common\repositories;
use common\entities\DailyMonitor;
use common\entities\Status;
use yii\data\ActiveDataProvider;
use yii\data\DataProviderInterface;
use yii\db\ActiveQuery;

class DailyMonitorRepository
{
    /*
     * @return DailyMonitor
     */
    public function get($Id): DailyMonitor {

        $entity = DailyMonitor::find()
            ->with('language')
            ->with('status')
            ->where([
                'StatusId' => Status::STATUS_PUBLISHED,
                'Id' => $Id
            ])
            ->one();

        if(!$entity){
            throw new \DomainException('Id not found!');
        }
        return $entity;
    }


    /*
     * @return Event count
     */
    public function count(): int{
        return DailyMonitor::find()->count();
    }


    /*
     * @return Event[]
     */
    public function getAll( int $languageId ): array
    {
        return DailyMonitor::find()
            ->with('language')
            ->with('status')
            ->where([
                'StatusId' => Status::STATUS_PUBLISHED,
                'LanguageId' => $languageId
            ]  )
            ->all();
    }


    /*
     * @return Latest Events
     */
    public function getLatest(): array
    {
        return DailyMonitor::find()
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