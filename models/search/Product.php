<?php

namespace app\models\search;

use netis\crud\db\ActiveSearchInterface;
use Yii;
use yii\base\Model;
use app\models\Product as ProductModel;
use app\models\ProductQuery;

/**
 * Product represents the model behind the search form about `\app\models\Product`.
 */
class Product extends ProductModel implements ActiveSearchInterface
{
    use \netis\crud\db\ActiveSearchTrait;

    /**
     * @inheritdoc
     */
    public function filteringRules()
    {
        return [
            [['ProductID', 'ProductName', 'SupplierID', 'CategoryID', 'QuantityPerUnit', 'UnitPrice', 'UnitsInStock', 'UnitsOnOrder', 'ReorderLevel', 'Discontinued'], 'trim'],
            [['ProductID', 'ProductName', 'SupplierID', 'CategoryID', 'QuantityPerUnit', 'UnitPrice', 'UnitsInStock', 'UnitsOnOrder', 'ReorderLevel', 'Discontinued'], 'default'],
            [['ProductID'], 'filter', 'filter' => '\netis\crud\crud\Action::explodeKeys'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['SupplierID', 'CategoryID', 'UnitsInStock', 'UnitsOnOrder', 'ReorderLevel'], 'integer', 'min' => -0x8000, 'max' => 0x7FFF],
            [['ProductID'], 'each', 'rule' => ['integer', 'min' => -0x8000, 'max' => 0x7FFF]],
            [['ProductName'], 'string', 'max' => 40],
            [['QuantityPerUnit'], 'string', 'max' => 20],
            [['UnitPrice'], 'number'],
            [['Discontinued'], 'integer', 'min' => -0x80000000, 'max' => 0x7FFFFFFF],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * @inheritdoc
     * @return ProductQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProductQuery('app\models\Product');
    }
}
