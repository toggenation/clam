<div class="row">
    <div class="col-lg-2">
        <ul class="nav flex-column nav-pills">
            <li class="heading"><?= __('Actions') ?></li>
            <li class="nav-item"><?= $this->Html->link(__('Edit Person'), ['action' => 'edit', $person->id], [
                                        'class' => 'nav-link'
                                    ]) ?> </li>
            <li class="nav-item"><?= $this->Form->postLink(__('Delete Person'), ['action' => 'delete', $person->id], [
                                        'class' => 'nav-link',
                                        'confirm' => __('Are you sure you want to delete # {0}?', $person->id)
                                    ]) ?> </li>
            <li class="nav-item"><?= $this->Html->link(__('List People'), ['action' => 'index'], ['class' => 'nav-link']) ?> </li>
            <li class="nav-item"><?= $this->Html->link(__('New Person'), ['action' => 'add'], ['class' => 'nav-link']) ?> </li>


            <li class="nav-item"><?= $this->Html->link(__('List Roles'), ['controller' => 'Roles', 'action' => 'index'], ['class' => 'nav-link']) ?> </li>
            <li class="nav-item"><?= $this->Html->link(__('New Role'), ['controller' => 'Roles', 'action' => 'add'], ['class' => 'nav-link']) ?> </li>
        </ul>
    </div>
    <div class="col-lg-10">
        <h3><?= $this->Html->genderIcon($person->brother); ?> <?= h($person->full_name) ?></h3>
        <table class="table table-condensed vertical-table">

            <tr>
                <th><?= __('Firstname') ?></th>
                <td><?= h($person->firstname) ?></td>
            </tr>
            <tr>
                <th><?= __('Lastname') ?></th>
                <td><?= h($person->lastname) ?></td>
            </tr>

            <tr>
                <th><?= __('Id') ?></th>
                <td><?= h($person->id) ?></td>
            </tr>
            <tr>
                <th><?= __('Created') ?></th>
                <td><?= h($person->created) ?></td>
            </tr>
            <tr>
                <th><?= __('Modified') ?></th>
                <td><?= h($person->modified) ?></td>
            </tr>
        </table>
        <div class="related">
            <h4><?= __('Related Assigned') ?></h4>
            <?php if (!empty($person->assigned)) : ?>
                <table class="table table-bordered table-condensed table-striped table-responsive">
                    <tr>
                        <th><?= __('Id') ?></th>

                        <th><?= __('Part Title') ?></th>
                        <th><?= __('Meeting') ?></th>

                        <th><?= __('Assistant') ?></th>
                        <th class="actions"><?= __('Actions') ?></th>
                    </tr>
                    <?php foreach ($person->assigned as $assigned) : ?>
                        <tr>
                            <td><?= h($assigned->id) ?></td>

                            <td><?= h($assigned->part_title) ?></td>
                            <td><?= h($assigned->meeting->date) ?></td>

                            <td><?= h($assigned->assistant) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Assigned', 'action' => 'view', $assigned->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Assigned', 'action' => 'edit', $assigned->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Assigned', 'action' => 'delete', $assigned->id], ['confirm' => __('Are you sure you want to delete # {0}?', $assigned->id)]) ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            <?php endif; ?>
        </div>
        <div class="related">
            <h4><?= __('Related Roles') ?></h4>
            <?php if (!empty($person->roles)) : ?>
                <table class="table table-bordered table-condensed table-striped table-responsive">
                    <tr>
                        <th><?= __('Id') ?></th>
                        <th><?= __('Role') ?></th>
                        <th><?= __('Created') ?></th>
                        <th><?= __('Modified') ?></th>
                        <th class="actions"><?= __('Actions') ?></th>
                    </tr>
                    <?php foreach ($person->roles as $roles) : ?>
                        <tr>
                            <td><?= h($roles->id) ?></td>
                            <td><?= h($roles->role) ?></td>
                            <td><?= h($roles->created) ?></td>
                            <td><?= h($roles->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Roles', 'action' => 'view', $roles->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Roles', 'action' => 'edit', $roles->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Roles', 'action' => 'delete', $roles->id], ['confirm' => __('Are you sure you want to delete # {0}?', $roles->id)]) ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            <?php endif; ?>
        </div>
    </div>
</div>
