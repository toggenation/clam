
    <div class="col-lg-2"><ul class="nav flex-column nav-pills">
        <li class="heading"><?= __('Actions') ?></li>
        <li class="nav-item"><?= $this->Html->link(__('New Parts Role'), ['action' => 'add'], ['class' => 'nav-link' ]) ?></li>
        <li class="nav-item"><?= $this->Html->link(__('List Parts'), ['controller' => 'Parts', 'action' => 'index'], ['class' => 'nav-link' ]) ?></li>
        <li class="nav-item"><?= $this->Html->link(__('New Part'), ['controller' => 'Parts', 'action' => 'add'], ['class' => 'nav-link' ]) ?></li>
        <li class="nav-item"><?= $this->Html->link(__('List Roles'), ['controller' => 'Roles', 'action' => 'index'], ['class' => 'nav-link' ]) ?></li>
        <li class="nav-item"><?= $this->Html->link(__('New Role'), ['controller' => 'Roles', 'action' => 'add'], ['class' => 'nav-link' ]) ?></li>
    </ul>
</div>
<div class="col-lg-10">
    <h3><?= __('Parts Roles') ?></h3>
    <table class="table table-bordered table-condensed table-striped table-responsive">
        <thead>
            <tr>

                <th><?= $this->Paginator->sort('part_id') ?></th>
                <th><?= $this->Paginator->sort('role_id') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($partsRoles as $partsRole): ?>
            <tr>
                <td><?= $this->Number->format($partsRole->id) ?></td>
                <td><?= $partsRole->has('part') ? $this->Html->link($partsRole->part->id, ['controller' => 'Parts', 'action' => 'view', $partsRole->part->id, ['class' => 'nav-link' ]) : '' ?></td>
                <td><?= $partsRole->has('role') ? $this->Html->link($partsRole->role->role, ['controller' => 'Roles', 'action' => 'view', $partsRole->role->id, ['class' => 'nav-link' ]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $partsRole->id, ['class' => 'nav-link' ]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $partsRole->id, ['class' => 'nav-link' ]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $partsRole->id], ['confirm' => __('Are you sure you want to delete # {0}?', $partsRole->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
    <ul class="pagination">
    <?=$this->Paginator->first($this->Icon->faIcon('fas fa-angle-double-left') . ' ' . __('first'), ['escape' => false]) ?>
    <?=$this->Paginator->prev($this->Icon->faIcon('fas fa-angle-left') . ' ' . __('previous'), ['escape' => false]) ?>
    <?=$this->Paginator->numbers(['wrapWithUL' => false]) ?>
    <?=$this->Paginator->next(__('next') . ' ' . $this->Icon->faIcon('fas fa-angle-right'), ['escape' => false]) ?>
    <?=$this->Paginator->last(__('last') . ' ' . $this->Icon->faIcon('fas fa-angle-double-right'), ['escape' => false]); ?>
</ul>
  <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
