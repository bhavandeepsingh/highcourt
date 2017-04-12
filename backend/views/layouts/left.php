<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p><?php echo ucfirst(Yii::$app->user->identity->username); ?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->
        
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
                    $menu[]=['label' => 'Gii', 'icon' => 'fa fa-file-code-o', 'url' => ['/gii']];
                    $menu[]=['label' => 'Memberships', 'icon' => 'fa fa-user-plus', 'url' => ['/membership-types']];
                    $menu[]=['label' => 'Users', 'icon' => 'fa fa-user', 'url' => ['/rbac']];
                    //$menu[]=['label' => 'Debug', 'icon' => 'fa fa-dashboard', 'url' => ['/debug']];
                }
            }
            $menu[]=['label' => 'Judges & Executives', 'icon' => 'fa fa-user', 'url' => ['/members']];
            $menu[]=['label' => 'Banners', 'icon' => 'fa fa-picture-o', 'url' => ['/banners']];
            $menu[]=['label' => 'Holidays', 'icon' => 'fa fa-tree', 'url' => ['/holidays']];
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
