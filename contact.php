
<?php
    include "head.php";
    include "header.php";
?>

<?php
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $date = date('Y-m-d');
        $time = date('H:i:s');
        $insertCont = $cont->insert_contact($_POST, $date, $time);
    }
?>

<?php
    if(Session::get('user_login')) {
        $info = $user->getInfo(Session::get('user_id'));
        $result = $info->fetch_assoc();
    }
?>

        <div class="contact-container">
            <div class="contact-main">
                <div class="contact-head">
                    <h3 class="contact-heading">Liên hệ</h3>
                    <div class="contact-desc">
                        <p>Công ty của chúng tôi luôn mong muốn được mang đến cho quý khách hàng có được trải nghiệm mua sắm và sản phẩm có chất lượng tốt nhất. Hãy liên hệ với chúng tôi nếu có bất cứ góp ý hay phản hồi gì về chất lượng sản phẩm. Chúc các bạn sẽ có khoảng thời gian mua sắm vui vẻ trên gian hàng của chúng tôi</p>
                    </div>
                </div>
                <form action="" method="POST" class="contact-body" id="contact-form">
                    <div class="contact-content">
                        <div class="contact-info">
                            <div class="contact-control contact-box">
                                <label for="name-contact" class="contact-label">Họ tên</label>
                                <input class="contact-input" id="full-name" type="text" name="name-contact" value="<?php 
                                if(Session::get('user_login')) {
                                    echo $result['fullName'];
                                }
                                ?>
                                ">
                                <span class="contact-message"></span>

                            </div>
                            <div class="contact-control contact-box">
                                <label for="email-contact" class="contact-label">Email</label>
                                <input class="contact-input" id="email" type="email" name="email-contact" value="<?php 
                                if(Session::get('user_login')) {
                                    echo $result['userEmail'];
                                }
                                ?>
                                ">
                                <span class="contact-message"></span>
                            </div>

                            <div class="contact-control contact-box">
                                <label for="phone-contact" class="contact-label">Số điện thoại</label>
                                <input class="contact-input" id="phone" type="text" name="phone-contact" value="<?php 
                                if(Session::get('user_login')) {
                                    echo $result['userPhone'];
                                }
                                ?>
                                ">
                                <span class="contact-message"></span>
                            </div>

                            <div class="contact-control contact-box">
                                <label for="phone-contact" class="contact-label">Địa chỉ</label>
                                <input class="contact-input" id="address" type="text" name="address-contact" value="<?php 
                                if(Session::get('user_login')) {
                                    echo $result['userAddress'];
                                }
                                ?>
                                ">
                                <span class="contact-message"></span>
                            </div>
                        </div>

                        <div class="contact-subject">
                            <div class="contact-area contact-box">
                                <label for="content" class="contact-label">Nội dung</label>
                                <textarea name="text-contact" id="content" cols="30" rows="10"></textarea>
                                <span class="contact-message"></span>
                            </div>
                        </div>
                    </div>

                    <div class="contact-btn">
                        <button type="submit">
                            <a class="contact-send-link">
                                Gửi đi
                            </a>
                        </button>
                    </div>
                </form>

                <script src="./js/validate3.js"></script>
                <script>
                    Validator({
                        form: '#contact-form',
                        errorSelector: '.contact-message',
                        formGroupSelector: '.contact-box',
                        rules: [
                            Validator.isRequired('#full-name'),
                            Validator.isRequired('#address'),
                            Validator.isEmail('#email', 'Vui lòng nhập email của bạn'),
                            Validator.isPhone('#phone', 'Vui lòng nhập số điện thoại'),
                            Validator.isRequired('#content'),
                        ],
                        
                    });
                </script>

            </div>

            <div id="toasts">
            </div>

            <script>
                const toasts = document.querySelector('#toasts');
                var data = <?php if(isset($insertCont)) {echo $insertCont;} else {echo "undefined";}?>;
                let templateInner;
                if(data) {
                    if (data.status === 'success') {
                    templateInner = `<i class="fa-solid fa-circle-check"></i>
                    <span class="message">${data.message}</span>`
                    } else {
                        templateInner = `<i class="fa-solid fa-triangle-exclamation"></i>
                        <span class="message">${data.message}</span>`
                    }
                    var toast = document.createElement('div');
                    toast.classList.add('toast');
                    toast.classList.add(data.status);
                    toast.innerHTML = `
                    ${templateInner}
                    <div class="countdown"></div>
                    `
                    toasts.appendChild(toast);
                    setTimeout(function() {
                        toast.style.animation = 'slideHide 2s ease-in-out forwards';
                    },3500);
                    setTimeout(function() {
                        toast.remove();
                    }, 5500);
                    if(data.status === 'success') {
                    delete data;
                    setTimeout(() => {
                        window.location.href = 'contact.php';
                    }, 5500);
                }
                delete data;
                }
            </script>

            <?php
                $insertCont = null;
            ?>
        </div>

<?php
    include "footer.php";
?>