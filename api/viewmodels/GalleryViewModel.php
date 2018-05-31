<?php
namespace api\viewmodels;

/**
 * @property int $Id
 * @property string $Title
 * @property string $Description
 * @property int $Hits
 * @property int $StatusId
 * @property int $LanguageId
 * @property string $CreatedDate
 * @property array $images
 */
class GalleryViewModel {
    public $Id;
    public $Title;
    public $Description;
    public $Hits;
    public $StatusId;
    public $LanguageId;
    public $CreatedDate;

    public $images;
}