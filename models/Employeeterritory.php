<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "employeeterritories".
 *
 * @property integer $EmployeeID
 * @property string $TerritoryID
 */
class Employeeterritory extends \netis\crud\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'employeeterritories';
    }

    /**
     * @inheritdoc
     */
    public function filteringRules()
    {
        return [
            [['EmployeeID', 'TerritoryID'], 'trim'],
            [['EmployeeID', 'TerritoryID'], 'default'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['EmployeeID', 'TerritoryID'], 'required'],
            [['EmployeeID'], 'integer', 'min' => -0x8000, 'max' => 0x7FFF],
            [['TerritoryID'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'EmployeeID' => Yii::t('app', 'Employee ID'),
            'TerritoryID' => Yii::t('app', 'Territory ID'),
        ];
    }

    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
            'labels' => [
                'class' => 'netis\crud\db\LabelsBehavior',
                'attributes' => ['TerritoryID'],
                'crudLabels' => [
                    'default'  => Yii::t('app', 'Employeeterritory'),
                    'relation' => Yii::t('app', 'Employeeterritories'),
                    'index'    => Yii::t('app', 'Browse Employeeterritories'),
                    'create'   => Yii::t('app', 'Create Employeeterritory'),
                    'read'     => Yii::t('app', 'View Employeeterritory'),
                    'update'   => Yii::t('app', 'Update Employeeterritory'),
                    'delete'   => Yii::t('app', 'Delete Employeeterritory'),
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
     * @return EmployeeterritoryQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new EmployeeterritoryQuery(get_called_class());
    }
}
