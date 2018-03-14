<?php
namespace api\viewmodels;
use common\entities\Language;
use common\entities\Status;

/**
 * @property Int $Id
 * @property string $Title
 * @property string $ShortDescription
 * @property string $FullDescription
 * @property int $ImageId
 * @property int $StaffId
 * @property int $NewsCategoryId
 * @property int $StatusId
 * @property int $LanguageId
 * @property string $CreatedDate
 * @property int $Hits
 *
 * @property string $ImageSrc
 * @property Language $Language
 * @property Status $Status
 *
 * */
class NewsVM
{
    public $Id;
    public $Title;
    public $ShortDescription;
    public $FullDescription;
    public $ImageId;
    public $NewsCategoryId;
    public $StatusId;
    public $LanguageId;
    public $CreatedDate;
    public $Hits;

    // Dictionaries
    public $ImageSrc;
    public $Language;
    public $Status;
}