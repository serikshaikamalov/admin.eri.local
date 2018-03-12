<?php
namespace api\viewmodels;
use common\entities\Publication;

/**
 * @property int $TotalCount
 * @property int $PageNumber
 * @property Publication[] $PublicationList
 * */

class PublicationListVM
{
    public $TotalCount;
    public $PageNumber;
    public $PublicationList;
}