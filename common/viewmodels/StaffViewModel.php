<?php
namespace common\viewmodels;
use common\entities\Language;
use common\entities\PublicationMainTag;
use common\entities\StaffPosition;
use common\entities\StaffType;
use common\entities\Status;

/**
 * @property int $Id
 * @property string $FullName
 * @property string $ShortBiography
 * @property string FullBiography
 * @property int $PublicationMainTagId
 * @property int $ImageId
 * @property int $LanguageId
 * @property int $StatusId
 * @property int $StaffTypeId
 * @property string $StaffPositionId
 * @property int $OrderNumber
 *
 * @property StaffPosition $StaffPosition
 * @property StaffType $StaffType
 * @property Language $Language
 * @property string $Image
 * @property PublicationMainTag $PublicationMainTag
 * @property Status $Status
 */
class StaffViewModel {

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
    public $OrderNumber;

    # Relations
    public $StaffPosition;
    public $StaffType;
    public $Language;
    public $Image;
    public $PublicationMainTag;
    public $Status;
}