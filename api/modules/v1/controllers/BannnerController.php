<?php
namespace app\modules\v1\controllers;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BannnerController
 *
 * @author bhavan
 */
class BannnerController extends ApiController{
    
    public function actionListAll(){
        return $this->dataProvider(\common\models\Banners::getApiDataProvider());
    }
    
}
