<?php
namespace common\entities;
use \yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * @property int $Id
 * @property string $Title
 * @property int $IsDefault
 * @property int $IsActive
 * @property string $Code
 */
class Language extends ActiveRecord
{
    public static function tableName()
    {
        return 'language';
    }

    public function rules()
    {
        return [
            [['Title', 'Code'], 'string', 'max' => 50],
            [['IsDefault', 'IsActive'], 'string', 'max' => 4],
        ];
    }

    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'Title' => 'Title',
            'IsDefault' => 'Is Default',
            'IsActive' => 'Is Active',
            'Code' => 'Code',
        ];
    }


    public static function getLanguageList(){
        $languages = Language::find()->all();
        $languages = ArrayHelper::map($languages, 'Id', 'Title');
        return $languages;
    }
}
