<script src="/<?php echo $root_path ?>/assets/js/vendor/jquery-2.2.4.min.js"></script>
<script src="/<?php echo $root_path ?>/assets/js/vendor/bootstrap.min.js"></script>
<script src="/<?php echo $root_path ?>/assets/js/jquery.ajaxchimp.min.js"></script>
<!-- notification JS
============================================ -->
<script src="/<?php echo $root_path ?>/assets/js/notifications/Lobibox.js"></script>
<script src="/<?php echo $root_path ?>/assets/js/notifications/notification-active.js"></script>


<script>
<?php //  session notification success 
if(isset($_SESSION['success'])): ?>
    Lobibox.notify('success', {
        sound: false,
        msg: "<?php echo $_SESSION['success'] ?>"
    });
<?php   // checked Message count 
         unset($_SESSION['success']); ?>
    <?php endif ?>
<?php   //  session notification error 
 if(isset($_SESSION['error'])): ?>
    Lobibox.notify('error', {
        sound: false,
        msg: "<?php echo $_SESSION['error'] ?>"
    });
    <?php   // checked Message count
            unset($_SESSION['error']); ?>
<?php endif ?>
</script>
</body>
</html>