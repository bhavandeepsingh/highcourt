<?php

namespace api\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;

class PaymentController extends Controller
{
    public function actionIndex()
    {
    	require(__DIR__."/../../../NON_SEAMLESS_KIT/ccavRequestHandler.php");
    }
    
    public function actionSuccess()
    {
    	require(__DIR__."/../../../NON_SEAMLESS_KIT/ccavRequestHandler.php");
    }
    
    public function actionCancel()
    {
    	require(__DIR__."/../../../NON_SEAMLESS_KIT/ccavRequestHandler.php");
    }
    
    public function actionError()
    {
    	require(__DIR__."/../../../NON_SEAMLESS_KIT/ccavRequestHandler.php");
    }

}
