<?php
namespace common\entities;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class DailyMonitorSearch extends DailyMonitor
{
    public $Title;

    public function rules()
    {
        return [
            [['Id', 'LanguageId', 'ImageId', 'CreatedBy'], 'integer'],
            [['Title', 'Description', 'Link', 'IsActive', 'CreatedDate'], 'safe'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    /*
     * @return $dataProvider
     * @params $params
     */
    public function search($params)
    {
        // ActiveQuery
        $query = DailyMonitor::find()
                    ->with('language')
                    ->with('status');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'Id' => $this->Id,
            'LanguageId' => $this->LanguageId,
            'ImageId' => $this->ImageId,
            'CreatedBy' => $this->CreatedBy,
            'CreatedDate' => $this->CreatedDate,
        ]);

        $query->andFilterWhere(['like', 'Title', $this->Title])
            //->andFilterWhere(['like', 'Description', $this->Description])
            //->andFilterWhere(['like', 'Link', $this->Link])
            ->andFilterWhere(['like', 'IsActive', $this->IsActive]);

        return $dataProvider;
    }
}
