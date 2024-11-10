<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h4">Available Tenders (Supplier)</h2>
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
                                <a href="/tender/view/<?= esc($tender['title']) ?>" class="btn btn-sm btn-outline-primary me-2">
                                    <i class="bi bi-eye"></i> View
                                </a>
                                <?php if ($tender['visibility'] == 'private' && in_array($supplier_email, $tender['invited_suppliers'])): ?>
                                    <a href="/tender/apply/<?= esc($tender['title']) ?>" class="btn btn-sm btn-outline-success">
                                        <i class="bi bi-check-circle"></i> Apply
                                    </a>
                                <?php elseif ($tender['visibility'] == 'public'): ?>
                                    <a href="/tender/apply/<?= esc($tender['title']) ?>" class="btn btn-sm btn-outline-success">
                                        <i class="bi bi-check-circle"></i> Apply
                                    </a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
