<?php
namespace common\entities;
use \yii\db\ActiveRecord;

/**
 * @property int $Id
 * @property string $Title
 * @property int $StatusId
 * @property int $ParentId
 * @property int $LanguageId
 */
class EventCategory extends ActiveRecord
{
    public static function tableName()
    {
        return 'eventCategory';
    }

    public function rules()
    {
        return [
            [['StatusId', 'ParentId', 'LanguageId'], 'integer'],
            [['LanguageId'], 'required'],
            [['Title'], 'string', 'max' => 50],
        ];
    }

    public function attributeLabels()
    {
        return [
            'Id' => 'Id',
            'Title' => 'Title',
            'StatusId' => 'Status',
            'ParentId' => 'Parent',
            'LanguageId' => 'Language',
        ];
    }


    /*
     * RELATIONS
     */
    public function getLanguage(){
        return $this->hasOne( Language::className(), ['Id' => 'LanguageId'] );
    }

    public function getStatus(){
        return $this->hasOne( Status::className(), ['Id' => 'StatusId'] );
    }
}
