<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\UserVisitLog */
?>
<div class="user-visit-log-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'token',
            'ip',
            'language',
            'user_agent',
            'user_id',
            'visit_time:datetime',
            'browser',
            'os',
        ],
    ]) ?>

</div>
