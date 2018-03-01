<?php
namespace common\entities;
use \yii\db\ActiveRecord;

class Post extends ActiveRecord
{
    public static function tableName()
    {
        return 'post';
    }

    public function rules()
    {
        return [
            [['Description'], 'string'],
            [['UserId'], 'integer'],
            [['Title'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'Title' => 'Title',
            'Description' => 'Description',
            'UserId' => 'User ID',
        ];
    }

    /**
     * RELATIONS
     * @return \yii\db\ActiveQuery
     */
    public function getUser(){
        return $this->hasOne( User::className(), ['Id' => 'UserId'] );
    }




}
