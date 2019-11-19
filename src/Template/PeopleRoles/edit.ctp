<div class="row">
    <div class="col-lg-2"><ul class="nav flex-column nav-pills">
        <li class="heading"><?= __('Actions') ?></li>
        <li class="nav-item"><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $peopleRole->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $peopleRole->id)]
            )
        ?></li>
        <li class="nav-item"><?= $this->Html->link(__('List People Roles'), ['action' => 'index'], ['class' => 'nav-link' ]) ?></li>
        <li class="nav-item"><?= $this->Html->link(__('List People'), ['controller' => 'People', 'action' => 'index'], ['class' => 'nav-link' ]) ?></li>
        <li class="nav-item"><?= $this->Html->link(__('New Person'), ['controller' => 'People', 'action' => 'add'], ['class' => 'nav-link' ]) ?></li>
        <li class="nav-item"><?= $this->Html->link(__('List Roles'), ['controller' => 'Roles', 'action' => 'index'], ['class' => 'nav-link' ]) ?></li>
        <li class="nav-item"><?= $this->Html->link(__('New Role'), ['controller' => 'Roles', 'action' => 'add'], ['class' => 'nav-link' ]) ?></li>
    </ul>
</div>
<div class="col-lg-10">
    <?= $this->Form->create($peopleRole) ?>
    <fieldset>
        <legend><?= __('Edit People Role') ?></legend>
        <?php
            echo $this->Form->input('person_id', ['options' => $people, 'empty' => true]);
            echo $this->Form->input('role_id', ['options' => $roles, 'empty' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
</div>
