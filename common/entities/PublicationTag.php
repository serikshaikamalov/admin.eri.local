<?php
namespace common\entities;
use \yii\db\ActiveRecord;

/**
 *
 * @property int $Id
 * @property int $Title
 * @property int $LanguageId
 * @property int $StatusId
 */
class PublicationTag extends ActiveRecord
{
    public static function tableName()
    {
        return 'publicationTag';
    }

    public function rules()
    {
        return [
            [['Title', 'LanguageId', 'StatusId'], 'integer'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'Title' => 'Title',
            'LanguageId' => 'Language ID',
            'StatusId' => 'Status ID',
        ];
    }
}
