<?php
/**
 * Created by PhpStorm.
 * User: Анастсия
 * Date: 19.05.2018
 * Time: 21:28
 */


namespace app\events;

use yii\base\Component;
use yii\base\Event;

class PostsEvents extends Event
{
    const VIEWS_EVENT = 'views_event';

    public static function addViewCount()
    {
        echo "<br><br><br><br><span class='alert alert-danger text-white'>ПРИБАВИЛИ СЧЕТЧИК из СТОРОНЕЙ СТАТИЧЕСКОЙ ФУНКЦИИ</span>";
    }
    public static function addViewCountDetailed()
    {
        echo "<br><br><br><br><span class='alert alert-danger text-white'>ПРИБАВИЛИ СЧЕТЧИК из СТОРОНЕЙ СТАТИЧЕСКОЙ ФУНКЦИИ</span>";
    }


}

