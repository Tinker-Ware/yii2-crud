<?php

namespace app\models;

use Yii;
use app\models\query\SupplierQuery;

/**
 * This is the model class for table "suppliers".
 *
 * @property integer $SupplierID
 * @property string $CompanyName
 * @property string $ContactName
 * @property string $ContactTitle
 * @property string $Address
 * @property string $City
 * @property string $Region
 * @property string $PostalCode
 * @property string $Country
 * @property string $Phone
 * @property string $Fax
 * @property string $HomePage
 *
 * @property Product[] $products
 */
class Supplier extends \netis\crud\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'suppliers';
    }

    /**
     * @inheritdoc
     */
    public function filteringRules()
    {
        return [
            [['SupplierID', 'CompanyName', 'ContactName', 'ContactTitle', 'Address', 'City', 'Region', 'PostalCode', 'Country', 'Phone', 'Fax', 'HomePage'], 'trim'],
            [['SupplierID', 'CompanyName', 'ContactName', 'ContactTitle', 'Address', 'City', 'Region', 'PostalCode', 'Country', 'Phone', 'Fax', 'HomePage'], 'default'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['SupplierID', 'CompanyName'], 'required'],
            [['HomePage'], 'safe'],
            [['SupplierID'], 'integer', 'min' => -0x8000, 'max' => 0x7FFF],
            [['CompanyName'], 'string', 'max' => 40],
            [['ContactName', 'ContactTitle'], 'string', 'max' => 30],
            [['Address'], 'string', 'max' => 60],
            [['City', 'Region', 'Country'], 'string', 'max' => 15],
            [['PostalCode'], 'string', 'max' => 10],
            [['Phone', 'Fax'], 'string', 'max' => 24],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'SupplierID' => Yii::t('app', 'Supplier ID'),
            'CompanyName' => Yii::t('app', 'Company Name'),
            'ContactName' => Yii::t('app', 'Contact Name'),
            'ContactTitle' => Yii::t('app', 'Contact Title'),
            'Address' => Yii::t('app', 'Address'),
            'City' => Yii::t('app', 'City'),
            'Region' => Yii::t('app', 'Region'),
            'PostalCode' => Yii::t('app', 'Postal Code'),
            'Country' => Yii::t('app', 'Country'),
            'Phone' => Yii::t('app', 'Phone'),
            'Fax' => Yii::t('app', 'Fax'),
            'HomePage' => Yii::t('app', 'Home Page'),
        ];
    }

    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
            'labels' => [
                'class' => 'netis\crud\db\LabelsBehavior',
                'attributes' => ['CompanyName'],
                'crudLabels' => [
                    'default'  => Yii::t('app', 'Supplier'),
                    'relation' => Yii::t('app', 'Suppliers'),
                    'index'    => Yii::t('app', 'Browse Suppliers'),
                    'create'   => Yii::t('app', 'Create Supplier'),
                    'read'     => Yii::t('app', 'View Supplier'),
                    'update'   => Yii::t('app', 'Update Supplier'),
                    'delete'   => Yii::t('app', 'Delete Supplier'),
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
            'products',
        ];
    }

    /**
     * @return ProductQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['SupplierID' => 'SupplierID'])->inverseOf('supplier');
    }

    /**
     * @inheritdoc
     * @return SupplierQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SupplierQuery(get_called_class());
    }
}
