<?php include("includes/header.php"); ?>


<?php 

$page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;

$items_per_page = 4;

$items_total_count = count(Photo::find_all());


$paginate = new Paginate($page, $items_per_page, $items_total_count);
$sql =  "SELECT * FROM Photos LIMIT {$items_per_page} OFFSET {$paginate->offset()}";
$photos = Photo::find_by_query($sql);

//$photos = Photo::find_all();
 ?>

        <div class="row">
            <!-- Blog Entries Column -->
            <div class="col-md-12">
                
                <div class="thumbnails row">
                    <?php foreach($photos as $photo) : ?>
                        
                        <div class="col-xs-6 col-md-3">
                            <a class="thumbnail" href="photo.php?id=<?php echo $photo->id; ?>">
                                <img class="img-responsive" src="admin/<?php echo $photo->picture_path(); ?>" alt="">
                            </a>
                         </div>
                    <?php endforeach; ?>
                </div>
                <div class="row">
                    <ul class="pager">
                        <?php
                            if($paginate->page_total() > 1)
                            {
                                if($paginate->has_next())
                                {
                                    echo "<li class='next'><a href=''>next</a></li>";
                                }
                                if($paginate->has_previous())
                                {?>
                                   <li class='previous'><a href=''>previous</a></li>;
                                <?php
                                }
                            }
                        ?>
                        
                    </ul>
                </div>      


            </div>
        </div>
        <!-- /.row -->

            <!-- Blog Sidebar Widgets Column -->
           <!-- <div class="col-md-4">

            
                 <?php // include("includes/sidebar.php"); ?>



        

        <?php include("includes/footer.php"); ?>
