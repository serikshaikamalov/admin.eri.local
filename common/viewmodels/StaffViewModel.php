<?php
namespace common\viewmodels;

class StaffViewModel {

    public $Id;
    public $Status;
    public $FullName;
    public $StaffPositionId;
    public $ResearchGroupId;
    public $StaffTypeId;
    public $ShortBiography;
    public $ImageId;
    public $LanguageId;

    // Relations
    public $StaffPosition;
    public $ResearchGroup;
    public $StaffType;
    public $Language;
    public $Image;
}