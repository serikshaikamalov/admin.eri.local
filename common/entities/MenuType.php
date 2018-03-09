<?php
namespace common\entities;
use \yii\db\ActiveRecord;

/**
 * @property int $Id
 * @property string $Title
 * @property int $StatusId
 */
class MenuType extends ActiveRecord
{
    public static function tableName()
    {
        return 'menuType';
    }

    public function rules()
    {
        return [
            [['StatusId'], 'integer'],
            [['Title'], 'string', 'max' => 250],
        ];
    }

    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'Title' => 'Title',
            'StatusId' => 'Status ID',
        ];
    }
}
