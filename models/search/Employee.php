<?php

namespace app\models\search;

use netis\crud\db\ActiveSearchInterface;
use Yii;
use yii\base\Model;
use app\models\Employee as EmployeeModel;
use app\models\EmployeeQuery;

/**
 * Employee represents the model behind the search form about `\app\models\Employee`.
 */
class Employee extends EmployeeModel implements ActiveSearchInterface
{
    use \netis\crud\db\ActiveSearchTrait;

    /**
     * @inheritdoc
     */
    public function filteringRules()
    {
        return [
            [['EmployeeID', 'LastName', 'FirstName', 'Title', 'TitleOfCourtesy', 'BirthDate', 'HireDate', 'Address', 'City', 'Region', 'PostalCode', 'Country', 'HomePhone', 'Extension', 'Photo', 'Notes', 'ReportsTo', 'PhotoPath'], 'trim'],
            [['EmployeeID', 'LastName', 'FirstName', 'Title', 'TitleOfCourtesy', 'BirthDate', 'HireDate', 'Address', 'City', 'Region', 'PostalCode', 'Country', 'HomePhone', 'Extension', 'Photo', 'Notes', 'ReportsTo', 'PhotoPath'], 'default'],
            [['EmployeeID'], 'filter', 'filter' => '\netis\crud\crud\Action::explodeKeys'],
            [['BirthDate', 'HireDate'], 'filter', 'filter' => [Yii::$app->formatter, 'filterDate']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['BirthDate', 'HireDate'], 'date', 'format' => 'yyyy-MM-dd'],
            [['Photo', 'Notes'], 'safe'],
            [['ReportsTo'], 'integer', 'min' => -0x8000, 'max' => 0x7FFF],
            [['EmployeeID'], 'each', 'rule' => ['integer', 'min' => -0x8000, 'max' => 0x7FFF]],
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
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * @inheritdoc
     * @return EmployeeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new EmployeeQuery('app\models\Employee');
    }
}
