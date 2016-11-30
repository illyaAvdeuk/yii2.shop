<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;
use yii\helpers\Url;
$this->title = $name;
?>
<div class="site-error container">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="alert alert-danger container">
        <?= nl2br(Html::encode($message)) ?>
    </div>
<div class="container">
    <p>
        Попробуйте найти то, что вам нужно, на  <a href="<?= Url::home(); ?>">главной странице</a>.
    </p>
    <p>
        Please contact us if you think this is a server error. Thank you.
    </p>

</div>
    

</div>
