<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

$this->title = 'Профиль пользователя: '.$model->username;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-profile">
    <div class="avatar-profile">
       <?= Html::img($model->photo?'/images/users/'.$model->photo:'/images/system/no-image.png', ['class' => 'img-thumbnail','style' => 'max-width:200px;'])?>
        <div class="username-profile">
           Логин: <?=$model->username?>
        </div>
        <div class="sex-profile">
            Пол: <?=$model->getSex($model->sex)?>
        </div>
        <?php if ($model->email): ?>
        <div class="email-profile">
           Почтовый адрес: <?=$model->email;?>
        </div>
        <?php endif ?>
        <div class="date-create-profile">
          Зарегистрировался:  <?= Yii::$app->formatter->asDate($model->created_at)?></div>
        </div>
    </div>
    <div class="reviews-profile">
        <h2 class="review-title">Отзывы:</h2>
        <div class="block-review">
            <?php foreach($model->recipient as $review): ?>
                <?= $this->render('/layouts/_reviewBlock', ['model' => $review]);?>
            <?php endforeach?>
        </div>
        <div class="form-review-add">
            <?php if ($model->id == Yii::$app->user->id):?>
                <div class="form-author-review">
                    Вы не можете писать отзывы себе.
                </div>
            <?php else:?>
                <h2>Написать отзыв:</h2>
                <?=$this->render('/layouts/_reviewForm', ['model' => $review, 'recipient_id' => $model->id]);?>
            <?php endif?>
        </div>
    </div>
</div>
