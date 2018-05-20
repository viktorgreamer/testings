<?php

namespace app\modules\webdriver\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "accounts".
 *
 * @property int $id
 * @property int $id_source
 * @property string $login
 * @property string $password
 */
class Accounts extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'accounts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_source'], 'integer'],
            [['login', 'password'], 'string', 'max' => 256],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_source' => 'Id Source',
            'login' => 'Login',
            'password' => 'Password',
        ];
    }

    /**
     * @inheritdoc
     * @return AccountsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AccountsQuery(get_called_class());
    }

    public static function getAccounts($id_source = null) {
        return ArrayHelper::map(self::find()->filterwhere(['id_source' => $id_source])->all(), 'id', 'login');
    }

    public function getSource() {
        return $this->hasOne(Sources::className(), ['id' => 'id_source']);
    }

}
