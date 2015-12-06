<?php

namespace app\models\query;

/**
 * This is the ActiveQuery class for [[\app\models\Customer]].
 *
 * @see \app\models\Customer
 */
class CustomerQuery extends \netis\crud\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return \app\models\Customer[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\models\Customer|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}