<?php
/**
  * @var \App\View\AppView $this
  */

  $this->Html->script('toggleShowPassword', [
      'block' => 'from_view'
  ]);

?>
<div class="row">
<nav class="large-3 col-lg-2 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li class="nav-item"><?= $this->Html->link(__('List Users'), ['action' => 'index'], ['class' => 'nav-link' ]) ?></li>
    </ul>
</nav>
<div class="users col-lg-10 form large-9 medium-8 columns content">
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Add User') ?></legend>
        <?php
          echo $this->Form->control('active', [ 'default' => 1 ]);
            echo $this->Form->control('person_id', [
                'empty' => '(select to link to person record)'
            ]);
            echo $this->Form->control('username');
            echo $this->Form->control('password', [
                'id' => 'pwd',
                'append' => $this->Icon->faIcon('fas fa-eye', [
                    'onClick' => 'toggleShowPassword()'
                ])
            ]);

        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
</div>
