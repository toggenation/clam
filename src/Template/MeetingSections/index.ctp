
    <div class="row">
    <div class="col-lg-2"><ul class="nav flex-column nav-pills">
        <li class="heading"><?=__('Actions') ?></li>
        <li class="nav-item"><?=$this->Html->link(__('New Meeting Section'), ['action' => 'add'], [ 'class' => 'nav-link']) ?></li>
        <li class="nav-item"><?=$this->Html->link(__('List Parts'), ['controller' => 'Parts', 'action' => 'index'], [ 'class' => 'nav-link']) ?></li>
        <li class="nav-item"><?=$this->Html->link(__('New Part'), ['controller' => 'Parts', 'action' => 'add'], [ 'class' => 'nav-link']) ?></li>
    </ul>
    </div>
<div class="col-lg-10">
    <h3><?=__('Meeting Sections') ?></h3>
    <table class="table table-bordered table-condensed table-striped table-responsive">
        <thead>
            <tr>

                <th><?=$this->Paginator->sort('name') ?></th>
                <th class="actions"><?=__('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($meetingSections as $meetingSection): ?>
            <tr>
                <td><?=$this->Number->format($meetingSection->id) ?></td>
                <td><?=h($meetingSection->name) ?></td>
                <td class="actions">
                    <?=$this->Html->link(__('View'), ['action' => 'view', $meetingSection->id]) ?>
                    <?=$this->Html->link(__('Edit'), ['action' => 'edit', $meetingSection->id]) ?>
                    <?=$this->Form->postLink(__('Delete'), ['action' => 'delete', $meetingSection->id], ['confirm' => __('Are you sure you want to delete # {0}?', $meetingSection->id)]) ?>
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
