<?php
use app\models\Webstep;

echo "<br>". \app\components\MyChromeDriver::getSteps($step->step) ." ".$step->text ."  ".$step->selector."  ".$step->preg_match;