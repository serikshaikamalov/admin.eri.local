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

//    public static function create(string $Title, int $ParentId, int $LanguageId, int $StatusId): self
//    {
//        $pc = new static();
//        $pc->Title = $Title;
//        $pc->ParentId = $ParentId;
//        $pc->LanguageId = $LanguageId;
//        $pc->StatusId = $StatusId;
//        return $pc;
//    }
//
//    public function edit($name, $slug): void
//    {
//        $this->name = $name;
//        $this->slug = $slug;
//    }

    public static function tableName()
    {
        return 'publicationCategory';
    }

    /*
     * @return PublicationCategory[]
     */
    public static function getPublicationCategoryList(){
        $result = PublicationCategory::find()->all();
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
