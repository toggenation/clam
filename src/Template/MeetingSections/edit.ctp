<div class="row">
    <div class="col-lg-2"><ul class="nav flex-column nav-pills">
        <li class="heading"><?= __('Actions') ?></li>
        <li class="nav-item"><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $meetingSection->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $meetingSection->id)]
            )
        ?></li>
        <li class="nav-item"><?= $this->Html->link(__('List Meeting Sections'), ['action' => 'index'], ['class' => 'nav-link' ]) ?></li>
        <li class="nav-item"><?= $this->Html->link(__('List Parts'), ['controller' => 'Parts', 'action' => 'index'], ['class' => 'nav-link' ]) ?></li>
        <li class="nav-item"><?= $this->Html->link(__('New Part'), ['controller' => 'Parts', 'action' => 'add'], ['class' => 'nav-link' ]) ?></li>
    </ul>
    </div>
<div class="col-lg-10">
    <?= $this->Form->create($meetingSection) ?>
    <fieldset>
        <legend><?= __('Edit Meeting Section') ?></legend>
        <?php
            echo $this->Form->input('name');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
</div>
