<?php include("includes/header.php"); ?>


<?php 

$page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;

$items_per_page = 4;

$items_total_count = count(Photo::find_all());
//Pagination is the task of dividing the potential result into pages
//and retrieving the required pages, one by one on demand

$paginate = new Paginate($page, $items_per_page, $items_total_count);

//The OFF SET value is also most often used together with the LIMIT keyword. 
//The OFF SET value allows us to specify which row to start from retrieving data
//The offset parameter will be set to NULL if another value is not available

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
                                    //two way to write 
                                    //1:html tag is embeded in php
                                    echo "<li class='next'><a href='index.php?page={$paginate->next()}'>Next</a></li>";
                                    /*
                                       <li class='next'><a href='index.php?page=<?php $paginate->next(); ?>'>next</a></li>
                                     */
                                }

                                for ($i=1; $i <= $paginate->page_total() ; $i++) { 
                                   if($i==$paginate->current_page)
                                   {
                                       echo "<li class='active'><a href='index.php?page={$i}'>{$i}</a></li>"; 
                                    
                                   }
                                   else{
                                    echo "<li ><a href='index.php?page={$i}'>{$i}</a></li>";
                                   }
                                }


                                if($paginate->has_previous())
                                {?>
                                    <!-- 2: simple html tag-->
                                   <li class='previous'><a href='index.php?page=<?php $paginate->previous(); ?>'>Previous</a></li>
                                    <!--           
                                   echo "<li class='previous'><a href='index.php?page={$paginate->previous()}'>previous</a></li>"
                                   --> 
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
