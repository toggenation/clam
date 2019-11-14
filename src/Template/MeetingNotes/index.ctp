<div class="row">
<nav class="col-lg-2 large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav nav nav-pills nav-stacked">
        <li class="heading"><?= __('Actions') ?></li>
        <li class="nav-item"><?= $this->Html->link(__('New Meeting Note'), ['action' => 'add'], ['class' => 'nav-link' ]) ?></li>
    </ul>
</nav>
<div class="meetingNotes index col-lg-10 large-9 medium-8 columns content">
    <h3><?= __('Meeting Notes') ?></h3>
      <table class="table table-bordered table-condensed table-striped table-responsive">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
								<th><?= $this->Paginator->sort('Meetings.date', "Schedule") ?></th>
                <th><?= $this->Paginator->sort('meeting_id') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('modified') ?></th>
                <th><?= $this->Paginator->sort('heading') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($meetingNotes as $meetingNote): ?>
							<?php $schedule_id = $meetingNote->meeting->schedule_id;
										$monthYear = h($meetingNote->meeting->schedule->month . ' ' . $this->Time->format($meetingNote->meeting->schedule->start_date, 'YYYY')) ;

							?>

            <tr>
                <td><?= $this->Number->format($meetingNote->id) ?></td>
				<td><?=$this->Html->link( $monthYear, ['controller' => 'Assigned', 'action' => 'editAssignments' , $schedule_id])?></td>
                <td><?= $this->Time->format($meetingNote->meeting->date, 'd/M/Y') ?></td>
                <td><?= h($meetingNote->created) ?></td>
                <td><?= h($meetingNote->modified) ?></td>
                <td><?= h($meetingNote->heading) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $meetingNote->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $meetingNote->id ]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $meetingNote->id], ['confirm' => __('Are you sure you want to delete # {0}?', $meetingNote->id)]) ?>
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
