<?php
namespace common\entities;
use cornernote\linkall\LinkAllBehavior;
use \yii\db\ActiveRecord;

/**
 * This is the model class for table "publication".
 *
 * @property int $Id
 * @property string $Title
 * @property int $PublicationCategoryId
 * @property int $StaffId
 * @property int $CreatedDate
 * @property int $CreatedBy
 * @property int $IsFeatured
 * @property string $ImageId
 * @property string $Description
 * @property string $ShortDescription
 * @property int $Hits
 * @property int $StatusId
 * @property int $LanguageId
 * @property int $FileId
 * @property int $PublicationMainTagId
 *
 * @property Staff $Staff
 * @property Status $Status
 * @property Language $Language
 * @property PublicationMainTag $PublicationMainTag
 *
 * @property mixed publicationTag
 */
class Publication extends ActiveRecord
{

    // All publication's tags
    public $tagIds;

    public static function tableName()
    {
        return 'publication';
    }

    public function behaviors()
    {
        return [
            LinkAllBehavior::className(),
        ];
    }


    public function afterSave($insert, $changedAttributes)
    {
        $tags = [];
        foreach ($this->tagIds as $tag_name) {
            //$tag = PublicationTag::getTagByTitle($tag_name);
//            if ($tag) {
//                $tags[] = $tag;
//            }

            //$this->link('publicationTag', $tag_name);

            $rel = new PublicationToTag();
            $rel->PublicationId = $this->Id;
            $rel->TagId = $tag_name;
            $rel->save();

        }
        parent::afterSave($insert, $changedAttributes);
    }


    public function rules()
    {
        return [
            [
                [
                    'PublicationCategoryId',
                    'StaffId',
                    'CreatedBy',
                    'Hits',
                    'StatusId',
                    'LanguageId',
                    'ImageId',
                    'IsFeatured',
                    'PublicationMainTagId'
                ], 'integer'],
            [
                [
                    'Description',
                    'ShortDescription',
                    'CreatedDate',
                    'FileId',
                ], 'string'],
            [
                [
                    'Title'
                ], 'string', 'max' => 250
            ],
            [
                ['tagIds'], 'required'
            ]
        ];
    }

    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'Title' => 'Title',
            'PublicationTypeId' => 'Publication Type',
            'PublicationCategoryId' => 'Publication Category',
            'StaffId' => 'Staff',
            'CreatedDate' => 'Created Date',
            'CreatedBy' => 'Created By',
            'IsFeatured' => 'Featured',
            'ImageId' => 'Image ID',
            'Description' => 'Description',
            'ShortDescription' => 'Short Description',
            'Hits' => 'Hits',
            'StatusId' => 'Status',
            'LanguageId' => 'Language',
            'FileId' => 'File',
            'PublicationMainTagId' => 'Main Tag',
            'tagIds' => 'Tag IDs'
        ];
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

    public function getStaff(){
        return $this->hasOne( Staff::className(), ['Id' => 'StaffId'] );
    }

    public function getPublicationCategory(){
        return $this->hasOne( PublicationCategory::className(), ['Id' => 'PublicationCategoryId'] );
    }

    public function getPublicationMainTag(){
        return $this->hasOne( PublicationMainTag::className(), ['Id' => 'PublicationMainTagId'] );
    }


    public function getPublicationTag() {
        return $this->hasMany(PublicationTag::className(), ['Id' => 'TagId'])
            ->viaTable('publicationToTag', ['PublicationId' => 'Id']);
    }
}
