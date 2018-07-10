<?php

namespace common\entities;

use Yii;

/**
 * This is the model class for table "publicationToTag".
 *
 * @property int $Id
 * @property int $PublicationId
 * @property int $TagId
 */
class PublicationToTag extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'publicationToTag';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['PublicationId', 'TagId'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'PublicationId' => 'Publication ID',
            'TagId' => 'Tag ID',
        ];
    }
}
