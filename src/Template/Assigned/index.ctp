<div class="row">
    <div class="col-lg-2"><ul class="nav flex-column nav-pills">
        <li class="heading"><?= __('Actions') ?></li>

        <li class="nav-item"><?= $this->Html->link(__('List Parts'), ['controller' => 'Parts', 'action' => 'index'], ['class' => 'nav-link' ]) ?></li>
        <li class="nav-item"><?= $this->Html->link(__('New Part'), ['controller' => 'Parts', 'action' => 'add'], ['class' => 'nav-link' ]) ?></li>

        <li class="nav-item"><?= $this->Html->link(__('New Meeting'), ['controller' => 'Meetings', 'action' => 'add'], ['class' => 'nav-link' ]) ?></li>
        <li class="nav-item"><?= $this->Html->link(__('List People'), ['controller' => 'People', 'action' => 'index'], ['class' => 'nav-link' ]) ?></li>
        <li class="nav-item"><?= $this->Html->link(__('New Person'), ['controller' => 'People', 'action' => 'add'], ['class' => 'nav-link' ]) ?></li>
    </ul>
    </div>
<div class="col-lg-10">
    <h3><?= __('Assigned') ?></h3>
    <table class="table table-bordered table-condensed table-striped table-responsive">
        <thead>
            <tr>

                <th><?= $this->Paginator->sort('part_id') ?></th>
                <th><?= $this->Paginator->sort('start_time') ?></th>
                <th><?= $this->Paginator->sort('part_title') ?></th>
                <th><?= $this->Paginator->sort('minutes') ?></th>
                <th><?= $this->Paginator->sort('meeting_id') ?></th>
                <th><?= $this->Paginator->sort('person_id') ?></th>
                <th><?= $this->Paginator->sort('assistant') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($assigned as $assigned): ?>
            <tr>

                <td><?= $assigned->has('part') ? $this->Html->link($assigned->part->partname, ['controller' => 'Parts', 'action' => 'view', $assigned->part->id]) : '' ?></td>
                <td><?= h($assigned->start_time) ?></td>
                <td><?= h($assigned->part_title) ?></td>
                <td><?= $this->Number->format($assigned->minutes) ?></td>
                <td><?= $assigned->has('meeting') ? $this->Html->link($assigned->meeting->date, ['controller' => 'Meetings', 'action' => 'view', $assigned->meeting->id]) : '' ?></td>
                <td><?= $assigned->has('person') ? $this->Html->link($assigned->person->full_name, ['controller' => 'People', 'action' => 'view', $assigned->person->id]) : '' ?></td>
                <td><?= $assigned->has('assistant') ? $this->Html->link($assigned->assistant->full_name, ['controller' => 'People', 'action' => 'view', $assigned->assistant->id ]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $assigned->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $assigned->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $assigned->id], ['confirm' => __('Are you sure you want to delete # {0}?', $assigned->id)]) ?>
                </td>
            </tr>
<!--            <tr><td><?php debug($assigned->toArray()); ?></td></tr>-->
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
         <!-- <p><?php echo $this->Paginator->counter(
    'Page {{page}} of {{pages}}, showing {{current}} records out of
     {{count}} total, starting on record {{start}}, ending on {{end}}'
); ?></p>
<p><?php echo $this->Paginator->counter([ 'format' => 'range']); ?></p> -->
    </div>
</div>
</div>
