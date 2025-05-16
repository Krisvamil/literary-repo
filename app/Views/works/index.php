<section class="card">
    <h2>All Works</h2>
    <?php if (!empty($works)): ?>
        <?php foreach ($works as $work): ?>
            <div class="card">
                <h3><?= htmlspecialchars($work['title']) ?></h3>
                <p><?= nl2br(htmlspecialchars($work['description'])) ?></p>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No works available.</p>
    <?php endif; ?>
</section>
