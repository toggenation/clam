
    <div class="col-lg-2"><ul class="nav flex-column nav-pills">
        <li class="heading"><?= __('Actions') ?></li>
        <li class="nav-item"><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $meeting->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $meeting->id)]
            )
        ?></li>
        <li class="nav-item"><?= $this->Html->link(__('List Meetings'), ['action' => 'index'], ['class' => 'nav-link' ]) ?></li>
        <li class="nav-item"><?= $this->Html->link(__('List Schedules'), ['controller' => 'Schedules', 'action' => 'index'], ['class' => 'nav-link' ]) ?></li>
        <li class="nav-item"><?= $this->Html->link(__('New Schedule'), ['controller' => 'Schedules', 'action' => 'add'], ['class' => 'nav-link' ]) ?></li>
        <li class="nav-item"><?= $this->Html->link(__('List Assigned'), ['controller' => 'Assigned', 'action' => 'index'], ['class' => 'nav-link' ]) ?></li>
        <li class="nav-item"><?= $this->Html->link(__('New Assigned'), ['controller' => 'Assigned', 'action' => 'add'], ['class' => 'nav-link' ]) ?></li>
    </ul>
    </div>
<div class="col-lg-10">
    <?= $this->Form->create($meeting) ?>
    <fieldset>
        <legend><?= __('Edit Meeting') ?></legend>
        <?php
         echo $this->Form->input('co_visit');
            echo $this->Form->input('date', [
                'empty' => true]);
            echo $this->Form->input('schedule_id', ['options' => $schedules]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
