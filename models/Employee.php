<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "employees".
 *
 * @property integer $EmployeeID
 * @property string $LastName
 * @property string $FirstName
 * @property string $Title
 * @property string $TitleOfCourtesy
 * @property string $BirthDate
 * @property string $HireDate
 * @property string $Address
 * @property string $City
 * @property string $Region
 * @property string $PostalCode
 * @property string $Country
 * @property string $HomePhone
 * @property string $Extension
 * @property resource $Photo
 * @property string $Notes
 * @property integer $ReportsTo
 * @property string $PhotoPath
 */
class Employee extends \netis\crud\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'employees';
    }

    /**
     * @inheritdoc
     */
    public function filteringRules()
    {
        return [
            [['EmployeeID', 'LastName', 'FirstName', 'Title', 'TitleOfCourtesy', 'BirthDate', 'HireDate', 'Address', 'City', 'Region', 'PostalCode', 'Country', 'HomePhone', 'Extension', 'Photo', 'Notes', 'ReportsTo', 'PhotoPath'], 'trim'],
            [['EmployeeID', 'LastName', 'FirstName', 'Title', 'TitleOfCourtesy', 'BirthDate', 'HireDate', 'Address', 'City', 'Region', 'PostalCode', 'Country', 'HomePhone', 'Extension', 'Photo', 'Notes', 'ReportsTo', 'PhotoPath'], 'default'],
            [['BirthDate', 'HireDate'], 'filter', 'filter' => [Yii::$app->formatter, 'filterDate']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['EmployeeID', 'LastName', 'FirstName'], 'required'],
            [['BirthDate', 'HireDate'], 'date', 'format' => 'yyyy-MM-dd'],
            [['Photo', 'Notes'], 'safe'],
            [['EmployeeID', 'ReportsTo'], 'integer', 'min' => -0x8000, 'max' => 0x7FFF],
            [['LastName'], 'string', 'max' => 20],
            [['FirstName', 'PostalCode'], 'string', 'max' => 10],
            [['Title'], 'string', 'max' => 30],
            [['TitleOfCourtesy'], 'string', 'max' => 25],
            [['Address'], 'string', 'max' => 60],
            [['City', 'Region', 'Country'], 'string', 'max' => 15],
            [['HomePhone'], 'string', 'max' => 24],
            [['Extension'], 'string', 'max' => 4],
            [['PhotoPath'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'EmployeeID' => Yii::t('app', 'Employee ID'),
            'LastName' => Yii::t('app', 'Last Name'),
            'FirstName' => Yii::t('app', 'First Name'),
            'Title' => Yii::t('app', 'Title'),
            'TitleOfCourtesy' => Yii::t('app', 'Title Of Courtesy'),
            'BirthDate' => Yii::t('app', 'Birth Date'),
            'HireDate' => Yii::t('app', 'Hire Date'),
            'Address' => Yii::t('app', 'Address'),
            'City' => Yii::t('app', 'City'),
            'Region' => Yii::t('app', 'Region'),
            'PostalCode' => Yii::t('app', 'Postal Code'),
            'Country' => Yii::t('app', 'Country'),
            'HomePhone' => Yii::t('app', 'Home Phone'),
            'Extension' => Yii::t('app', 'Extension'),
            'Photo' => Yii::t('app', 'Photo'),
            'Notes' => Yii::t('app', 'Notes'),
            'ReportsTo' => Yii::t('app', 'Reports To'),
            'PhotoPath' => Yii::t('app', 'Photo Path'),
        ];
    }

    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
            'labels' => [
                'class' => 'netis\crud\db\LabelsBehavior',
                'attributes' => ['Title'],
                'crudLabels' => [
                    'default'  => Yii::t('app', 'Employee'),
                    'relation' => Yii::t('app', 'Employees'),
                    'index'    => Yii::t('app', 'Browse Employees'),
                    'create'   => Yii::t('app', 'Create Employee'),
                    'read'     => Yii::t('app', 'View Employee'),
                    'update'   => Yii::t('app', 'Update Employee'),
                    'delete'   => Yii::t('app', 'Delete Employee'),
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
     * @return EmployeeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new EmployeeQuery(get_called_class());
    }
}
