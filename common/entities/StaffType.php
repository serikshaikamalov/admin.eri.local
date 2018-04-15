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
class StaffType extends ActiveRecord
{
    public static function tableName()
    {
        return 'staffType';
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
     * @return StaffType detailed
     */
    public static function getFullStaffType($Id){
        $staff = StaffType::find()
            ->with('status')
            ->with('language')
            ->where(['Id' => $Id] )
            ->one();

        return $staff;
    }

    /*
     * @return Active Query
     */
    public static function getFullStaffTypeList(){
        $query = StaffType::find()
                        ->with('status')
                        ->with('language');
        return $query;
    }


    /*
     * @return StaffType[]
     */
    public static function getStaffTypeList( int $languageId ){
        $staffTypes = StaffType::find()
            ->where(['LanguageId' => $languageId])
            ->all();
        return ArrayHelper::map($staffTypes, 'Id', 'Title');
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

}
