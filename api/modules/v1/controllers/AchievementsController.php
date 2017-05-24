<?php

namespace app\modules\v1\controllers;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AchievementsController
 *
 * @author bhavan
 */
class AchievementsController extends ApiController{
    
    public function actionList(){
        return $this->success(['achievement' => \common\models\AchievementsSearch::getApiAchievement()]);
    }
    
}
