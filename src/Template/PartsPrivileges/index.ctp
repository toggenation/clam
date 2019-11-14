
    <div class="col-lg-2"><ul class="nav flex-column nav-pills">
        <li class="heading"><?= __('Actions') ?></li>
        <li class="nav-item"><?= $this->Html->link(__('New Parts Privilege'), ['action' => 'add'], ['class' => 'nav-link' ]) ?></li>
        <li class="nav-item"><?= $this->Html->link(__('List Parts'), ['controller' => 'Parts', 'action' => 'index'], ['class' => 'nav-link' ]) ?></li>
        <li class="nav-item"><?= $this->Html->link(__('New Part'), ['controller' => 'Parts', 'action' => 'add'], ['class' => 'nav-link' ]) ?></li>
        <li class="nav-item"><?= $this->Html->link(__('List Privileges'), ['controller' => 'Privileges', 'action' => 'index'], ['class' => 'nav-link' ]) ?></li>
        <li class="nav-item"><?= $this->Html->link(__('New Privilege'), ['controller' => 'Privileges', 'action' => 'add'], ['class' => 'nav-link' ]) ?></li>
    </ul>
</div>
<div class="col-lg-10">
    <h3><?= __('Parts Privileges') ?></h3>
    <table class="table table-bordered table-condensed table-striped table-responsive">
        <thead>
            <tr>

                <th><?= $this->Paginator->sort('part_id') ?></th>
                <th><?= $this->Paginator->sort('privilege_id') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($partsPrivileges as $partsPrivilege): ?>
            <tr>
                <td><?= $this->Number->format($partsPrivilege->id) ?></td>
                <td><?= $partsPrivilege->has('part') ? $this->Html->link($partsPrivilege->part->id, ['controller' => 'Parts', 'action' => 'view', $partsPrivilege->part->id, ['class' => 'nav-link' ]) : '' ?></td>
                <td><?= $partsPrivilege->has('privilege') ? $this->Html->link($partsPrivilege->privilege->privilege, ['controller' => 'Privileges', 'action' => 'view', $partsPrivilege->privilege->id, ['class' => 'nav-link' ]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $partsPrivilege->id, ['class' => 'nav-link' ]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $partsPrivilege->id, ['class' => 'nav-link' ]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $partsPrivilege->id], ['confirm' => __('Are you sure you want to delete # {0}?', $partsPrivilege->id)]) ?>
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
