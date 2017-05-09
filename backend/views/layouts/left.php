<style>
    .user-panel>.image>img {
        width: 100%;
        max-width: 45px;
        height: 45px;
    }
    .skin-blue.sidebar-mini.sidebar-collapse .user-panel>.image>img {
        width: 100%;
        max-width: 30px;
        height: 30px;
    }
</style>
<?php if(!Yii::$app->user->isGuest): ?>
<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= @Yii::$app->user->getIdentity()->profile->profilePicSrc; ?>" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p><?php echo ucfirst(@Yii::$app->user->identity->username); ?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <?php
            $menu = [['label' => 'Application Menu', 'options' => ['class' => 'header']]];
                    
                    /*[[
                        'label' => 'Same tools',
                        'icon' => 'fa fa-share',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Gii', 'icon' => 'fa fa-file-code-o', 'url' => ['/gii'],],
                            ['label' => 'Debug', 'icon' => 'fa fa-dashboard', 'url' => ['/debug'],],
                            [
                                'label' => 'Level One',
                                'icon' => 'fa fa-circle-o',
                                'url' => '#',
                                'items' => [
                                    ['label' => 'Level Two', 'icon' => 'fa fa-circle-o', 'url' => '#',],
                                    [
                                        'label' => 'Level Two',
                                        'icon' => 'fa fa-circle-o',
                                        'url' => '#',
                                        'items' => [
                                            ['label' => 'Level Three', 'icon' => 'fa fa-circle-o', 'url' => '#',],
                                            ['label' => 'Level Three', 'icon' => 'fa fa-circle-o', 'url' => '#',],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ];*/
            $roles=\Yii::$app->authManager->getRolesByUser(Yii::$app->user->id);
            foreach($roles as $key=>$role){
                if($key=="admin"){
                    //$menu[]=['label' => 'Gii', 'icon' => 'fa fa-file-code-o', 'url' => ['/gii']];
                    $menu[]=['label' => 'Subscription', 'icon' => 'fa fa-user-plus', 'url' => ['/membership-types']];
                    $menu[]=['label' => 'Users', 'icon' => 'fa fa-user', 'url' => ['/user/admin/index']];
                    //$menu[]=['label' => 'Debug', 'icon' => 'fa fa-dashboard', 'url' => ['/debug']];
                }
            }
            $menu[]=['label' => 'Judges', 'icon' => 'fa fa-user-circle', 'url' => ['/judges']];            
            //$menu[]=['label' => 'Executive Members', 'icon' => 'fa fa-user', 'url' => ['/members']];
            //$menu[]=['label' => 'Benches', 'icon' => 'fa fa-picture-o', 'url' => ['/benches']];
            $menu[]=['label' => 'Rosters', 'items' => [
                ['label' => 'Benches', 'icon' => 'fa fa-picture-o', 'url' => ['/benches']],
                ['label' => 'Create Roster', 'icon' => 'fa fa-picture-o', 'url' => ['/roster']],
            ]];
            
            $menu[]=['label' => 'Case Law', 'icon' => 'fa fa-legal', 'url' => ['/case-law']];
            $menu[]=['label' => 'Payment History', 'icon' => 'fa fa-money', 'url' => ['/payment-log']];
            $menu[]=['label' => 'Notification', 'icon' => 'fa fa-envelope', 'url' => ['/notification']];
            $menu[]=['label' => 'Banners', 'icon' => 'fa fa-picture-o', 'url' => ['/banners']];
            $menu[]=['label' => 'Holidays', 'icon' => 'fa fa-tree', 'url' => ['/holidays']];
            $menu[]=['label' => 'Settings', 'icon' => 'fa fa-cog', 'url' => ['/settings']];
            $menu[]=['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest];
            
        ?>
        
        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'items' => $menu,
            ]
        ) ?>

    </section>

</aside>
<?php endif; ?>