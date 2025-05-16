<?php if (!empty($_SESSION['flash'])): ?>
    <div class="alert alert-info" role="alert">
        <?= htmlspecialchars($_SESSION['flash']) ?>
    </div>
    <?php unset($_SESSION['flash']); ?>
<?php endif; ?>