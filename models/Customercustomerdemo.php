<?php

namespace app\models;

use Yii;
use app\models\query\CustomercustomerdemoQuery;

/**
 * This is the model class for table "customercustomerdemo".
 *
 * @property string $CustomerID
 * @property string $CustomerTypeID
 *
 * @property Customerdemographic $customerType
 * @property Customer $customer
 */
class Customercustomerdemo extends \netis\crud\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'customercustomerdemo';
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
            [['CustomerTypeID'], 'exist', 'skipOnError' => true, 'targetClass' => Customerdemographic::className(), 'targetAttribute' => ['CustomerTypeID' => 'CustomerTypeID']],
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
                    'default'  => Yii::t('app', 'Customercustomerdemo'),
                    'relation' => Yii::t('app', 'Customercustomerdemos'),
                    'index'    => Yii::t('app', 'Browse Customercustomerdemos'),
                    'create'   => Yii::t('app', 'Create Customercustomerdemo'),
                    'read'     => Yii::t('app', 'View Customercustomerdemo'),
                    'update'   => Yii::t('app', 'Update Customercustomerdemo'),
                    'delete'   => Yii::t('app', 'Delete Customercustomerdemo'),
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
     * @return CustomerdemographicQuery
     */
    public function getCustomerType()
    {
        return $this->hasOne(Customerdemographic::className(), ['CustomerTypeID' => 'CustomerTypeID'])->inverseOf('customercustomerdemos');
    }

    /**
     * @return CustomerQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['CustomerID' => 'CustomerID'])->inverseOf('customercustomerdemos');
    }

    /**
     * @inheritdoc
     * @return CustomercustomerdemoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CustomercustomerdemoQuery(get_called_class());
    }
}
