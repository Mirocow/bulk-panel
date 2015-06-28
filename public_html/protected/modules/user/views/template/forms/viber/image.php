<?php
/* @var $model Template */
/* @var $form CActiveForm */
?>

<div class="form-group">
    <?=$form->label($model, 'file')?>
    <?php echo $form->fileField($model, 'file', ['class' => 'form-control', 'placeholder' => 'Текст сообщения']); ?>
</div>