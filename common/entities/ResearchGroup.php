<?php

namespace common\entities;

use Yii;

/**
 * This is the model class for table "researchGroup".
 *
 * @property int $Id
 * @property string $Title
 * @property int $ResearchGroupCategoryId
 * @property int $LanguageId
 * @property int $StatusId
 */
class ResearchGroup extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'researchGroup';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ResearchGroupCategoryId', 'LanguageId', 'StatusId'], 'integer'],
            [['Title'], 'string', 'max' => 50],
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
            'ResearchGroupCategoryId' => 'Research Group Category ID',
            'LanguageId' => 'Language ID',
            'StatusId' => 'Status ID',
        ];
    }
}
