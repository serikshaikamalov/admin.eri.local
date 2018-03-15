<?php
namespace api\viewmodels;
use common\entities\EventCategory;

/**
 * Class EventVM
 * @package app\modules\api\models
 *
 * @property int $Id
 * @property string $Title
 * @property string $StartDate
 * @property string $ShortDescription
 * @property string $FullDescription
 * @property int $EventCategoryId
 * @property int $LanguageId
 * @property string $SpeakerFullName
 *
 * @property EventCategory $EventCategory
 * @property string $ImageSrc
 */
class EventVM
{
    public $Id;
    public $Title;
    public $StartDate;
    public $ShortDescription;
    public $FullDescription;
    public $EventCategoryId;
    public $LanguageId;
    public $SpeakerFullName;

    // Dictionary
    public $EventCategory;
    public $ImageSrc;
}