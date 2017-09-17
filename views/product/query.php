<?php
use yii\helpers\Html;

echo Html::beginForm(['/product'], 'get');
echo Html::label('Поставщик:', 'provider_name');
echo Html::textInput('provider_name');
echo Html::submitButton('Найти');
echo Html::endForm();
