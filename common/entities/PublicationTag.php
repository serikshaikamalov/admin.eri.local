<?php
namespace common\entities;
use \yii\db\ActiveRecord;

/**
 *
 * @property int $Id
 * @property int $Title
 * @property int $LanguageId
 * @property int $StatusId
 */
class PublicationTag extends ActiveRecord
{
    public static function tableName()
    {
        return 'publicationTag';
    }

    public function rules()
    {
        return [
            [
                ['Title'], 'string',
            ],
            [
                ['LanguageId', 'StatusId'], 'integer'
            ],
        ];
    }

    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'Title' => 'Title',
            'LanguageId' => 'Language ID',
            'StatusId' => 'Status ID',
        ];
    }

    public static function getTagByTitle( $tagTitle )
    {
        $tag = PublicationTag::find()->where(['Title' => $tagTitle])->one();
        if (!$tag) {
            $tag = new PublicationTag();
            $tag->Title = $tagTitle;
            $tag->save(false);
        }
        return $tag;
    }
}
