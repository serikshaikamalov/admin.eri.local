<?php
namespace common\entities;
use Yii;
use \yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * @property int $Id
 * @property string $Title
 */
class ResearchFellowType extends ActiveRecord
{
    public static function tableName()
    {
        return 'researchFellowType';
    }

    public function rules()
    {
        return [
            [['Title'], 'string', 'max' => 50],
        ];
    }

    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'Title' => 'Title',
        ];
    }

    public static function getResearchFellowTypeList(){
        $languages = ResearchFellowType::find()->all();
        return ArrayHelper::map($languages, 'Id', 'Title');
    }
}
