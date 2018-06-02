<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Ads */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Объявления', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ads-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'author_id',
            'title',
            'body:ntext',
            'price',
            'created_at',
            'updated_at',
        ],
    ]) ?>
    <?php if ($model->images): ?>
<div class="images-ads">
    <?php foreach ($model->images as $img): ?>
    <span class="img-path">
        <?= Html::img('@web/images/uploads/ads/'.$img['path'], ['style' => 'max-width:200px;']) ?>
    </span>
    <?php endforeach ?>
</div>
    <?php endif ?>
</div>
