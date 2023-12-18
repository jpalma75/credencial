<?php
use yii\helpers\Html;
use yii\helpers\Url;
use webvimark\modules\UserManagement\UserManagementModule;

/* @var $this \yii\web\View */
/* @var $content string */
?>

<header class="main-header">

    <?= Html::a('<span class="logo-mini">'.Yii::$app->params['SistemaSiglas'].'</span><span class="logo-lg"><small>' . Yii::$app->params['SistemaSiglas'] . '</small></span>', Yii::$app->homeUrl, ['class' => 'logo']) ?>

    <nav class="navbar navbar-static-top" role="navigation">

        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">

                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <!-- <img src="< ?= Url::home(true)?>/img/perfil/foto.jpg" class="user-image" alt="User Image"/> -->
                        <img src="<?= Url::home(true)?>/img/perfil/foto.jpg ?>" class="user-image" alt="User Image"/>
                        
                        <span class="hidden-xs"><?= Yii::$app->user->identity->username ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="<?= Url::home(true)?>/img/perfil/foto.jpg ?>" class="img-circle"
                                 alt="User Image"/>

                            <p>
                                <?= Yii::$app->user->identity->username ?>
                            </p>
                        </li>
                        
                        <!-- Menu Footer-->
                        <li class="user-footer">
                        
                            <div class="">
                                <?=
                                    Html::a(
                                        'Cerrar Sesión',
                                        ['/site/logout'],
                                        // ['data-method' => 'post', 'class' => 'btn btn-default btn-flat']
                                        ['data-method' => 'post', 'class' => 'btn btn-danger btn-flat btn-block bg-red']
                                    )
                                ?>
                            </div>
                                
                        </li>
                    </ul>
                </li>

                <!-- User Account: style can be found in dropdown.less -->
                <!-- <li>
                    <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                </li> -->

            </ul>
        </div>
    </nav>
</header>
