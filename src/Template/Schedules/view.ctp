
    <div class="row">
    <div class="col-lg-2"><ul class="nav flex-column nav-pills">
        <li class="heading"><?= __('Actions') ?></li>
        <li class="nav-item"><?= $this->Html->link(
            __('Edit Schedule'),
            [ 'action' => 'edit', $schedule->id] , ['class' => 'nav-link' ]);?> </li>
        <li class="nav-item"><?= $this->Form->postLink(__('Delete Schedule'), ['action' => 'delete', $schedule->id], [
            'class' => 'nav-link',
            'confirm' => __('Are you sure you want to delete # {0}?', $schedule->id)]) ?> </li>
        <li class="nav-item"><?= $this->Html->link(__('List Schedules'), ['action' => 'index'], ['class' => 'nav-link' ]) ?> </li>
        <li class="nav-item"><?= $this->Html->link(__('New Schedule'), ['action' => 'add'], ['class' => 'nav-link' ]) ?> </li>
        <li class="nav-item"><?= $this->Html->link(__('List Meetings'), ['controller' => 'Meetings', 'action' => 'index'], ['class' => 'nav-link' ]) ?> </li>
        <li class="nav-item"><?= $this->Html->link(__('New Meeting'), ['controller' => 'Meetings', 'action' => 'add'], ['class' => 'nav-link' ]) ?> </li>
    </ul>
</div>
<div class="col-lg-10">
    <h3><?= h($schedule->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Month') ?></th>
            <td><?= h($schedule->month) ?></td>
        </tr>
        <tr>
            <th><?= __('Comment') ?></th>
            <td><?= h($schedule->comment) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($schedule->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Start Date') ?></th>
            <td><?= h($schedule->start_date) ?></td>
        </tr>
        <tr>
            <th><?= __('End Date') ?></th>
            <td><?= h($schedule->end_date) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Meetings') ?></h4>
        <?php if (!empty($schedule->meetings)): ?>
        <table class="table table-bordered table-condensed table-striped table-responsive">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Date') ?></th>
                <th><?= __('Schedule Id') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($schedule->meetings as $meetings): ?>
            <tr>
                <td><?= h($meetings->id) ?></td>
                <td><?= h($meetings->date) ?></td>
                <td><?= h($meetings->schedule_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Meetings', 'action' => 'view', $meetings->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Meetings', 'action' => 'edit', $meetings->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Meetings', 'action' => 'delete', $meetings->id], ['confirm' => __('Are you sure you want to delete # {0}?', $meetings->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
</div>
