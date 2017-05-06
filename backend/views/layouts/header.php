    <?php
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */
?>

<header class="main-header">
<?php if(!Yii::$app->user->isGuest): ?>
    <?= Html::a('<span class="logo-mini">HBA</span><span class="logo-lg">' . Yii::$app->name . '</span>', Yii::$app->homeUrl, ['class' => 'logo']) ?>
    
    <nav class="navbar navbar-static-top" role="navigation">

        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">
                 
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="<?= @Yii::$app->user->getIdentity()->profile->profilePicSrc; ?>" class="user-image" alt="User Image"/>
                        <span class="hidden-xs"><?php echo ucfirst(@Yii::$app->user->identity->username); ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="<?= @Yii::$app->user->getIdentity()->profile->profilePicSrc; ?>" class="img-circle"
                                 alt="User Image"/>

                            <p>
                               <?php echo ucfirst(@Yii::$app->user->identity->username); ?>
                                <small>Member since <?php echo date("F j, Y",@Yii::$app->user->identity->created_at); ?></small>
                            </p>
                        </li>
                        <!-- Menu Body -->
                        <!-- <li class="user-body">
                            <div class="col-xs-4 text-center">
                                <a href="#">Followers</a>
                            </div>
                            <div class="col-xs-4 text-center">
                                <a href="#">Sales</a>
                            </div>
                            <div class="col-xs-4 text-center">
                                <a href="#">Friends</a>
                            </div>
                        </li> -->
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="<?php echo yii\helpers\Url::to(["/user/admin/update-profile", 'id'=> Yii::$app->user->id]); ?>" class="btn btn-default btn-flat">Profile</a>
                            </div>
                            <div class="pull-right">
                                <?= Html::a(
                                    'Sign out',
                                    ['/site/logout'],
                                    ['data-method' => 'post', 'class' => 'btn btn-default btn-flat']
                                ) ?>
                            </div>
                        </li>
                    </ul>
                </li>
                <?php /* ?>
                <!-- User Account: style can be found in dropdown.less -->
                <li>
                    <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                </li>
                <?php */ ?>
            </ul>
        </div>
    </nav>
    <?php endif; ?>
</header>
