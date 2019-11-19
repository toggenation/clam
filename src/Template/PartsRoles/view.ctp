
    <div class="col-lg-2"><ul class="nav flex-column nav-pills">
        <li class="heading"><?= __('Actions') ?></li>
        <li class="nav-item"><?= $this->Html->link(__('Edit Parts Role'), ['action' => 'edit', $partsRole->id, ['class' => 'nav-link' ]) ?> </li>
        <li class="nav-item"><?= $this->Form->postLink(__('Delete Parts Role'), ['action' => 'delete', $partsRole->id], ['confirm' => __('Are you sure you want to delete # {0}?', $partsRole->id)]) ?> </li>
        <li class="nav-item"><?= $this->Html->link(__('List Parts Roles'), ['action' => 'index'], ['class' => 'nav-link' ]) ?> </li>
        <li class="nav-item"><?= $this->Html->link(__('New Parts Role'), ['action' => 'add'], ['class' => 'nav-link' ]) ?> </li>
        <li class="nav-item"><?= $this->Html->link(__('List Parts'), ['controller' => 'Parts', 'action' => 'index'], ['class' => 'nav-link' ]) ?> </li>
        <li class="nav-item"><?= $this->Html->link(__('New Part'), ['controller' => 'Parts', 'action' => 'add'], ['class' => 'nav-link' ]) ?> </li>
        <li class="nav-item"><?= $this->Html->link(__('List Roles'), ['controller' => 'Roles', 'action' => 'index'], ['class' => 'nav-link' ]) ?> </li>
        <li class="nav-item"><?= $this->Html->link(__('New Role'), ['controller' => 'Roles', 'action' => 'add'], ['class' => 'nav-link' ]) ?> </li>
    </ul>
</div>
<div class="col-lg-10">
    <h3><?= h($partsRole->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Part') ?></th>
            <td><?= $partsRole->has('part') ? $this->Html->link($partsRole->part->id, ['controller' => 'Parts', 'action' => 'view', $partsRole->part->id, ['class' => 'nav-link' ]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Role') ?></th>
            <td><?= $partsRole->has('role') ? $this->Html->link($partsRole->role->role, ['controller' => 'Roles', 'action' => 'view', $partsRole->role->id, ['class' => 'nav-link' ]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($partsRole->id) ?></td>
        </tr>
    </table>
</div>
