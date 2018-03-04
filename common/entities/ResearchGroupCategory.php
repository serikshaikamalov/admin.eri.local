<?php

namespace common\entities;

use Yii;

/**
 * This is the model class for table "researchGroupCategory".
 *
 * @property int $Id
 * @property string $Title
 * @property int $ParentId
 * @property int $LanguageId
 * @property int $StatusId
 * @property int $ImageId
 * @property string $Description
 */
class ResearchGroupCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'researchGroupCategory';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ParentId', 'LanguageId', 'StatusId', 'ImageId'], 'integer'],
            [['Description'], 'string'],
            [['Title'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'Title' => 'Title',
            'ParentId' => 'Parent ID',
            'LanguageId' => 'Language ID',
            'StatusId' => 'Status ID',
            'ImageId' => 'Image ID',
            'Description' => 'Description',
        ];
    }
}
