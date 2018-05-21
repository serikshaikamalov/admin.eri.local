<?php
namespace api\controllers;

use common\repositories\SliderRepository;
use api\viewmodels\SliderVM;
use Yii;

class SlidersController extends ApiBaseController
{
    public $defaultAction = 'index';
    public $repo;
    public $limit;

    public function  __construct(string $id,
                                 $module,
                                 SliderRepository $repo,
                                 array $config = []
    )
    {
        parent::__construct($id, $module, $config);
        $this->repo = $repo;
        $this->limit = 10;
    }

    /**
     * @param int $limit
     * @return array
     */
    public function actionIndex( int $limit = 10 ): array
    {
        $result = array();

        // REPO
        $sliders = $this->repo->getAll($limit);

        if( count($sliders) > 0 ){
            foreach ($sliders as $slider){

                $sliderVM = new SliderVM();
                $sliderVM->Id = $slider->Id;
                $sliderVM->Title = $slider->Title;
                $sliderVM->Description = $slider->Description;
                $sliderVM->Url = $slider->Url;
                $sliderVM->IsActive = $slider->IsActive;

                // Dictionaries
                $sliderVM->ImageSrc = IMAGE_SERVER . '/media/images/' . Yii::$app->imagemanager->getImageByUrl($slider->ImageId, 400, 400,'inset');;
                $result[] = $sliderVM;
            }
        }

        return $result;
    }
}
