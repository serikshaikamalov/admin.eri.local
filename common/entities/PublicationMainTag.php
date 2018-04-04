<?php
namespace common\entities;
use yii\db\ActiveRecord;

class PublicationMainTag extends ActiveRecord
{
    public static function tableName()
    {
        return 'publicationMainTag';
    }

    public function rules()
    {
        return [
            [['ParentId', 'LanguageId', 'StatusId'], 'integer'],
            [['Title'], 'string', 'max' => 50],
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
}