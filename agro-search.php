<?php include('partials/head.php'); ?>


    <!-- fOOD sEARCH Section Starts Here -->
    <section class="agro-search text-center">
        <div class="container">

            <?php

                $search = mysqli_real_escape_string($conn, $_POST['search']);

            ?>
            
            <h2>Your Search - <a href="Home.php" class="text-white">"<?php echo $search; ?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="agro-menu">
        <div class="container">
            <h2 class="text-center">Fertilizer Menu</h2>

            <?php
                
                $sql = "SELECT * FROM tbl_fertilizer WHERE title LIKE '%$search%' OR description LIKE '%$search%'";

                $res = mysqli_query($conn, $sql);

                $count = mysqli_num_rows($res);

                if($count>0)
                {
                    while($row=mysqli_fetch_assoc($res))
                    {
                        $id = $row['id'];
                        $title = $row['title'];
                        $price = $row['price'];
                        $description = $row['description'];
                        $image_name = $row['image_name'];

                        ?>

                        <div class="agro-menu-box">
                            <div class="agro-menu-img">
                                <?php
                                    if($image_name=="")
                                    {
                                        echo "<div class='error'>image Not Available.</div>";
                                    }
                                    else
                                    {
                                        ?>
                                        <img src="<?php echo SITEURL; ?>img/ferti/<?php echo $image_name; ?>" alt="Ferti" class="img-responsive img-curve">
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

                                <a href="order.php" class="btn btn-primary">Order Now</a>
                            </div>
                        </div>

                        <?php
                    }
                }
                else
                {
                    echo "<div class='error'>Fertilizer Not Found.</div>";
                }

            ?>

            <div class="clearfix"></div>

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partials/footerus.php'); ?>