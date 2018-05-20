<?php

namespace app\models;

use app\components\TagsBehavior;
use app\components\TagsTrait;
use cebe\markdown\Markdown;
use Yii;

/**
 * This is the model class for table "posts".
 *
 * @property int $id
 * @property string $name
 * @property string $body
 * @property int $id_user
 */
class Posts extends \yii\db\ActiveRecord

{

    public $image;
    use TagsTrait;

    const DIV = ',';

    const IMAGE_PATH = 'uploads/post';
//
//    public function getFileUrl()
//    {
//        return Yii::$app-("@web/" . self::IMAGE_PATH) . "/" . $this->image;
//    }
//
//    public function getFilePath()
//    {
//        return getAlias("@webroot/" . self::IMAGE_PATH) . "/" . $this->image;
//    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $markdown = new Markdown();

            $this->body = $markdown->parse($this->body);
            return true;
        } else return false;
    }


    const EVENT_VIEW = 'detail_view';
    const EVENT_DETAIL_VIEW = 'views_count_detailed';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'posts';
    }

    public function init()
    {

        $this->on(self::EVENT_VIEW, [$this, 'addViewCount']);
        $this->on(self::EVENT_DETAIL_VIEW, [$this, 'addViewCountDetailed']);
        parent::init();
    }

    public function addViewCount()
    {
        $this->views_count++;
        $this->save();
    }

    public function addViewCountDetailed()
    {
        $this->views_count_detailed++;
        $this->save();
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['body'], 'string'],
            [['id_user'], 'required'],
            [['id_user'], 'integer'],
            [['name', 'tags_id'], 'string', 'max' => 256],
        ];
    }

    public function getAuthor()
    {
        return $this->hasOne(User::className(), ['id' => 'id_user']);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'body' => 'Body',
            'id_user' => 'Id User',
        ];
    }


    /**
     * @inheritdoc
     * @return PostsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PostsQuery(get_called_class());
    }
}
