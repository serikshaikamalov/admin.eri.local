<?php
namespace common\entities;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

class PublicationMainTag extends ActiveRecord
{
    public static function tableName()
    {
        return 'publicationMainTag';
    }

    public function rules()
    {
        return [
            [
                [
                    'ParentId',
                    'LanguageId',
                    'StatusId'
                ],
                'integer'
            ],
            [
                [
                    'Title'
                ],
                'string',
                'max' => 50
            ],
        ];
    }

    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'Title' => 'Title',
            'ParentId' => 'ParentID',
            'LanguageId' => 'Language ID',
            'StatusId' => 'Status ID',
            'ImageId' => 'Image',
            'Description' => 'Description',
        ];
    }


    /**
     * @param $languageId
     * @return array
     */
    public static function getPublicationMainTagList( int $languageId = 1): array {
        $result = PublicationMainTag::find()
            ->where(['LanguageId' => $languageId])
            ->all();
        return ArrayHelper::map($result, 'Id', 'Title');
    }


    public static function getPublicationMainTagParentList( int $languageId = 1): array {
        $result = PublicationMainTag::find()
            ->where(
                [
                    'ParentId' => 0,
                    'LanguageId' => $languageId
                ]
            )
            ->all();
        return ArrayHelper::map($result, 'Id', 'Title');
    }





}