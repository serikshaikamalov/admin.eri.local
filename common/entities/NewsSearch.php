<?php

namespace common\entities;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\entities\News;

/**
 * NewsSearch represents the model behind the search form of `common\entities\News`.
 */
class NewsSearch extends News
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Id', 'NewsCategoryId', 'ImageId', 'Hits', 'StatusId', 'LanguageId'], 'integer'],
            [['Title', 'ShortDescription', 'FullDescription', 'CreatedDate'], 'safe'],
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
        $query = News::find();

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
            'NewsCategoryId' => $this->NewsCategoryId,
            'ImageId' => $this->ImageId,
            'Hits' => $this->Hits,
            'StatusId' => $this->StatusId,
            'LanguageId' => $this->LanguageId,
        ]);

        $query->andFilterWhere(['like', 'Title', $this->Title])
            ->andFilterWhere(['like', 'ShortDescription', $this->ShortDescription])
            ->andFilterWhere(['like', 'FullDescription', $this->FullDescription])
            ->andFilterWhere(['like', 'CreatedDate', $this->CreatedDate]);

        return $dataProvider;
    }
}
