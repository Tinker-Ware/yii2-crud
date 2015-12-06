<?php

namespace app\models;

use Yii;
use app\models\query\CustomerDemographicQuery;

/**
 * This is the model class for table "CustomerDemographics".
 *
 * @property string $CustomerTypeID
 * @property string $CustomerDesc
 *
 * @property CustomerCustomerDemo[] $customerCustomerDemos
 * @property Customer[] $customers
 */
class CustomerDemographic extends \netis\crud\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'CustomerDemographics';
    }

    /**
     * @inheritdoc
     */
    public function filteringRules()
    {
        return [
            [['CustomerTypeID', 'CustomerDesc'], 'trim'],
            [['CustomerTypeID', 'CustomerDesc'], 'default'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CustomerTypeID'], 'required'],
            [['CustomerDesc'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'CustomerTypeID' => Yii::t('app', 'Customer Type ID'),
            'CustomerDesc' => Yii::t('app', 'Customer Desc'),
        ];
    }

    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
            'labels' => [
                'class' => 'netis\crud\db\LabelsBehavior',
                'attributes' => ['CustomerTypeID'],
                'crudLabels' => [
                    'default'  => Yii::t('app', 'Customer Demographic'),
                    'relation' => Yii::t('app', 'Customer Demographics'),
                    'index'    => Yii::t('app', 'Browse Customer Demographics'),
                    'create'   => Yii::t('app', 'Create Customer Demographic'),
                    'read'     => Yii::t('app', 'View Customer Demographic'),
                    'update'   => Yii::t('app', 'Update Customer Demographic'),
                    'delete'   => Yii::t('app', 'Delete Customer Demographic'),
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
            'customers',
        ];
    }

    /**
     * @return CustomerCustomerDemoQuery
     */
    public function getCustomerCustomerDemos()
    {
        return $this->hasMany(CustomerCustomerDemo::className(), ['CustomerTypeID' => 'CustomerTypeID'])->inverseOf('customerType');
    }

    /**
     * @return CustomerQuery
     */
    public function getCustomers()
    {
        return $this->hasMany(Customer::className(), ['CustomerID' => 'CustomerID'])->viaTable('CustomerCustomerDemo', ['CustomerTypeID' => 'CustomerTypeID']);
    }

    /**
     * @inheritdoc
     * @return CustomerDemographicQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CustomerDemographicQuery(get_called_class());
    }
}
