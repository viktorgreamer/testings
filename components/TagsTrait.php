<?php
/**
 * Created by PhpStorm.
 * User: Анастсия
 * Date: 19.05.2018
 * Time: 23:12
 */

namespace app\components;


use yii\base\Behavior;
use Yii;


trait TagsTrait
{


    //  public $tags_id;


    public function setTags($insert)
    {
        if ($insert) $this->tags_id = "," . implode(self::DIV, $insert) . ",";
    }

    public function getTags()
    {
        return explode(self::DIV, trim($this->tags_id, self::DIV));

    }

    public function addTag($insert)
    {
        $this->tags_id .= $insert . self::DIV;
    }

    public function removeTag($tag)
    {
        $this->tags_id = preg_replace("/" . self::DIV . $tag . self::DIV . "/", self::DIV, $this->tags_id);
    }

    public function searchTag($tag)
    {
        if (preg_match("/" . self::DIV . $tag . self::DIV . "/",$this->tags_id))
        return true;

        else return false;
    }

    public function renderTags()
    {
        $tags = $this->tags;

        if ($tags) {
            $body = "";
            foreach ($tags as $tag) {
                $body .= $this->renderTag($tag);
            }

        } else {
            $body = 'tags no';

        }
        return $body;


    }

    public function renderTag($tag)
    {
        return "<span class=\"badge\" style='background-color: #953b39;'>" . $tag . "</span>";
    }


}