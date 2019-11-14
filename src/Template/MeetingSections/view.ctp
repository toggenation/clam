<div class="row">
    <div class="col-lg-2"><ul class="nav flex-column nav-pills">
        <li class="heading"><?= __('Actions') ?></li>
        <li class="nav-item"><?= $this->Html->link(__('Edit Meeting Section'), ['action' => 'edit', $meetingSection->id], ['class' => 'nav-link' ]) ?> </li>
        <li class="nav-item"><?= $this->Form->postLink(__('Delete Meeting Section'), ['action' => 'delete', $meetingSection->id], ['confirm' => __('Are you sure you want to delete # {0}?', $meetingSection->id)]) ?> </li>
        <li class="nav-item"><?= $this->Html->link(__('List Meeting Sections'), ['action' => 'index'], ['class' => 'nav-link' ]) ?> </li>
        <li class="nav-item"><?= $this->Html->link(__('New Meeting Section'), ['action' => 'add'], ['class' => 'nav-link' ]) ?> </li>
        <li class="nav-item"><?= $this->Html->link(__('List Parts'), ['controller' => 'Parts', 'action' => 'index'], ['class' => 'nav-link' ]) ?> </li>
        <li class="nav-item"><?= $this->Html->link(__('New Part'), ['controller' => 'Parts', 'action' => 'add'], ['class' => 'nav-link' ]) ?> </li>
    </ul>
    </div>
<div class="col-lg-10">
    <h3><?= h($meetingSection->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Name') ?></th>
            <td><?= h($meetingSection->name) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($meetingSection->id) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Parts') ?></h4>
        <?php if (!empty($meetingSection->parts)): ?>
        <table class="table table-bordered table-condensed table-striped table-responsive">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Active') ?></th>
                <th><?= __('Partname') ?></th>
                <th><?= __('Minutes') ?></th>
                <th><?= __('Meeting Section Id') ?></th>
                <th><?= __('Sort Order') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($meetingSection->parts as $parts): ?>
            <tr>
                <td><?= h($parts->id) ?></td>
                <td><?= h($parts->active) ?></td>
                <td><?= h($parts->partname) ?></td>
                <td><?= h($parts->minutes) ?></td>
                <td><?= h($parts->meeting_section_id) ?></td>
                <td><?= h($parts->sort_order) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Parts', 'action' => 'view', $parts->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Parts', 'action' => 'edit', $parts->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Parts', 'action' => 'delete', $parts->id], ['confirm' => __('Are you sure you want to delete # {0}?', $parts->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
</div>
