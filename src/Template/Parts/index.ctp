
    <div class="row">
    <div class="col-lg-2"><ul class="nav flex-column nav-pills">
        <li class="heading"><?=__('Actions') ?></li>
        <li class="nav-item"><?=$this->Html->link(__('New Part'), ['action' => 'add'], ['class' => 'nav-link' ]) ?></li>
        <li class="nav-item"><?=$this->Html->link(__('List Sections'), ['controller' => 'Sections', 'action' => 'index'], ['class' => 'nav-link' ]) ?></li>
        <li class="nav-item"><?=$this->Html->link(__('New Section'), ['controller' => 'Sections', 'action' => 'add'], ['class' => 'nav-link' ]) ?></li>


        <li class="nav-item"><?=$this->Html->link(__('List Roles'), ['controller' => 'Roles', 'action' => 'index'], ['class' => 'nav-link' ]) ?></li>
        <li class="nav-item"><?=$this->Html->link(__('New Role'), ['controller' => 'Roles', 'action' => 'add'], ['class' => 'nav-link' ]) ?></li>
    </ul>
</div>
<div class="col-lg-10">
    <h3><?=__('Parts') ?></h3>
    <table class="table table-bordered table-condensed table-striped table-responsive">
        <thead>
            <tr>
            <th><?=$this->Paginator->sort('partname') ?></th>
							  <th><?=$this->Paginator->sort('section_id') ?></th>
                <th><?=$this->Paginator->sort('active') ?></th>
                <th><?=$this->Paginator->sort('school_part') ?></th>
								<th><?=$this->Paginator->sort('chairman_part') ?></th>

								<th><?=$this->Paginator->sort('has_auxiliary', 'Auxiliary Classroom') ?></th>
                <th><?=$this->Paginator->sort('co_visit') ?></th>
                <th><?=$this->Paginator->sort('not_co_visit') ?></th>
								<th><?=$this->Paginator->sort('assistant') ?></th>
								<th><?=$this->Paginator->sort('assistant_prefix') ?></th>
                <th><?=$this->Paginator->sort('no_assign') ?></th>

                 <th><?=$this->Paginator->sort('replace_token') ?></th>
                   <th><?=$this->Paginator->sort('start_time') ?></th>
                <th><?=$this->Paginator->sort('minutes') ?></th>
                 <th><?=$this->Paginator->sort('counsel_mins') ?></th>
                <th><?=$this->Paginator->sort('min_suffix') ?></th>


                <th><?=$this->Paginator->sort('sort_order') ?></th>
                <th class="actions"><?=__('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($parts as $part): ?>
            <tr>
                <td><?=h($part->partname) ?></td>
				<td><?=$part->has('section') ? $this->Html->link($part->section->name, ['controller' => 'Sections', 'action' => 'view', $part->section->id ]) : '' ?></td>
                <td class="text-center"><?=$part->active ? $this->Icon->faIcon('fas fa-check') : "" ?></td>
                <td class="text-center"><?=$part->school_part ? $this->Icon->faIcon('fas fa-check') : "" ?></td>
				<td class="text-center"><?=$part->chairman_part ? $this->Icon->faIcon('fas fa-check') : "" ?></td>
				<td class="text-center"><?=$part->has_auxiliary ? $this->Icon->faIcon('fas fa-check') : "" ?></td>
                <td class="text-center"><?=$part->co_visit ? $this->Icon->faIcon('fas fa-check') : "" ?></td>
                <td class="text-center"><?=$part->not_co_visit ? $this->Icon->faIcon('fas fa-check') : "" ?></td>
				<td class="text-center"><?=$part->assistant ? $this->Icon->faIcon('fas fa-check') : "" ?></td>
				<td><?=h($part->assistant_prefix) ?></td>
				<td class="text-center"><?=$part->no_assign ? $this->Icon->faIcon('fas fa-check') : "" ?></td>
                <td><?=h($part->replace_token) ?></td>
                <td><?=$this->Time->format($part->start_time, 'h:mm a') ?></td>
                <td><?=$this->Number->format($part->minutes) ?></td>
                <td><?=$this->Number->format($part->counsel_mins) ?></td>
                <td><?=h($part->min_suffix) ?></td>
                <td><?=$this->Number->format($part->sort_order) ?></td>
                <td class="actions">
                    <?=$this->Html->link(__('View'), ['action' => 'view', $part->id ]) ?>
                    <?=$this->Html->link(__('Edit'), ['action' => 'edit', $part->id]) ?>
                    <?=$this->Form->postLink(__('Delete'), ['action' => 'delete', $part->id], ['confirm' => __('Are you sure you want to delete # {0}?', $part->id)]) ?>
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
