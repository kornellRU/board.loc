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
?>

<?php $form = ActiveForm::begin(
        [
                'action' => '/profile/review'
        ]
); ?>

<?=  $form->field($model, 'rating')->widget(StarRating::classname(), [
'pluginOptions' => ['size'=>'md']
])?>
<?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

<?= $form->field($model, 'recipient_id')->hiddenInput(['value'=>$recipient_id])->label('') ?>

<div class="form-group">
    <?= Html::submitButton('Оставить отзыв', ['class' => 'btn btn-success']) ?>
</div>

<?php ActiveForm::end(); ?>
