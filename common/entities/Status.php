<?php
namespace common\entities;
use \yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * @property int $Id
 * @property string $Title
 * @property int $IsActive
 */
class Status extends ActiveRecord
{
    public static function tableName()
    {
        return 'status';
    }

    public function rules()
    {
        return [
            [['Title'], 'string', 'max' => 50],
            [['IsActive'], 'string', 'max' => 4],
        ];
    }
    
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'Title' => 'Title',
            'IsActive' => 'Is Active',
        ];
    }


    public static function getStatusList(){
        $statuses = Status::find()->all();
        return ArrayHelper::map($statuses, 'Id', 'Title');
    }

}
