<?php include('partials/head.php'); ?>

    <!-- Search Section Starts Here -->
    <section class="agro-search text-center">
        <div class="container">

            <form action="<?php echo SITEURL; ?>agro-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Fertilizer..." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary1">
            </form>

        </div>
    </section>
    <!-- Search Section Ends Here -->



    <!-- Menu Section Starts Here -->
    <section class="agro-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php
                $sql2 = "SELECT * FROM tbl_fertilizer WHERE active='Yes'";

                $res2 = mysqli_query($conn, $sql2);

                $count2 = mysqli_num_rows($res2);

                if($count2>0)
                {
                    while($row=mysqli_fetch_assoc($res2))
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
                                        echo "<div class='error'>Image Not Available.</div>";
                                    }
                                    else
                                    {
                                        ?>
                                        <img src="<?php echo SITEURL; ?>img/ferti/<?php echo $image_name; ?>" alt="Vegetable Fertilizer" class="img-responsive img-curve">
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
                    echo "<div class='error'>Fertilizer Not Available.</div>";
                }
            ?>
            

            <div class="clearfix"></div>  

        </div>

    </section>
    <!-- Menu Section Ends Here -->


    <?php include('partials/footerus.php'); ?>

