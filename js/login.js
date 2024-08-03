const app = function() {
    const showPassword = document.querySelector('.show-password');
    const password = document.querySelector('#password');
    password.oninput = function() {
        showPassword.innerHTML = `
            <i class="icon-show fa-solid fa-eye-slash"></i>
        `;
        if(password.value.length === 0) {
            showPassword.innerHTML = ``;
        } else {
            const iconShow = document.querySelector('.icon-show');
            if(iconShow) {
                iconShow.addEventListener('click', function() {
                    if(password.type === 'password') {
                        password.type = 'text';
                        iconShow.classList.remove('fa-eye-slash');
                        iconShow.classList.add('fa-eye')
                    } else {
                        password.type = 'password';
                        iconShow.classList.remove('fa-eye')
                        iconShow.classList.add('fa-eye-slash');
                    }
                }) 
            }
            
        }
    }
}

app();