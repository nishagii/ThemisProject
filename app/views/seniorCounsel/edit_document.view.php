<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Edit Document</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/seniorCounsel/one_case.css" />
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/seniorCounsel/document_upload.css" />
    <link href="https://cdn.jsdelivr.net/npm/boxicons@2.1.1/css/boxicons.min.css" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

<?php include('component/bigNav.view.php'); ?>
<?php include('component/smallNav1.view.php'); ?>
<?php include('component/sidebar.view.php'); ?>

    <div class="home-section">
        <h1 class="card-section">Edit Document</h1>
        
        <?php if (isset($document) && !empty($document) && isset($document[0])) : ?>
            <div class="case-details-card">
                <form action="<?= ROOT ?>/document/updateDocument" method="POST" enctype="multipart/form-data">
                    
                    <input type="hidden" name="document_id" value="<?= $document[0]->document_id ?>">
                    
                    <div class="form-group">
                        <label for="docName">Document Name</label>
                        <input type="text" id="docName" name="doc_name" value="<?= htmlspecialchars($document[0]->doc_name) ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="docDescription">Description</label>
                        <textarea id="docDescription" name="doc_description" rows="4" required><?= htmlspecialchars($document[0]->doc_description) ?></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label>Existing File:</label>
                        <p><?= htmlspecialchars($document[0]->file_path) ?></p>
                    </div>
                    
                    <div class="form-group">
                        <label for="fileUpload">Upload New Document (optional)</label>
                        <input type="file" id="fileUpload" name="document_file">
                    </div>
                    
                    <button type="submit" class="btn-submit">Update Document</button>
                </form>
            </div>
        <?php else : ?>
            <p style="color: red; padding: 1rem;">Document not found.</p>
        <?php endif; ?>
    </div>

</body>
</html>