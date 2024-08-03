</div>

    <div class="footer">
        <div class="wrapper grid wide">
            <div class="footer-main row">
                <div class="col l-3 m-6 c-6">
                    <div class="column-footer">
                        <h3 class="footer-logo">
                            <i class="fa-solid fa-pen-fancy"></i>
                            <div class="footer-logo__text">Nhóm 2</div>
                        </h3>

                        <div class="footer-label">
                            Thông tin các thành viên trong nhóm
                        </div>

                        <div class="member-info">
                            <p class="member-info__text">21103100276 - Nguyễn Đình Kiên (L) - 24/01/2003</p>
                            <p class="member-info__text">21103100730 - Ngô Quang Hiển - 17/12/2003</p>
                            <p class="member-info__text">21103100851 - Nguyễn Đức Huy - 11/11/2003</p>
                        </div>
                    </div>
                </div>
                <div class="col l-3 m-6 c-6">
                    <div class="column-footer">
                        <div class="footer-cus-service">
                            <p>Hỗ trợ khách hàng</p>
                            <span>Hotline: 1900 0091</span><br>
                            <span class="mgt-8">Email</span>
                        </div>

                        <div class="email-service">
                            <p>ndkien.dhti15a4hn@sv.uneti.edu.vn</p>
                            <p>nqhien.dhti15a13hn@sv.uneti.edu.vn</p>
                            <p>ndhuy.dhti15a14hn@sv.uneti.edu.vn</p>
                        </div>

                        <p class="text-service">Chúng tôi luôn mong muốn mang đến những sản phẩm tốt nhất cho quý khách hàng</p>
                    </div>
                </div>
                <div class="col l-3 m-6 c-6">
                    <div class="column-footer">
                        <h3 class="footer-label address-label">Địa chỉ</h3>
                        <div class="address-company">
                            <div class="address-item">
                                <span class="footer-label">Head Office: </span>
                                <i class="fa-solid fa-location-dot"></i>
                                <p class="address-text">Số 353 Trần Hưng Đạo, P.Bà Triệu, TP.Nam Định</p>
                            </div>

                            <div class="address-item">
                                <span class="footer-label">Cơ sở 2: </span>
                                <i class="fa-solid fa-location-dot"></i>
                                <p class="address-text">Số 456 Minh Khai, P.Vĩnh Tuy, Q.Hai Bà Trưng, TP.Hà Nội</p>
                            </div>

                            <div class="address-item">
                                <span class="footer-label">Cơ sở 3: </span>
                                <i class="fa-solid fa-location-dot"></i>
                                <p class="address-text">Số 218 Đường Lĩnh Nam, Q.Hoàng Mai, TP.Hà Nội</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col l-3 m-6 c-6">
                    <div class="column-footer">
                        <h3 class="footer-label social-label">Thông tin liên hệ</h3>
                        <ul class="social-network">
                            <li><a href="">
                                <i class="fa-brands fa-facebook-f"></i>
                            </a></li>
                            <li><a href="">
                                <i class="fa-brands fa-youtube"></i>
                            </a></li>
                            <li><a href="">
                                <i class="fa-brands fa-google"></i>
                            </a></li>
                            <li><a href="">
                                <i class="fa-brands fa-twitter"></i>
                            </a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="copy_right">
            <div class="copy-right__text">Copyright by <a href="https://thienlong.vn/">thienlong.vn</a> - Đây chỉ là sản phẩm thử nghiệm - Tất cả những thông tin trên có thể không chính xác</div>
        </div>
        <div class="back-to-top" id="backToTopBtn" onclick="topFunc()">
            <i class="fa-solid fa-arrow-up"></i>
        </div>
        <script>
            let backToTopBtn = document.getElementById("backToTopBtn");
            window.onscroll = function() {
                scrollFunction();
            }
            function scrollFunction() {
                if(document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                    backToTopBtn.style.display = "grid";
                } else {
                    backToTopBtn.style.display = "none";
                }
            }

            function topFunc() {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            }
            
        </script>   
    </div>

    <?php
        if(isset($delCart)) {
            echo "<script>
            var url = window.location.href;
            var cleanUrl = url.split('?')[0];
            history.replaceState(null, null, cleanUrl);
        </script>";
        }
    ?>

</body>
</html>