<div class="row">
<nav class="large-3 col-lg-2 medium-4 columns" id="actions-sidebar">
    <ul class="nav nav-pills flex-column">
        <li class="heading"><?= __('Actions'); ?></li>
        <li class="nav-item"><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $meetingNote->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $meetingNote->id)]
            )
        ?></li>
        <li class="nav-item"><?= $this->Html->link(__('List Meeting Notes'), ['action' => 'index'], ['class' => 'nav-link' ]) ?></li>
    </ul>
</nav>
<div class="meetingNotes form col-lg-10 large-9 medium-8 columns content">
    <?= $this->Form->create($meetingNote) ?>
    <fieldset>
        <legend><?= __('Edit Meeting Note') ?></legend>
        <?php
            echo $this->Form->input('meeting_id');
          	echo $this->Form->hidden('callingScheduleId');
            echo $this->Form->input('heading');
            echo $this->Form->input('note');

        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
</div>
