<?php

namespace common\entities;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\entities\Infographic;

/**
 * InfographicSearch represents the model behind the search form of `common\entities\Infographic`.
 */
class InfographicSearch extends Infographic
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Id', 'ImageId', 'CreatedBy', 'LanguageId', 'StatusId'], 'integer'],
            [['Title', 'CreatedDate'], 'safe'],
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
        $query = Infographic::find();

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
            'ImageId' => $this->ImageId,
            'CreatedBy' => $this->CreatedBy,
            'LanguageId' => $this->LanguageId,
            'StatusId' => $this->StatusId,
        ]);

        $query->andFilterWhere(['like', 'Title', $this->Title])
            ->andFilterWhere(['like', 'CreatedDate', $this->CreatedDate]);


        $query->orderBy(['CreatedDate' => SORT_DESC]);



        return $dataProvider;
    }
}
