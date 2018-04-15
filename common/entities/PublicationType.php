<?php
namespace common\entities;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

class PublicationType extends ActiveRecord
{
    public static function tableName()
    {
        return 'publicationType';
    }

    public function rules()
    {
        return [
            [
                [
                    'Title'
                ],
                'string',
                'max' => 250
            ],
        ];
    }

    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'Title' => 'Title'
        ];
    }


    /**
     * @return array
     */
    public static function getPublicationTypeList(): array {

        $result = PublicationType::find()
            ->all();

        return ArrayHelper::map($result, 'Id', 'Title');
    }





}