<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use budyaga\users\components\AuthChoice;
use yii\helpers\Url;
//use app\assets\AuthAsset;
//
//AuthAsset::register($this);

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \budyaga\users\models\forms\LoginForm */

$this->title = Yii::t('users', 'LOGIN');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <div class="row">
        <div class="col-md-6">
            <div class="col-sm-6 col-sm-push-6 col-sm-push-0 col-md-12 social-auth">
                <p><?= Yii::t('users', 'YOU_CAN_ENTER_VIA_SOCIAL_NETWORKS')?></p>
                <?= AuthChoice::widget([
                    'baseAuthUrl' => ['/auth/index'],
                    'clientCssClass' => 'col-xs-2 col-sm-1 col-md-1  pr-0 mr-5px'
                ]) ?>
            </div>
            <div class="col-sm-6 col-sm-pull-6  col-sm-pull-0 col-md-12">
                <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
                <?= $form->field($model, 'email') ?>
                <?= $form->field($model, 'password')->passwordInput() ?>
                <?= $form->field($model, 'rememberMe')->checkbox() ?>
                <div style="color:#999;margin:1em 0">
                    <?= Yii::t('users', 'YOU_CAN_RESET_PASSWORD', ['url' => Url::toRoute('/users/request-password-reset')])?>
                </div>
                <div class="form-group">
                    <?= Html::submitButton(Yii::t('users', 'LOGIN'), ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
    <hr>
    <div class="register-bottom-block">
    <span>Не зарегистрированы?<br><em>Вы можете зарегистрироваться.</em></span>
        <a class="center block" href="<?=Url::to('/signup')?>">Регистрация</a>
    </div>

</div>
