<div class="row">
<div class="col-lg-2"><ul class="nav flex-column nav-pills">
        <li class="heading"><?= __('Actions') ?></li>
        <li class="nav-item"><?= $this->Html->link(__('List Schedules'), ['action' => 'index'], ['class' => 'nav-link' ]) ?></li>
        <li class="nav-item"><?= $this->Html->link(__('List Meetings'), ['controller' => 'Meetings', 'action' => 'index'], ['class' => 'nav-link' ]) ?></li>
        <li class="nav-item"><?= $this->Html->link(__('New Meeting'), ['controller' => 'Meetings', 'action' => 'add'], ['class' => 'nav-link' ]) ?></li>
    </ul>
</div>
<div class="col-lg-10">
<?= $this->Form->create($schedule) ?>
    <fieldset>
        <legend><?= __('Add Schedule') ?></legend>
<?php
echo $this->Form->input('published', [ 'value' => 0 ]);
echo $this->Form->input('start_date', [ 'type' => 'date']);
echo $this->Form->input('end_date');
echo $this->Form->input('month', ['empty' => '(Select a month)']);
echo $this->Form->input('comment');
?>
    </fieldset>
        <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>

    <?php debug($months); ?>
</div>
</div>
