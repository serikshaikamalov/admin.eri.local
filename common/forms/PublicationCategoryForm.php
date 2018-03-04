<?php
namespace common\forms;
use yii\base\Model;


class PublicationCategoryForm extends Model
{
    public $Id;
    public $Title;
    public $ParentId;
    public $LanguageId;
    public $StatusId;

    public function rules()
    {
        return [
            [['Title', 'LanguageId', 'StatusId'], 'required'],
            [['ParentId', 'LanguageId', 'StatusId'], 'integer'],
            [['Title'], 'string', 'max' => 250],
        ];
    }

    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'Title' => 'Title',
            'ParentId' => 'Parent ID',
            'LanguageId' => 'Language ID',
            'StatusId' => 'Status ID',
        ];
    }
}