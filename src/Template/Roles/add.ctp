<div class="row">
    <div class="col-lg-2"><ul class="nav flex-column nav-pills">
        <li class="heading"><?= __('Actions') ?></li>
        <li class="nav-item"><?= $this->Html->link(__('List Roles'), ['action' => 'index'], ['class' => 'nav-link' ]) ?></li>
        <li class="nav-item"><?= $this->Html->link(__('List Parts'), ['controller' => 'Parts', 'action' => 'index'], ['class' => 'nav-link' ]) ?></li>
        <li class="nav-item"><?= $this->Html->link(__('New Part'), ['controller' => 'Parts', 'action' => 'add'], ['class' => 'nav-link' ]) ?></li>
        <li class="nav-item"><?= $this->Html->link(__('List People'), ['controller' => 'People', 'action' => 'index'], ['class' => 'nav-link' ]) ?></li>
        <li class="nav-item"><?= $this->Html->link(__('New Person'), ['controller' => 'People', 'action' => 'add'], ['class' => 'nav-link' ]) ?></li>
    </ul>
</div>
<div class="col-lg-10">
    <?= $this->Form->create($role) ?>
    <fieldset>
        <legend><?= __('Add Role') ?></legend>
        <?php
            echo $this->Form->input('role');
            echo $this->Form->input('assistant');

            echo $this->Form->input('parts._ids', [
                'multiple' => 'checkbox',
                'options' => $parts]);
            echo $this->Form->input('people._ids', [
                'multiple' => 'checkbox',
                'escape' => false,
                'options' => $people]);

        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
</div>
