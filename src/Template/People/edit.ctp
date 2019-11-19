<div class="row">
    <div class="col-lg-2">
        <ul class="nav flex-column nav-pills">
            <li class="heading"><?= __('Actions') ?></li>
            <li class="nav-item"><?= $this->Form->postLink(
                                        __('Delete'),
                                        ['action' => 'delete', $person->id],
                                        [
                                            'confirm' => __('Are you sure you want to delete # {0}?', $person->id),
                                            'class' => 'nav-link'
                                        ]
                                    )
                                    ?></li>
            <li class="nav-item"><?= $this->Html->link(__('List People'), ['action' => 'index'], ['class' => 'nav-link']) ?></li>


            <li class="nav-item"><?= $this->Html->link(__('List Roles'), ['controller' => 'Roles', 'action' => 'index'], ['class' => 'nav-link']) ?></li>
            <li class="nav-item"><?= $this->Html->link(__('New Role'), ['controller' => 'Roles', 'action' => 'add'], ['class' => 'nav-link']) ?></li>
        </ul>
    </div>
    <div class="col-lg-10">
        <?= $this->Form->create($person) ?>
        <fieldset>
            <legend><?= __('Edit Person') ?></legend>
            <?php
            echo $this->Form->input('active');
            echo $this->Form->input('brother', [
                'label' => false,
                'type' => 'radio',
                'options' => [1 => "Brother", 0 => "Sister"]
            ]);
            echo $this->Form->input('firstname');
            echo $this->Form->input('lastname');
            echo $this->Form->input('roles._ids', [
                'multiple' => 'checkbox',
                'options' => $roles
            ]);
            ?>
        </fieldset>
        <?= $this->Form->button(__('Submit')) ?>
        <?= $this->Form->end() ?>
    </div>
</div>
