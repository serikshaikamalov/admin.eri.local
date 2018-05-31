<?php
namespace common\formmodels;
use \yii\base\Model;

/**
 * Class ImageFormModel
 * @property $image1
 * @property $image2
 * @property $image3
 */
class ImageFormModel extends Model {
    public $image1;
    public $image2;
    public $image3;
    public $image4;
    public $image5;
    public $image6;
    public $image7;
    public $image8;
    public $image9;
    public $image10;
    public $image11;
    public $image12;
    public $image13;
    public $image14;
    public $image15;
    public $image16;
    public $image17;
    public $image18;
    public $image19;
    public $image20;


    public function rules()
    {
        return [
            [
                [
                    'image1',
                    'image2',
                    'image3',
                    'image4',
                    'image5',
                    'image6',
                    'image7',
                    'image8',
                    'image9',
                    'image10',
                    'image11',
                    'image12',
                    'image13',
                    'image14',
                    'image15',
                    'image16',
                    'image17',
                    'image18',
                    'image19',
                    'image20',
                ],
                'string'
            ]
        ];
    }

    public function attributeLabels()
    {
        return [
            'image1' => 'image1',
            'image2' => 'image2',
        ];
    }


}