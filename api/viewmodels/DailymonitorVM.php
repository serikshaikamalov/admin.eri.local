<?php
namespace api\viewmodels;
use common\entities\Language;
use common\entities\Status;

/**
 * @property int $Id
 * @property string $Title
 * @property string $Description
 * @property int $Link
 * @property int $StatusId
 * @property int $LanguageId
 * @property int $ImageId

 * @property string $ImageSrc
 * @property Language $Language
 * @property Status $Status
 * */
class DailymonitorVM
{
    public $Id;
    public $Title;
    public $Description;
    public $Link;
    public $StatusId;
    public $LanguageId;
    public $ImageId;

    // Dictionaries
    public $ImageSrc;
    public $Language;
    public $Status;
}