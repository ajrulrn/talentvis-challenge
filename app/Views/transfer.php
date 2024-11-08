<?php $this->include('partials/_header') ?>
    <h2 class="text-center text-white">Transfer</h2>
    <div class="flex justify-center flex-column">
        <form action="/transfer/store" method="post">
            <div class="flex flex-column" style="flex-wrap: wrap; margin-bottom: 10px;">
                <label for="amount" class="block">Amount</label>
                <input type="text" class="form-control" id="amount" name="amount" autofocus autocomplete="off">
            </div>
            <div class="flex flex-column" style="flex-wrap: wrap; margin-bottom: 10px;">
                <label for="recipient" class="block">Recipient</label>
                <select name="recipient" id="recipient" class="form-control">
                    <option value="">Select</option>
                    <?php foreach($recipients as $item) : ?>
                    <option value="<?= $item->id ?>"><?= $item->name; ?></option>
                    <?php endforeach; ?>
                </select>
                <small class="text-danger"><?= $this->getFlashData('transfer') ?></small>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <a href="/" class="back">Back</a>
<?php $this->include('partials/_footer') ?>
