<div class="row">
    <div class="col-lg-2"><ul class="nav flex-column nav-pills">
        <li class="heading"><?= __('Actions') ?></li>
        <li class="nav-item"><?= $this->Html->link(__('Edit Person Type'), ['action' => 'edit', $personType->id, ['class' => 'nav-link' ]) ?> </li>
        <li class="nav-item"><?= $this->Form->postLink(__('Delete Person Type'), ['action' => 'delete', $personType->id], ['confirm' => __('Are you sure you want to delete # {0}?', $personType->id)]) ?> </li>
        <li class="nav-item"><?= $this->Html->link(__('List Person Type'), ['action' => 'index'], ['class' => 'nav-link' ]) ?> </li>
        <li class="nav-item"><?= $this->Html->link(__('New Person Type'), ['action' => 'add'], ['class' => 'nav-link' ]) ?> </li>
    </ul>
</div>
<div class="col-lg-10">
    <h3><?= h($personType->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Type') ?></th>
            <td><?= h($personType->type) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($personType->id) ?></td>
        </tr>
    </table>
</div>
</div>
