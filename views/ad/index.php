<?php
/**
 * Created by PhpStorm.
 * User: kornell
 * Date: 01.06.18
 * Time: 1:02
 */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \budyaga\users\models\forms\LoginForm */

$this->title = 'Доска объявлений';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="container">
    <div class="row">
        <?php foreach ($posts as $post): ?>
        <div class="card-ad">
            <div class="img-ad">
                <?= Html::img('@web/images/uploads/ads/'.$post->images['0']['path'], ['class' => 'img-thumbnail','style' => 'max-width:200px;']) ?>
            </div>
            <div class="title-ad"><a href="<?= Url::to(['/ad/view', 'id' => $post->id, 'name' => $post->title]) ?>"><?=$post->title?></a></div>
            <div class="author-ad">Добавил: <a href="<?= Url::to(['/profile/default/index', 'id' => $post->author['id'], 'name' => $post->author['username']]) ?>"><?=$post->author['username']?></a></div>
            <div class="price-ad"><em>Цена:</em> <?=$post->price?> грн.</div>
            <div class="date-created-ad">Добавлен: <?= Yii::$app->formatter->asDate($post->created_at)?></div>
        </div>
        <?php endforeach ?>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <?= $this->render('/layouts/_pagination', ['pages'=> $pages]);?>
    </div>
</div>