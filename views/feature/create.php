<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\feature\FeatureRecord */

$this->title = 'Create Feature Record';
$this->params['breadcrumbs'][] = ['label' => 'Feature Records', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="feature-record-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
