document.addEventListener('DOMContentLoaded', function() {
    const passwordInput = document.getElementById('password');
    const togglePassword = document.getElementById('togglePassword');
    const loginForm = document.getElementById('loginForm');

    // 1. Fitur Lihat/Sembunyikan Password
    togglePassword.addEventListener('click', function() {
        // Cek tipe input saat ini
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        
        // Ubah ikon mata (FontAwesome)
        this.classList.toggle('fa-eye');
        this.classList.toggle('fa-eye-slash');
    });

    // 2. Simulasi Submit Form Login
    loginForm.addEventListener('submit', function(e) {
        e.preventDefault(); // Mencegah reload halaman secara default
        
        const username = document.getElementById('username').value;
        const password = passwordInput.value;

        // Di sini kamu bisa memasukkan logika AJAX/Fetch untuk validasi ke backend Yii
        console.log('Mencoba login dengan:', username);
        
        // Contoh alert sukses sementara
        alert('Proses login untuk ' + username + ' berhasil dipicu! Menghubungkan ke sistem pemantauan...');
    });
});
document.addEventListener('DOMContentLoaded', function() {
    const password = document.getElementById('password');
    const confirmPassword = document.getElementById('confirmPassword');
    const togglePassword = document.getElementById('togglePassword');
    const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');
    const passwordError = document.getElementById('passwordError');
    const registerForm = document.getElementById('registerForm');
    const submitBtn = document.querySelector('.btn-login');

    // 1. Toggle Lihat Password Utama
    togglePassword.addEventListener('click', function() {
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        this.classList.toggle('fa-eye');
        this.classList.toggle('fa-eye-slash');
    });

    // 2. Toggle Lihat Konfirmasi Password
    toggleConfirmPassword.addEventListener('click', function() {
        const type = confirmPassword.getAttribute('type') === 'password' ? 'text' : 'password';
        confirmPassword.setAttribute('type', type);
        this.classList.toggle('fa-eye');
        this.classList.toggle('fa-eye-slash');
    });

    // 3. Validasi Kecocokan Password Real-time
    function validatePassword() {
        if (confirmPassword.value === "") {
            passwordError.style.display = "none";
            submitBtn.disabled = false;
            return;
        }

        if (password.value !== confirmPassword.value) {
            passwordError.style.display = "block";
            confirmPassword.style.borderColor = "#dc3545";
            submitBtn.disabled = true;
            submitBtn.style.opacity = "0.6";
            submitBtn.style.cursor = "not-allowed";
        } else {
            passwordError.style.display = "none";
            confirmPassword.style.borderColor = "#198754";
            submitBtn.disabled = false;
            submitBtn.style.opacity = "1";
            submitBtn.style.cursor = "pointer";
        }
    }

    password.addEventListener('input', validatePassword);
    confirmPassword.addEventListener('input', validatePassword);

    // 4. Simulasi Submit Pendaftaran
    registerForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const fullname = document.getElementById('fullname').value;
        const email = document.getElementById('email').value;
        const instansi = document.getElementById('instansi').value;

        console.log('Mencoba mendaftarkan user baru:', { fullname, email, instansi });
        
        alert(`Pendaftaran Berhasil!\n\nHalo ${fullname}, akun Anda telah diajukan ke admin sistem Pemantauan Hilal LDII untuk proses aktivasi.`);
        
        // Di sini bisa diarahkan ke halaman login setelah sukses
        // window.location.href = 'login.html';
    });
});