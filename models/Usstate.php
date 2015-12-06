<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "usstates".
 *
 * @property integer $StateID
 * @property string $StateName
 * @property string $StateAbbr
 * @property string $StateRegion
 */
class Usstate extends \netis\crud\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'usstates';
    }

    /**
     * @inheritdoc
     */
    public function filteringRules()
    {
        return [
            [['StateID', 'StateName', 'StateAbbr', 'StateRegion'], 'trim'],
            [['StateID', 'StateName', 'StateAbbr', 'StateRegion'], 'default'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['StateID'], 'required'],
            [['StateID'], 'integer', 'min' => -0x8000, 'max' => 0x7FFF],
            [['StateName'], 'string', 'max' => 100],
            [['StateAbbr'], 'string', 'max' => 2],
            [['StateRegion'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'StateID' => Yii::t('app', 'State ID'),
            'StateName' => Yii::t('app', 'State Name'),
            'StateAbbr' => Yii::t('app', 'State Abbr'),
            'StateRegion' => Yii::t('app', 'State Region'),
        ];
    }

    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
            'labels' => [
                'class' => 'netis\crud\db\LabelsBehavior',
                'attributes' => ['StateName'],
                'crudLabels' => [
                    'default'  => Yii::t('app', 'Usstate'),
                    'relation' => Yii::t('app', 'Usstates'),
                    'index'    => Yii::t('app', 'Browse Usstates'),
                    'create'   => Yii::t('app', 'Create Usstate'),
                    'read'     => Yii::t('app', 'View Usstate'),
                    'update'   => Yii::t('app', 'Update Usstate'),
                    'delete'   => Yii::t('app', 'Delete Usstate'),
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
     * @return UsstateQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UsstateQuery(get_called_class());
    }
}
