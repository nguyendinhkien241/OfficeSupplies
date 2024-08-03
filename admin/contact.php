<?php
    include "./inc/head.php";
    include "./inc/header.php";
    include "./inc/sidebar.php";
?>

<?php
    include "../classes/contact.php";
    $cont = new contact();
?>

<?php
    if(isset($_GET['contactId'])) {
        $id = $_GET['contactId'];
        $delContact= $cont->delete_contact($id);
    }
?>

                    <div class="col l-10 m-12 main-dashboard">
                        <div class="dashboard change-pwad">
                            <h3 class="contact-heading">Tin nhắn phản hồi</h3>
                            <div class="contact-box">
                                <ul class="contact-list">
                                    <?php
                                        $contList = $cont->show_contact();
                                        if($contList) {
                                            while($result = $contList->fetch_assoc()) {
                                    ?>
                                    <li class="contact-row">
                                        <div class="contact-user-img">
                                            <i class="fa-regular fa-circle-user"></i>
                                        </div>
                                        <div class="contact-user-info">
                                            <div class="contact-user-top">
                                                <span class="contact-user-name"><?php echo $result['contactName'] ?></span> -
                                                <span class="contact-user-phone">
                                                    <i class="fa-solid fa-phone"></i>
                                                    <?php echo $result['contactPhone'] ?>
                                                </span>
                                            </div>
                                            <p class="contact-user-email">
                                                <i class="fa-regular fa-envelope"></i>
                                                <?php echo $result['contactEmail'] ?>
                                            </p>
                                            <p class="contact-user-address">
                                                <i class="fa-solid fa-location-dot"></i>
                                                <?php echo $result['contactAddress'] ?>
                                            </p>
                                            <p class="contact-date">
                                                <i class="fa-regular fa-clock"></i>
                                                <?php echo $result['date'] ?> <?php echo $result['time'] ?>
                                            </p>
                                            <p class="contact-text">
                                                <?php echo $result['content'] ?>
                                            </p>
                                        </div>

                                        <a href="?contactId=<?php echo $result['contactId'] ?>" class="contact-delete">
                                            <i class="fa-regular fa-circle-xmark"></i>
                                        </a>
                                    </li>

                                    <?php
                                            }
                                        }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>