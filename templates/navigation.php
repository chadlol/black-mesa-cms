

<aside>
    <nav>
        <a href ='index.php' class='home'> <img src="images/home.png" alt="home"> </a> <br/>
        <a href='products.php'> Products </a>		<br/>
        <a href='articles.php'> News </a>		<br/>
        <a href='blog.php'> Blog </a>			    <br/>
        <a href='calendar.php'> Calendar</a>		<br/>
        <a href='aboutus.php'> About Us </a>		<br/>
        <a href='contactus.php'> Contact Us </a>	<br/>

        <?php
        if ($_SESSION['name']){
            echo "<a href='admin_panel.php'> Admin Panel </a>	<br/>";
            echo "<a href='logout.php'> Logout </a><br/>";

        }
        else{
            echo "<a href='login.php'> Login </a><br/>";
        }

        ?>

    </nav>

</aside>