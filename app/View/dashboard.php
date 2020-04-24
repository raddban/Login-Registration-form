<?php session_start();?>
<?php if ($_SESSION['email'] == null) header('location: /');?>
<h1>Dashboard</h1>

Welcome <?php echo  $_SESSION['email']?>
<form action="" method="get">
    <button name="log">Logout</button>
</form>

<?php if (!empty($_GET))
{
    unset($_SESSION['email']);
    session_destroy();
    header('location: /');

}?>




