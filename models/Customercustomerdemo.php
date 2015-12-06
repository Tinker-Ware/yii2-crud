<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "customercustomerdemo".
 *
 * @property string $CustomerID
 * @property string $CustomerTypeID
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
        ];
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
