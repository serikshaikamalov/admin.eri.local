<?php
namespace common\entities;
use \yii\db\ActiveRecord;

/**
 *
 * @property int $Id
 * @property string $Title
 * @property string $Link
 * @property int $LanguageId
 * @property int $ParentId
 * @property int $MenuTypeId
 * @property int $StatusId
 * @property int $IsDefault
 */
class Menu extends ActiveRecord
{
    public static function tableName()
    {
        return 'menu';
    }

    public function rules()
    {
        return [
            [['LanguageId', 'ParentId', 'MenuTypeId', 'StatusId'], 'integer'],
            [['Title'], 'string', 'max' => 100],
            [['Link'], 'string', 'max' => 250],
            [['IsDefault'], 'string', 'max' => 2],
        ];
    }

    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'Title' => 'Title',
            'Link' => 'Link',
            'LanguageId' => 'Language ID',
            'ParentId' => 'Parent ID',
            'MenuTypeId' => 'Menu Type ID',
            'StatusId' => 'Status ID',
            'IsDefault' => 'Is Default',
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

    public function getMenuType(){
        return $this->hasOne( Status::className(), ['Id' => 'MenuTypeId'] );
    }

}
