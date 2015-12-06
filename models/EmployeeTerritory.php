<?php

namespace app\models;

use Yii;
use app\models\query\EmployeeTerritoryQuery;

/**
 * This is the model class for table "EmployeeTerritories".
 *
 * @property integer $EmployeeID
 * @property string $TerritoryID
 *
 * @property Employee $employee
 * @property Territory $territory
 */
class EmployeeTerritory extends \netis\crud\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'EmployeeTerritories';
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
            [['EmployeeID'], 'exist', 'skipOnError' => true, 'targetClass' => Employee::className(), 'targetAttribute' => ['EmployeeID' => 'EmployeeID']],
            [['TerritoryID'], 'exist', 'skipOnError' => true, 'targetClass' => Territory::className(), 'targetAttribute' => ['TerritoryID' => 'TerritoryID']],
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
                    'default'  => Yii::t('app', 'Employee Territory'),
                    'relation' => Yii::t('app', 'Employee Territories'),
                    'index'    => Yii::t('app', 'Browse Employee Territories'),
                    'create'   => Yii::t('app', 'Create Employee Territory'),
                    'read'     => Yii::t('app', 'View Employee Territory'),
                    'update'   => Yii::t('app', 'Update Employee Territory'),
                    'delete'   => Yii::t('app', 'Delete Employee Territory'),
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
            'employee',
            'territory',
        ];
    }

    /**
     * @return EmployeeQuery
     */
    public function getEmployee()
    {
        return $this->hasOne(Employee::className(), ['EmployeeID' => 'EmployeeID'])->inverseOf('employeeTerritories');
    }

    /**
     * @return TerritoryQuery
     */
    public function getTerritory()
    {
        return $this->hasOne(Territory::className(), ['TerritoryID' => 'TerritoryID'])->inverseOf('employeeTerritories');
    }

    /**
     * @inheritdoc
     * @return EmployeeTerritoryQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new EmployeeTerritoryQuery(get_called_class());
    }
}
