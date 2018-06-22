<?php
namespace common\entities;
use yii\base\Model;
use yii\data\ActiveDataProvider;


class EriInPressSearch extends EriInPress
{
    public function rules()
    {
        return [
            [['Id', 'ImageId', 'StatusId', 'LanguageId'], 'integer'],
            [['Title', 'Description', 'Link'], 'safe'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = EriInPress::find();

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
            'StatusId' => $this->StatusId,
            'LanguageId' => $this->LanguageId,
        ]);

        $query->andFilterWhere(['like', 'Title', $this->Title]);

        return $dataProvider;
    }
}
