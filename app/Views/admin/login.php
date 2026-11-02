<?php include 'main.php'?>
<div id="login-form" class="fixed inset-0 bg-gray-900 bg-opacity-75 flex items-center justify-center">
    <div class="bg-gray-800 p-8 rounded-lg">
        <h2 class="text-2xl mb-4">Login</h2>
        <?php if (session()->getFlashdata('error')): ?>
            <div class="bg-red-600 text-white p-2 rounded mb-4">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>
        <form action="/admin/login" method="POST">
            <div class="mb-4">
                <label for="username" class="block text-sm font-medium">Username</label>
                <input type="text" id="username" name="username" class="w-full p-2 bg-gray-700 rounded-md">
            </div>
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium">Password</label>
                <input type="password" id="password" name="password" class="w-full p-2 bg-gray-700 rounded-md">
            </div>
            <div class="flex justify-between items-center">
                <button type="submit" class="bg-blue-600 py-2 px-4 rounded-md">Login</button>
            </div>
        </form>
    </div>
</div>