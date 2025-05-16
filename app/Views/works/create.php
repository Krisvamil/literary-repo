<section class="card">
    <h2>Create New Work</h2>
    <form method="post" action="/works/store">
        <label for="title">Title</label>
        <input type="text" id="title" name="title" required>

        <label for="description">Description</label>
        <textarea id="description" name="description" required></textarea>

        <button type="submit">Submit</button>
    </form>
</section>