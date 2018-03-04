<?php
namespace common\services;

use common\entities\PublicationCategory;
use common\forms\PublicationCategoryForm;
use common\repositories\PublicationCategoryRepository;

class PublicationCategoryService
{
    private $repo;

    public function __construct(PublicationCategoryRepository $repo)
    {
        $this->repo = $repo;
    }

    public function create(PublicationCategoryForm $form): PublicationCategory
    {
        $publicationCategory = PublicationCategory::create(
            $form->Title,
            $form->ParentId,
            $form->LanguageId,
            $form->StatusId
        );
        $this->repo->save($publicationCategory);
        return $publicationCategory;
    }

}