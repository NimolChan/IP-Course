<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Files</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .upload-container {
            max-width: 600px;
            margin: 50px auto;
        }
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            background-color: #007bff;
            color: white;
            border-radius: 10px 10px 0 0;
            font-weight: 500;
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .form-control {
            border-radius: 5px;
        }
        hr {
            margin: 2rem 0;
            border-color: #dee2e6;
        }
    </style>
</head>
<body>
    <div class="container upload-container">
        <div class="card mb-4">
            <div class="bg-warning card-header">
                Upload File to Local Storage
            </div>
            <div class="card-body">
                <form action="<?php echo e(route('upload.local')); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="mb-3">
                        <label for="document" class="form-label">Select File</label>
                        <input type="file" class="form-control" id="document" name="document" required />
                    </div>
                    <button type="submit" class="btn btn-warning">Upload to Local</button>
                </form>
            </div>
        </div>

        <hr>

        <div class="card">
            <div class="card-header ">
                Upload Image to MinIO (server)
            </div>
            <div class="card-body">
                <form action="<?php echo e(route('upload.minio')); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="mb-3">
                        <label for="image" class="form-label">Select Image</label>
                        <input type="file" class="form-control" id="image" name="image" accept="image/*" required />
                    </div>
                    <button type="submit" class="btn btn-primary">Upload to MinIO</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS (Optional, for components like tooltips or modals if needed) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html><?php /**PATH /var/www/resources/views/upload_file.blade.php ENDPATH**/ ?>