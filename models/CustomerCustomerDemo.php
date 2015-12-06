<?php

namespace app\models;

use Yii;
use app\models\query\CustomerCustomerDemoQuery;

/**
 * This is the model class for table "CustomerCustomerDemo".
 *
 * @property string $CustomerID
 * @property string $CustomerTypeID
 *
 * @property CustomerDemographic $customerType
 * @property Customer $customer
 */
class CustomerCustomerDemo extends \netis\crud\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'CustomerCustomerDemo';
    }

    /**
     * @inheritdoc
     */
    public function filteringRules()
    {
        return [
            [['CustomerID', 'CustomerTypeID'], 'trim'],
            [['CustomerID', 'CustomerTypeID'], 'default'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CustomerID', 'CustomerTypeID'], 'required'],
            [['CustomerTypeID'], 'exist', 'skipOnError' => true, 'targetClass' => CustomerDemographic::className(), 'targetAttribute' => ['CustomerTypeID' => 'CustomerTypeID']],
            [['CustomerID'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['CustomerID' => 'CustomerID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'CustomerID' => Yii::t('app', 'Customer ID'),
            'CustomerTypeID' => Yii::t('app', 'Customer Type ID'),
        ];
    }

    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
            'labels' => [
                'class' => 'netis\crud\db\LabelsBehavior',
                'attributes' => ['CustomerID'],
                'crudLabels' => [
                    'default'  => Yii::t('app', 'Customer Customer Demo'),
                    'relation' => Yii::t('app', 'Customer Customer Demos'),
                    'index'    => Yii::t('app', 'Browse Customer Customer Demos'),
                    'create'   => Yii::t('app', 'Create Customer Customer Demo'),
                    'read'     => Yii::t('app', 'View Customer Customer Demo'),
                    'update'   => Yii::t('app', 'Update Customer Customer Demo'),
                    'delete'   => Yii::t('app', 'Delete Customer Customer Demo'),
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
            'customerType',
            'customer',
        ];
    }

    /**
     * @return CustomerDemographicQuery
     */
    public function getCustomerType()
    {
        return $this->hasOne(CustomerDemographic::className(), ['CustomerTypeID' => 'CustomerTypeID'])->inverseOf('customerCustomerDemos');
    }

    /**
     * @return CustomerQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['CustomerID' => 'CustomerID'])->inverseOf('customerCustomerDemos');
    }

    /**
     * @inheritdoc
     * @return CustomerCustomerDemoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CustomerCustomerDemoQuery(get_called_class());
    }
}
