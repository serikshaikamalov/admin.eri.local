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
 * @property string $Icon
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
            [['LanguageId', 'ParentId', 'MenuTypeId', 'StatusId', 'OrderNumber'], 'integer'],
            [['Title'], 'string', 'max' => 100],
            [['Link'], 'string', 'max' => 250],
            [['Icon'], 'string'],
            [['IsDefault', 'IsOptional'], 'string', 'max' => 2],
        ];
    }

    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'Title' => 'Title',
            'Link' => 'Link',
            'LanguageId' => 'Language',
            'ParentId' => 'Parent',
            'MenuTypeId' => 'Menu Type',
            'StatusId' => 'Status',
            'IsDefault' => 'Default',
            'IsOptional' => 'Optional',
            'Icon' => 'Icon',
            'OrderNumber' => 'Order Number'
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
