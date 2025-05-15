// Toggle password visibility
function togglePassword(inputId) {
    const passwordInput = document.getElementById(inputId);
    const icon = passwordInput.nextElementSibling.nextElementSibling.querySelector('i');

    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        icon.classList.remove('bi-eye');
        icon.classList.add('bi-eye-slash');
    } else {
        passwordInput.type = 'password';
        icon.classList.remove('bi-eye-slash');
        icon.classList.add('bi-eye');
    }
}

// Form Register
document.getElementById('registerForm').addEventListener('submit', function (e) {
    e.preventDefault();

    // Get form values
    const name = document.getElementById('registerName').value;
    const nim = document.getElementById('registerNIM').value;
    const email = document.getElementById('registerEmail').value;
    const password = document.getElementById('registerPassword').value;
    const confirmPassword = document.getElementById('registerConfirmPassword').value;
    const faculty = document.getElementById('registerFaculty').value;

    // Validate password match
    if (password !== confirmPassword) {
        alert('Password dan konfirmasi password tidak cocok!');
        return;
    }

    // send values
    console.log('Registration attempt:', {
        name,
        nim,
        email,
        password,
        faculty
    });

    // show success message
    alert('Pendaftaran berhasil! Silakan login dengan akun baru Anda.');
    switchTab('login');
});

// Form Login
document.getElementById('loginForm').addEventListener('submit', function (e) {
    e.preventDefault();

    // Get form values
    const username = document.getElementById('loginUsername').value;
    const password = document.getElementById('loginPassword').value;

    // send values
    console.log('Login attempt:', {
        username,
        password
    });

    // redirect index.html
    window.location.href = 'index.html';
});

