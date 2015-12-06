<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "products".
 *
 * @property integer $ProductID
 * @property string $ProductName
 * @property integer $SupplierID
 * @property integer $CategoryID
 * @property string $QuantityPerUnit
 * @property double $UnitPrice
 * @property integer $UnitsInStock
 * @property integer $UnitsOnOrder
 * @property integer $ReorderLevel
 * @property integer $Discontinued
 */
class Product extends \netis\crud\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'products';
    }

    /**
     * @inheritdoc
     */
    public function filteringRules()
    {
        return [
            [['ProductID', 'ProductName', 'SupplierID', 'CategoryID', 'QuantityPerUnit', 'UnitPrice', 'UnitsInStock', 'UnitsOnOrder', 'ReorderLevel', 'Discontinued'], 'trim'],
            [['ProductID', 'ProductName', 'SupplierID', 'CategoryID', 'QuantityPerUnit', 'UnitPrice', 'UnitsInStock', 'UnitsOnOrder', 'ReorderLevel', 'Discontinued'], 'default'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ProductID', 'ProductName', 'Discontinued'], 'required'],
            [['ProductID', 'SupplierID', 'CategoryID', 'UnitsInStock', 'UnitsOnOrder', 'ReorderLevel'], 'integer', 'min' => -0x8000, 'max' => 0x7FFF],
            [['ProductName'], 'string', 'max' => 40],
            [['QuantityPerUnit'], 'string', 'max' => 20],
            [['UnitPrice'], 'number'],
            [['Discontinued'], 'integer', 'min' => -0x80000000, 'max' => 0x7FFFFFFF],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ProductID' => Yii::t('app', 'Product ID'),
            'ProductName' => Yii::t('app', 'Product Name'),
            'SupplierID' => Yii::t('app', 'Supplier ID'),
            'CategoryID' => Yii::t('app', 'Category ID'),
            'QuantityPerUnit' => Yii::t('app', 'Quantity Per Unit'),
            'UnitPrice' => Yii::t('app', 'Unit Price'),
            'UnitsInStock' => Yii::t('app', 'Units In Stock'),
            'UnitsOnOrder' => Yii::t('app', 'Units On Order'),
            'ReorderLevel' => Yii::t('app', 'Reorder Level'),
            'Discontinued' => Yii::t('app', 'Discontinued'),
        ];
    }

    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
            'labels' => [
                'class' => 'netis\crud\db\LabelsBehavior',
                'attributes' => ['ProductName'],
                'crudLabels' => [
                    'default'  => Yii::t('app', 'Product'),
                    'relation' => Yii::t('app', 'Products'),
                    'index'    => Yii::t('app', 'Browse Products'),
                    'create'   => Yii::t('app', 'Create Product'),
                    'read'     => Yii::t('app', 'View Product'),
                    'update'   => Yii::t('app', 'Update Product'),
                    'delete'   => Yii::t('app', 'Delete Product'),
                ],
            ],
        ]);
    }

    /**
     * @inheritdoc
     */
    public static function relations()
    {
        return [
        ];
    }

    /**
     * @inheritdoc
     * @return ProductQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProductQuery(get_called_class());
    }
}
