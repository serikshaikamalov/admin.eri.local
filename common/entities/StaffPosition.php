<?php
namespace common\entities;
use \yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * @property int $Id
 * @property string $Title
 * @property int $StatusId
 * @property int $LanguageId
 */
class StaffPosition extends ActiveRecord
{
    public static function tableName()
    {
        return 'staffPosition';
    }

    public function rules()
    {
        return [
            [['StatusId', 'LanguageId'], 'integer'],
            [['Title'], 'string', 'max' => 50],
        ];
    }

    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'Title' => 'Title',
            'StatusId' => 'Status',
            'LanguageId' => 'Language',
        ];
    }


    /*
     * FULL
    * @return Active Query
    */
    public static function getFullStaffPositionList(){
        $query = StaffPosition::find()
            ->with('status')
            ->with('language');
        return $query;
    }

    /*
     * FULL
    * @return Active Query
    */
    public static function getFullStaffPosition($Id){
        $query = StaffPosition::find()
            ->with('status')
            ->with('language')
            ->where(['Id'=> $Id])
            ->one();

        return $query;
    }

    /*
     * @return StaffPosition[]
     */
    public static function getStaffPositionList( int $languageId = 1 ){
        $staffPositions = StaffPosition::find()
            ->where(['LanguageId' => $languageId])
            ->all();
        return ArrayHelper::map($staffPositions, 'Id', 'Title');
    }


    /**
     * RELATIONS
     * @return \yii\db\ActiveQuery
     */
    public function getLanguage(){
        return $this->hasOne( Language::className(), ['Id' => 'LanguageId'] );
    }

    public function getStatus()
    {
        return $this->hasOne(Status::className(), ['Id' => 'StatusId']);

    }
}
