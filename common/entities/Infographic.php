<?php
namespace common\entities;

use Yii;
use \yii\db\ActiveRecord;

/**
 * @property int $Id
 * @property string $Title
 * @property int $ImageId
 * @property int $CreatedBy
 * @property string $CreatedDate
 * @property int $LanguageId
 * @property int $StatusId
 */
class Infographic extends ActiveRecord
{
    public static function tableName()
    {
        return 'infographic';
    }

    public function rules()
    {
        return [
            [['ImageId', 'CreatedBy', 'LanguageId', 'StatusId'], 'integer'],
            [['Title', 'CreatedDate'], 'string', 'max' => 50],
        ];
    }

    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'Title' => 'Title',
            'ImageId' => 'Image',
            'CreatedBy' => 'Author',
            'CreatedDate' => 'Created Date',
            'LanguageId' => 'Language',
            'StatusId' => 'Status',
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
