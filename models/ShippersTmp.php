<?php

namespace app\models;

use Yii;
use app\models\query\ShippersTmpQuery;

/**
 * This is the model class for table "shippers_tmp".
 *
 * @property integer $ShipperID
 * @property string $CompanyName
 * @property string $Phone
 */
class ShippersTmp extends \netis\crud\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'shippers_tmp';
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
                    'default'  => Yii::t('app', 'Shippers Tmp'),
                    'relation' => Yii::t('app', 'Shippers Tmps'),
                    'index'    => Yii::t('app', 'Browse Shippers Tmps'),
                    'create'   => Yii::t('app', 'Create Shippers Tmp'),
                    'read'     => Yii::t('app', 'View Shippers Tmp'),
                    'update'   => Yii::t('app', 'Update Shippers Tmp'),
                    'delete'   => Yii::t('app', 'Delete Shippers Tmp'),
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
     * @return ShippersTmpQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ShippersTmpQuery(get_called_class());
    }
}
