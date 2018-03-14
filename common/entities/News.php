<?php
namespace common\entities;
use \yii\db\ActiveRecord;

/**
 * @property int $Id
 * @property string $Title
 * @property string $ShortDescription
 * @property string $FullDescription
 * @property int $NewsCategoryId
 * @property int $ImageId
 * @property string $CreatedDate
 * @property int $Hits
 * @property int $StatusId
 * @property int $LanguageId
 */
class News extends ActiveRecord
{
    public static function tableName()
    {
        return 'news';
    }

    public function rules()
    {
        return [
            [['ShortDescription', 'FullDescription'], 'string'],
            [['NewsCategoryId', 'ImageId', 'Hits', 'StatusId', 'LanguageId'], 'integer'],
            [['Title'], 'string', 'max' => 250],
            [['CreatedDate'], 'string', 'max' => 50],
        ];
    }

    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'Title' => 'Title',
            'ShortDescription' => 'Short Description',
            'FullDescription' => 'Full Description',
            'NewsCategoryId' => 'News Category',
            'ImageId' => 'Image',
            'CreatedDate' => 'Created Date',
            'Hits' => 'Hits',
            'StatusId' => 'Status ID',
            'LanguageId' => 'Language ID',
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
        return $this->hasOne( NewsCategory::className(), ['Id' => 'NewsCategoryId'] );
    }
}
