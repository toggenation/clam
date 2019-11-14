<div class="row">
<nav class="col-lg-2 large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav nav nav-pills nav-stacked">
        <li class="heading"><?= __('Actions') ?></li>
        <li class="nav-item"><?= $this->Html->link(__('List Meeting Notes'), ['action' => 'index'], ['class' => 'nav-link' ]) ?></li>
    </ul>
</nav>
<div class="col-lg-10 meetingNotes form large-9 medium-8 columns content">

    <?= $this->Form->create($meetingNote) ?>
    <fieldset>
        <legend><?= __('Add Meeting Note') ?></legend>
        <?php
						echo $this->Form->hidden('callingScreen');

            echo $this->Form->input('meeting_id', [ 'empty' => '(select a meeting)']);

            echo $this->Form->input('heading');
             echo $this->Form->input('note');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
</div>
