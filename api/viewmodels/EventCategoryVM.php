<?php
namespace api\viewmodels;

/**
 * @property int $Id
 * @property string $Title
 * @property int $IsActive
 * @property int $ParentId
 * @property int $LanguageId
 * @property array $Children
 * @property string $Url
 */
class EventCategoryVM
{
    public $Id;
    public $Title;
    public $IsActive;
    public $ParentId;
    public $LanguageId;
    public $Children;
    public $Url;
}