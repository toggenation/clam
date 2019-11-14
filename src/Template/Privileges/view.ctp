<div class="row">
    <div class="col-lg-2"><ul class="nav flex-column nav-pills">
        <li class="heading"><?= __('Actions') ?></li>
        <li class="nav-item"><?= $this->Html->link(
            __('Edit Privilege'), ['action' => 'edit', $privilege->id], ['class' => 'nav-link' ]) ?> </li>
        <li class="nav-item"><?= $this->Form->postLink(__('Delete Privilege'), ['action' => 'delete', $privilege->id],

        [
            'class' => 'nav-link',
            'confirm' => __('Are you sure you want to delete # {0}?', $privilege->id)]) ?> </li>
        <li class="nav-item"><?= $this->Html->link(__('List Privileges'), ['action' => 'index'], ['class' => 'nav-link' ]) ?> </li>
        <li class="nav-item"><?= $this->Html->link(__('New Privilege'), ['action' => 'add'], ['class' => 'nav-link' ]) ?> </li>
        <li class="nav-item"><?= $this->Html->link(__('List Parts'), ['controller' => 'Parts', 'action' => 'index'], ['class' => 'nav-link' ]) ?> </li>
        <li class="nav-item"><?= $this->Html->link(__('New Part'), ['controller' => 'Parts', 'action' => 'add'], ['class' => 'nav-link' ]) ?> </li>
        <li class="nav-item"><?= $this->Html->link(__('List People'), ['controller' => 'People', 'action' => 'index'], ['class' => 'nav-link' ]) ?> </li>
        <li class="nav-item"><?= $this->Html->link(__('New Person'), ['controller' => 'People', 'action' => 'add'], ['class' => 'nav-link' ]) ?> </li>
    </ul>
</div>
<div class="col-lg-10">
    <h3><?= h($privilege->privilege) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Privilege') ?></th>
            <td><?= h($privilege->privilege) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>

        </tr>
        <tr>
            <th><?= __('Assistant') ?></th>
            <td><?= h($privilege->assistant) ?></td>
        </tr>

    </table>
    <div class="related">
        <h4><?= __('Related Parts') ?></h4>
        <?php if (!empty($privilege->parts)): ?>
        <table class="table table-bordered table-condensed table-striped table-responsive">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Active') ?></th>
                <th><?= __('Partname') ?></th>
                <th><?= __('Minutes') ?></th>
                <th><?= __('Min Suffix') ?></th>
                <th><?= __('Assistant') ?></th>
                <th><?= __('Section Id') ?></th>
                <th><?= __('Sort Order') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($privilege->parts as $parts): ?>
            <tr>
                <td><?= h($parts->id) ?></td>
                <td><?= h($parts->active) ?></td>
                <td><?= h($parts->partname) ?></td>
                <td><?= h($parts->minutes) ?></td>
                <td><?= h($parts->min_suffix) ?></td>
                <td><?= h($parts->assistant) ?></td>
                <td><?= h($parts->section_id) ?></td>
                <td><?= h($parts->sort_order) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'),
                    ['controller' => 'Parts', 'action' => 'view', $parts->id]) ?>
                    <?= $this->Html->link(__('Edit'),
                    ['controller' => 'Parts', 'action' => 'edit', $parts->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Parts', 'action' => 'delete', $parts->id], ['confirm' => __('Are you sure you want to delete # {0}?', $parts->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related People') ?></h4>
        <?php if (!empty($privilege->people)): ?>
        <table class="table table-bordered table-condensed table-striped table-responsive">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Firstname') ?></th>
                <th><?= __('Lastname') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($privilege->people as $people): ?>
            <tr>
                <td><?= h($people->id) ?></td>
                <td><?= h($people->firstname) ?></td>
                <td><?= h($people->lastname) ?></td>
                <td><?= h($people->created) ?></td>
                <td><?= h($people->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(
                        __('View'), ['controller' => 'People', 'action' => 'view', $people->id], ['class' => 'nav-link' ]) ?>
                    <?= $this->Html->link(
                        __('Edit'), ['controller' => 'People', 'action' => 'edit', $people->id], ['class' => 'nav-link' ]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'People', 'action' => 'delete', $people->id], ['confirm' => __('Are you sure you want to delete # {0}?', $people->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
</div>
