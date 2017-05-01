<?php
namespace app\modules\v1\controllers;

use Yii;
use common\models\ProfileSearch;
use common\models\UploadForm;
class ProfileController extends ApiController{
    
    public function actionList(){
      
        return $this->dataProvider(ProfileSearch::getApiList(Yii::$app->request->post(), null, true));
    }


    public function actionUpdate()
    { 
        if($this->loginId() <= 0) return $this->errorLoginRequierd();

        $model = \common\models\Profile::find()->andWhere(['user_id' => $this->login_user->id])->one();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
           UploadForm::uploadUserProfilePic($model->user_id);                                       
           return $this->success(['user' => $model->getProfileDataApi()]);
        } else {
            return $this->eror(['message' => $model->getFirstError()]);
        }
        
    }
}
