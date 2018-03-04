<?php
namespace common\entities;
use \yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * @property integer $Id
 * @property integer $StatusId
 * @property string $FullName
 * @property string $StaffPositionId
 * @property string $ResearchGroupId
 * @property string $ShortBiography
 */
class Staff extends ActiveRecord
{
    const STATUS_PUBLISHED = 1;
    const STATUS_UNPUBLISHED = 0;

    public static function tableName()
    {
        return 'staff';
    }

    public function rules()
    {
        return [
            [['StatusId', 'ImageId', 'StaffPositionId', 'ResearchGroupId', 'ResearchGroupId', 'LanguageId', 'StaffPositionId', 'StaffTypeId'], 'integer'],
            [['ShortBiography', 'FullBiography'], 'string'],
            [['FullName'], 'string', 'max' => 200],
        ];
    }

    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'StatusId' => 'Status',
            'FullName' => 'Full Name',
            'StaffPositionId' => 'Position',
            'ResearchGroupId' => 'Research Group',
            'StaffTypeId' => 'Staff Type',
            'ShortBiography' => 'Short Biography',
            'FullBiography' => 'Full Biography',
            'ImageId' => 'Image',
            'LanguageId' => 'Language',
        ];
    }


    /*
     * @return Staff with relations
     */
    public static function getStaff($Id){
        $staff = Staff::find()
            ->with('language')
            ->with('staffType')
            ->with('staffPosition')
            ->with('status')
            ->where(['Id' => $Id, 'StatusId' => Staff::STATUS_PUBLISHED]  )
            ->one();
        return $staff;
    }

    /*
     * @return Staff[]
     */
    public static function getStaffList(){
        $staffs = Staff::find()->all();
        return ArrayHelper::map($staffs, 'Id', 'FullName');
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

    public function getStaffType(){
        return $this->hasOne( StaffType::className(), ['Id' => 'StaffTypeId'] );
    }

    public function getStaffPosition(){
        return $this->hasOne( StaffPosition::className(), ['Id' => 'StaffPositionId'] );
    }

    public function getResearchGroup(){
        return $this->hasOne( ResearchGroup::className(), ['Id' => 'ResearchGroupId'] );
    }
}