<div class="row">
    <div class="col-lg-2"><ul class="nav flex-column nav-pills">
        <li class="heading"><?= __('Actions') ?></li>
        <li class="nav-item"><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $schedule->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $schedule->id)]
            )
        ?></li>


        <li class="nav-item"><?= $this->Html->link(__('New Meeting'), ['controller' => 'Meetings', 'action' => 'add'], ['class' => 'nav-link' ]) ?></li>
    </ul>
</div>
<div class="col-lg-10">
    <?= $this->Form->create($schedule) ?>
    <fieldset>
        <legend><?= __('Edit Schedule') ?></legend>
        <?php
         echo $this->Form->input('published');
            echo $this->Form->input('start_date');
            echo $this->Form->input('end_date');
            echo $this->Form->input('month');
            echo $this->Form->input('comment');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
</div>
