<?php
namespace common\repositories;
use common\entities\Slider;

class SliderRepository
{
    /**
     * @param int $limit
     * @return array
     */
    public function getAll(int $limit = 10): array
    {
        $query = Slider::find()
            ->orderBy(['Id' => SORT_DESC])
            ->limit($limit);

        return $query->all();
    }
}