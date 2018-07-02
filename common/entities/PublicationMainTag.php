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
     * @return array
     */
    public static function getPublicationMainTagList(): array {
        $result = PublicationMainTag::find()
            ->where(['LanguageId' => \Yii::$app->language] )
            ->all();

        foreach( $result as $item ){
            if( $item->ParentId  != 0){
                $item->Title = '--'.$item->Title;
            }
        }

        return ArrayHelper::map($result, 'Id', 'Title');
    }


    public static function getPublicationMainTagParentList( int $languageId = 1): array {
        $result = PublicationMainTag::find()
            ->where(
                [
                    'ParentId' => 0,
                    'LanguageId' => \Yii::$app->language
                ]
            )
            ->all();
        return ArrayHelper::map($result, 'Id', 'Title');
    }





}