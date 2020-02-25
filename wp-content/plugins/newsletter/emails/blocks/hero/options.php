<?php
/*
 * @var $options array contains all the options the current block we're ediging contains
 * @var $controls NewsletterControls 
 */
/* @var $fields NewsletterFields */
?>

<div class="tnp-field-row">
<div class="tnp-field-col-20">
<?php $fields->select('layout', __('Layout', 'newsletter'), array('full' => 'Full', 'left' => 'Left'))?>
</div>
<div class="tnp-field-col-80">

<?php $fields->text('title', __('Title', 'newsletter')) ?>
</div>
    
</div>

<?php $fields->font('title_font', '')?>

<?php $fields->media('image', __('Image', 'newsletter'))?>



<?php $fields->textarea('text', __('Text', 'newsletter')) ?>
<?php $fields->font('font', '')?>

<?php $fields->button('button', __('Button', 'newsletter'))?>

<?php $fields->block_commons() ?>

