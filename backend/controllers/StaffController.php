<?php
namespace backend\controllers;

use Yii;
use common\entities\Staff;
use common\entities\StaffSearch;
use common\entities\Language;
use common\entities\StaffPosition;
use common\entities\StaffType;
use common\entities\Status;
use common\viewmodels\StaffFormViewModel;
use common\viewmodels\StaffViewModel;
use yii\web\NotFoundHttpException;

class StaffController extends AdminBaseController
{
    /**
     * Staff: List
     */
    public function actionIndex()
    {
        $searchModel = new StaffSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Staff: View
     */
    public function actionView($id)
    {
        $model = Staff::getStaff( $id );

        // viewModel
        $vm = new StaffViewModel();
        $vm->Id = $model->Id;
        $vm->FullName = $model->FullName;

        $vm->StaffPositionId = $model->StaffPositionId;
        $vm->ResearchGroupId = $model->ResearchGroupId;
        $vm->StaffTypeId = $model->StaffTypeId;
        $vm->ShortBiography = $model->ShortBiography;
        $vm->ImageId = $model->ImageId;
        $vm->LanguageId = $model->LanguageId;

        // Relations
        $vm->StaffPosition = $model->staffPosition;
        $vm->Status = $model->status;
        //$vm->ResearchGroup = $model->researchGroup;
        $vm->StaffType = $model->staffType;
        $vm->Language = $model->language;
        $vm->Image = Yii::$app->imagemanager->getImagePath($model->ImageId, 400, 400,'inset');

        return $this->render('view', [
            'vm' => $vm
        ]);
    }

    /**
     * Staff: Create
     */
    public function actionCreate()
    {
        $vm = new StaffFormViewModel();
        $vm->model = new Staff();

        $vm->statuses = Status::getStatusList();
        $vm->staffTypes = StaffType::getStaffTypeList();
        $vm->languages = Language::getLanguageList();
        $vm->staffPositions = StaffPosition::getStaffPositionList();



        if ($vm->model->load(Yii::$app->request->post())) {

            if( $vm->model->validate() ){
                $vm->model->save();

                return $this->redirect(['view', 'id' => $vm->model->Id]);
            }
        } else {
            return $this->render('create', [
                'vm' => $vm,
            ]);
        }
    }

    /**
     * Staff: Update
     */
    public function actionUpdate($id)
    {
        $vm = new StaffFormViewModel();
        $vm->model = $this->findModel($id);
        $vm->languages = Language::getLanguageList();
        $vm->statuses = Status::getStatusList();
        $vm->staffTypes = StaffType::getStaffTypeList();
        $vm->staffPositions = StaffPosition::getStaffPositionList();



        if ($vm->model->load(Yii::$app->request->post()) && $vm->model->save()) {
            return $this->redirect(['view', 'id' => $vm->model->Id]);
        } else {
            return $this->render('update', [
                'vm' => $vm,
            ]);
        }
    }

    /**
     * Staff: Delete
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Staff: Find one
     */
    protected function findModel($id)
    {
        if (($model = Staff::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
