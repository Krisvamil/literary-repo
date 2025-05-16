<?php
use App\Utils\Logger;

if (session_status() === PHP_SESSION_NONE) session_start();

$user = $_SESSION['user'] ?? ['role' => 'guest'];
$role = $user['role'] ?? 'unknown';
$email = isset($user['email']) ? htmlspecialchars($user['email']) : 'Guest';
?>
<h2>Dashboard</h2>
<div class="card">
    <div class="card-header">
        <h3>Welcome, <?= $email ?></h3>
    </div>
    <div class="card-body">
        <p>You are logged in as: <strong><?= htmlspecialchars(ucfirst($role)) ?></strong></p>

        <?php if ($role === 'author'): ?>
            <a href="/author/profile" class="btn">Go to Author Profile</a>
        <?php elseif ($role === 'reader'): ?>
            <a href="/reader/dashboard" class="btn">Go to Reader Dashboard</a>
        <?php else: ?>
            <p>No role-specific dashboard available.</p>
        <?php endif; ?>

        <p><a href="/logout" class="btn btn-link">Logout</a></p>
    </div>
</div>
