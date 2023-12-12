<?php
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */


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
    <!-- <body class="hold-transition skin-st sidebar-mini"> -->
    <!-- <body class="hold-transition skin-blue sidebar-mini"> -->
    <!-- <body class="skin-blue sidebar-mini sidebar-collapse"> -->
    <body class="sidebar-mini skin-blue sidebar-mini">
    <!-- <body class="hold-transition skin-blue sidebar-mini sidebar-collapse"> -->
    <?php $this->beginBody() ?>

    <?php
    echo
        \ibrarturi\scrollup\ScrollUp::widget([
            'theme' => 'image',   // pill, link, image, tab
            'options' => [
                'scrollName'     => 'scrollUp',     // Element ID
                'scrollDistance' => 300,            // Distance from top/bottom before showing element (px)
                'scrollFrom'     => 'top',          // 'top' or 'bottom'
                'scrollSpeed'    => 300,            // Speed back to top (ms)
                'easingType'     => 'linear',       // Scroll to top easing (see http://easings.net/)
                'animation'      => 'fade',         // Fade, slide, none
                'animationSpeed' => 200,            // Animation speed (ms)
                'scrollTrigger'  => false,          // Set a custom triggering element. Can be an HTML string or jQuery object
                'scrollTarget'   => false,          // Set a custom target element for scrolling to. Can be element or number
                'scrollText'     => 'Scroll to top',// Text for element, can contain HTML
                'scrollTitle'    => false,          // Set a custom <a> title if required.
                'scrollImg'      => false,          // Set true to use image
                'activeOverlay'  => false,          // Set CSS color to display scrollUp active point, e.g '#00FFFF'
                'zIndex'         => 2147483647,     // Z-Index for the overlay
            ]
        ]);
    ?>

    
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