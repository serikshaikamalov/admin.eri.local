<?php
namespace common\entities;
use Yii;
use \yii\db\ActiveRecord;

/**
 * This is the model class for table "publication".
 *
 * @property int $Id
 * @property string $Title
 * @property int $PublicationCategoryId
 * @property int $StaffId
 * @property int $CreatedDate
 * @property int $CreatedBy
 * @property int $IsFeatured
 * @property string $ImageId
 * @property string $Description
 * @property string $ShortDescription
 * @property int $Hits
 * @property int $StatusId
 * @property int $LanguageId
 * @property int $FileId
 *
 * @property Staff $Staff
 * @property Status $Status
 * @property Language $Language
 */
class Publication extends ActiveRecord
{
    public static function tableName()
    {
        return 'publication';
    }

    public function rules()
    {
        return [
            [['PublicationCategoryId', 'StaffId', 'CreatedBy', 'Hits', 'StatusId', 'LanguageId', 'FileId', 'ImageId', 'IsFeatured'], 'integer'],
            [['Description', 'ShortDescription', 'CreatedDate'], 'string'],
            [['Title'], 'string', 'max' => 250],
        ];
    }

    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'Title' => 'Title',
            'PublicationCategoryId' => 'Publication Category',
            'StaffId' => 'Staff',
            'CreatedDate' => 'Created Date',
            'CreatedBy' => 'Created By',
            'IsFeatured' => 'Featured',
            'ImageId' => 'Image ID',
            'Description' => 'Description',
            'ShortDescription' => 'Short Description',
            'Hits' => 'Hits',
            'StatusId' => 'Status',
            'LanguageId' => 'Language',
            'FileId' => 'File',
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

    public function getStaff(){
        return $this->hasOne( Staff::className(), ['Id' => 'StaffId'] );
    }

    public function getPublicationCategory(){
        return $this->hasOne( PublicationCategory::className(), ['Id' => 'PublicationCategoryId'] );
    }
}
