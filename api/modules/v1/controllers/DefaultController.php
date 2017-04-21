<?php

namespace app\modules\v1\controllers;

use yii\web\Controller;

/**
 * Default controller for the `v1` module
 */
class DefaultController extends ApiController
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return ["success" => true];
        //return $this->render('index');
    }
}
