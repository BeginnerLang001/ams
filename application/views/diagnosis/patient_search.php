<div id="layoutSidenav_content">
    <main class="container mt-4">
        <h2>Search Patient</h2>
        <form action="<?php echo site_url('diagnosis/search'); ?>" method="post">
            <div class="form-group">
                <label for="name">Patient Name:</label>
                <input type="text" name="name" class="form-control" placeholder="Enter patient's name" required>
            </div>
            <button type="submit" class="btn btn-primary">Search</button>
            
        </form>
    </main>
    
</div>
