<?php
namespace api\viewmodels;
use common\entities\Publication;

/**
 * @property int $TotalCount
 * @property int $PageNumber
 * @property Publication[] $Items
 * */

class NewsListVM
{
    public $TotalCount;
    public $PageNumber;
    public $Items;
}