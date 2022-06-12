<?php

$conn = mysqli_connect('localhost', 'root', '', 'tropicals_db') or die('connection failed');
session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
    header('location:login.php');
}

if(isset($_POST['add_to_cart'])){

    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_quantity = $_POST['product_quantity'];

    $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

    if(mysqli_num_rows($check_cart_numbers) > 0){
        $message[] = 'Already added to cart';
    }else{
        mysqli_query($conn, "INSERT INTO `cart`(user_id, pid, name, price, quantity, image) VALUES('$user_id', '$product_id', '$product_name', '$product_price', '$product_quantity', '$product_image')") or die('query failed');
        $message[] = 'Item added to cart';
    }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>

    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
<?php @include 'header.php'; ?>

<!--Home Slider-->
<section class="home">

    <div class="swiper home-slider">

        <div class="swiper-wrapper">

            <div class="swiper-slide slide" style="background:url(images/background_4.jpg) no-repeat">
                <div class="home-slidercontent">
                    <span>Monsteras, calatheas and more</span>
                    <h3>Plant Care Tips</h3>
                    <a href="#home-blogs" class="btn">Learn More</a>
                </div>
            </div>

            <div class="swiper-slide slide" style="background:url(images/background_3.jpg) no-repeat">
                <div class="home-slidercontent">
                    <span>Shop the latest exotic plants</span>
                    <h3>Create your indoor jungle</h3>
                    <a href="shop.php" class="btn">Shop Now</a>
                </div>
            </div>

            <div class="swiper-slide slide" style="background:url(images/background_5.jpg) no-repeat">
                <div class="home-slidercontent">
                    <span>Shipping, returns and more</span>
                    <h3>Got any questions?</h3>
                    <a href="contact.php" class="btn">Contact Us</a>
                </div>
            </div>

        </div>

        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>

    </div>
</section>
<!--Home slider ends-->


<!--home featured products-->
<section class="products">
    <h1 class="title">New Plants</h1>

    <div class="box-container">

        <?php
        $select_products = mysqli_query($conn, "SELECT * FROM `products` LIMIT 3") or die('query failed');
        if(mysqli_num_rows($select_products) > 0){
            while($fetch_products = mysqli_fetch_assoc($select_products)){
                ?>
                <form action="" method="POST" class="box">
                    <a href="view_page.php?pid=<?php echo $fetch_products['id']; ?>" class="fas fa-eye"></a>
                    <div class="price">R<?php echo $fetch_products['price']; ?></div>
                    <img src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="" class="image">
                    <div class="name"><?php echo $fetch_products['name']; ?></div>
                    <input type="number" name="product_quantity" value="1" max="2" min="0" class="qty">
                    <input type="hidden" name="product_id" value="<?php echo $fetch_products['id']; ?>">
                    <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
                    <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
                    <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
                    <input type="submit" value="add to cart" name="add_to_cart" class="btn">
                </form>
                <?php
            }
        }else{
            echo '<p class="empty">no products added yet!</p>';
        }
        ?>
    </div>

    <div class="more-btn">
        <a href="shop.php" class="option-btn">See more</a>
    </div>
</section>
<!--products section ends-->

<!--Home about us section-->
<section class="home-about">

    <div class="image">
        <center>
            <img src="images/stian2.png" alt="">
        </center>
    </div>

    <div class="content">
        <center>
        <h3>Who we are</h3>
        <p>We are Stian's Tropicals, an online nursery where you can buy the latest rare and exotic houseplants.</p>
        <p>Our aim is to create a community of like-minded individuals who enjoy caring for plants. We also aim to educate people about proper plant care to ensure their plants live a long and happy life. The plant community in South Africa is quickly growing and people are more interested in houseplants now than ever before.</p>
        </center>
    </div>
</section>
<!--Home about ends-->


<!--Home blog section-->
<div class="blog-container" div id="home-blogs">
<div class="row">
    <div class="blog-header">
        <h1>Mini Blogs</h1>
        <p>Mini Plant care blogs to help you get started! </p>
    </div>
    <div class="blog-content">
        <div class="card">
            <img src="images/blog-img1.jpg">
            <h4>Calathea White Star</h4>
            <p>Care: Keep the soil moist, water when the first inch of soil gets dry. Do not let the plant sit in water. Use only half of the recommended strength of fertilizer or opt for a slow-release fertilizer. Maintain a high humidity level around the plant to keep the leaves healthy.</p>
        </div>
        <div class="card">
            <img src="images/blog-img4.jpg">
            <h4>Rhaphidophora Tetrasperma</h4>
            <p>Care: Keep soil moist, but do not allow the plant to sit in water. Moderate humidity and regular misting will be beneficial. Use a balanced fertiliser at half the recommended dilution level for this plant. Use a free-draining organic potting mix which allows breathability for the roots. </p>
        </div>
        <div class="card">
            <img src="images/blog-img3.jpg">
            <h4>Anthurium Clarinervium</h4>
            <p>Care: Water thoroughly once the top 1-2 inches of soil is dry. Medium to bright, indirect light. Avoid direct sunlight where possible. Fertilize every 4-6 weeks through the growing season.  Intolerant of temperatures below 13°C Keep between 20-27°C .</p>
        </div>
    </div>
</div>
<!--Home blog ends-->

<?php @include 'footer.php';?>

<script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
<script src="js/script.js"></script>

</body>
</html>
