<?php

namespace app\modules\webdriver\models;

/**
 * This is the ActiveQuery class for [[Kolmovo]].
 *
 * @see Kolmovo
 */
class KolmovoQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Kolmovo[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Kolmovo|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
