<?php

namespace app\models\query;

/**
 * This is the ActiveQuery class for [[\app\models\Region]].
 *
 * @see \app\models\Region
 */
class RegionQuery extends \netis\crud\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return \app\models\Region[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\models\Region|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}