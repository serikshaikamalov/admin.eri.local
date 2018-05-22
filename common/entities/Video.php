<?php
namespace common\entities;
use Yii;
use \yii\db\ActiveRecord;

/**
 * This is the model class for table "video".
 *
 * @property int $Id
 * @property string $Title
 * @property string $Description
 * @property string $Url
 * @property int $StatusId
 * @property string $CDate
 * @property int $LanguageId
 * @property int $Hits
 */
class Video extends ActiveRecord
{
    public static function tableName()
    {
        return 'video';
    }

    public function rules()
    {
        return [
            [['LanguageId', 'Hits'], 'integer'],
            [['Title', 'Description', 'Url'], 'string', 'max' => 250],
            [['StatusId'], 'string', 'max' => 4],
            [['CDate'], 'string', 'max' => 50],
        ];
    }

    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'Title' => 'Title',
            'Description' => 'Description',
            'Url' => 'Url',
            'StatusId' => 'Status',
            'CDate' => 'Created Date',
            'LanguageId' => 'Language',
            'Hits' => 'Hits',
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