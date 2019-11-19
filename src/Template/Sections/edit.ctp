<div class="row">
    <div class="col-lg-2">
        <ul class="nav flex-column nav-pills">
            <li class="heading"><?= __('Actions') ?></li>
            <li class="nav-item">
                <?= $this->Form->postLink(
                    __('Delete'),
                    ['action' => 'delete', $section->id],
                    ['confirm' => __('Are you sure you want to delete # {0}?', $section->id)]
                )
                ?>
            </li>
            <li class="nav-item"><?= $this->Html->link(__('List Sections'), ['action' => 'index'], ['class' => 'nav-link']) ?></li>
            <li class="nav-item"><?= $this->Html->link(__('List Parts'), ['controller' => 'Parts', 'action' => 'index'], ['class' => 'nav-link']) ?></li>
            <li class="nav-item"><?= $this->Html->link(__('New Part'), ['controller' => 'Parts', 'action' => 'add'], ['class' => 'nav-link']) ?></li>
        </ul>
    </div>
    <div class="col-lg-10">
        <?= $this->Form->create($section) ?>
        <fieldset>
            <legend><?= __('Edit Section') ?></legend>
            <?php
            echo $this->Form->input('heading');
            echo $this->Form->input('name');
            echo $this->Form->input('sort_order');

            ?>
        </fieldset>
        <?= $this->Form->button(__('Submit')) ?>
        <?= $this->Form->end() ?>
    </div>
</div>
