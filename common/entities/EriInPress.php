<?php
namespace common\entities;
use yii\db\ActiveRecord;

/**
 * @property int $Id
 * @property string $Title
 * @property string $Description
 * @property int $ImageId
 * @property string $CreatedDate
 * @property int $StatusId
 * @property int $LanguageId
 * @property string $Link
 */
class EriInPress extends ActiveRecord
{
    public static function tableName()
    {
        return 'eriInPress';
    }

    public function rules()
    {
        return [
            [['Description'], 'string'],
            [['ImageId', 'StatusId', 'LanguageId'], 'integer'],
            [['Title'], 'string', 'max' => 250],
            [['CreatedDate'], 'string', 'max' => 50],
            [['Link'], 'string', 'max' => 300],
        ];
    }

    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'Title' => 'Title',
            'Description' => 'Description',
            'ImageId' => 'Image',
            'CreatedDate' => 'Created',
            'StatusId' => 'Status',
            'LanguageId' => 'Language',
            'Link' => 'Link',
        ];
    }

    /**
     * RELATIONS
     * @return \yii\db\ActiveQuery
     */
    public function getLanguage(){
        return $this->hasOne( Language::className(), ['Id' => 'LanguageId'] );
    }

    public function getStatus(){
        return $this->hasOne( Status::className(), ['Id' => 'StatusId'] );
    }
}