<?php
$title = "Home — Home Coffee";
include "config.php";
include "includes/header.php";
?>
<?php if (isset($_SESSION['login_success'])): ?>
<div class="alert-login">
    <?= $_SESSION['login_success']; ?>
</div>
<?php unset($_SESSION['login_success']); ?>
<?php endif; ?>

<style>
.alert-login {
    background: #4caf50;
    padding: 15px;
    color: #fff;
    margin: 20px auto;
    width: 90%;
    max-width: 1100px;
    border-radius: 8px;
    text-align: center;
    font-size: 1.2rem;
    animation: fadeOut 4s forwards;
}

@keyframes fadeOut {
    0% {
        opacity: 1;
    }

    70% {
        opacity: 1;
    }

    100% {
        opacity: 0;
        display: none;
    }
}
</style>

<!-- HOME SECTION -->
<section class="home" id="home">
    <div class="row">
        <div class="content">
            <h3>Enjoy coffee at home in a relaxed manner</h3>
            <?php if (isset($_SESSION['user'])): ?>
            <p class="welcome-text">Welcome back,
                <strong><?= $_SESSION['user']['nama']; ?></strong> ☕
            </p>
            <?php endif; ?>

            <?php if (!isset($_SESSION['user_id'])): ?>
            <a href="login.php" class="btn">buy one now</a>
            <?php else: ?>
            <a href="menu.php" class="btn">buy one now</a>
            <?php endif; ?>
        </div>

        <div class="image">
            <img src="image/home-img-1.png" class="main-home-image" alt="">
        </div>
    </div>

    <div class="image-slider">
        <img src="image/home-img-1.png" alt="">
        <img src="image/home-img-2.png" alt="">
        <img src="image/home-img-3.png" alt="">
    </div>
</section>

<!-- ABOUT SECTION -->
<section id="about" class="about">
    <h1 class="heading">about <span>who we are</span></h1>

    <div class="row">
        <div class="image">
            <img src="image/about-img.png" alt="">
        </div>

        <div class="content">
            <h3 class="title">fresh coffee, fresh vibes</h3>
            <p>
                Hommies Coffee adalah tempat dimana suasana hangat, aroma kopi, dan momen tenang
                berpadu sempurna. Kami menyajikan kopi pilihan berkualitas tinggi dengan proses
                yang teliti untuk menghadirkan rasa terbaik di setiap cangkir.
            </p>

            <div class="icons-container">
                <div class="icons">
                    <img src="image/about-icon-1.png" alt="">
                    <h3>best beans</h3>
                </div>

                <div class="icons">
                    <img src="image/about-icon-2.png" alt="">
                    <h3>pure flavor</h3>
                </div>

                <div class="icons">
                    <img src="image/about-icon-3.png" alt="">
                    <h3>cozy place</h3>
                </div>
            </div>

            <a href="about_detail.php" class="btn">learn more</a>
        </div>
    </div>
</section>

<!-- MENU SECTION -->
<section class="menu" id="menu">
    <h1 class="heading">our menu <span>popular menu</span></h1>

    <!-- FILTER -->
    <div class="filter-buttons" style="text-align:center; margin-bottom:25px;">
        <button class="btn filter-btn" data-filter="all">All</button>
        <button class="btn filter-btn" data-filter="coffee">Coffee</button>
        <button class="btn filter-btn" data-filter="noncoffee">Non Coffee</button>
    </div>

    <div class="menu-gallery">
        <?php
        $query = mysqli_query($conn, "SELECT * FROM menu ORDER BY id DESC");
        while ($row = mysqli_fetch_assoc($query)):
            ?>
        <div class="menu-card menu-item" data-category="<?= $row['kategori']; ?>">

            <img src="image/<?= $row['gambar']; ?>" alt="<?= $row['nama']; ?>">

            <div class="menu-info">

                <h3><?= $row['nama']; ?></h3>

                <?php if (!empty($row['deskripsi'])): ?>
                <p><?= $row['deskripsi']; ?></p>
                <?php endif; ?>

                <div class="price">Rp <?= number_format($row['harga'], 0, ',', '.'); ?></div>

                <!-- ADD TO CART BUTTON -->
                <?php if (!isset($_SESSION['user_id'])): ?>

                <!-- Guest → diarahkan ke login -->
                <a href="login.php" class="btn" style="margin-top:10px;">Add to Cart</a>

                <?php else: ?>

                <!-- User login → bisa tambah ke keranjang -->
                <form action="add_to_cart.php" method="POST">
                    <input type="hidden" name="id" value="<?= $row['id']; ?>">
                    <button type="submit" class="btn btn-primary">Add to Cart</button>
                </form>

                <?php endif; ?>

                <!-- ORDER BUTTON -->
                <?php if (!isset($_SESSION['user_id'])): ?>
                <a href="login.php" class="btn" style="margin-top:8px;">Order Now</a>
                <?php else: ?>
                <a href="order_add.php?id=<?= $row['id']; ?>" class="btn" style="margin-top:8px;">Order Now</a>
                <?php endif; ?>

            </div>
        </div>

        <?php endwhile; ?>
    </div>
</section>

<!-- REVIEW SECTION -->
<section id="review" class="review">
    <h1 class="heading">customer's review</h1>

    <div class="swiper review-slider">
        <div class="swiper-wrapper">

            <div class="swiper-slide box">
                <img src="image/pic-1.png" alt="">
                <h3>Ryuz</h3>
                <p>The Best Signature Coffee For Me</p>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
            </div>

            <div class="swiper-slide box">
                <img src="image/pic-2.png" alt="">
                <h3>Kanjoo</h3>
                <p>This is very delicious, especially the matcha, I really like it</p>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
            </div>

            <div class="swiper-slide box">
                <img src="image/pic-3.png" alt="">
                <h3></h3>
                <p>Very delicious coffee, perfect to accompany me when I'm feeling down.</p>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- BOOK SECTION -->
<section class="book" id="book">
    <h1 class="heading">book a table</h1>

    <form action="book.php" method="post">

        <input type="text" name="name" placeholder="your name" class="box" required>
        <input type="number" name="guests" placeholder="number of guests" class="box" required>

        <input type="datetime-local" name="date" class="box" required>
        <input type="text" name="phone" placeholder="phone number" class="box" required>

        <input type="submit" value="booking now" class="btn">
    </form>
</section>


<?php include "includes/footer.php"; ?>