<?php
namespace api\viewmodels;
use common\entities\Language;
use common\entities\ResearchGroup;
use common\entities\StaffPosition;
use common\entities\StaffType;
use common\entities\Status;

/**
 * @property Int $Id
 * @property string $Title
 * @property string $ShortDescription
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

}