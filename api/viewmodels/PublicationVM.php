<?php
namespace api\viewmodels;
use common\entities\Language;
use common\entities\PublicationCategory;
use common\entities\ResearchGroup;
use common\entities\Staff;
use common\entities\Status;

/**
 * @property Int $Id
 * @property string $Title
 * @property string $ShortDescription
 * @property string $FullDescription
 * @property int $ImageId
 * @property int $StaffId
 * @property int $PublicationCategoryId
 * @property int $StatusId
 * @property int $LanguageId
 * @property string $CreatedDate
 * @property int $ViewsCount
 * @property int $FileId
 *
 * @property ResearchGroup $ResearchGroup
 * @property string $ImageSrc
 * @property Staff $Staff
 * @property Language $Language
 * @property Status $Status
 * @property PublicationCategory $PublicationCategory
 *
 * */
class PublicationVM
{
    public $Id;
    public $Title;
    public $ShortDescription;
    public $FullDescription;
    public $ImageId;
    public $StaffId;
    public $PublicationCategoryId;
    public $StatusId;
    public $LanguageId;
    public $CreatedDate;
    public $ViewsCount;
    public $FileId;

    // Dictionaries
    public $ResearchGroup;
    public $ImageSrc;
    public $Staff;
    public $Language;
    public $Status;
    public $PublicationCategory;
}