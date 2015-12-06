<?php

namespace app\models;

use Yii;
use app\models\query\ShipperQuery;

/**
 * This is the model class for table "Shippers".
 *
 * @property integer $ShipperID
 * @property string $CompanyName
 * @property string $Phone
 *
 * @property Order[] $orders
 */
class Shipper extends \netis\crud\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Shippers';
    }

    /**
     * @inheritdoc
     */
    public function filteringRules()
    {
        return [
            [['ShipperID', 'CompanyName', 'Phone'], 'trim'],
            [['ShipperID', 'CompanyName', 'Phone'], 'default'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ShipperID', 'CompanyName'], 'required'],
            [['ShipperID'], 'integer', 'min' => -0x8000, 'max' => 0x7FFF],
            [['CompanyName'], 'string', 'max' => 40],
            [['Phone'], 'string', 'max' => 24],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ShipperID' => Yii::t('app', 'Shipper ID'),
            'CompanyName' => Yii::t('app', 'Company Name'),
            'Phone' => Yii::t('app', 'Phone'),
        ];
    }

    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
            'labels' => [
                'class' => 'netis\crud\db\LabelsBehavior',
                'attributes' => ['CompanyName'],
                'crudLabels' => [
                    'default'  => Yii::t('app', 'Shipper'),
                    'relation' => Yii::t('app', 'Shippers'),
                    'index'    => Yii::t('app', 'Browse Shippers'),
                    'create'   => Yii::t('app', 'Create Shipper'),
                    'read'     => Yii::t('app', 'View Shipper'),
                    'update'   => Yii::t('app', 'Update Shipper'),
                    'delete'   => Yii::t('app', 'Delete Shipper'),
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
            'orders',
        ];
    }

    /**
     * @return OrderQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::className(), ['ShipVia' => 'ShipperID'])->inverseOf('shipVia');
    }

    /**
     * @inheritdoc
     * @return ShipperQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ShipperQuery(get_called_class());
    }
}
