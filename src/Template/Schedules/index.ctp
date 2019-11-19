<?php use Cake\Routing\Router; ?>
<div class="row">
    <div class="col-lg-2">
    <ul class="nav flex-column nav-pills">
        <li class="heading"><?=__('Actions') ?></li>


        <li class="nav-item"><?=$this->Html->link(__('New Meeting'), ['controller' => 'Meetings', 'action' => 'add'], ['class' => 'nav-link']) ?></li>
    </ul>
    </div>

<div class="col-lg-10">
    <h3><?=__('Schedules') ?></h3>
    <table class="table table-bordered table-condensed table-striped table-responsive">
        <thead>
            <tr>
                <th><?=$this->Paginator->sort('published') ?></th>
                <th><?=$this->Paginator->sort('start_date') ?></th>
                <th><?=$this->Paginator->sort('end_date') ?></th>
                <th><?=$this->Paginator->sort('month') ?></th>
                <th><?=$this->Paginator->sort('comment') ?></th>
                <th class="actions"><?=__('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($schedules as $schedule): ?>
            <tr>
                <td><?php
$icon = (bool)$schedule->published ? $this->Icon->faIcon("fas fa-check") :
$this->Icon->faIcon('fas fa-times');
echo $this->Form->postLink($icon, ['action' => 'toggleScheduled', $schedule->id], [
    'data-submit' => Router::url(['action' => 'toggleScheduled']),
    'escape' => false,
    'data-id' => $schedule->id,
]);
?></td>
                <td><?=h($schedule->start_date) ?></td>
                <td><?=h($schedule->end_date) ?></td>
                <td><?=h($schedule->month) ?></td>
                <td><?=h($schedule->comment) ?></td>
                <td class="actions">
                    <?=$this->Html->link(__('View'), ['action' => 'view', $schedule->id], ['class' => 'btn btn-sm']) ?>
                    <?=$this->Html->link(__('Edit'), ['action' => 'edit', $schedule->id], ['class' => 'btn btn-sm']) ?>
                    <?=$this->Form->postLink(__('Delete'), ['action' => 'delete', $schedule->id], [
    'class' => 'btn btn-sm',
    'confirm' => __('Are you sure you want to delete # {0}?', $schedule->id)]) ?>
                    <?=$this->Html->link(__('Add Meetings'), ['controller' => 'meetings', 'action' => 'add-meetings', $schedule->id], ['class' => 'btn btn-sm']); ?>
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
