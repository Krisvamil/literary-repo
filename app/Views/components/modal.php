<div class="modal" id="<?= htmlspecialchars($modal['id'] ?? 'modal') ?>">
    <div class="modal-content">
        <?php if (!empty($modal['title'])): ?>
            <h2><?= htmlspecialchars($modal['title']) ?></h2>
        <?php endif; ?>
        <p><?= $modal['body'] ?? '' ?></p>
    </div>
</div>