
    <div class="row">
    <div class="col-lg-2"><ul class="nav flex-column nav-pills">
        <li class="heading"><?= __('Actions') ?></li>
        <li class="nav-item"><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $privilege->id],
                [
                    'class' => 'nav-link',
                    'confirm' => __('Are you sure you want to delete # {0}?', $privilege->id)]
            )
        ?></li>
        <li class="nav-item"><?= $this->Html->link(__('List Privileges'), ['action' => 'index'], ['class' => 'nav-link' ]) ?></li>
        <li class="nav-item"><?= $this->Html->link(__('List Parts'), ['controller' => 'Parts', 'action' => 'index'], ['class' => 'nav-link' ]) ?></li>
        <li class="nav-item"><?= $this->Html->link(__('New Part'), ['controller' => 'Parts', 'action' => 'add'], ['class' => 'nav-link' ]) ?></li>
        <li class="nav-item"><?= $this->Html->link(__('List People'), ['controller' => 'People', 'action' => 'index'], ['class' => 'nav-link' ]) ?></li>
        <li class="nav-item"><?= $this->Html->link(__('New Person'), ['controller' => 'People', 'action' => 'add'], ['class' => 'nav-link' ]) ?></li>
    </ul>
</div>
<div class="col-lg-10">
    <?= $this->Form->create($privilege) ?>
    <fieldset>
        <legend><?= __('Edit Privilege') ?></legend>
        <?php

            echo $this->Form->input('privilege');
            echo $this->Form->input('assistant');


            echo $this->Form->input('parts._ids', [
                'options' => $parts,
                'multiple' => 'checkbox',

                ]);
            echo $this->Form->input('people._ids', [
                'escape' => false,
                'options' => $people,
                'multiple' => 'checkbox']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
</div>
