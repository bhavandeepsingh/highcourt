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
        return $this->success([
            'list' => \common\models\Banners::getBannerDataApi(),
            'banner_timing' => \common\models\Settings::getSetting('scroll_time')
        ]);
    }
    
}
