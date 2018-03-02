<?php
namespace common\entities;
use \yii\db\ActiveRecord;

/**
 * @property int $Id
 * @property string $Title
 * @property string $Description
 * @property string $Link
 * @property int $IsActive
 * @property int $LanguageId
 * @property int $ImageId
 * @property int $CreatedBy
 * @property string $CreatedDate
 */
class DailyMonitor extends ActiveRecord
{
    public static function tableName()
    {
        return 'dailyMonitor';
    }

    public function rules()
    {
        return [
            [['Title', 'LanguageId'], 'required'],
            [['Description'], 'string'],
            [['LanguageId', 'ImageId', 'CreatedBy'], 'integer'],
            [['CreatedDate'], 'safe'],
            [['Title'], 'string', 'max' => 50],
            [['Link'], 'string', 'max' => 250],
            [['IsActive'], 'string', 'max' => 4],
        ];
    }
    
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'Title' => 'Title',
            'Description' => 'Description',
            'Link' => 'Link',
            'IsActive' => 'Published',
            'LanguageId' => 'Language',
            'ImageId' => 'Image',
            'CreatedBy' => 'Author',
            'CreatedDate' => 'Created Date',
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
        return $this->hasOne( Status::className(), ['Id' => 'IsActive'] );
    }

    public function getUser(){
        return $this->hasOne( User::className(), ['Id' => 'CreatedBy'] );
    }

}
