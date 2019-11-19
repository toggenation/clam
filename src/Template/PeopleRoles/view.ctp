
    <div class="row">
    <div class="col-lg-2"><ul class="nav flex-column nav-pills">
        <li class="heading"><?= __('Actions') ?></li>
        <li class="nav-item"><?= $this->Html->link(__('Edit People Role'), ['action' => 'edit', $peopleRole->id, ['class' => 'nav-link' ]) ?> </li>
        <li class="nav-item"><?= $this->Form->postLink(__('Delete People Role'), ['action' => 'delete', $peopleRole->id], ['confirm' => __('Are you sure you want to delete # {0}?', $peopleRole->id)]) ?> </li>
        <li class="nav-item"><?= $this->Html->link(__('List People Roles'), ['action' => 'index'], ['class' => 'nav-link' ]) ?> </li>
        <li class="nav-item"><?= $this->Html->link(__('New People Role'), ['action' => 'add'], ['class' => 'nav-link' ]) ?> </li>
        <li class="nav-item"><?= $this->Html->link(__('List People'), ['controller' => 'People', 'action' => 'index'], ['class' => 'nav-link' ]) ?> </li>
        <li class="nav-item"><?= $this->Html->link(__('New Person'), ['controller' => 'People', 'action' => 'add'], ['class' => 'nav-link' ]) ?> </li>
        <li class="nav-item"><?= $this->Html->link(__('List Roles'), ['controller' => 'Roles', 'action' => 'index'], ['class' => 'nav-link' ]) ?> </li>
        <li class="nav-item"><?= $this->Html->link(__('New Role'), ['controller' => 'Roles', 'action' => 'add'], ['class' => 'nav-link' ]) ?> </li>
    </ul>
</div>
<div class="col-lg-10">
    <h3><?= h($peopleRole->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Person') ?></th>
            <td><?= $peopleRole->has('person') ? $this->Html->link($peopleRole->person->full_name, ['controller' => 'People', 'action' => 'view', $peopleRole->person->id, ['class' => 'nav-link' ]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Role') ?></th>
            <td><?= $peopleRole->has('role') ? $this->Html->link($peopleRole->role->role, ['controller' => 'Roles', 'action' => 'view', $peopleRole->role->id, ['class' => 'nav-link' ]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($peopleRole->id) ?></td>
        </tr>
    </table>
</div>
</div>
