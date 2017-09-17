<?php
echo \yii\widgets\DetailView::widget(
    [
        'model' => $model,
        'attributes' => [
            ['attribute' => 'name'],
            ['attribute' => 'price'],
            'description:text',
            ['label' => 'Поставщик', 'attribute' => 'providers.0.name']
        ]
    ]
);
