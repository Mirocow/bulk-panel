<?php
/* @var $model Template */
/* @var $form CActiveForm */
?>

<div class="form-group">
    <?=$form->label($model, 'text_content')?>
    <?php echo $form->textArea($model, 'text_content', ['class' => 'form-control']); ?>
</div>