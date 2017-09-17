<?php
use app\models\product\ProductRecord;
use app\models\product\ProviderRecord;
use yii\web\View;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * Add Product UI.
 * @var View $this
 * @var ProductRecord $product
 * @var ProviderRecord $provider
 */

$form =ActiveForm::begin([
    'id' => 'add-product-form',
]);

echo $form->errorSummary([$product, $provider]);
echo $form->field($product, 'name');
echo $form->field($product, 'price');
echo $form->field($product, 'description');

echo $form->field($provider, 'name');

echo Html::submitButton('Сохранить', ['class' => 'btn btn-primary']);

ActiveForm::end();
