<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h4">My Tenders (Contractor)</h2>
        <a href="<?= base_url('tender/create') ?>" class="btn btn-primary">Create New Tender</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-borderless align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Visibility</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tenders as $tender): ?>
                        <tr>
                            <td><?= esc($tender['title']) ?></td>
                            <td><?= esc($tender['description']) ?></td>
                            <td><?= esc($tender['visibility']) ?></td>
                            <td>
                                <a href="/tender/edit/<?= esc($tender['title']) ?>" class="btn btn-sm btn-outline-primary me-2">
                                    <i class="bi bi-pencil"></i> Edit
                                </a>
                                <a href="/tender/delete/<?= esc($tender['title']) ?>" class="btn btn-sm btn-outline-danger">
                                    <i class="bi bi-trash"></i> Delete
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
