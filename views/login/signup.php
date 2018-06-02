<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \budyaga\users\models\SignupForm */

$this->title = Yii::t('users', 'SIGNUP');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <span class="htitle"><?= Html::encode($this->title) ?></span>
    <hr class="mt-0">
    <?php $form = ActiveForm::begin(['id' => 'form-profile']); ?>
    <div class="row">
        <div class="col-xs-12 col-sm-6">
            <div><?= $form->field($model, 'username') ?></div>
            <div><?= $form->field($model, 'email')->input('email') ?></div>
            <div><?= $form->field($model, 'password')->passwordInput() ?></div>
            <div><?= $form->field($model, 'password_repeat')->passwordInput() ?></div>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('users', 'SIGNUP'), ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
    </div>
    <?php ActiveForm::end(); ?>
    <hr>
    <div class="register-bottom-block">
        <span>Уже зарегистрированы?<br><em>Вы можете авторизоваться.</em></span>
        <a class="center block" href="<?=Url::to('/login')?>">Войти</a>
    </div>
</div>
