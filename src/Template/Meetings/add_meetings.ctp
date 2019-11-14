
<?php

$this->Html->script([

    'moment-with-locales.min',
    'bootstrap4-timepicker/tempusdominus-bootstrap-4',
    'clam'], ['block' => 'from_view']);

$this->Html->css(
    'bootstrap4-timepicker/tempusdominus-bootstrap-4'
    , ['block' => 'cssFromView']);

?>
<div class="row">
<div class="col-lg-2">
    <ul class="nav flex-column nav-pills">
        <li class="nav-item"><?=__('Actions') ?></li>
        <li role="presentation"><?=$this->Html->link(__('List Meetings'), ['action' => 'index'], ['class' => 'nav-link']) ?></li>
        <li role="presentation"><?=$this->Html->link(__('List Schedules'), ['controller' => 'Schedules', 'action' => 'index'], ['class' => 'nav-link']) ?></li>
        <li role="presentation"><?=$this->Html->link(__('New Schedule'), ['controller' => 'Schedules', 'action' => 'add'], ['class' => 'nav-link']) ?></li>
        <li role="presentation"><?=$this->Html->link(__('List Assigned'), ['controller' => 'Assigned', 'action' => 'index'], ['class' => 'nav-link']) ?></li>
        <li role="presentation"><?=$this->Html->link(__('New Assigned'), ['controller' => 'Assigned', 'action' => 'add'], ['class' => 'nav-link']) ?></li>
    </ul>
</div>
<div class="col-lg-10">
    <?=$this->Form->create('Meetings') ?>
    <fieldset>
        <legend><?=__('Add Meetings to Schedule'); ?></legend>
        <h3> <?=h($schedule->range); ?></h3>
        <?=$this->Form->hidden('schedule_id', ['value' => $schedule->id]); ?>
        <?=$this->Form->hidden('start_date', [
    'id' => 'start-date',
    'value' => $schedule->start_date]); ?>

         <?=$this->Form->input(
    'meeting_dates', [
        'id' => 'datetimepicker3',
        'data-target' => "#datetimepicker3",
        'autocomplete' => 'off',
    ]); ?>

    </fieldset>
    <?=$this->Form->button(__('Submit')) ?>
    <?=$this->Form->end() ?>
</div>
 </div>
