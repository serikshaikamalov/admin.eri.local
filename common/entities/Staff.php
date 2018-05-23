<?php
namespace common\entities;
use \yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * @property integer $Id
 * @property string $FullName
 * @property string $ShortBiography
 * @property string FullBiography
 * @property int $PublicationMainTagId
 * @property int $ImageId
 * @property int $LanguageId
 * @property integer $StatusId
 * @property int $StaffTypeId
 * @property string $StaffPositionId
 * @property int $OrderNumber
 * @property $staffPosition
 * @property $staffType
 * @property $language
 * @property $image
 * @property $publicationMainTag
 * @property $status
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
            [
                [
                    'StatusId',
                    'ImageId',
                    'StaffPositionId',
                    'PublicationMainTagId',
                    'LanguageId',
                    'StaffPositionId',
                    'StaffTypeId',
                    'OrderNumber'
                ],
                'integer'
            ],
            [
                [
                    'ShortBiography',
                    'FullBiography'
                ], 'string'
            ],
            [
                [
                    'FullName'
                ],
                'string',
                'max' => 200
            ],
        ];
    }

    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'StatusId' => 'Status',
            'FullName' => 'Full Name',
            'StaffPositionId' => 'Position',
            'PublicationMainTagId' => 'Research Group',
            'StaffTypeId' => 'Staff Type',
            'ShortBiography' => 'Short Biography',
            'FullBiography' => 'Full Biography',
            'ImageId' => 'Image',
            'LanguageId' => 'Language',
            'OrderNumber' => 'Order Number'
        ];
    }


    /**
     * @param int $Id
     * @return ActiveRecord | null
     */
    public static function getStaff(int $Id): ActiveRecord {
        $staff = Staff::find()
            ->with('language')
            ->with('staffType')
            ->with('staffPosition')
            ->with('status')
            ->where(['Id' => $Id, 'StatusId' => Status::STATUS_PUBLISHED]  )
            ->one();
        return $staff;
    }

    /**
     * @return Staff[]
     */
    public static function getStaffList(){
        $staffs = Staff::find()
            ->where(['LanguageId' => \Yii::$app->language] )
            ->orderBy(['FullName' => SORT_ASC])
            ->all();
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

    public function getPublicationMainTag(){
        return $this->hasOne( PublicationMainTag::className(), ['Id' => 'PublicationMainTagId'] );
    }
}