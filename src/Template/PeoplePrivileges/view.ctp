
    <div class="row">
    <div class="col-lg-2"><ul class="nav flex-column nav-pills">
        <li class="heading"><?= __('Actions') ?></li>
        <li class="nav-item"><?= $this->Html->link(__('Edit People Privilege'), ['action' => 'edit', $peoplePrivilege->id, ['class' => 'nav-link' ]) ?> </li>
        <li class="nav-item"><?= $this->Form->postLink(__('Delete People Privilege'), ['action' => 'delete', $peoplePrivilege->id], ['confirm' => __('Are you sure you want to delete # {0}?', $peoplePrivilege->id)]) ?> </li>
        <li class="nav-item"><?= $this->Html->link(__('List People Privileges'), ['action' => 'index'], ['class' => 'nav-link' ]) ?> </li>
        <li class="nav-item"><?= $this->Html->link(__('New People Privilege'), ['action' => 'add'], ['class' => 'nav-link' ]) ?> </li>
        <li class="nav-item"><?= $this->Html->link(__('List People'), ['controller' => 'People', 'action' => 'index'], ['class' => 'nav-link' ]) ?> </li>
        <li class="nav-item"><?= $this->Html->link(__('New Person'), ['controller' => 'People', 'action' => 'add'], ['class' => 'nav-link' ]) ?> </li>
        <li class="nav-item"><?= $this->Html->link(__('List Privileges'), ['controller' => 'Privileges', 'action' => 'index'], ['class' => 'nav-link' ]) ?> </li>
        <li class="nav-item"><?= $this->Html->link(__('New Privilege'), ['controller' => 'Privileges', 'action' => 'add'], ['class' => 'nav-link' ]) ?> </li>
    </ul>
</div>
<div class="col-lg-10">
    <h3><?= h($peoplePrivilege->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Person') ?></th>
            <td><?= $peoplePrivilege->has('person') ? $this->Html->link($peoplePrivilege->person->full_name, ['controller' => 'People', 'action' => 'view', $peoplePrivilege->person->id, ['class' => 'nav-link' ]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Privilege') ?></th>
            <td><?= $peoplePrivilege->has('privilege') ? $this->Html->link($peoplePrivilege->privilege->privilege, ['controller' => 'Privileges', 'action' => 'view', $peoplePrivilege->privilege->id, ['class' => 'nav-link' ]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($peoplePrivilege->id) ?></td>
        </tr>
    </table>
</div>
</div>
