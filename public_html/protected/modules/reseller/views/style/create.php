<?php
/* @var $this StyleController */
/* @var $form CActiveForm */
/* @var $model Style */

Yii::app()->getClientScript()->registerCssFile(Yii::app()->request->baseUrl . '/plugins/bower_components/codemirror/lib/codemirror.css');
Yii::app()->getClientScript()->registerCssFile(Yii::app()->request->baseUrl . '/plugins/bower_components/codemirror/addon/hint/show-hint.css');
Yii::app()->getClientScript()->registerCssFile(Yii::app()->request->baseUrl . '/plugins/bower_components/codemirror/theme/paraiso-light.css');
Yii::app()->getClientScript()->registerScriptFile(Yii::app()->request->baseUrl . '/plugins/bower_components/codemirror/lib/codemirror.js');
Yii::app()->getClientScript()->registerScriptFile(Yii::app()->request->baseUrl . '/plugins/bower_components/codemirror/mode/css/css.js');
Yii::app()->getClientScript()->registerScriptFile(Yii::app()->request->baseUrl . '/plugins/bower_components/codemirror/addon/hint/show-hint.js');
Yii::app()->getClientScript()->registerScriptFile(Yii::app()->request->baseUrl . '/plugins/bower_components/codemirror/addon/hint/css-hint.js');
?>

<?php $this->showMessages($model); ?>
<div class="row">
    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'login-form',
        'enableAjaxValidation'=>true,
    )); ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title">
                <i class="fa fa-plus"></i> <?=Yii::t('Module/Reseller', 'Новый стиль')?>
            </div>
        </div>
        <div class="panel-body">
            <div class="form-group">
                <label><?=Yii::t('Module/Reseller', 'Название')?></label>
                <?php echo $form->textField($model, 'title', ['class' => 'form-control', 'placeholder' => Yii::t('Module/Reseller', 'Название')]); ?>
            </div>
            <div class="form-group">
                <label><?=Yii::t('Module/Reseller', 'CSS-Код')?></label>
                <?php echo $form->textArea($model, 'content', ['class' => 'form-control', 'id' => 'code', 'placeholder' => Yii::t('Module/Reseller', 'CSS-Код')]); ?>
            </div>
        </div>
        <div class="panel-footer">
            <button type="submit" class="btn btn-success"><i class="fa fa-save"></i></button>
        </div>
    </div>
    <?php $this->endWidget(); ?>
</div>

<script>
    $(document).ready(function(){
        var editor = CodeMirror.fromTextArea(document.getElementById("code"), {
            mode: "css",
            lineNumbers: true,
            theme: 'paraiso-light',
            extraKeys: {"Ctrl-Space": "autocomplete"}
        });
    });
</script>