<?php $this->include('partials/_header') ?>
    <h2 class="text-center text-white">Login</h2>
    <div class="flex justify-center flex-column">
        <form action="/login/authenticate" method="post">
            <div class="flex flex-column" style="flex-wrap: wrap;">
                <label for="username" class="block">Username</label>
                <input type="text" class="form-control" id="username" name="username" autofocus autocomplete="off">
            </div>
            <div class="flex flex-column" style="flex-wrap: wrap; margin-top: 10px; margin-bottom: 10px;">
                <label for="password" class="block">Password</label>
                <input type="password" class="form-control" id="password" name="password">
                <small class="text-danger"><?= $this->getFlashData('login') ?></small>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
<?php $this->include('partials/_footer') ?>
