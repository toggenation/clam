    <div class="row">
    <div class="col-lg-2">
        <ul class="nav flex-column nav-pills">
            <li class="heading"><?= __('Actions') ?></li>
            <li class="nav-item"><?= $this->Html->link(
                                        __('Edit Part'),
                                        ['action' => 'edit', $part->id],
                                        ['class' => 'nav-link']
                                    ); ?> </li>
            <li class="nav-item"><?= $this->Form->postLink(__('Delete Part'), ['action' => 'delete', $part->id], [
                'class' => 'nav-link',
                'confirm' => __('Are you sure you want to delete # {0}?', $part->id)]) ?> </li>
            <li class="nav-item"><?= $this->Html->link(__('List Parts'), ['action' => 'index'], ['class' => 'nav-link']) ?> </li>
            <li class="nav-item"><?= $this->Html->link(__('New Part'), ['action' => 'add'], ['class' => 'nav-link']) ?> </li>
            <li class="nav-item"><?= $this->Html->link(__('List Sections'), ['controller' => 'Sections', 'action' => 'index'], ['class' => 'nav-link']) ?> </li>
            <li class="nav-item"><?= $this->Html->link(__('New Section'), ['controller' => 'Sections', 'action' => 'add'], ['class' => 'nav-link']) ?> </li>
            <li class="nav-item"><?= $this->Html->link(__('List Assigned'), ['controller' => 'Assigned', 'action' => 'index'], ['class' => 'nav-link']) ?> </li>
            <li class="nav-item"><?= $this->Html->link(__('New Assigned'), ['controller' => 'Assigned', 'action' => 'add'], ['class' => 'nav-link']) ?> </li>
            <li class="nav-item"><?= $this->Html->link(__('List Privileges'), ['controller' => 'Privileges', 'action' => 'index'], ['class' => 'nav-link']) ?> </li>
            <li class="nav-item"><?= $this->Html->link(__('New Privilege'), ['controller' => 'Privileges', 'action' => 'add'], ['class' => 'nav-link']) ?> </li>
        </ul>
    </div>
    <div class="col-lg-10">
        <h3><?= h($part->id) ?></h3>
        <table class="vertical-table">
            <tr>
                <th><?= __('Partname') ?></th>
                <td><?= h($part->partname) ?></td>
            </tr>
            <tr>
                <th><?= __('School Part') ?></th>
                <td><?= h($part->school_part) ?></td>
            </tr>
            <tr>
                <th><?= __('Linked to Part') ?></th>
                <td><?= $part->link_to ? $part->link_to : '' ?></td>
            </tr>
            <tr>
                <th><?= __('CO Visit Part') ?></th>
                <td><?= $part->co_visit ? $part->co_visit : '' ?></td>
            </tr>
            <tr>
                <th><?= __('Not CO Visit') ?></th>
                <td><?= $part->not_co_visit ? $part->not_co_visit : '' ?></td>
            </tr>
            <tr>
                <th><?= __('Replace Token') ?></th>
                <td><?= h($part->replace_token) ?></td>
            </tr>
            <tr>
                <th><?= __('Start Time') ?></th>
                <td><?= $this->Time->format($part->start_time, 'H:m') ?></td>
            </tr>
            <tr>
                <th><?= __('Min Suffix') ?></th>
                <td><?= h($part->min_suffix) ?></td>
            </tr>
            <tr>
                <th><?= __('Section') ?></th>
                <td><?= $part->has('section') ?
                        $this->Html->link(
                            $part->section->name,
                            ['controller' => 'Sections', 'action' => 'view', $part->section->id],
                            ['class' => 'nav-link']
                        ) : '' ?></td>
            </tr>
            <tr>
                <th><?= __('Id') ?></th>

            </tr>
            <tr>
                <th><?= __('Minutes') ?></th>
                <td><?= $this->Number->format($part->minutes) ?></td>
            </tr>
            <tr>
                <th><?= __('Counsel Minutes') ?></th>
                <td><?= $this->Number->format($part->counsel_mins) ?></td>
            </tr>
            <tr>
                <th><?= __('Sort Order') ?></th>
                <td><?= $this->Number->format($part->sort_order) ?></td>
            </tr>
            <tr>
                <th><?= __('Active') ?></th>
                <td><?= $part->active ? __('Yes') : __('No'); ?></td>
            </tr>
            <tr>
                <th><?= __('Assistant') ?></th>
                <td><?= $part->assistant ? __('Yes') : __('No'); ?></td>
            </tr>
            <tr>
                <th><?= __('No Assign') ?></th>
                <td><?= $part->no_assign ? __('Yes') : __('No'); ?></td>
            </tr>
        </table>
        <div class="related">
            <h4><?= __('Related Assigned') ?></h4>
            <?php if (!empty($part->assigned)) : ?>
                <table class="table table-bordered table-condensed table-striped table-responsive">
                    <tr>
                        <th><?= __('Id') ?></th>
                        <th><?= __('Part Id') ?></th>
                        <th><?= __('Part Title') ?></th>
                        <th><?= __('Meeting Id') ?></th>
                        <th><?= __('Person Id') ?></th>
                        <th><?= __('Assistant') ?></th>
                        <th class="actions"><?= __('Actions') ?></th>
                    </tr>
                    <?php foreach ($part->assigned as $assigned) : ?>
                        <tr>
                            <td><?= h($assigned->id) ?></td>
                            <td><?= h($assigned->part_id) ?></td>
                            <td><?= h($assigned->part_title) ?></td>
                            <td><?= $assigned->has('meeting') ? h($assigned->meeting->date) : ""; ?></td>
                            <td><?= $assigned->has('person') ? $assigned->person->full_name : "" ?></td>
                            <td><?= $assigned->has('assistant') ? h($assigned->assistant->full_name) : "" ?></td>
                            <td class="actions">
                                <?= $this->Html->link(
                                            __('View'),
                                            ['controller' => 'Assigned', 'action' => 'view', $assigned->id],
                                        ) ?>
                                <?= $this->Html->link(
                                            __('Edit'),
                                            ['controller' => 'Assigned', 'action' => 'edit', $assigned->id],
                                        ) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Assigned', 'action' => 'delete', $assigned->id], ['confirm' => __('Are you sure you want to delete # {0}?', $assigned->id)]) ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            <?php endif; ?>
        </div>
        <div class="related">
            <h4><?= __('Related Privileges') ?></h4>
            <?php if (!empty($part->privileges)) : ?>
                <table class="table table-bordered table-condensed table-striped table-responsive">
                    <tr>
                        <th><?= __('Id') ?></th>
                        <th><?= __('Privilege') ?></th>
                        <th><?= __('Created') ?></th>
                        <th><?= __('Modified') ?></th>
                        <th class="actions"><?= __('Actions') ?></th>
                    </tr>
                    <?php foreach ($part->privileges as $privileges) : ?>
                        <tr>
                            <td><?= h($privileges->id) ?></td>
                            <td><?= h($privileges->privilege) ?></td>
                            <td><?= h($privileges->created) ?></td>
                            <td><?= h($privileges->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(
                                            __('View'),
                                            ['controller' => 'Privileges', 'action' => 'view', $privileges->id],

                                        ) ?>
                                <?= $this->Html->link(
                                            __('Edit'),
                                            ['controller' => 'Privileges', 'action' => 'edit', $privileges->id],

                                        ) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Privileges', 'action' => 'delete', $privileges->id], ['confirm' => __('Are you sure you want to delete # {0}?', $privileges->id)]) ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            <?php endif; ?>
        </div>
    </div>
    </div>
