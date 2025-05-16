<div class="card">
    <?php if (!empty($card['title'])): ?>
        <div class="card-header">
            <h3><?= htmlspecialchars($card['title']) ?></h3>
        </div>
    <?php endif; ?>
    <div class="card-body">
        <?= $card['body'] ?? 'Card content goes here.' ?>
    </div>
</div>