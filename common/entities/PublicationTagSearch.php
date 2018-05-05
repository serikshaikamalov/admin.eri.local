<?php

namespace common\entities;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\entities\PublicationTag;

/**
 * PublicationTagSearch represents the model behind the search form of `common\entities\PublicationTag`.
 */
class PublicationTagSearch extends PublicationTag
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Id', 'Title', 'LanguageId', 'StatusId'], 'integer'],
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
        $query = PublicationTag::find()->where(['LanguageId' => \Yii::$app->language] );

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
            'Title' => $this->Title,
            'LanguageId' => $this->LanguageId,
            'StatusId' => $this->StatusId,
        ]);

        return $dataProvider;
    }
}
