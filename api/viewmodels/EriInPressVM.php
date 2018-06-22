<?php
namespace api\viewmodels;
use common\entities\Language;
use common\entities\Status;

/**
 * @property Int $Id
 * @property string $Title
 * @property string $Description
 * @property int $ImageId
 * @property int $StatusId
 * @property int $LanguageId
 * @property string $CreatedDate
 * @property string $Link
 * @property string $ImageSrc
 *
 * @property Language $Language
 * @property Status $Status
 *
 * */
class EriInPressVM
{
    public $Id;
    public $Title;
    public $Description;
    public $ImageId;
    public $StatusId;
    public $LanguageId;
    public $CreatedDate;
    public $Link;

    # Dictionaries
    public $ImageSrc;
    public $Language;
    public $Status;
}