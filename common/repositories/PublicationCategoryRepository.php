<?php
namespace common\repositories;
use common\entities\PublicationCategory;
use common\forms\PublicationCategoryForm;

class PublicationCategoryRepository
{

    /*
     * @return PublicationCategory
     */
    public function get($id): PublicationCategory
    {
        if (!$pc = PublicationCategory::findOne($id)) {
            throw new \DomainException('Tag is not found.');
        }
        return $pc;
    }


    public function getFull( $id ){

        $pc = PublicationCategory::find()
            ->where(['Id' => $id ])
            ->with('language')
            ->with('status')
            ->one();

        return $pc;
    }

    /*
    * @return PublicationCategory
    */
    public function getChildren( int $ParentId ): array
    {
        $all = PublicationCategory::find()
            ->where(['ParentId' => $ParentId])
            ->all();
        return $all;
    }



    /*
     * @return PublicationCategory
     */
    public function getAll(): array
    {
        if (!$all = PublicationCategory::find()->all()) {
            throw new \DomainException('Tag is not found.');
        }
        return $all;
    }


    /*
     * Save
     */
    public function save(PublicationCategoryForm $form): PublicationCategory
    {
        $pc = new PublicationCategory();

        if( $form ){
            $pc->Title = $form->Title;
            $pc->ParentId = $form->ParentId;
            $pc->StatusId = $form->StatusId;
            $pc->LanguageId = $form->LanguageId;

            if (!$pc->save()) {
                throw new \RuntimeException('Saving error.');
            }
        }
        return $pc;
    }


    /*
     * Edit
     */
    public function edit( int $Id, $form): PublicationCategory
    {
        $pc = $this->get($Id);


        if( $form ){
            $pc->Title = $form->Title;
            $pc->ParentId = $form->ParentId;
            $pc->StatusId = $form->StatusId;
            $pc->LanguageId = $form->LanguageId;

            if (!$pc->save()) {
                throw new \RuntimeException('Saving error.');
            }
        }
        return $pc;
    }



    /*
     * Delete
     */
    public function delete(PublicationCategory $publicationCategory): void
    {
        if (!$publicationCategory->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}