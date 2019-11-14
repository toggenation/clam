<?php $schedule = $schedule->toArray(); ?>
<div class="container">
    <h4>Number of times a person is assigned <?= $schedule['start_date'] . ' - ' . $schedule['end_date']; ?></h4>
    <?php $last = ''; ?>
<?php foreach($assignments as $person ): ?>
    <?php $current = $person['parts']; ?>
    <?php if($last !== '' && $current !== $last): ?>
            </div>
<?php endif; ?>
    <?php if($current !== $last): ?>
    <div class="col-lg-2">
        <h5><?= $person['parts'];?></h5>
        <?php endif; ?>
        <div class="row">
    <?= $this->Html->link(
            $person['firstname'] . ' ' . $person['lastname'],
            ['action' => 'view', $person['id']]); ?>

        </div>

    <?php $last = $person['parts']; ?>
        <?php endforeach; ?>
</div>
