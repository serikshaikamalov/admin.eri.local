<?php
namespace api\viewmodels;

/**
 * @property int $Id
 * @property string $Title
 * @property int $ParentId
 * @property int $LanguageId
 * @property int $StatusId
 * @property int $ImageId
 * @property int $Description
 * @property ResearchGroupVM $Children
 * */
class ResearchGroupVM
{
    public $Id;
    public $Title;
    public $ParentId;
    public $LanguageId;
    public $StatusId;
    public $ImageId;
    public $Description;
    public $Children;
}