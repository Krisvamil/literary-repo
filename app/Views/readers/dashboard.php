<section class="card">
    <h2>Reader Dashboard</h2>
    <p>Welcome, <?= isset($reader['name']) ? htmlspecialchars($reader['name']) : 'Reader' ?>!</p>
</section>