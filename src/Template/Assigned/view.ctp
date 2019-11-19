<div class="row">
    <div class="col-lg-2"><ul class="nav flex-column nav-pills">
        <li class="heading"><?= __('Actions') ?></li>
        <li class="nav-item"><?= $this->Html->link(__('Edit Assigned'), ['action' => 'edit', $assigned->id], ['class' => 'nav-link' ]) ?> </li>
        <li class="nav-item"><?= $this->Form->postLink(__('Delete Assigned'), ['action' => 'delete', $assigned->id], [
            'class' => 'nav-link',
            'confirm' => __('Are you sure you want to delete # {0}?', $assigned->id)]) ?> </li>


        <li class="nav-item"><?= $this->Html->link(__('List Parts'), ['controller' => 'Parts', 'action' => 'index'], ['class' => 'nav-link' ]) ?> </li>
        <li class="nav-item"><?= $this->Html->link(__('New Part'), ['controller' => 'Parts', 'action' => 'add'], ['class' => 'nav-link' ]) ?> </li>

        <li class="nav-item"><?= $this->Html->link(__('New Meeting'), ['controller' => 'Meetings', 'action' => 'add'], ['class' => 'nav-link' ]) ?> </li>
        <li class="nav-item"><?= $this->Html->link(__('List People'), ['controller' => 'People', 'action' => 'index'], ['class' => 'nav-link' ]) ?> </li>
        <li class="nav-item"><?= $this->Html->link(__('New Person'), ['controller' => 'People', 'action' => 'add'], ['class' => 'nav-link' ]) ?> </li>
    </ul>
    </div>
<div class="col-lg-10">
    <h3><?= h($assigned->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Part') ?></th>
            <td><?= $assigned->has('part') ? $this->Html->link($assigned->part->id, ['controller' => 'Parts', 'action' => 'view', $assigned->part->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Part Title') ?></th>
            <td><?= h($assigned->part_title) ?></td>
        </tr>
        <tr>
            <th><?= __('Start Time') ?></th>
            <td><?= h($assigned->start_time) ?></td>
        </tr>
        <tr>
            <th><?= __('Meeting') ?></th>
            <td><?= $assigned->has('meeting') ? $this->Html->link($assigned->meeting->date, ['controller' => 'Meetings', 'action' => 'view', $assigned->meeting->id ]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Person') ?></th>
            <td><?= $assigned->has('person') ? $this->Html->link($assigned->person->full_name, ['controller' => 'People', 'action' => 'view', $assigned->person->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>

        </tr>
        <tr>
            <th><?= __('Assistant') ?></th>
            <td><?= $this->Number->format($assigned->assistant) ?></td>
        </tr>
    </table>
</div>
</div>
