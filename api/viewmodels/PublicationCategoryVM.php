<?php
namespace app\viewmodels;

/**
 * @property int $Id
 * @property string $Title
 * @property string $Link
 * @property int $LanguageId
 * @property int $StatusId
 * @property int $ParentId
 * @property PublicationCategoryVM $Children
 */
class PublicationCategoryVM
{
    public $Id;
    public $Title;
    public $Link;
    public $LanguageId;
    public $StatusId;
    public $ParentId;
    public $Children;
}