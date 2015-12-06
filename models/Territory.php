<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "territories".
 *
 * @property string $TerritoryID
 * @property string $TerritoryDescription
 * @property integer $RegionID
 */
class Territory extends \netis\crud\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'territories';
    }

    /**
     * @inheritdoc
     */
    public function filteringRules()
    {
        return [
            [['TerritoryID', 'TerritoryDescription', 'RegionID'], 'trim'],
            [['TerritoryID', 'TerritoryDescription', 'RegionID'], 'default'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['TerritoryID', 'TerritoryDescription', 'RegionID'], 'required'],
            [['TerritoryID'], 'string', 'max' => 20],
            [['RegionID'], 'integer', 'min' => -0x8000, 'max' => 0x7FFF],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'TerritoryID' => Yii::t('app', 'Territory ID'),
            'TerritoryDescription' => Yii::t('app', 'Territory Description'),
            'RegionID' => Yii::t('app', 'Region ID'),
        ];
    }

    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
            'labels' => [
                'class' => 'netis\crud\db\LabelsBehavior',
                'attributes' => ['TerritoryID'],
                'crudLabels' => [
                    'default'  => Yii::t('app', 'Territory'),
                    'relation' => Yii::t('app', 'Territories'),
                    'index'    => Yii::t('app', 'Browse Territories'),
                    'create'   => Yii::t('app', 'Create Territory'),
                    'read'     => Yii::t('app', 'View Territory'),
                    'update'   => Yii::t('app', 'Update Territory'),
                    'delete'   => Yii::t('app', 'Delete Territory'),
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
     * @return TerritoryQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TerritoryQuery(get_called_class());
    }
}
