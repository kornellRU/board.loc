<?php
/**
 * Created by PhpStorm.
 * User: kornell
 * Date: 01.06.18
 * Time: 16:47
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\rating\StarRating;
use yii\helpers\Url;
?>

<div class="review-block-ad">
    <div class="review-rating">
        <?php
        echo StarRating::widget([
        'name' => 'rating_1',
        'value' => $model->rating,
        'pluginOptions' => ['disabled'=>true, 'showClear'=>false]
        ]);?>
    </div>
    <div class="author-review">
        <div class="avatar-author-review"> <?= Html::img($model->author['photo']?'/images/users/'.$model->author['photo']:'/images/system/no-image.png', ['class' => 'img-thumbnail','style' => 'max-width:50px; border-radius:50%;'])?></div>
        <div class="username-author-review"><a href="<?= Url::to(['/profile/default/index', 'id' => $model->author['id'], 'name' => $model->author['username']]) ?>"><?=$model->author['username']?></a></div>
    </div>
    <div class="review-content"><?=$model->content?></div>
    <div class="review-date"><?=$model->created_at?></div>
</div>
