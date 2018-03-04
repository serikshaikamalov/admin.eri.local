<?php
namespace api\viewmodels;
use common\entities\Language;
use common\entities\ResearchGroup;
use common\entities\StaffPosition;
use common\entities\StaffType;
use common\entities\Status;

/**
 * @property int $Id
 * @property string $FullName
 * @property string $ShortBiography
 * @property string $FullBiography
 * @property int $ResearchGroupId
 * @property int $ImageId
 * @property int $LanguageId
 * @property int $StatusId
 * @property int $StaffTypeId
 * @property int $StaffPositionId
 * @property ResearchGroup $ResearchGroup
 * @property string $ImageSrc
 * @property Language $Language
 * @property Status $Status
 * @property StaffType $StaffType
 * @property StaffPosition $StaffPosition
 * */
class StaffVM
{
    public $Id;
    public $FullName;
    public $ShortBiography;
    public $FullBiography;
    public $ResearchGroupId;
    public $ImageId;
    public $LanguageId;
    public $StatusId;
    public $StaffTypeId;
    public $StaffPositionId;

    // Dictionaries
    public $ResearchGroup;
    public $ImageSrc;
    public $Language;
    public $Status;
    public $StaffType;
    public $StaffPosition;
}