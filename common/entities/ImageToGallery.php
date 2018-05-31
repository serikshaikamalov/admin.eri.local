<?php
namespace common\entities;
use Yii;
use \yii\db\ActiveRecord;

/**
 * @property int $Id
 * @property int $GalleryId
 * @property int $ImageId
 */
class ImageToGallery extends ActiveRecord
{
    public static function tableName()
    {
        return 'ImageToGallery';
    }

    public function rules()
    {
        return [
            [['GalleryId'], 'integer'],
            [['ImageId'], 'string', 'max' => 100],
        ];
    }

    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'GalleryId' => 'Gallery ID',
            'ImageId' => 'Image ID',
        ];
    }
}