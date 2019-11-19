
<div class="row">
    <div class="col-lg-2"><ul class="nav flex-column nav-pills">
        <li class="heading"><?= __('Actions') ?></li>
        <li class="nav-item"><?= $this->Html->link(__('New Person'), ['action' => 'add'], ['class' => 'nav-link' ]) ?></li>
        <li class="nav-item"><?= $this->Html->link(__('List Roles'), ['controller' => 'Roles', 'action' => 'index'], ['class' => 'nav-link' ]) ?></li>
        <li class="nav-item"><?= $this->Html->link(__('New Role'), ['controller' => 'Roles', 'action' => 'add'], ['class' => 'nav-link' ]) ?></li>
    </ul>
         <h3>Edit</h3>
    <?= $this->Form->create(null, [
        'type' => 'GET',
        'url' => [
        'controller' => 'people',
        'action' => 'edit'
    ]]); ?>
         <fieldset>
    <?= $this->Form->control('person', [
        'empty' => '(select to edit)',
        'options' => $people_lookup]); ?>
                 </fieldset>
       <?= $this->Form->submit("Edit Person") ; ?>

    <?= $this->Form->end() ; ?>

</div>
<div class="col-lg-10">
    <h3><?= __('People') ?></h3>
    <table class="table table-bordered table-condensed table-striped">
        <thead>
            <tr>


                <th>
                <?= $this->Paginator->sort('firstname' , "First Name") ?>
                <?= $this->Paginator->sort('lastname' , "Last Name") ?></th>
                <th><?= $this->Paginator->sort('active') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($people as $person): ?>
            <tr>

                <!-- <td class="text-center"><?= ((bool) $person->brother) ? $this->Icon->faIcon('fas fa-male') : '' ; ?></td> -->
                <td>
                <?= ((bool) $person->brother) ? $this->Icon->faIcon('fas fa-male') :  $this->Icon->faIcon('fas fa-female') ; ?>
                <?= h($person->full_name) ?></td>
                <td class="text-center"><?= ((bool) $person->active) ? $this->Icon->faIcon('fas fa-check'): ''; ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), [
                        'action' => 'view', $person->id], [ 'easyIcon' => 'i:pencil']) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $person->id]) ?>
                    <?= $this->Form->postLink(
                        __('Delete'),
                        ['action' => 'delete', $person->id],
                        ['confirm' => __('Are you sure you want to delete # {0}?', $person->id)]
                        ) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

        <div class="paginator">
        <ul class="pagination">
            <?=$this->Paginator->first($this->Icon->faIcon('fas fa-angle-double-left') . ' ' . __('first'), ['escape' => false]) ?>
            <?=$this->Paginator->prev($this->Icon->faIcon('fas fa-angle-left') . ' ' . __('previous'), ['escape' => false]) ?>
            <?=$this->Paginator->numbers(['wrapWithUL' => false]) ?>
            <?=$this->Paginator->next(__('next') . ' ' . $this->Icon->faIcon('fas fa-angle-right'), ['escape' => false]) ?>
            <?=$this->Paginator->last(__('last') . ' ' . $this->Icon->faIcon('fas fa-angle-double-right'), ['escape' => false]); ?>
        </ul>
          <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
</div>
