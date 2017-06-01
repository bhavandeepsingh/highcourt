<?php
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */

$userroles=Yii::$app->authManager->getRolesByUser(Yii::$app->user->id);
$flag=true;
foreach ($userroles as $key => $role){
    if($key=="admin" || $key=="author"){
        $flag=false;
    }
}/*
if(!Yii::$app->user->isGuest && $flag==true){
    echo "<html><body><p style='text-align:center;'>You are not authorized to view this page</p>";
    echo "</body></html>";
    exit;
}*/
//echo urldecode(Yii::$app->request->url);die;
//echo preg_match("/(user\/registration\/resend|user\/registration\/register)/", urldecode(Yii::$app->request->url));
if(Yii::$app->user->isGuest && !preg_match("/user\/security\/login/", urldecode(Yii::$app->request->url))){
    Yii::$app->getResponse()->redirect(Yii::$app->urlManager->createUrl('/user/security/login'));
}

if (Yii::$app->controller->action->id === 'login') { 
/**
 * Do not use this code in your template. Remove it. 
 * Instead, use the code  $this->layout = '//main-login'; in your controller.
 */
    echo $this->render(
        'main-login',
        ['content' => $content]
    );
} else {

    if (class_exists('backend\assets\AppAsset')) {
        backend\assets\AppAsset::register($this);
    } else {
        app\assets\AppAsset::register($this);
    }

    dmstr\web\AdminLteAsset::register($this);

    $directoryAsset = Yii::$app->assetManager->getPublishedUrl('@vendor/almasaeed2010/adminlte/dist');
    $this->registerJsFile('https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=pd5o516w1etfa6ix6afk0kurj1kuahvwfbwsd276lbqw6zu7', [yii\web\JqueryAsset::className()]);
    //$this->registerJs("tinymce.init({ selector:'textarea' });");
    ?>
    <?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body class="hold-transition skin-yellow sidebar-mini">
    <?php $this->beginBody() ?>
    <div class="wrapper">

        <?= $this->render(
            'header.php',
            ['directoryAsset' => $directoryAsset]
        ) ?>

        <?= $this->render(
            'left.php',
            ['directoryAsset' => $directoryAsset]
        )
        ?>

        <?= $this->render(
            'content.php',
            ['content' => $content, 'directoryAsset' => $directoryAsset]
        ) ?>

    </div>

    <?php $this->endBody() ?>
    </body>
    </html>
    <?php $this->endPage() ?>
<?php } ?>
