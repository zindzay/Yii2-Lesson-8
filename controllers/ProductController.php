<?php
namespace app\controllers;

use yii\web\Controller;
use app\models\product\Product;
use app\models\product\ProductRecord;
use app\models\product\Provider;
use app\models\product\ProviderRecord;
use yii\data\ArrayDataProvider;
use yii\filters\AccessControl;

class ProductController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['add'],
                        'roles' => ['manager'],
                        'allow' => true
                    ],
                    [
                        'actions' => ['index', 'query'],
                        'roles' => ['user'],
                        'allow' => true
                    ]
                ]
            ]
        ];
    }

    public function actionIndex()
    {
        $records = $this->findRecordsByQuery();
        return $this->render('index', compact('records'));
    }

    public function actionAdd()
    {
        $product = new ProductRecord();
        $provider = new ProviderRecord();

        if ($this->load($product, $provider, $_POST)) {
            $this->store($this->makeProduct($product, $provider));
            return $this->redirect('/product');
        }

        return $this->render('add', compact('product', 'provider'));
    }

    public function actionQuery()
    {
        return $this->render('query');
    }

    private function findRecordsByQuery()
    {
        $name = \Yii::$app->request->get('provider_name');
        $records = $this->getRecordsByProviderName($name);
        $dataProvider = $this->wrapIntoDataProvider($records);
        return $dataProvider;
    }

    private function wrapIntoDataProvider($data)
    {
        return new ArrayDataProvider(
            [
                'allModels' => $data,
                'pagination' => false
            ]
        );
    }

    private function getRecordsByProviderName($name)
    {
        $provider_record = ProviderRecord::findOne(['name' => $name]);
        if (!$provider_record) {
            return [];
        }

        $product_record = ProductRecord::findOne($provider_record->id_product);
        if (!$product_record) {
            return [];
        }

        return [$this->makeProduct($product_record, $provider_record)];
    }

    private function load(ProductRecord $product, ProviderRecord $provider, array $post)
    {
        return $product->load($post)
            and $provider->load($post)
            and $product->validate()
            and $provider->validate(['name']);
    }

    private function store(Product $product)
    {
        $product_record = new ProductRecord();
        $product_record->name = $product->name;
        $product_record->price =$product->price;
        $product_record->description = $product->description;
        $product_record->save();

        foreach ($product->providers as $provider) {
            $provider_record = new ProviderRecord();
            $provider_record->name = $provider->name;
            $provider_record->id_product = $product_record->id;
            $provider_record->save();
        }
    }

    private function makeProduct(
        ProductRecord $product_record,
        ProviderRecord $provider_record
    ) {
        $name = $product_record->name;
        $price = $product_record->price;

        $product = new Product($name, $price);
        $product->description = $product_record->description;
        $product->providers[] = new Provider($provider_record->name);

        return $product;
    }
}
