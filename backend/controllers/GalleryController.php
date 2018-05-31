<?php
namespace backend\controllers;
use common\entities\ImageToGallery;
use common\entities\Language;
use common\entities\Status;
use common\formmodels\ImageFormModel;
use Yii;
use common\entities\Gallery;
use common\entities\GallerySearch;
use common\viewmodels\GalleryFormModel;
use yii\base\Model;

class GalleryController extends AdminBaseController
{
    /**
     * Gallery: List
     */
    public function actionIndex()
    {
        $searchModel = new GallerySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    
    /**
     * Gallery: Create
     */
    public function actionCreate()
    {
        $vm = new GalleryFormModel();
        $vm->model = new Gallery();
        $vm->imageFormModel = new ImageFormModel();

        ### Defaults
        $vm->model->StatusId = 1;
        $vm->model->LanguageId = Yii::$app->language;
        $vm->model->CreatedDate = date('Y-m-d');
        $vm->model->CreatedUserId = Yii::$app->user->Id;

        # DICTIONARIES
        $vm->statuses = Status::getStatusList();
        $vm->languages = Language::getLanguageList();

        ### POST
        $req = Yii::$app->request->post();

        if ( $vm->model->load($req) && $vm->imageFormModel->load($req)) {

            # Save gallery
            $vm->model->save();

            # Save images
            for( $i=0; $i < 20; $i++ ){
                if( $vm->imageFormModel->{'image'.($i+1)} != ""){
                    $imageToGallery = new ImageToGallery();
                    $imageToGallery->GalleryId = $vm->model->Id;
                    $imageToGallery->ImageId = $vm->imageFormModel->{'image'.($i+1)};
                    $imageToGallery->save();
                }
            }
            Yii::$app->session->setFlash('success', "'".$vm->model->Title."' successfully saved!");
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'vm' => $vm,
        ]);
    }

    /**
     * Gallery: Update
     */
    public function actionUpdate($id)
    {
        $vm = new GalleryFormModel();
        $vm->model = $this->findModel($id);
        $vm->imageFormModel = new ImageFormModel();

        # Defaults
        $vm->model->LastEditedDate = date('Y-m-d');

        # DICTIONARIES
        $vm->statuses = Status::getStatusList();
        $vm->languages = Language::getLanguageList();

        ### View
        $images = ImageToGallery::findAll(['GalleryId' => $vm->model->Id]);

        for( $i=0; $i < 20; $i++ ){
            // Access to object property dynamically
            if( $images[$i] ){
                $vm->imageFormModel->{'image'.($i+1)} = $images[$i]->ImageId;
            }else{
                $vm->imageFormModel->{'image'.($i+1)} = '';
            }
        }


        ### Post
        if ($vm->model->load(Yii::$app->request->post()) && $vm->model->save()) {
            /**
             * 1. Delete all images from gallery
             * 2. Insert new images into gallery
             */

            # Delete
            ImageToGallery::deleteAll(['GalleryId'=> $vm->model->Id]);

            # Insert
            if( $vm->imageFormModel->load(Yii::$app->request->post()) ){

                for( $i=0; $i < 20; $i++ ){
                    if( $vm->imageFormModel->{'image'.($i+1)} != ""){
                        $imageToGallery = new ImageToGallery();
                        $imageToGallery->GalleryId = $vm->model->Id;
                        $imageToGallery->ImageId = $vm->imageFormModel->{'image'.($i+1)};
                        $imageToGallery->save();
                    }
                }
            }

            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'vm' => $vm,
        ]);
    }

    /**
     * Gallery: Delete
     */
    public function actionDelete($id)
    {
        # Delete images of gallery
        ImageToGallery::deleteAll(['GalleryId'=>$id]);

        # Delete Gallery
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Gallery: FindOne
     */
    protected function findModel($id)
    {
        if (($model = Gallery::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
