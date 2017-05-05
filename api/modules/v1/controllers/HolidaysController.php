<?php
namespace app\modules\v1\controllers;

use Yii;
use common\models\ProfileSearch;
use common\models\UploadForm;
use common\models\HolidaysSearch;
class HolidaysController extends ApiController{
    
    public function actionList(){
        return $this->dataProvider(HolidaysSearch::getApiList(Yii::$app->request->post(), null, true));
    }
    public function actionUpdate($id){
        $model = \common\models\Holidays::findOne($id);
      if($model->load(Yii::$app->request->post()) && $model->save()){
          return $this->success(['message'=>'seccess']);
      }else{
          return $this->error(['message' => $model->getError()]);
      }
    }
}
