<?php

use app\models\Posts;

$post = new Posts();
$post->tags = [34,88758,3253,87867];

echo "<br> RAW_TAGS = ".$post->tags_id;
echo "<br>".$post->renderTags();


$tag = 3253;
echo "<br> REMOVING TAG = ".$tag;
$post->removeTag($tag);
echo "<br> RAW_TAGS = ".$post->tags_id;
echo "<br>".$post->renderTags();

$tag = 36;
echo "<br> ADDING TAG = ".$post->renderTag($tag);
$post->addTag($tag);
echo "<br> RAW_TAGS = ".$post->tags_id;
echo "<br>".$post->renderTags();

$tag = 78;
echo "<br> SEARHING FOR TAG = ".$post->renderTag($tag);
if ($post->searchTag($tag)) echo "<br> ДАННЫЙ TAG СУЩЕСТВУЕТ";
else echo "<br> ДАННЫЙ TAG НЕ СУЩЕСТВУЕТ";
echo "<br> RAW_TAGS = ".$post->tags_id;
echo "<br>".$post->renderTags();


$post->id_user = 3;

 // if (!$post->save()) my_var_dump($post->getErrors());