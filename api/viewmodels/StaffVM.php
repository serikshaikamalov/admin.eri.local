<?php
namespace api\viewmodels;

use common\entities\Language;
use common\entities\PublicationMainTag;
use common\entities\StaffPosition;
use common\entities\StaffType;
use common\entities\Status;

/**
 * @property int $Id
 * @property string $FullName
 * @property string $ShortBiography
 * @property string $FullBiography
 * @property int $PublicationMainTagId
 * @property int $ImageId
 * @property int $LanguageId
 * @property int $StatusId
 * @property int $StaffTypeId
 * @property int $StaffPositionId
 * @property string $ImageSrc
 *
 * @property Language $Language
 * @property Status $Status
 * @property StaffType $StaffType
 * @property StaffPosition $StaffPosition
 * @property PublicationMainTag $PublicationMainTag
 * */
class StaffVM
{
    public $Id;
    public $FullName;
    public $ShortBiography;
    public $FullBiography;
    public $PublicationMainTagId;
    public $ImageId;
    public $LanguageId;
    public $StatusId;
    public $StaffTypeId;
    public $StaffPositionId;

    // Dictionaries
    public $ImageSrc;
    public $Language;
    public $Status;
    public $StaffType;
    public $StaffPosition;
    public $PublicationMainTag;
}