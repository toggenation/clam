<div class="row">
    <div class="col-lg-2"><ul class="nav flex-column nav-pills">
        <li class="heading"><?= __('Actions') ?></li>
        <li class="nav-item"><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $personType->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $personType->id)]
            )
        ?></li>
        <li class="nav-item"><?= $this->Html->link(__('List Person Type'), ['action' => 'index'], ['class' => 'nav-link' ]) ?></li>
    </ul>
</div>
<div class="col-lg-10">
    <?= $this->Form->create($personType) ?>
    <fieldset>
        <legend><?= __('Edit Person Type') ?></legend>
        <?php
            echo $this->Form->input('type');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
</div>
