<div id="layoutSidenav_content">
    <div class="container mt-4">
        <h2 class="text-primary">Search Patient</h2>
        <form action="<?= site_url('findings/search') ?>" method="post" class="form-inline">
            <div class="input-group mb-3">
                <input type="text" name="name" class="form-control" placeholder="Enter patient name" required>
                <div class="input-group-append">
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </div>
        </form>
    </div>
</div>
