<?php
namespace common\entities;
use \yii\db\ActiveRecord;

/**
 *
 * @property int $Id
 * @property int $Title
 * @property int $TitleTR
 * @property int $TitleRU
 * @property int $TitleKZ
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
                ['Title', 'TitleTR','TitleRU', 'TitleKZ'], 'string',
            ],
            [
                ['StatusId'], 'integer'
            ],
        ];
    }

    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'Title' => 'Title(EN)',
            'TitleTR' => 'Title(TR)',
            'TitleRU' => 'Title(RU)',
            'TitleKZ' => 'Title(KZ)',
            'StatusId' => 'Status',
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


    public function getPublication() {
        return $this->hasMany(Publication::className(), ['Id' => 'PublicationId'])
            ->viaTable('publicationToTag', ['TagId' => 'Id']);
    }
}
