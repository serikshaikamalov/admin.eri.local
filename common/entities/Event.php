<?php
namespace common\entities;
use \yii\db\ActiveRecord;

/**
 * @property int $Id
 * @property string $Title
 * @property string $StartDate
 * @property string $ShortDescription
 * @property string $FullDescription
 * @property int $EventCategoryId
 * @property int $LanguageId
 * @property string $SpeakerFullName
 * @property int $CreatedBy
 * @property string $CreatedDate
 * @property int $StatusId
 * @property string $Address
 * @property int $ImageId
 * @property string $Link
 */
class Event extends ActiveRecord
{
    const UPCOMING_EVENT = 1;
    const PAST_EVENT = 2;

    public static function tableName()
    {
        return 'event';
    }

    public function rules()
    {
        return [
            [['Title', 'StartDate', 'LanguageId', 'EventCategoryId'], 'required'],
            [['ShortDescription', 'FullDescription', 'Address', 'Link', 'StartDate'], 'string'],
            [['EventCategoryId', 'LanguageId', 'CreatedBy', 'StatusId', 'ImageId'], 'integer'],
            [['Title', 'SpeakerFullName'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'Title' => 'Title',
            'StartDate' => 'Start Date',
            'ShortDescription' => 'Short Description',
            'FullDescription' => 'Full Description',
            'EventCategoryId' => 'Event Category',
            'LanguageId' => 'Language',
            'SpeakerFullName' => 'Speaker Full Name',
            'CreatedBy' => 'Author',
            'CreatedDate' => 'Created Date',
            'StatusId' => 'Status',
            'Address' => 'Address',
            'ImageId' => 'Image',
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

    public function getEventCategory(){
        return $this->hasOne( EventCategory::className(), ['Id' => 'EventCategoryId'] );
    }
    
    public function getUser(){
        return $this->hasOne( User::className(), ['Id' => 'CreatedBy'] );
    }
}
