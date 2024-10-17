<!-- patient_search.php -->
<div id="layoutSidenav_content">
    <main class="container mt-4">
        <h2 class="mb-4 text-center">Search Patient</h2>
        <form action="<?= site_url('VitalSign/search_patients'); ?>" method="post">
            <div class="form-group">
                <label for="name">Patient Name</label>
                <input type="text" class="form-control" name="name" required>
            </div>
            <button type="submit" class="btn btn-primary">Search</button>
        </form>
    </main>
</div>
