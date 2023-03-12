<?php
/* Project Name: E-commerce
 * Author: Faruk Haider
 * Author URI: https://github.com/farukhaiderbd
 * Description: E-commerce project for PHP developer
 * Version: 1.0
 * PHP Version: 8.0.8
 * Date: 2023-03-12
 */
if (version_compare(PHP_VERSION, '8.0.8', '<')) { # php version check
    die('To run this E-commerce project, your host requires PHP 8.0.8 or higher.');
}
$page_title = "PHP Practical Test || Brain Station 23";
?>
<?php include_once './views/layout/header.php';?>
    <div class="main">
        <header>
            <nav class="navMenu">
                <a href="pages/task_one.php">Task 1</a>
                <a href="pages/task_two.php">Task 2</a>
            </nav>
        </header>
    </div>

<?php include_once './views/layout/footer.php';?>