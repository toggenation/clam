<div class="row">
<nav class="col-lg-2 large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav nav nav-pills nav-stacked">
        <li class="heading"><?= __('Actions') ?></li>
        <li class="nav-item"><?= $this->Html->link(
            __('Edit Meeting Note'),
            [
                'action' => 'edit', $meetingNote->id
                ], ['class' => 'nav-link' ]);?> </li>
        <li class="nav-item"><?= $this->Form->postLink(__('Delete Meeting Note'), ['action' => 'delete', $meetingNote->id], [
            'class' => 'nav-link',
            'confirm' => __('Are you sure you want to delete # {0}?', $meetingNote->id)]) ?> </li>
        <li class="nav-item"><?= $this->Html->link(__('List Meeting Notes'), ['action' => 'index'], ['class' => 'nav-link' ]) ?> </li>
        <li class="nav-item"><?= $this->Html->link(__('New Meeting Note'), ['action' => 'add'], ['class' => 'nav-link' ]) ?> </li>
    </ul>
</nav>
<div class="col-lg-10 meetingNotes view large-9 medium-8 columns content">
    <div class="row">
    <h3><?= h($meetingNote->id) ?></h3>
    <table class="table vertical-table">
        <tr>
            <th><?= __('Heading') ?></th>
            <td><?= h($meetingNote->heading) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($meetingNote->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Meeting Id') ?></th>
            <td><?= $this->Number->format($meetingNote->meeting_id) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($meetingNote->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($meetingNote->modified) ?></td>
        </tr>
    </table>
    </div>
    <div class="row">
            <div class="col">
        <h4><?= __('Note') ?></h4>
        <?= $this->Text->autoParagraph(h($meetingNote->note)); ?>
        </div>
    </div>
</div>
</div>
