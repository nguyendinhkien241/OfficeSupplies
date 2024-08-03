<?php
    include "./inc/head.php";
    include "./inc/header.php";
    include "./inc/sidebar.php";
?>

<?php
    include_once "../classes/user.php";
    $user = new user();
?>

<?php
    if(isset($_GET['action']) && isset($_GET['userId'])) {
        $action = $_GET['action'];
        $id = $_GET['userId'];
        $lock = $user->disableAccount($id, $action);
    }

    if(!isset($_GET['action']) && isset($_GET['userId'])) {
        $id = $_GET['userId'];
        $delete = $user->delete_user($id);
    }
?>

                    <div class="col l-10 m-12 main-dashboard">
                        <div class="dashboard user-container">
                            <h3 class="user-heading">Danh sách người dùng</h3>
                            <div class="user-box">
                                <ul class="user-list">
                                    <?php
                                        $userList = $user->show_user();
                                        if($userList) {
                                            $i = 0;
                                            while($row = $userList->fetch_assoc()) {
                                                $i++;
                                            
                                    ?>
                                    <li class="user-row">
                                        <div class="user-ordinal">
                                            <span><?php echo $i ?></span>
                                        </div>
                                        <div class="user-table">
                                            <table>
                                                <tr>
                                                    <th>Họ tên</th>
                                                    <th>Email</th>
                                                    <th>Số điện thoại</th>
                                                    <th>Điều chỉnh</th>
                                                </tr>

                                                <tr>
                                                    <td><?php echo $row['fullName'] ?></td>
                                                    <td><?php echo $row['userEmail'] ?></td>
                                                    <td><?php echo $row['userPhone'] ?></td>
                                                    <td>
                                                        <?php
                                                            if($row['disable'] == 0) {
                                                        ?>
                                                        <a href="?action=lock&userId=<?php echo $row['userId'] ?>" class="user-change-link">Khóa</a>
                                                        <?php
                                                            } else {
                                                        ?>
                                                        <a href="?action=unlock&userId=<?php echo $row['userId'] ?>" class="user-change-link">Mở Khóa</a>
                                                        <?php
                                                            }
                                                        ?>
                                                        <a data-id="<?php echo $row['userId'] ?>" onclick="showModal(this)" class="user-delete-link">Xóa</a>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
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
        <div class="modal hide">
            <div class="modal__inner">
                <div class="modal__header">
                    <p>
                        <i class="fa-solid fa-circle-exclamation"></i>
                        Cảnh báo
                    </p>
                    <i class="fas fa-times"></i>
                </div>
                <div class="modal__body">
                    <h2>Tài khoản này sẽ bị Xóa</h2>
                    <p>Bạn có muốn tiếp tục không?</p>
                </div>
                <div class="modal__footer">
                    <a class="submit-action">Xác nhận</a>
                    <button>Close</button>
                </div>
            </div>
        </div>

        <script>
            var modal = document.querySelector('.modal');
            var iconClose = document.querySelector('.modal__header>i');
            var btnClose = document.querySelector('.modal__footer button');
            var submitBtn = document.querySelector('.submit-action');
            function toggleModal() {
                modal.classList.toggle('hide');
            }
            btnClose.onclick = toggleModal;
            iconClose.onclick = toggleModal;
            modal.addEventListener('click', function(e) {
                if(e.target == e.currentTarget) {
                    toggleModal();
                }
            });
            function showModal(x) {
                toggleModal();
                var id = x.getAttribute('data-id');
                submitBtn.href = `?userId=${id}`;
            }
        </script>

        <div id="toasts">
        </div>

        <script>
            const toasts = document.querySelector('#toasts');
            var data = <?php if(isset($delete)) {echo $delete;} else {echo undefined;}?>;
            let templateInner;
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
                    window.location.href = 'user.php';
                }, 5500);
            }
            delete data;
        </script>
    </div>
</body>
</html>