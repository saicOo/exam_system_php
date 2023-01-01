<?php
if(isset($_GET['logout'])){
    session_unset();
    session_destroy();
    header('location:<?php echo $root_path ?>login/index.php');
    exit;
  }
?>
<!DOCTYPE html>
<html lang="en" class="no-js">

<head>
  <!-- Mobile Specific Meta -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Favicon -->
  <link rel="shortcut icon" href="<?php echo $root_path ?>/assets/img/fav.png" />
  <!-- Author Meta -->
  <meta name="author" content="colorlib" />
  <!-- Meta Description -->
  <meta name="description" content="" />
  <!-- Meta Keyword -->
  <meta name="keywords" content="" />
  <!-- meta character set -->
  <meta charset="UTF-8" />
  <!-- Site Title -->
  <title>Exam Online</title>

  <!--
      CSS
      =============================================
    -->
    <link rel="stylesheet" href="<?php echo $root_path ?>/assets/css/font-awesome.min.css" />
    <link rel="stylesheet" href="<?php echo $root_path ?>/assets/css/bootstrap.css" />
    <!-- notifications CSS
		============================================ -->
    <link rel="stylesheet" href="<?php echo $root_path ?>/assets/css/notifications/Lobibox.min.css">
    <link rel="stylesheet" href="<?php echo $root_path ?>/assets/css/notifications/notifications.css">
</head>

<body style="background: linear-gradient(282deg, var(--gray-dark), #3b4958);color: #fff;">
  	<!-- ================ Start Header Area ================= -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="<?php echo $root_path ?>/">Home <span class="sr-only">(current)</span></a>
      </li>
      <?php if(isset($_SESSION['admin'])): ?>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo $root_path ?>/dashboard.php">Dashboard</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo $root_path ?>/subject.php">subjects</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo $root_path ?>/question.php">qustions</a>
      </li>
      <?php endif; ?>
      
      <li class="nav-item">
        <a class="nav-link" href="<?php echo $root_path ?>/exam.php">exams</a>
      </li>
  </div>
</nav>
	<!-- ================ End Header Area ================= -->