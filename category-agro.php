<?php include('partials/head.php'); ?>

<?php

    if(isset($_GET['category_id']))
    {
        $category_id = $_GET['category_id'];

        $sql = "SELECT * FROM tbl_cat WHERE id=$category_id";

        $res = mysqli_query($conn, $sql);

        $row = mysqli_fetch_assoc($res);

        $category_title = $row['title'];
    }
    else
    {
        header('location:'.SITEURL);
    }

?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="agro-search text-center">
        <div class="container">
            
            <h2>Fertilizer on <a href="#" class="text-white">"<?php echo $category_title; ?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="agro-menu">
        <div class="container">
            <h2 class="text-center">Menu</h2>

            <?php

                $sql2 = "SELECT * FROM tbl_fertilizer WHERE category_id=$category_id";

                $res2 = mysqli_query($conn, $sql2);

                $count2 = mysqli_num_rows($res2);

                if($count2>0)
                {
                    while($row2=mysqli_fetch_assoc($res2))
                    {
                        $id = $row2['id'];
                        $title = $row2['title'];
                        $price = $row2['price'];
                        $description = $row2 ['description'];
                        $image_name = $row2['image_name'];
                        ?>

                        <div class="agro-menu-box">
                            <div class="agro-menu-img">

                                <?php

                                    if($image_name=="")
                                    {
                                        echo "<div class='error'>Image Not Available.</div>";
                                    }
                                    else
                                    {
                                        ?>
                                        <img src="<?php echo SITEURL; ?>img/ferti/<?php echo $image_name; ?>" alt="agro" class="img-responsive img-curve">
                                        <?php
                                    }

                                ?>

                            </div>

                            <div class="agro-menu-desc">
                                <h4><?php echo $title; ?></h4>
                                <p class="agro-price"><?php echo $price; ?></p>
                                <p class="agro-detail">
                                    <?php echo $description; ?>
                                </p>
                                <br>

                                <a href="<?php echo SITEURL; ?>order.php?fertilizer_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                            </div>
                        </div>

                        <?php
                    }
                }
                else
                {
                    echo "<div class='error'>Fertilizer Not Availablle.</div>";
                }

            ?>

            

            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->



    <?php include('partials/footerus.php'); ?>

