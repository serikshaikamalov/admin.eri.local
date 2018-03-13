<?php
namespace common\repositories;
use common\entities\PublicationCategory;
use common\forms\PublicationCategoryForm;

class PublicationCategoryRepository
{
    /**
     * @param int $id - Publication's Category Id
     * @return PublicationCategory
     */
    public function get($id): PublicationCategory
    {
        if (!$pc = PublicationCategory::findOne($id)) {
            throw new \DomainException('Tag is not found.');
        }
        return $pc;
    }


    /**
     * @param int $languageId
     * @param int $publicationTypeId - Тип категории
     * @return array ActiveRecord[]
     */
    public function getAll( int $languageId, int $publicationTypeId ): array {
        if( !$languageId ){
            throw new \DomainException('Tag is not found.');
        }

        $all = PublicationCategory::find()
            ->where([
                'LanguageId' => $languageId,
                'ParentId' => 0,
                'PublicationTypeId' => $publicationTypeId
            ])
            ->all();

        return $all;
    }


    /**
     * @param int $ParentId
     * @return array
     */
    public function getChildren( int $ParentId ): array
    {
        $all = PublicationCategory::find()
            ->where(['ParentId' => $ParentId])
            ->all();
        return $all;
    }


    /**
     * @param PublicationCategoryForm $form
     * @return PublicationCategory
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


    /**
     * @param int $Id
     * @param $form
     * @return PublicationCategory
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


    /**
     * @param PublicationCategory $publicationCategory
     * @throws \Exception
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function delete(PublicationCategory $publicationCategory): void
    {
        if (!$publicationCategory->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}