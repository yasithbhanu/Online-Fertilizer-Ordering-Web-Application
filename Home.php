<?php include('partials/head.php'); ?>

        <?php
            if (isset($_SESSION['username'])) 
            {
                // User is logged in, show their full name
                $username = $_SESSION['username'];
            
                // Retrieve the full name from the database
                $sql = "SELECT full_name FROM tbl_cust WHERE username = '$username'";
                $result = mysqli_query($conn, $sql);
            
                if ($result) {
                    $row = mysqli_fetch_assoc($result);
                    $fullName = $row['full_name'];
                    echo "<div class='text-center success'>Welcome, $fullName!</div>";
                } else {
                    echo "<div class='text-center success'>Welcome, User!</div>";
                }
            }
            else 
            {
                // Display a generic message or a login link if the user is not logged in
                echo "<marquee><div class='text-center success'>Welcome to AR Agro Team. Please log in to access more features.</div></marquee>";
            }
        ?>

    <!-- Agro Search Section Starts Here -->
    <section class="agro-search text-center">
        <div class="container">

        

            <h1>What You Are Growing Today <br>Will Help You Tomorrow</h1>

            <form action="<?php echo SITEURL; ?>agro-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for..." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary1">
            </form>

        </div>
    </section>
    <!-- Agro Search Section Ends Here -->
<br><br>
            <?php
                if(isset($_SESSION['login']))
                {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }
                if(isset($_SESSION['order']))
                {
                    echo $_SESSION['order'];
                    unset($_SESSION['order']);
                }
            ?>     

    <!-- Categories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <!--<h2 class="text-center">Explore</h2> -->

            <?php
                $sql = "SELECT * FROM tbl_cat WHERE active='Yes' AND featured='Yes' LIMIT 3";

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


            

            <!--<a href="#">
            <div class="box-3 float-container">
                <img src="img/11.jpg" alt="Chemicals" class="img-responsive img-curve">

                <h3 class="float-text text-white">Chemicals</h3>
            </div>
            </a>-->

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    <!-- Menu Section Starts Here -->
    <section class="agro-menu">
        <div class="container">
            <h2 class="text-center">Fertilizers Menu</h2>

            <?php
                $sql2 = "SELECT * FROM tbl_fertilizer WHERE active='Yes' Limit 4";

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

            

            <!-- <div class="agro-menu-box">
                <div class="agro-menu-img">
                    <img src="img/13.jpg" alt="Vegetable Fertilizer Super" class="img-responsive img-curve">
                </div>

                <div class="agro-menu-desc">
                    <h4>Vegetable Fertilizer (Super Top)</h4>
                    <p class="agro-price">Rs.11,500</p>
                    <p class="agro-detail">
                        එලවළු පොහොර (Super Top)</br>1kg = Rs.250
                    </p>
                    <br>

                    <a href="order.php" class="btn btn-primary">Order Now</a>
                </div>
            </div>-->

            <div class="clearfix"></div>

            

        </div>

        <p class="text-center">
            <a href="<?php echo SITEURL; ?>menu.php">See All Fertilizers    <i class="fa fa-chevron-down" aria-hidden="true"></i></a>
        </p>
    </section>
    <!-- fOOD Menu Section Ends Here -->

    
    
    <?php include('partials/footerus.php'); ?>

</body>
</html>