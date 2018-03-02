<?php

namespace common\entities;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\StaffPosition;

/**
 * StaffPositionSearch represents the model behind the search form of `app\models\StaffPosition`.
 */
class StaffPositionSearch extends StaffPosition
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Id', 'StatusId', 'LanguageId'], 'integer'],
            [['Title'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = StaffPosition::getFullStaffPositionList();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'Id' => $this->Id,
            'StatusId' => $this->StatusId,
            'LanguageId' => $this->LanguageId,
        ]);

        $query->andFilterWhere(['like', 'Title', $this->Title]);

        return $dataProvider;
    }
}
