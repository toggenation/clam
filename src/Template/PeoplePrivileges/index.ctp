<div class="row">

    <div class="col-lg-2"><ul class="nav flex-column nav-pills">
        <li class="heading"><?= __('Actions') ?></li>
        <li class="nav-item"><?= $this->Html->link(__('New People Privilege'), ['action' => 'add'], ['class' => 'nav-link' ]) ?></li>
        <li class="nav-item"><?= $this->Html->link(__('List People'), ['controller' => 'People', 'action' => 'index'], ['class' => 'nav-link' ]) ?></li>
        <li class="nav-item"><?= $this->Html->link(__('New Person'), ['controller' => 'People', 'action' => 'add'], ['class' => 'nav-link' ]) ?></li>
        <li class="nav-item"><?= $this->Html->link(__('List Privileges'), ['controller' => 'Privileges', 'action' => 'index'], ['class' => 'nav-link' ]) ?></li>
        <li class="nav-item"><?= $this->Html->link(__('New Privilege'), ['controller' => 'Privileges', 'action' => 'add'], ['class' => 'nav-link' ]) ?></li>
    </ul>
</div>
<div class="col-lg-10">
    <h3><?= __('People Privileges') ?></h3>
    <table class="table table-bordered table-condensed table-striped table-responsive">
        <thead>
            <tr>

                <th><?= $this->Paginator->sort('person_id') ?></th>
                <th><?= $this->Paginator->sort('privilege_id') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($peoplePrivileges as $peoplePrivilege): ?>
            <tr>
                <td><?= $this->Number->format($peoplePrivilege->id) ?></td>
                <td><?= $peoplePrivilege->has('person') ? $this->Html->link($peoplePrivilege->person->full_name, ['controller' => 'People', 'action' => 'view', $peoplePrivilege->person->id, ['class' => 'nav-link' ]) : '' ?></td>
                <td><?= $peoplePrivilege->has('privilege') ? $this->Html->link($peoplePrivilege->privilege->privilege, ['controller' => 'Privileges', 'action' => 'view', $peoplePrivilege->privilege->id, ['class' => 'nav-link' ]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $peoplePrivilege->id, ['class' => 'nav-link' ]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $peoplePrivilege->id, ['class' => 'nav-link' ]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $peoplePrivilege->id], ['confirm' => __('Are you sure you want to delete # {0}?', $peoplePrivilege->id)]) ?>
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
