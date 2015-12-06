<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "customerdemographics".
 *
 * @property string $CustomerTypeID
 * @property string $CustomerDesc
 */
class Customerdemographic extends \netis\crud\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'customerdemographics';
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
                    'default'  => Yii::t('app', 'Customerdemographic'),
                    'relation' => Yii::t('app', 'Customerdemographics'),
                    'index'    => Yii::t('app', 'Browse Customerdemographics'),
                    'create'   => Yii::t('app', 'Create Customerdemographic'),
                    'read'     => Yii::t('app', 'View Customerdemographic'),
                    'update'   => Yii::t('app', 'Update Customerdemographic'),
                    'delete'   => Yii::t('app', 'Delete Customerdemographic'),
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
     * @return CustomerdemographicQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CustomerdemographicQuery(get_called_class());
    }
}
