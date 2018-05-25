<?php
namespace common\entities;
use Yii;
use \yii\db\ActiveRecord;

/**
 * This is the model class for table "asyaAvrupa".
 *
 * @property int $Id
 * @property string $Title
 * @property string $TitleSecond
 * @property int $FileId
 * @property string $InteractiveSrc
 * @property int $LanguageId
 * @property int $StatusId
 */
class AsyaAvrupa extends ActiveRecord
{
    public static function tableName()
    {
        return 'asyaAvrupa';
    }

    public function rules()
    {
        return [
            [['LanguageId', 'StatusId', 'ImageId'], 'integer'],
            [['FileId','Title', 'TitleSecond', 'InteractiveSrc'], 'string', 'max' => 50],
        ];
    }

    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'Title' => 'Title',
            'TitleSecond' => 'Title Second',
            'FileId' => 'File',
            'InteractiveSrc' => 'Interactive Source',
            'LanguageId' => 'Language',
            'StatusId' => 'Status',
            'ImageId' => 'Image'
        ];
    }
}