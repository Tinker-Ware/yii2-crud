<?php

namespace app\models;

use Yii;
use app\models\query\OrderQuery;

/**
 * This is the model class for table "Orders".
 *
 * @property integer $OrderID
 * @property string $CustomerID
 * @property integer $EmployeeID
 * @property string $OrderDate
 * @property string $RequiredDate
 * @property string $ShippedDate
 * @property integer $ShipVia
 * @property double $Freight
 * @property string $ShipName
 * @property string $ShipAddress
 * @property string $ShipCity
 * @property string $ShipRegion
 * @property string $ShipPostalCode
 * @property string $ShipCountry
 *
 * @property OrderDetail[] $orderDetails
 * @property Product[] $products
 * @property Customer $customer
 * @property Employee $employee
 * @property Shipper $shipVia
 */
class Order extends \netis\crud\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Orders';
    }

    /**
     * @inheritdoc
     */
    public function filteringRules()
    {
        return [
            [['OrderID', 'CustomerID', 'EmployeeID', 'OrderDate', 'RequiredDate', 'ShippedDate', 'ShipVia', 'Freight', 'ShipName', 'ShipAddress', 'ShipCity', 'ShipRegion', 'ShipPostalCode', 'ShipCountry'], 'trim'],
            [['OrderID', 'CustomerID', 'EmployeeID', 'OrderDate', 'RequiredDate', 'ShippedDate', 'ShipVia', 'Freight', 'ShipName', 'ShipAddress', 'ShipCity', 'ShipRegion', 'ShipPostalCode', 'ShipCountry'], 'default'],
            [['OrderDate', 'RequiredDate', 'ShippedDate'], 'filter', 'filter' => [Yii::$app->formatter, 'filterDate']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['OrderID'], 'required'],
            [['OrderDate', 'RequiredDate', 'ShippedDate'], 'date', 'format' => 'yyyy-MM-dd'],
            [['CustomerID'], 'safe'],
            [['OrderID', 'EmployeeID', 'ShipVia'], 'integer', 'min' => -0x8000, 'max' => 0x7FFF],
            [['Freight'], 'number'],
            [['ShipName'], 'string', 'max' => 40],
            [['ShipAddress'], 'string', 'max' => 60],
            [['ShipCity', 'ShipRegion', 'ShipCountry'], 'string', 'max' => 15],
            [['ShipPostalCode'], 'string', 'max' => 10],
            [['CustomerID'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['CustomerID' => 'CustomerID']],
            [['EmployeeID'], 'exist', 'skipOnError' => true, 'targetClass' => Employee::className(), 'targetAttribute' => ['EmployeeID' => 'EmployeeID']],
            [['ShipVia'], 'exist', 'skipOnError' => true, 'targetClass' => Shipper::className(), 'targetAttribute' => ['ShipVia' => 'ShipperID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'OrderID' => Yii::t('app', 'Order ID'),
            'CustomerID' => Yii::t('app', 'Customer ID'),
            'EmployeeID' => Yii::t('app', 'Employee ID'),
            'OrderDate' => Yii::t('app', 'Order Date'),
            'RequiredDate' => Yii::t('app', 'Required Date'),
            'ShippedDate' => Yii::t('app', 'Shipped Date'),
            'ShipVia' => Yii::t('app', 'Ship Via'),
            'Freight' => Yii::t('app', 'Freight'),
            'ShipName' => Yii::t('app', 'Ship Name'),
            'ShipAddress' => Yii::t('app', 'Ship Address'),
            'ShipCity' => Yii::t('app', 'Ship City'),
            'ShipRegion' => Yii::t('app', 'Ship Region'),
            'ShipPostalCode' => Yii::t('app', 'Ship Postal Code'),
            'ShipCountry' => Yii::t('app', 'Ship Country'),
        ];
    }

    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
            'labels' => [
                'class' => 'netis\crud\db\LabelsBehavior',
                'attributes' => ['CustomerID'],
                'crudLabels' => [
                    'default'  => Yii::t('app', 'Order'),
                    'relation' => Yii::t('app', 'Orders'),
                    'index'    => Yii::t('app', 'Browse Orders'),
                    'create'   => Yii::t('app', 'Create Order'),
                    'read'     => Yii::t('app', 'View Order'),
                    'update'   => Yii::t('app', 'Update Order'),
                    'delete'   => Yii::t('app', 'Delete Order'),
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
            'orderDetails',
            'products',
            'customer',
            'employee',
            'shipVia',
        ];
    }

    /**
     * @return OrderDetailQuery
     */
    public function getOrderDetails()
    {
        return $this->hasMany(OrderDetail::className(), ['OrderID' => 'OrderID'])->inverseOf('order');
    }

    /**
     * @return ProductQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['ProductID' => 'ProductID'])->viaTable('Order Details', ['OrderID' => 'OrderID']);
    }

    /**
     * @return CustomerQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['CustomerID' => 'CustomerID'])->inverseOf('orders');
    }

    /**
     * @return EmployeeQuery
     */
    public function getEmployee()
    {
        return $this->hasOne(Employee::className(), ['EmployeeID' => 'EmployeeID'])->inverseOf('orders');
    }

    /**
     * @return ShipperQuery
     */
    public function getShipVia()
    {
        return $this->hasOne(Shipper::className(), ['ShipperID' => 'ShipVia'])->inverseOf('orders');
    }

    /**
     * @inheritdoc
     * @return OrderQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new OrderQuery(get_called_class());
    }
}
