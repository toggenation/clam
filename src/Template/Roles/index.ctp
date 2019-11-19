<div class="row">
    <div class="col-lg-2"><ul class="nav flex-column nav-pills">
        <li class="heading"><?= __('Actions') ?></li>
        <li class="nav-item"><?= $this->Html->link(__('New Role'), ['action' => 'add'], ['class' => 'nav-link' ]) ?></li>
        <li class="nav-item"><?= $this->Html->link(__('List Parts'), ['controller' => 'Parts', 'action' => 'index'], ['class' => 'nav-link' ]) ?></li>
        <li class="nav-item"><?= $this->Html->link(__('New Part'), ['controller' => 'Parts', 'action' => 'add'], ['class' => 'nav-link' ]) ?></li>
        <li class="nav-item"><?= $this->Html->link(__('List People'), ['controller' => 'People', 'action' => 'index'], ['class' => 'nav-link' ]) ?></li>
        <li class="nav-item"><?= $this->Html->link(__('New Person'), ['controller' => 'People', 'action' => 'add'], ['class' => 'nav-link' ]) ?></li>
    </ul>
</div>
<div class="col-lg-10">
    <h3><?= __('Roles') ?></h3>
    <table class="table table-bordered table-condensed table-striped">
        <thead>
            <tr>


                <th><?= $this->Paginator->sort('role') ?></th>
                <th><?= $this->Paginator->sort('assistant') ?></th>

                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($roles as $role): ?>
            <tr>

                <td><?= h($role->role) ?></td>
                 <td class="text-center"><?= $role->assistant === true ? $this->Icon->faIcon('fas fa-check'): ""?></td>


                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $role->id ]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $role->id ]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $role->id], ['confirm' => __('Are you sure you want to delete # {0}?', $role->id)]) ?>
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
</div>
