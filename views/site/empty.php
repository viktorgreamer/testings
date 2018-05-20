<?php
use app\models\User;
 // my_var_dump($permissions) ?>

    <h3><?= $message; ?></h3>


<?php if (count($roles) > 1) {

    foreach ($roles as $role) { ?>
        <br>role is <?= $role->name; ?>
    <? }
} elseif (count($roles) != 0) echo " <br>role is " . $roles->name;
else  echo " roles is not isset";

?>


<?php if (count($permissions) > 1) {

    foreach ($permissions as $permission) { ?>
        <br>permissions is <?= $permission->name; ?>
    <? }
} elseif (count($permissions) != 0) echo " <br>role is " . $permissions->name;
else  echo "<br><h3>permissions is not isset</h3> ";

?>
<?php if (count($rules) > 1) {

    foreach ($rules as $rule) { ?>
        <br>permissions is <?= $rule->name; ?>
    <? }
} elseif (count($rules) != 0) echo " <br>role is " . $rules->name;
else  echo "<br><h3>rules is not isset</h3> ";

?>
    <span class="glyphicon-facetime-video-edit"></span>
<?php
echo User::renderButtons(2);

