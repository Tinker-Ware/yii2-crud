<?php

namespace app\models;

use Yii;
use app\models\query\RegionQuery;

/**
 * This is the model class for table "Regions".
 *
 * @property integer $RegionID
 * @property string $RegionDescription
 *
 * @property Territory[] $territories
 */
class Region extends \netis\crud\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Regions';
    }

    /**
     * @inheritdoc
     */
    public function filteringRules()
    {
        return [
            [['RegionID', 'RegionDescription'], 'trim'],
            [['RegionID', 'RegionDescription'], 'default'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['RegionID', 'RegionDescription'], 'required'],
            [['RegionID'], 'integer', 'min' => -0x8000, 'max' => 0x7FFF],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'RegionID' => Yii::t('app', 'Region ID'),
            'RegionDescription' => Yii::t('app', 'Region Description'),
        ];
    }

    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
            'labels' => [
                'class' => 'netis\crud\db\LabelsBehavior',
                'attributes' => ['RegionDescription'],
                'crudLabels' => [
                    'default'  => Yii::t('app', 'Region'),
                    'relation' => Yii::t('app', 'Regions'),
                    'index'    => Yii::t('app', 'Browse Regions'),
                    'create'   => Yii::t('app', 'Create Region'),
                    'read'     => Yii::t('app', 'View Region'),
                    'update'   => Yii::t('app', 'Update Region'),
                    'delete'   => Yii::t('app', 'Delete Region'),
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
            'territories',
        ];
    }

    /**
     * @return TerritoryQuery
     */
    public function getTerritories()
    {
        return $this->hasMany(Territory::className(), ['RegionID' => 'RegionID'])->inverseOf('region');
    }

    /**
     * @inheritdoc
     * @return RegionQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RegionQuery(get_called_class());
    }
}
