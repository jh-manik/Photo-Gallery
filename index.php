<?php

    require('db.php');
    include('views/header.php');
    
?>

<!-- start of App Main Section -->
<main class="app-body py-4">
    <div class="container">
        <!-- start of Upload Section -->
        <section class="upload-container">
            <div class="container">
                <div class="upload-heading">
                    <h3 class="text-center section-heading">Upload a image to add it into the Photo Gallery</h3>
                    <hr class="heading-underline">
                </div> <!-- ./ upload-heading -->

                <div class="upload-form">
                    <form action="upload.php" method="post" enctype="multipart/form-data">
                        <div class="input-group">
                            <input type="text" name="title" placeholder="Enter Image Title" required>
                            <input type="file" name="image" accept="image/*" required>
                        </div> <!-- input field -->

                        <button type="submit" class="button">Upload</button>
                    </form>
                </div> <!-- ./ upload-form -->
            </div> <!-- ./container -->
        </section>
        <!-- end of upload form section -->

        <hr>

        <!-- start of Gallery Section -->
        <section class="photo-gallery py-1-5">
            <div class="contaienr">
                <div class="gallery-container">
                    <div class="gallery-heading">
                        <h3 class="text-center section-heading">Photo Gallery</h3>
                        <hr class="heading-underline">
                    </div>

                    <div class="flex-container gallery-items">

                        <?php
                        
                            $dbConnection = dbConnect();
                            $imageData = query("SELECT * FROM photos ORDER BY created_at DESC;", [], $dbConnection);
                            $images = $imageData->fetchAll();                            
                            if ( count($images) > 0 ) :
                                foreach ( $images as $image ) :
                        
                        ?>

                        <div class="gallery-item">
                            <figure class="img-card">
                                <img src="<?= $image['image_path'] ?>" alt="Gallery Image" width="300" height="250">

                                <figcaption class="card-desc">
                                    <h4><?= $image['title'] ?></h4>

                                    <div class="delete-form">
                                        <form action="delete.php" method="post">
                                            <input type="hidden" name="id" value="<?= $image['id'] ?>">
                                            <button class="button" type="submit">Delete</button>
                                        </form>
                                    </div>
                                </figcaption>
                            </figure> <!-- ./ image-card -->
                        </div> <!-- ./ column -->

                        <?php
                    
                                endforeach;

                            else:
                                print("<h2 class='text-center gallery-message'>No Image Uploaded Yet!</h2>");

                            endif;
                        
                        ?>

                    </div> <!-- ./ end of row -->
                </div> <!-- ./ gallery-container -->
            </div> <!-- ./ container -->
        </section>
        <!-- end of Gallery Section -->
    </div>
</main>
<!-- End of App Main Section -->

<?php include('views/footer.php'); ?>