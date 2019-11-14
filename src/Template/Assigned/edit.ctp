<div class="row">
    <div class="col-lg-2"><ul class="nav flex-column nav-pills">
        <li class="heading"><?= __('Actions') ?></li>
        <li class="nav-item"><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $assigned->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $assigned->id),
                'class' => 'nav-link']
            )
        ?></li>
        <li class="nav-item"><?= $this->Html->link(__('List Assigned'), ['action' => 'index'], ['class' => 'nav-link' ]) ?></li>
        <li class="nav-item"><?= $this->Html->link(__('List Parts'), ['controller' => 'Parts', 'action' => 'index'], ['class' => 'nav-link' ]) ?></li>
        <li class="nav-item"><?= $this->Html->link(__('New Part'), ['controller' => 'Parts', 'action' => 'add'], ['class' => 'nav-link' ]) ?></li>
        <li class="nav-item"><?= $this->Html->link(__('List Meetings'), ['controller' => 'Meetings', 'action' => 'index'], ['class' => 'nav-link' ]) ?></li>
        <li class="nav-item"><?= $this->Html->link(__('New Meeting'), ['controller' => 'Meetings', 'action' => 'add'], ['class' => 'nav-link' ]) ?></li>
        <li class="nav-item"><?= $this->Html->link(__('List People'), ['controller' => 'People', 'action' => 'index'], ['class' => 'nav-link' ]) ?></li>
        <li class="nav-item"><?= $this->Html->link(__('New Person'), ['controller' => 'People', 'action' => 'add'], ['class' => 'nav-link' ]) ?></li>
    </ul>
    </div>
<div class="col-lg-10">
    <?= $this->Form->create($assigned) ?>
    <fieldset>
        <legend><?= __('Edit Assigned') ?></legend>
        <?php
            echo $this->Form->input('part_id', ['options' => $parts]);
            echo $this->Form->input('part_title');
            echo $this->Form->input('start_time');
              echo $this->Form->input('minutes');
            echo $this->Form->input('meeting_id', ['options' => $meetings]);
            echo $this->Form->input('person_id', [
                'empty' => '(Select)',
                'options' => $people]);
            echo $this->Form->input('assistant_id', [
                'options' => $people,
                'empty' => '(Select)']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
</div>
