<div class="row">
<?php
/**
  * @var \App\View\AppView $this
  */
?>

<nav class="large-3 col-lg-2 medium-4 columns" id="actions-sidebar">
<ul class="nav flex-column nav-pills">
        <li class="heading"><?= __('Actions') ?></li>
        <li class="nav-item"><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $user->id],
                [
                    'class' => 'nav-link',
                    'confirm' => __('Are you sure you want to delete # {0}?', $user->id)
                    ]
            )
        ?></li>
        <li class="nav-item"><?= $this->Html->link(__('List Users'), ['action' => 'index'], ['class' => 'nav-link' ]) ?></li>
    </ul>
</nav>
<div class="users col-lg-10 form large-9 medium-8 columns content">
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Edit User') ?></legend>
        <?php
            echo $this->Form->control('active');
            echo $this->Form->control('username');
            echo $this->Form->control('password');
            echo $this->Form->control('person_id', [
                'empty' => '(select to link to person record)'
            ]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
</div>
