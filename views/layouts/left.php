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



        <!-- search form -->
       <!--  <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form> -->
        <!-- /.search form -->
        
        <?php 
            include 'left_superadmin.php';
        ?>

        <?php
        
            // echo dmstr\widgets\Menu2::widget(
            //     [
            //         'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
            //         'items' => [

            //             ['label'=>'Inicio',    'icon'=>' fa-home',        'l2'=>'', 'c'=>'', 'url'=> Yii::$app->homeUrl,],
            //             // ['label'=>'Ayuda',     'icon'=>' fa-plus-square', 'l2'=>'', 'c'=>'', 'url'=> Yii::$app->homeUrl,],
            //             // ['label'=>'Acerca de', 'icon'=>' fa-info-circle', 'l2'=>'', 'c'=>'', 'url'=> Yii::$app->homeUrl,],
                        
            //             // ['label' => 'Menu ', 'options' => ['class' => 'header'],'l2' => '','c'=> ''],
            //             // ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest,'l2' => '','c'=> ''],
                       
            //         ],
            //     ]
            // );
        ?>


    </section>

</aside>
