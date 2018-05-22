<?php

namespace common\entities;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\entities\Video;

class VideoSearch extends Video
{
    public function rules()
    {
        return [
            [['Id', 'LanguageId', 'Hits'], 'integer'],
            [['Title', 'Description', 'Url', 'StatusId', 'CDate'], 'safe'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Video::find();

        // add conditions that should always apply here
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
            'LanguageId' => $this->LanguageId
        ]);

        $query->andFilterWhere(['like', 'Title', $this->Title])
            ->andFilterWhere(['like', 'Url', $this->Url])
            ->andFilterWhere(['like', 'StatusId', $this->StatusId])
            ->andFilterWhere(['like', 'CDate', $this->CDate]);

        return $dataProvider;
    }
}