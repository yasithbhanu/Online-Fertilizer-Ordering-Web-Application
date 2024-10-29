<?php include('partials/head.php'); ?>



    <!-- Categories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Categories</h2>

            <?php
                $sql = "SELECT * FROM tbl_cat WHERE active='Yes'";

                $res = mysqli_query($conn, $sql);

                $count = mysqli_num_rows($res);

                if($count>0)
                {
                    while($row=mysqli_fetch_assoc($res))
                    {
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];

                        ?>
                            <a href="<?php echo SITEURL; ?>category-agro.php?category_id=<?php echo $id; ?>">
                                <div class="box-3 float-container">

                                    <?php
                                        if($image_name=="")
                                        {
                                            echo "<div class='error'>Image Not Available</div>";
                                        }
                                        else
                                        {
                                            ?>
                                            <img src="<?php echo SITEURL; ?>img/category/<?php echo $image_name; ?>" alt="Fertilizer" class="img-responsive img-curve">
                                            <?php
                                        }
                                    ?>
                                    <h3 class="float-text text-white"><?php echo $title; ?></h3>
                                </div>
                            </a>
                        <?php
                    }
                }
                else
                {
                    echo "<div class='error'>Category Not Found.</div>";
                }

            ?>

            
            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->


    <?php include('partials/footerus.php'); ?>

</body>
</html>