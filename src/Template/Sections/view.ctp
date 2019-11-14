
    <div class="row">
    <div class="col-lg-2">
        <ul class="nav flex-column nav-pills">
        <li class="heading"><?= __('Actions') ?></li>
        <li class="nav-item"><?= $this->Html->link
            (__('Edit Section'),
            ['action' => 'edit', $section->id], ['class' => 'nav-link' ]) ?> </li>
        <li class="nav-item"><?= $this->Form->postLink(__('Delete Section'), ['action' => 'delete', $section->id], [
            'class' => 'nav-link',
            'confirm' => __('Are you sure you want to delete # {0}?', $section->id)]) ?> </li>
        <li class="nav-item"><?= $this->Html->link(__('List Sections'), ['action' => 'index'], ['class' => 'nav-link' ]) ?> </li>
        <li class="nav-item"><?= $this->Html->link(__('New Section'), ['action' => 'add'], ['class' => 'nav-link' ]) ?> </li>
        <li class="nav-item"><?= $this->Html->link(__('List Parts'), ['controller' => 'Parts', 'action' => 'index'], ['class' => 'nav-link' ]) ?> </li>
        <li class="nav-item"><?= $this->Html->link(__('New Part'), ['controller' => 'Parts', 'action' => 'add'], ['class' => 'nav-link' ]) ?> </li>
    </ul>
</div>
<div class="col-lg-10">
    <h3><?= h($section->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Name') ?></th>
            <td><?= h($section->name) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($section->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Sort Order') ?></th>
            <td><?= $this->Number->format($section->sort_order) ?></td>
        </tr>
        <tr>
            <th><?= __('Heading') ?></th>
            <td><?= $section->heading ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Parts') ?></h4>
        <?php if (!empty($section->parts)): ?>
        <table class="table table-bordered table-condensed table-striped table-responsive">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Active') ?></th>
                <th><?= __('Partname') ?></th>
                <th><?= __('Minutes') ?></th>
                <th><?= __('Min Suffix') ?></th>
                <th><?= __('Assistant') ?></th>
                <th><?= __('Section Id') ?></th>
                <th><?= __('Sort Order') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($section->parts as $parts): ?>
            <tr>
                <td><?= h($parts->id) ?></td>
                <td><?= h($parts->active) ?></td>
                <td><?= h($parts->partname) ?></td>
                <td><?= h($parts->minutes) ?></td>
                <td><?= h($parts->min_suffix) ?></td>
                <td><?= h($parts->assistant) ?></td>
                <td><?= h($parts->section_id) ?></td>
                <td><?= h($parts->sort_order) ?></td>
                <td class="actions">
                    <?= $this->Html->link(
                        __('View'), ['controller' => 'Parts', 'action' => 'view', $parts->id]) ?>
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
