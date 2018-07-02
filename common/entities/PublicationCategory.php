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
     * @return PublicationCategory[]
     */
    public static function getPublicationCategoryList(){

        $result = PublicationCategory::find()
            ->where(['LanguageId' => \Yii::$app->language] )
            ->all();

        foreach( $result as $item ){
            if( $item->ParentId  != 0){
                $item->Title = '--'.$item->Title;
            }else if( $item->ParentId == 2 ){
                $item->Title = '---'.$item->Title;
            }
        }

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
