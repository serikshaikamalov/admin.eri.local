<?php
namespace common\entities;

use Yii;
use \yii\db\ActiveRecord;

/**
 * This is the model class for table "slider".
 *
 * @property int $Id
 * @property string $Title
 * @property string $Url
 * @property string $ImageId
 * @property int $IsActive
 * @property string $Description
 */
class Slider extends ActiveRecord
{

    public static function tableName()
    {
        return 'slider';
    }

    public function rules()
    {
        return [
            [['Description'], 'string'],
            [['Title'], 'string', 'max' => 100],
            [['Url'], 'string', 'max' => 250],
            [['ImageId'], 'integer'],
            [['IsActive'], 'string', 'max' => 4],
        ];
    }

    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'Title' => 'Title',
            'Url' => 'Url',
            'ImageId' => 'Image',
            'IsActive' => 'Status',
            'Description' => 'Description',
        ];
    }
}
