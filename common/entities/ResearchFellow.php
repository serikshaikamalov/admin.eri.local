<?php
namespace common\entities;
use Yii;
use \yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * @property int $Id
 * @property int $ResearchFellowTypeId
 * @property int $ResearchFellowCategoryId
 * @property string $Title
 * @property string $ShortDescription
 * @property string $FullDescription
 * @property int $ImageId
 * @property string $FilePDFId
 * @property string $FileWordId
 * @property string $CreatedDate
 * @property int $CreatedBy
 * @property int $LanguageId
 * @property int $StatusId
 */
class ResearchFellow extends ActiveRecord
{
    public static function tableName()
    {
        return 'researchFellow';
    }

    public function rules()
    {
        return [
            [['ResearchFellowTypeId', 'ResearchFellowCategoryId', 'ImageId', 'CreatedBy', 'LanguageId', 'StatusId'], 'integer'],
            [['FullDescription', 'FilePDFId', 'FileWordId',], 'string'],
            [['Title'], 'string', 'max' => 100],
            [['ShortDescription'], 'string', 'max' => 300],
            [['CreatedDate'], 'string', 'max' => 50],
        ];
    }

    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'ResearchFellowTypeId' => 'Type',
            'ResearchFellowCategoryId' => 'Category',
            'Title' => 'Title',
            'ShortDescription' => 'Short Description',
            'FullDescription' => 'Full Description',
            'ImageId' => 'Image',
            'FilePDFId' => 'File(PDF)',
            'FileWordId' => 'File(Word)',
            'CreatedDate' => 'Created',
            'CreatedBy' => 'Author',
            'LanguageId' => 'Language',
            'StatusId' => 'Status'
        ];
    }

    /**
     * RELATIONS
     * @return \yii\db\ActiveQuery
     */
    public function getResearchFellowType(){
        return $this->hasOne( ResearchFellowType::className(), ['Id' => 'ResearchFellowTypeId'] );
    }

    public function getResearchFellowCategory(){
        return $this->hasOne( ResearchFellowCategory::className(), ['Id' => 'ResearchFellowCategoryId'] );
    }

    public function getLanguage(){
        return $this->hasOne( Language::className(), ['Id' => 'LanguageId'] );
    }

    public function getStatus(){
        return $this->hasOne( Status::className(), ['Id' => 'StatusId'] );
    }
}