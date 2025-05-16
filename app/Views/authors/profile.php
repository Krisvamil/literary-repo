<section class="card">
    <h2>Author Profile</h2>
    <p>Name: <?= isset($author['name']) ? htmlspecialchars($author['name']) : 'Unknown' ?></p>
    <p>Bio: <?= isset($author['bio']) ? nl2br(htmlspecialchars($author['bio'])) : 'No bio available.' ?></p>
</section>