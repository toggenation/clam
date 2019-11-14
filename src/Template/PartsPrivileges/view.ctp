
    <div class="col-lg-2"><ul class="nav flex-column nav-pills">
        <li class="heading"><?= __('Actions') ?></li>
        <li class="nav-item"><?= $this->Html->link(__('Edit Parts Privilege'), ['action' => 'edit', $partsPrivilege->id, ['class' => 'nav-link' ]) ?> </li>
        <li class="nav-item"><?= $this->Form->postLink(__('Delete Parts Privilege'), ['action' => 'delete', $partsPrivilege->id], ['confirm' => __('Are you sure you want to delete # {0}?', $partsPrivilege->id)]) ?> </li>
        <li class="nav-item"><?= $this->Html->link(__('List Parts Privileges'), ['action' => 'index'], ['class' => 'nav-link' ]) ?> </li>
        <li class="nav-item"><?= $this->Html->link(__('New Parts Privilege'), ['action' => 'add'], ['class' => 'nav-link' ]) ?> </li>
        <li class="nav-item"><?= $this->Html->link(__('List Parts'), ['controller' => 'Parts', 'action' => 'index'], ['class' => 'nav-link' ]) ?> </li>
        <li class="nav-item"><?= $this->Html->link(__('New Part'), ['controller' => 'Parts', 'action' => 'add'], ['class' => 'nav-link' ]) ?> </li>
        <li class="nav-item"><?= $this->Html->link(__('List Privileges'), ['controller' => 'Privileges', 'action' => 'index'], ['class' => 'nav-link' ]) ?> </li>
        <li class="nav-item"><?= $this->Html->link(__('New Privilege'), ['controller' => 'Privileges', 'action' => 'add'], ['class' => 'nav-link' ]) ?> </li>
    </ul>
</div>
<div class="col-lg-10">
    <h3><?= h($partsPrivilege->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Part') ?></th>
            <td><?= $partsPrivilege->has('part') ? $this->Html->link($partsPrivilege->part->id, ['controller' => 'Parts', 'action' => 'view', $partsPrivilege->part->id, ['class' => 'nav-link' ]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Privilege') ?></th>
            <td><?= $partsPrivilege->has('privilege') ? $this->Html->link($partsPrivilege->privilege->privilege, ['controller' => 'Privileges', 'action' => 'view', $partsPrivilege->privilege->id, ['class' => 'nav-link' ]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($partsPrivilege->id) ?></td>
        </tr>
    </table>
</div>
