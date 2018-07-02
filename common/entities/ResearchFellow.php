<?php
namespace common\entities;
use Yii;
use \yii\db\ActiveRecord;

/**
 * @property int $Id
 * @property int $researchFellowTypeId
 * @property int $researchFellowCategoryId
 * @property string $Title
 * @property string $ShortDescription
 * @property string $FullDescription
 * @property int $ImageId
 * @property string $FilePDFId
 * @property string $FileWordId
 * @property string $CreatedDate
 * @property int $CreatedBy
 */
class ResearchFellow extends ActiveRecord
{
    public static function tableName()
    {
        return 'researchFellow';
    }

    public function rules()
    {
        return [
            [['researchFellowTypeId', 'researchFellowCategoryId', 'ImageId', 'CreatedBy'], 'integer'],
            [['FullDescription', 'FilePDFId', 'FileWordId',], 'string'],
            [['Title'], 'string', 'max' => 100],
            [['ShortDescription'], 'string', 'max' => 300],
            [['CreatedDate'], 'string', 'max' => 50],
        ];
    }

    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'researchFellowTypeId' => 'Type',
            'researchFellowCategoryId' => 'Category',
            'Title' => 'Title',
            'ShortDescription' => 'Short Description',
            'FullDescription' => 'Full Description',
            'ImageId' => 'Image',
            'FilePDFId' => 'File(PDF)',
            'FileWordId' => 'File(Word)',
            'CreatedDate' => 'Created',
            'CreatedBy' => 'Author',
        ];
    }
}
