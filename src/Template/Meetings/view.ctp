<div class="row">
<div class="col-lg-2"><ul class="nav flex-column nav-pills">
        <li class="heading"><?= __('Actions') ?></li>
        <li class="nav-item"><?= $this->Html->link(__('Edit Meeting'), ['action' => 'edit', $meeting->id], ['class' => 'nav-link' ]) ?> </li>
        <li class="nav-item"><?= $this->Form->postLink(__('Delete Meeting'), ['action' => 'delete', $meeting->id], [
            'class' => 'nav-link',
            'confirm' => __('Are you sure you want to delete # {0}?', $meeting->id)]) ?> </li>
        <li class="nav-item"><?= $this->Html->link(__('List Meetings'), ['action' => 'index'], ['class' => 'nav-link' ]) ?> </li>
        <li class="nav-item"><?= $this->Html->link(__('New Meeting'), ['action' => 'add'], ['class' => 'nav-link' ]) ?> </li>
        <li class="nav-item"><?= $this->Html->link(__('List Schedules'), ['controller' => 'Schedules', 'action' => 'index'], ['class' => 'nav-link' ]) ?> </li>
        <li class="nav-item"><?= $this->Html->link(__('New Schedule'), ['controller' => 'Schedules', 'action' => 'add'], ['class' => 'nav-link' ]) ?> </li>
        <li class="nav-item"><?= $this->Html->link(__('List Assigned'), ['controller' => 'Assigned', 'action' => 'index'], ['class' => 'nav-link' ]) ?> </li>
        <li class="nav-item"><?= $this->Html->link(__('New Assigned'), ['controller' => 'Assigned', 'action' => 'add'], ['class' => 'nav-link' ]) ?> </li>
    </ul>
    </div>
<div class="col-lg-10">
    <?php //debug($meeting); ?>
    <h3><?= h($meeting->date) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Schedule') ?></th>
            <td><?= $meeting->has('schedule') ? $this->Html->link($meeting->schedule->id, ['controller' => 'Schedules', 'action' => 'view', $meeting->schedule->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('CO Visit') ?></th>
            <td><?= h($meeting->co_visit) ; ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($meeting->id) ?></td>
        </tr>
				<tr>
						<th><?= __('Chairman') ?></th>
						<td><?= $meeting->has('chairman') ? h($meeting->chairman->full_name) : '' ?></td>
				</tr>
				<tr>
						<th><?= __('Auxiliary Counselor') ?></th>
						<td><?= $meeting->has('auxiliary_counselor') ? h($meeting->auxiliary_counselor->full_name) : '' ?></td>
				</tr>
        <tr>
            <th><?= __('Date') ?></th>
            <td><?= h($meeting->date) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Assigned') ?></h4>
        <?php if (!empty($meeting->assigned)): ?>
        <table class="table table-bordered table-condensed table-striped table-responsive">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Part Id') ?></th>
                <th><?= __('Part Title') ?></th>
                <th><?= __('Meeting Id') ?></th>
                <th><?= __('Person Id') ?></th>
                <th><?= __('Assistant') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($meeting->assigned as $assigned): ?>
            <tr>
                <td><?= h($assigned->id) ?></td>
                <td><?= h($assigned->part_id) ?></td>
                <td><?= h($assigned->part_title) ?></td>
                <td><?= h($assigned->meeting_id) ?></td>
                <td><?= $assigned->has('person') ? h($assigned->person->full_name) : '' ?></td>
                <td><?= $assigned->has('assistant') ? h($assigned->assistant->full_name) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Assigned', 'action' => 'view', $assigned->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Assigned', 'action' => 'edit', $assigned->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Assigned', 'action' => 'delete', $assigned->id], ['confirm' => __('Are you sure you want to delete # {0}?', $assigned->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
</div>
