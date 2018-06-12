<?php
namespace api\viewmodels;
use common\entities\Language;
use common\entities\Status;

/**
 * Class MenuItemVM
 * @property int $Id
 * @property string $Title
 * @property string $Link
 * @property int $LanguageId
 * @property int $ParentId
 * @property int $MenuTypeId
 * @property int $StatusId
 * @property int $IsDefault
 * @property string $Icon
 *
 * @property Language $Language
 * @property Status $Status
 * @property array $Children
 */
class MenuItemVM
{
    public $Id;
    public $Title;
    public $Link;
    public $LanguageId;
    public $ParentId;
    public $MenuTypeId;
    public $StatusId;
    public $IsDefault;
    public $Icon;

    # Dictionaries
    public $Language;
    public $Status;
    public $Children;
}