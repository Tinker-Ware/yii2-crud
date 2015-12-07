<?php

use yii\helpers\Markdown;

/* @var $this \yii\web\View */

?>

<?= Markdown::process(file_get_contents(Yii::getAlias('@app/README.md')));