<?php
namespace api\viewmodels;

/**
 * @property int $Id
 * @property int $ResearchFellowTypeId
 * @property int $ResearchFellowCategoryId
 * @property string $Title
 * @property string $ShortDescription
 * @property string $FullDescription
 * @property string $CreatedDate
 * @property string $ImageSource
 * @property string $FilePDFSource
 * @property string $FileWordSource
 *
 * @property mixed $ResearchFellowType
 * @property mixed $ResearchFellowCategory
 * */

class ResearchFellowVM
{
    public $Id;
    public $ResearchFellowTypeId;
    public $ResearchFellowCategoryId;
    public $Title;
    public $ShortDescription;
    public $FullDescription;
    public $CreatedDate;
    public $ImageSource;
    public $FilePDFSource;
    public $FileWordSource;

    # DICTIONARIES
    public $ResearchFellowType;
    public $ResearchFellowCategory;
}