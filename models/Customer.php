<?php

namespace app\models;

use Yii;
use app\models\query\CustomerQuery;

/**
 * This is the model class for table "Customers".
 *
 * @property string $CustomerID
 * @property string $CompanyName
 * @property string $ContactName
 * @property string $ContactTitle
 * @property string $Address
 * @property string $City
 * @property string $Region
 * @property string $PostalCode
 * @property string $Country
 * @property string $Phone
 * @property string $Fax
 *
 * @property CustomerCustomerDemo[] $customerCustomerDemos
 * @property CustomerDemographic[] $customerTypes
 * @property Order[] $orders
 */
class Customer extends \netis\crud\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Customers';
    }

    /**
     * @inheritdoc
     */
    public function filteringRules()
    {
        return [
            [['CustomerID', 'CompanyName', 'ContactName', 'ContactTitle', 'Address', 'City', 'Region', 'PostalCode', 'Country', 'Phone', 'Fax'], 'trim'],
            [['CustomerID', 'CompanyName', 'ContactName', 'ContactTitle', 'Address', 'City', 'Region', 'PostalCode', 'Country', 'Phone', 'Fax'], 'default'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CustomerID', 'CompanyName'], 'required'],
            [['CompanyName'], 'string', 'max' => 40],
            [['ContactName', 'ContactTitle'], 'string', 'max' => 30],
            [['Address'], 'string', 'max' => 60],
            [['City', 'Region', 'Country'], 'string', 'max' => 15],
            [['PostalCode'], 'string', 'max' => 10],
            [['Phone', 'Fax'], 'string', 'max' => 24],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'CustomerID' => Yii::t('app', 'Customer ID'),
            'CompanyName' => Yii::t('app', 'Company Name'),
            'ContactName' => Yii::t('app', 'Contact Name'),
            'ContactTitle' => Yii::t('app', 'Contact Title'),
            'Address' => Yii::t('app', 'Address'),
            'City' => Yii::t('app', 'City'),
            'Region' => Yii::t('app', 'Region'),
            'PostalCode' => Yii::t('app', 'Postal Code'),
            'Country' => Yii::t('app', 'Country'),
            'Phone' => Yii::t('app', 'Phone'),
            'Fax' => Yii::t('app', 'Fax'),
        ];
    }

    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
            'labels' => [
                'class' => 'netis\crud\db\LabelsBehavior',
                'attributes' => ['CustomerID'],
                'crudLabels' => [
                    'default'  => Yii::t('app', 'Customer'),
                    'relation' => Yii::t('app', 'Customers'),
                    'index'    => Yii::t('app', 'Browse Customers'),
                    'create'   => Yii::t('app', 'Create Customer'),
                    'read'     => Yii::t('app', 'View Customer'),
                    'update'   => Yii::t('app', 'Update Customer'),
                    'delete'   => Yii::t('app', 'Delete Customer'),
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
            'customerCustomerDemos',
            'customerTypes',
            'orders',
        ];
    }

    /**
     * @return CustomerCustomerDemoQuery
     */
    public function getCustomerCustomerDemos()
    {
        return $this->hasMany(CustomerCustomerDemo::className(), ['CustomerID' => 'CustomerID'])->inverseOf('customer');
    }

    /**
     * @return CustomerDemographicQuery
     */
    public function getCustomerTypes()
    {
        return $this->hasMany(CustomerDemographic::className(), ['CustomerTypeID' => 'CustomerTypeID'])->viaTable('CustomerCustomerDemo', ['CustomerID' => 'CustomerID']);
    }

    /**
     * @return OrderQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::className(), ['CustomerID' => 'CustomerID'])->inverseOf('customer');
    }

    /**
     * @inheritdoc
     * @return CustomerQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CustomerQuery(get_called_class());
    }
}
