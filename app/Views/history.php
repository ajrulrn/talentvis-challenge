<?php $this->include('partials/_header') ?>
    <h2 class="text-center text-white">History</h2>
    <?php foreach ($transactions as $item) : ?>
    <div class="card items-center">
        <div class="flex" style="gap: 15px;">
            <div>
                <p><?= date('d-m-Y', strtotime($item->created_at)) ?></p>
                <p><?= date('H:i', strtotime($item->created_at)) ?></p>
            </div>
            <div>
                <p style="font-size: 16pt;"><?= $item->category ?></p>
                <p><?= $item->type; ?></p>
            </div>
        </div>
        <?php if ($item->type === 'Debit') : ?>
        <p class="text-success" style="font-size: 32pt;">+<?= $item->amount ?></p>
        <?php else : ?>
        <p style="font-size: 32pt;">-<?= $item->amount ?></p>
        <?php endif; ?>
    </div>
    <?php endforeach; ?>
    <a href="/" class="back">Back</a>
<?php $this->include('partials/_footer') ?>
