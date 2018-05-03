<?php
namespace common\viewmodels;
use common\entities\EventCategory;
use common\entities\Language;
use common\entities\Status;

/**
 * Class EventViewModel
 * @property int $Id
 * @property string $Title
 * @property string $StartDate
 * @property string $ShortDescription
 * @property string $FullDescription
 * @property string $SpeakerFullName
 * @property int $CreatedBy
 * @property string $CreatedDate
 * @property string $Address
 * @property string $Image
 * @property string $Link
 *
 * @property Status $Status
 * @property EventCategory $EventCategory
 * @property Language $Language
 */
class EventViewModel {
    public $Id;
    public $Title;
    public $StartDate;
    public $ShortDescription;
    public $FullDescription;
    public $SpeakerFullName;
    public $CreatedBy;
    public $CreatedDate;
    public $Address;
    public $Image;
    public $Link;

    // Dictionaries
    public $Status;
    public $EventCategory;
    public $Language;
}