<?php

namespace app\models\search;

use netis\crud\db\ActiveSearchInterface;
use Yii;
use yii\base\Model;
use app\models\Order as OrderModel;
use app\models\query\OrderQuery;

/**
 * Order represents the model behind the search form about `\app\models\Order`.
 */
class Order extends OrderModel implements ActiveSearchInterface
{
    use \netis\crud\db\ActiveSearchTrait;

    /**
     * @inheritdoc
     */
    public function filteringRules()
    {
        return [
            [['OrderID', 'CustomerID', 'EmployeeID', 'OrderDate', 'RequiredDate', 'ShippedDate', 'ShipVia', 'Freight', 'ShipName', 'ShipAddress', 'ShipCity', 'ShipRegion', 'ShipPostalCode', 'ShipCountry'], 'trim'],
            [['OrderID', 'CustomerID', 'EmployeeID', 'OrderDate', 'RequiredDate', 'ShippedDate', 'ShipVia', 'Freight', 'ShipName', 'ShipAddress', 'ShipCity', 'ShipRegion', 'ShipPostalCode', 'ShipCountry'], 'default'],
            [['OrderID', 'CustomerID', 'EmployeeID', 'ShipVia'], 'filter', 'filter' => '\netis\crud\crud\Action::explodeKeys'],
            [['OrderDate', 'RequiredDate', 'ShippedDate'], 'filter', 'filter' => [Yii::$app->formatter, 'filterDate']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['OrderDate', 'RequiredDate', 'ShippedDate'], 'date', 'format' => 'yyyy-MM-dd'],
            [['CustomerID'], 'safe'],
            [['OrderID', 'EmployeeID', 'ShipVia'], 'each', 'rule' => ['integer', 'min' => -0x8000, 'max' => 0x7FFF]],
            [['Freight'], 'number'],
            [['ShipName'], 'string', 'max' => 40],
            [['ShipAddress'], 'string', 'max' => 60],
            [['ShipCity', 'ShipRegion', 'ShipCountry'], 'string', 'max' => 15],
            [['ShipPostalCode'], 'string', 'max' => 10],
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
     * @return OrderQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new OrderQuery('app\models\Order');
    }
}
