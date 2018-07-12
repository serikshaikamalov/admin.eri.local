<?php
namespace api\viewmodels;

use common\entities\PublicationCategory;
use common\entities\PublicationMainTag;
use common\entities\Staff;
use common\entities\Language;
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
 * @property int $Hits
 * @property string $FileId
 * @property int $PublicationMainTagId
 *
 * @property string $ImageSrc
 * @property Staff $Staff
 * @property Language $Language
 * @property Status $Status
 * @property PublicationCategory $PublicationCategory
 * @property PublicationMainTag $PublicationMainTag
 * @property mixed $PublicationTags
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
    public $Hits;
    public $FileId;
    public $PublicationMainTagId;

    # Dictionaries
    public $ResearchGroup;
    public $ImageSrc;
    public $Staff;
    public $Language;
    public $Status;
    public $PublicationCategory;
    public $PublicationMainTag;
    public $PublicationTags;
}