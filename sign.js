const togglePassword = document.getElementById('togglePassword');
const password = document.getElementById('password');

togglePassword.addEventListener('click', function() {
  const type = password.getAttribute('type') === 'password' ? 'password2' : 'password';
  password.setAttribute('type', type);
  this.querySelector('i').classList.toggle('fa-eye-slash');
});