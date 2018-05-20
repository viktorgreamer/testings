<?php

namespace app\modules\webdriver\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "sources".
 *
 * @property int $id id
 * @property string $name название
 */
class Sources extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sources';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 256],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'id',
            'name' => 'название',
        ];
    }

    /**
     * @inheritdoc
     * @return SourcesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SourcesQuery(get_called_class());
    }

    public static function getSources() {
        return ArrayHelper::map(self::find()->all(), 'id', 'name');
    }
}
