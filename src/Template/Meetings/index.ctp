<div class="row">
<div class="col-lg-2">
    <ul class="nav flex-column nav-pills">
        <li class="heading"><?=__('Actions') ?></li>
        <li class="nav-item"><?=$this->Html->link(__('New Meeting'), ['action' => 'add'], ['class' => 'nav-link']) ?></li>
        <li class="nav-item"><?=$this->Html->link(__('List Schedules'), ['controller' => 'Schedules', 'action' => 'index'], ['class' => 'nav-link']) ?></li>
        <li class="nav-item"><?=$this->Html->link(__('New Schedule'), ['controller' => 'Schedules', 'action' => 'add'], ['class' => 'nav-link']) ?></li>
        <li class="nav-item"><?=$this->Html->link(__('List Assigned'), ['controller' => 'Assigned', 'action' => 'index'], ['class' => 'nav-link']) ?></li>
        <li class="nav-item"><?=$this->Html->link(__('New Assigned'), ['controller' => 'Assigned', 'action' => 'add'], ['class' => 'nav-link']) ?></li>
        <li class="nav-item"><?=$this->Html->link(__('Add Meetings'), ['action' => 'add_meetings'], ['class' => 'nav-link']) ?></li>
    </ul>
</div>
<div class="col-lg-10">
    <h3><?=__('Meetings') ?></h3>
    <table class="table table-bordered table-condensed table-striped table-responsive">
        <!-- class="table table-bordered table-condensed table-striped table-responsive" -->
        <thead>
            <tr>
                  <th><?=$this->Paginator->sort('person_id', ['label' => "Chairman"]) ?></th>
                    <th><?=$this->Paginator->sort('auxiliary_counselor_id') ?></th>
                <th><?=$this->Paginator->sort('date') ?></th>
                <th><?=$this->Paginator->sort('schedule_id') ?></th>
                <th><?=$this->Paginator->sort('co_visit') ?></th>
                <th class="actions"><?=__('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($meetings as $meeting): ?>
            <tr>
                <td><?=$meeting->has('chairman') ? h($meeting->chairman->full_name) : ''; ?></td>
								<td><?=$meeting->has('auxiliary_counselor') ? h($meeting->auxiliary_counselor->full_name) : ''; ?></td>
                <td><?=$this->Time->format($meeting->date, 'EE d MMM yyyy'); ?></td>
                <td><?=$meeting->has('schedule') ? $this->Html->link($meeting->schedule->month, ['controller' => 'Schedules', 'action' => 'view', $meeting->schedule->id], ['class' => 'nav-link']) : '' ?></td>
                <td><?=$meeting->co_visit; ?></td>
                <td class="actions">
                    <?=$this->Html->link(__('View'), ['action' => 'view', $meeting->id], ['class' => 'btn btn-sm']) ?>
                    <?=$this->Html->link(__('Edit'), ['action' => 'edit', $meeting->id], ['class' => 'btn btn-sm']) ?>
                    <?=$this->Form->postLink(__('Delete'), ['action' => 'delete', $meeting->id], [
    'class' => 'btn btn-sm',
    'confirm' => __('Are you sure you want to delete # {0}?', $meeting->id)]) ?>

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
