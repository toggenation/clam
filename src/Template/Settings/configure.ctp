<?php $this->Form->setConfig('columns', [
    'sm' => [
        'label' => 4,
        'input' => 4,
        'error' => 4,
    ],
    'md' => [
        'label' => 4,
        'input' => 8,
        'error' => 4,
    ],
]); ?>
<div class="row">
    <div class="col">
        <p>This pages edits the settins in the config/clam.php file</p>
    </div>
</div>
<div class="row">
<div class="col-6">

<?php echo $this->Form->create(null, [
    'horizontal' => true,
    'class' => 'border rounded border-light p-4'
]); ?>
<legend>Update a setting</legend>
<?php foreach ($appSettings as $setting => $value): ?>
<?=$this->Form->control($setting, [
    'value' => $value,
    'class' => 'form-control-sm',
]); ?>
<?php endforeach; ?>

<div class="row">
<div class="col"><?=$this->Form->button('Reset', ['type' => 'reset', 'size' => 'sm']); ?></div>
<div class="col"><?=$this->Form->submit('Save', ['class' => 'float-right', 'size' => 'sm']); ?></div>
</div>
<?=$this->Form->end(); ?>
</div>

<div class="col-6">
<?php echo $this->Form->create(null, [
    'url' => ['action' => 'addSetting'],
    'horizontal' => true,
    'class' => 'border rounded border-light p-4 mb-4'
]); ?>
 <legend>Create a new setting</legend>
    <?=$this->Form->control('newSettingValue', [
        'class' => 'form-control-sm',
    ]); ?>
    <div class="row">
<div class="col"><?=$this->Form->button('Reset', ['type' => 'reset', 'size' => 'sm']); ?></div>
<div class="col"><?=$this->Form->submit('Save', ['class' => 'float-right', 'size' => 'sm']); ?></div>
</div>
    <?=$this->Form->end(); ?>

    <?php echo $this->Form->create(null, [
    'url' => ['action' => 'delete'],
    'horizontal' => true,
    'class' => 'border rounded border-light p-4 mb-2  bg-warning'
]); ?>
    <legend><?= $this->Icon->faIcon('fas fa-exclamation-triangle'); ?> Delete a setting</legend>
    <?=$this->Form->control('delete', [
    'label' => "Delete setting",
    'empty' => '(select a setting to delete)',
    'class' => 'form-control-sm',
    'options' => $deleteValues,
]); ?>
    <div class="row">
<div class="col"><?=$this->Form->button('Reset', ['type' => 'reset', 'size' => 'sm']); ?></div>
<div class="col"><?=$this->Form->submit('Delete', [ 'class' => 'btn btn-danger float-right',  'size' => 'sm']); ?></div>
</div>
    <?=$this->Form->end(); ?>
</div>
    </div>
