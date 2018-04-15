<?php
namespace common\entities;
use \yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * @property int $Id
 * @property string $Title
 * @property int $ParentId
 * @property int $LanguageId
 * @property int $StatusId
 */
class PublicationCategory extends ActiveRecord
{
    public static function tableName()
    {
        return 'publicationCategory';
    }

    /**
     * @param int $languageId
     * @return PublicationCategory[]
     */
    public static function getPublicationCategoryList( int $languageId = 1){

        $result = PublicationCategory::find()
            ->where(['LanguageId' => $languageId])
            ->all();

        return ArrayHelper::map($result, 'Id', 'Title');
    }

    /*
     * RELATIONS
     */
    public function getStatus(){
        return $this->hasOne( Status::className(), ['Id' => 'StatusId'] );
    }

    public function getLanguage(){
        return $this->hasOne( Language::className(), ['Id' => 'LanguageId'] );
    }

}
