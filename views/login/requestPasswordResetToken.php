<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
//use app\assets\AuthAsset;
use yii\helpers\Url;

//AuthAsset::register($this);

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

$this->title = Yii::t('users', 'REQUEST_PASSWORD_RESET');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-request-password-reset">
    <span class="htitle"><?= Html::encode($this->title) ?></span>
    <hr class="mt-0">
    <div class="row">
        <div class="col-sm-5">
            <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>
                <?= $form->field($model, 'email') ?>
                <div class="form-group">
                    <?= Html::submitButton(Yii::t('users', 'SEND'), ['class' => 'btn btn-primary']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
    <hr>
    <div class="register-bottom-block">
        <a href="<?=Url::to('/login')?>">Вход</a> | <a href="<?=Url::to('/signup')?>">Регистрация</a>
    </div>
</div>
