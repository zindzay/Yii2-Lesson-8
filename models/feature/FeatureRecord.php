<?php

namespace app\models\feature;

use Yii;
use app\models\product\ProductRecord;

/**
 * This is the model class for table "feature".
 *
 * @property integer $id
 * @property integer $id_product
 * @property string $name
 * @property string $value
 *
 * @property ProductRecord $idProduct
 */
class FeatureRecord extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'feature';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_product'], 'integer'],
            [['name', 'value'], 'string', 'max' => 255],
            [['id_product'], 'exist', 'skipOnError' => true,
                'targetClass' => ProductRecord::className(),
                'targetAttribute' => ['id_product' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_product' => 'Id Product',
            'name' => 'Name',
            'value' => 'Value',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdProduct()
    {
        return $this->hasOne(ProductRecord::className(), ['id' => 'id_product']);
    }
}
