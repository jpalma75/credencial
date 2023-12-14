<?php 
// use yii\helpers\Html;
// use yii\helpers\Url;
// use yii\db\Expression;
use webvimark\modules\UserManagement\UserManagementModule;
// use yii\widgets\ActiveForm;

?>

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
                'label'   => 'Registro de visitas',
                'icon'    => ' fa- fa-history',
                'l2'      => '',
                'c'       => '',
                // 'visible' => Yii::$app->user->identity->superadmin,
                'url'     => ['/user-visit-log'],
                // 'items'   => [
                    // ['label' => UserManagementModule::t('back', 'Visit log'), 'icon' => ' fa-history','l2' => '','c'=> '','url' => ['/user-management/user-visit-log/index']],
                // ],
            ],


            // ['label' => 'Ayuda', 'options' => ['class' => 'header'],'l2' => 'Ayuda','c'=> 'Ayuda'],
            // ['label' => 'Acerca de ', 'options' => ['class' => 'header'],'l2' => '','c'=> ''],
            [
                'label'   => 'Ayuda',
                'icon'    => ' fa-plus-square',
                'l2'      => '',
                'c'       => '',
                // 'visible' => Yii::$app->user->identity->superadmin,
                'url'     => '',
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


            // ['label' => 'Menu ', 'options' => ['class' => 'header'],'l2' => '','c'=> ''],
            // ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest,'l2' => '','c'=> ''],
            

            [
                'label'   => 'Administrador',
                'icon'    => ' fa-expeditedssl',
                'l2'      => '',
                'c'       => '',
                // 'visible' => Yii::$app->user->identity->superadmin,
                'url'     => '',
                'items'   => [
                    ['label' => UserManagementModule::t('back', 'Users'), 'icon' => ' fa-users','l2' => '','c'=> '', 'url' => ['/user-management/user/index']],
                    ['label' => UserManagementModule::t('back', 'Roles'), 'icon' => ' fa-user-secret','l2' => '','c'=> '','url' => ['/user-management/role/index']],
                    ['label' => UserManagementModule::t('back', 'Permissions'), 'icon' => ' fa-flag','l2' => '','c'=> '', 'url' => ['/user-management/permission/index']],
                    ['label' => UserManagementModule::t('back', 'Permission groups'), 'icon' => ' fa-flag-o','l2' => '','c'=> '','url' => ['/user-management/auth-item-group/index']],
                    ['label' => UserManagementModule::t('back', 'Visit log'), 'icon' => ' fa-history','l2' => '','c'=> '','url' => ['/user-management/user-visit-log/index']],
                ],
            ],

            [
                'label' => 'Algunas herramientas',
                'icon' => 'share',
                'url' => '#',
                'l2'      => '',
                'c'       => '',
                'items' => [
                    ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii'],'l2' => '','c'=> ''],
                    ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug'],'l2' => '','c'=> ''],                    
                ],
            ],

            


        ],
    ]
) ?>