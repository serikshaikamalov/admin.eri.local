<?php
namespace common\entities;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\entities\PublicationTag;

class PublicationTagSearch extends PublicationTag
{
    public function search($params)
    {
        $query = PublicationTag::find();

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
            'Title' => $this->Title,
            'TitleTR' => $this->TitleTR,
            'TitleRU' => $this->TitleRU,
            'TitleKZ' => $this->TitleKZ,
            'StatusId' => $this->StatusId,
            'Url' => $this->Url,
        ]);

        return $dataProvider;
    }
}
