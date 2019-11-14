<?php if (!$schedules->isEmpty()): ?>
<div class="row">

    <div class="col-lg-12">


        <div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading"><h4>Christian Life and Ministry Schedules</h4></div>

  <!-- Table -->
	<div class="table-responsive">
  <table class="table table-striped table-bordered table-hover table-sm">
      <thead>
      <tr>
           <th>
            <?=$this->Paginator->sort('start_date', 'Month', ['direction' => 'DESC']); ?>
            </th>
            <th>
                Dates
            </th>
            <th>
                Edit
            </th>
            <th>
                PDF
            </th>
            <th>
                Assignments
            </th>

						<th>
							<?=$this->Paginator->sort('published'); ?>
						</th>
						<th>
								Delete
						</th>
      </tr>
			</thead>
      <tbody>
           <?php foreach ($schedules as $sched): ?>
            <tr>
                <td>
                   <?=$sched->month . ' ' . $sched->full_year; ?>

                </td>
                <td>
                    <?=$sched->start_date . ' - ' . $sched->end_date; ?>

                </td>


                <td>
                    <?php
$icon = $sched->published ? 'fas fa-lock' : "fas fa-pencil-alt";
$icon_glyph = $this->Icon->faIcon($icon);
?>

                    <?=
$this->Html->link(
    $icon_glyph, ['controller' => 'assigned',
        'action' => 'scheduleEdit', 'id' => $sched->id], [
        'title' => $sched->published ? "Published" : "Incomplete",
        'escape' => false,
        'class' => 'btn btn-link btn-xs']);
?>

                </td>

                <td>

                    <?=
$this->Html->link(
    $this->Icon->faIcon("fas fa-file-pdf"), [
        'action' => 'pdf-view', $sched->id], [
        'class' => 'btn btn-link btn-xs',
        'title' => "Click to view or print PDF",
        'escape' => false,
        'aria-hidden' => "true",
    ]);
?>

                </td>

                <td>
                    <?=
$this->Html->link(
    $this->Icon->faIcon("fas fa-users"), ['controller' => 'people',
        'action' => 'view-who', $sched->id], [
        'title' => 'View assigned people',
        'escape' => false,
        'class' => 'btn btn-link btn-xs',
    ]);
?>


                </td>

								<td>
									<?php $icon = $sched->published ? 'on' : "off";
$format = 'fas fa-toggle-%s';

echo $this->Form->postLink(
    $this->Html->tag('i', '', ['class' => sprintf($format, $icon)])
    , [
        'action' => 'toggleScheduled',
        $sched->id,
    ],
    [
        'class' => "btn btn-link btn-xs",
        'title' => 'Toggle published',
        'escape' => false,
        'data-id' => $sched->id,
    ]
);
?>
								</td>
								<td>
										<?php echo $this->Form->postLink(
    $this->Html->tag('i', '', ['class' => 'fas fa-trash-alt']),
    [
        'action' => 'delete',
        $sched->id,

    ],
    [
        'escape' => false,
        'class' => "btn btn-link btn-xs",
        'title' => 'Delete the schedule',
        'confirm' => "Deleting a schedule will remove all meetings and part assignments"]
); ?>
								</td>

            </tr>
    <?php endforeach; ?>


      </tbody>
  </table>

</div>
</div>
<div class="paginator">
<ul class="pagination">
            <?=$this->Paginator->first($this->Icon->faIcon('fas fa-angle-double-left') . ' ' . __('first'), ['escape' => false]) ?>
            <?=$this->Paginator->prev($this->Icon->faIcon('fas fa-angle-left') . ' ' . __('previous'), ['escape' => false]) ?>
            <?=$this->Paginator->numbers(['wrapWithUL' => false]) ?>
            <?=$this->Paginator->next(__('next') . ' ' . $this->Icon->faIcon('fas fa-angle-right'), ['escape' => false]) ?>
            <?=$this->Paginator->last(__('last') . ' ' . $this->Icon->faIcon('fas fa-angle-double-right'), ['escape' => false]); ?>
        </ul>
          <p><?=$this->Paginator->counter() ?></p>
</div>



<?php else: ?>

        <p>You need to add a Schedule, Meetings and Parts</p>

<?php endif; ?>
</div>
                                </div>
