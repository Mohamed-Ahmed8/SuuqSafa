<?php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$user = \App\Models\User::first();
if ($user) {
    $user->update(['role' => 'admin']);
    echo "User {$user->name} is now an admin.\n";
} else {
    echo "No users found.\n";
}
