<?php
namespace common\entities;
use Yii;
use \yii\db\ActiveRecord;

/**
 * @property int $Id
 * @property string $Title
 * @property string $Description
 * @property int $Hits
 * @property int $StatusId
 * @property int $LanguageId
 * @property string $CreatedDate
 * @property int $CreatedUserId
 * @property string $LastEditedDate
 */
class Gallery extends ActiveRecord
{
    public static function tableName()
    {
        return 'gallery';
    }

    public function rules()
    {
        return [
            [
                ['Description'],
                'string'
            ],
            [
                [
                    'Hits',
                    'StatusId',
                    'LanguageId',
                    'CreatedUserId'
                ],
                'integer'],
            [
                [
                    'Title',
                    'CreatedDate'
                ],
                'string', 'max' => 250
            ],
            [
                [
                    'LastEditedDate'
                ], 'string', 'max' => 50],
        ];
    }

    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'Title' => 'Title',
            'Description' => 'Description',
            'Hits' => 'Hits',
            'StatusId' => 'Status',
            'LanguageId' => 'Language',
            'CreatedDate' => 'Created Date',
            'CreatedUserId' => 'Author',
            'LastEditedDate' => 'Edited Date',
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