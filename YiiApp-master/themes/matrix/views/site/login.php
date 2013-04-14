<?php
$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);
Yii::import('bootstrap.widgets.input.*');
?>
<div id="loginbox">            
            <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'loginform',
   'type'=>'search',
    'errorMessageCssClass'=>'error',
	'enableClientValidation'=>true,
	'htmlOptions'=>array('class'=>'form-vertical'),
	'clientOptions'=>array(
     'validateOnSubmit'=>true,
	),
)); ?>
	<div class="control-group normal_text"> <h3><?php echo app()->name;?></h3></div>
	  <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
		
                            <span class="add-on bg_lg">
		
		<i class="icon-user"></i></span><input type="text" placeholder="用户名或Email" name="LoginForm[username]"/>
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on bg_ly"><i class="icon-lock"></i></span><input type="password" placeholder="密码" name="LoginForm[password]"/>
                        </div>
                    </div>
                </div>
	<?php echo $form->error($model,'status'); ?>  
	<?php if ($model->getRequireCaptcha()) : ?>
	     <?php $this->widget('application.extensions.recaptcha.EReCaptcha',
	        array('model'=>$user, 'attribute'=>'verify_code',
		'theme'=>'red', 'language'=>'en',
		'publicKey'=>Yii::app()->params['recaptcha_public_key'] ));?>
	    <?php echo CHtml::error($model, 'verify_code'); ?>
	    <?php endif; ?>
                <div class="form-actions">
                    <span class="pull-left">
	      <?php $this->widget('bootstrap.widgets.TbButton',
        array('buttonType'=>'link','url'=>'#','type'=>'info','label'=>'找回密码？', 'icon'=>'exclamation-sign','id'=>'to-recover'));?>
		</span>
                    <span class="pull-right">
		<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit','type'=>'success','label'=>'登入', 'icon'=>'ok'));?>
		<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'reset','label'=>'重置'));?>
                </div>
            <?php $this->endWidget(); ?>
            <form id="recoverform" action="<?php echo url('site/email_for_reset');?>" class="form-vertical">
				<p class="normal_text">请输入你在注册时所填写的Email地址，系统将发送一份重置密码的说明。</p>
				
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on bg_lo"><i class="icon-envelope"></i></span><input type="text" placeholder="邮件地址" name='EmailForm[email]' />
                        </div>
                    </div>
               
                <div class="form-actions">
                    <span class="pull-left"><a href="#" class="flip-link btn btn-success" id="to-login">&laquo; 返回登陆</a></span>
                    <span class="pull-right">
	<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit','type'=>'info','label'=>'找回密码', 'icon'=>'ok'));?>
		<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'reset','label'=>'重置'));?>
                </div>
            </form>
        </div>
