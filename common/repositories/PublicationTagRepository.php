<?php
namespace common\repositories;

use common\entities\Language;
use common\entities\PublicationTag;
use common\entities\Status;

class PublicationTagRepository
{
    /**
     * @param int $languageId
     * @param string $searchQuery
     *
     * @return int
     */
    public function count( int $languageId = Language::LANGUAGE_ENGLISH,
                           string $searchQuery = '' ): int{

        $query = PublicationTag::find()
            ->where([
                'StatusId' => Status::STATUS_PUBLISHED
            ]  );

        # GET TITLE
        $title = $this->getTagTitle( $languageId );

        # FILTER: Query
        $query->andWhere([
            'like',$title, $searchQuery
        ]);

        return $query->count();
    }


    /**
     * @param int $languageId
     * @param int $offset
     * @param int $limit
     * @param string $searchQuery
     *
     * @return array
     */
    public function getAll( int $languageId = 1,
                            int $offset,
                            int $limit = 5,
                            string $searchQuery = ''
                            ): array
    {

        $query = PublicationTag::find()
            ->where([
                'StatusId' => Status::STATUS_PUBLISHED
            ]  )
            ->offset($offset)
            ->limit($limit);

        # GET TITLE
        $title = $this->getTagTitle( $languageId );


        # FILTER: Query
        $query->andWhere([
            'like',$title, $searchQuery
        ]);


        ### ORDER BY
        $query->orderBy([ $title  => SORT_ASC]);


        return $query->all();
    }

    /**
     * GET TAG TITLE
     * @param int $languageId
     *
     * @return string
     */
    public function getTagTitle( $languageId = Language::LANGUAGE_ENGLISH ): string {
        $title = null;

        switch ($languageId){
            case Language::LANGUAGE_ENGLISH :
            default:
                $title = 'Title';
                break;
            case Language::LANGUAGE_TURKISH :
                $title = 'TitleTR';
                break;
            case Language::LANGUAGE_RUSSIAN :
                $title = 'TitleRU';
                break;

            case Language::LANGUAGE_KAZAKH :
                $title = 'TitleKZ';
                break;
        }

        return $title;
    }


    /**
     * @param int $Id
     *
     * @return PublicationTag | null
     */
    public function get($Id): PublicationTag {

        $one = PublicationTag::find()
            ->where([
                'Id' => $Id
            ])
            ->one();

        if(!$one){
            throw new \DomainException('Id not found!');
        }
        return $one;
    }


    /**
     * @param string $url
     *
     * @return PublicationTag
     */
    public function getByUrl(string $url = ''): PublicationTag {

        $one = PublicationTag::find()
            ->where([
                'Url' => $url
            ])
            ->one();

        if(!$one){
            throw new \DomainException('Id not found!');
        }
        return $one;
    }

}