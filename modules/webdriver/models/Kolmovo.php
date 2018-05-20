<?php

namespace app\modules\webdriver\models;

use Yii;

/**
 * This is the model class for table "kolmovo".
 *
 * @property int $id
 * @property string $name
 * @property string $login
 * @property string $password
 */
class Kolmovo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'kolmovo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'login', 'password'], 'required'],
            [['name', 'login', 'password'], 'string', 'max' => 256],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'login' => 'Login',
            'password' => 'Password',
        ];
    }

    /**
     * @inheritdoc
     * @return KolmovoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new KolmovoQuery(get_called_class());
    }
}
