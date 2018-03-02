<?php
namespace common\entities;
use \yii\db\ActiveRecord;

/**
 * @property int $Id
 * @property string $Title
 * @property string $StartDay
 * @property string $StartTime
 * @property string $Description
 * @property int $EventCategoryId
 * @property int $LangId
 * @property string $SpeakerFullName
 * @property int $CreatedBy
 * @property string $CreatedDate
 * @property string $UpdatedDate
 * @property int $StatusId
 * @property string $Address
 * @property int $ImageId
 * @property string $Link
 */
class Event extends ActiveRecord
{
    public static function tableName()
    {
        return 'event';
    }

    public function rules()
    {
        return [
            [['Title', 'StartDay', 'StartTime', 'LangId', 'EventCategoryId'], 'required'],
            [['StartDay', 'StartTime', 'CreatedDate', 'UpdatedDate'], 'safe'],
            [['Description', 'Address', 'Link'], 'string'],
            [['EventCategoryId', 'LangId', 'CreatedBy', 'StatusId', 'ImageId'], 'integer'],
            [['Title', 'SpeakerFullName'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'Title' => 'Title',
            'StartDay' => 'Start Day',
            'StartTime' => 'Start Time',
            'Description' => 'Description',
            'EventCategoryId' => 'Event Category ID',
            'LangId' => 'Lang ID',
            'SpeakerFullName' => 'Speaker Full Name',
            'CreatedBy' => 'Created By',
            'CreatedDate' => 'Created Date',
            'UpdatedDate' => 'Updated Date',
            'StatusId' => 'Publish',
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
        return $this->hasOne( Language::className(), ['Id' => 'LangId'] );
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
