<?php 
use yii\helpers\Html;
use yii\helpers\Url;
use yii\db\Expression;
use webvimark\modules\UserManagement\UserManagementModule;
use yii\widgets\ActiveForm;

?>
<aside class="main-sidebar">

    <section class="sidebar">

            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="<?= Url::home(true)?>/img/perfil/foto.jpg" class="img-circle" alt="User Image"/>
                </div>
                <div class="pull-left info">
                    <p><?= Yii::$app->user->identity->username; ?></p>

                    <!-- <a href="#"><i class="fa fa-circle text-success"></i> Online</a> -->
                    <a href="#">
                        <small>
                            <i class="fa fa-circle text-success"></i> En linea
                        </small>
                    </a>
                </div> 
            </div>


<?= dmstr\widgets\Menu::widget(
    [
        'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
        'items' => [


            [
                'label'   => 'Inicio',
                'icon'    => ' fa-home',
                'l2'      => '',
                'c'       => '',
                // 'visible' => Yii::$app->user->identity->superadmin,
                'url'     => Yii::$app->homeUrl,
                // 'items'   => [
                    // ['label' => UserManagementModule::t('back', 'Visit log'), 'icon' => ' fa-history','l2' => '','c'=> '','url' => ['/user-management/user-visit-log/index']],
                // ],
            ],
            [
                'label'   => 'Encargados',
                'icon'    => ' fa-home',
                'l2'      => '',
                'c'       => '',
                // 'visible' => Yii::$app->user->identity->superadmin,
                'url'     => Yii::$app->homeUrl . 'encargados',
                // 'items'   => [
                    // ['label' => UserManagementModule::t('back', 'Visit log'), 'icon' => ' fa-history','l2' => '','c'=> '','url' => ['/user-management/user-visit-log/index']],
                // ],
            ],
            [
                'label'   => 'Departamentos',
                'icon'    => ' fa-home',
                'l2'      => '',
                'c'       => '',
                // 'visible' => Yii::$app->user->identity->superadmin,
                'url'     => Yii::$app->homeUrl . 'departamentos',
                // 'items'   => [
                    // ['label' => UserManagementModule::t('back', 'Visit log'), 'icon' => ' fa-history','l2' => '','c'=> '','url' => ['/user-management/user-visit-log/index']],
                // ],
            ],
            [
                'label'   => 'Empleados',
                'icon'    => ' fa-home',
                'l2'      => '',
                'c'       => '',
                // 'visible' => Yii::$app->user->identity->superadmin,
                'url'     => Yii::$app->homeUrl . 'empleados',
                // 'items'   => [
                    // ['label' => UserManagementModule::t('back', 'Visit log'), 'icon' => ' fa-history','l2' => '','c'=> '','url' => ['/user-management/user-visit-log/index']],
                // ],
            ],

            [
                'label'   => 'Acerca de',
                'icon'    => ' fa-info-circle',
                'l2'      => '',
                'c'       => '',
                // 'visible' => Yii::$app->user->identity->superadmin,
                'url'     => '',
                // 'items'   => [
                    // ['label' => UserManagementModule::t('back', 'Visit log'), 'icon' => ' fa-history','l2' => '','c'=> '','url' => ['/user-management/user-visit-log/index']],
                // ],
            ],

        ],
    ]
) ?>


    </section>

</aside>