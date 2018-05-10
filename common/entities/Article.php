<?php
namespace common\entities;
use \yii\db\ActiveRecord;

/**
 * @@property int $Id
 * @@property string $Title
 * @@property string $Description
 * @property string $ShortDescription
 * @@property string $UserId
 * @@property int $LanguageId
 * @@property string $Link
 */

class Article extends ActiveRecord
{
    public static function tableName()
    {
        return 'article';
    }

    public function rules()
    {
        return [
            [['Description', 'Link', 'ShortDescription'], 'string'],
            [['UserId', 'LanguageId'], 'integer'],
            [['Title'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'Title' => 'Title',
            'ShortDescription' => 'Short Description',
            'Description' => 'Description',
            'UserId' => 'User ID',
            'LanguageId' => 'Language',
            'Link' => 'Link'
        ];
    }

    /**
     * RELATIONS
     * @return \yii\db\ActiveQuery
     */
    public function getUser(){
        return $this->hasOne( User::className(), ['Id' => 'UserId'] );
    }




}
