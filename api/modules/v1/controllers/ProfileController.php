<?php
namespace app\modules\v1\controllers;

use Yii;
use common\models\ProfileSearch;
use common\models\UploadForm;
class ProfileController extends ApiController{
    
    public function actionList(){
      
        return $this->dataProvider(ProfileSearch::getApiList(Yii::$app->request->post(), null, true));
    }


    public function actionUpdate($id)
    { 
        $model = \common\models\Profile::find()->andWhere(['user_id'=>$id])->one();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //echo $model->executive;die;
           UploadForm::uploadUserProfilePic($model->user_id);
            
            
            return $this->redirect(['view', 'user_id' => $model->user_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
        
    }
}
