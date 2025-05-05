$(function() {
  document.getElementById('usuario_form').addEventListener('submit', function(e) {
    const pass1 = document.getElementById('password_usuario').value;
    const pass2 = document.getElementById('password_usuario2').value;

    if (pass1 !== pass2) {
      e.preventDefault();
      Swal.fire({
        icon: 'error',
        title: 'Error',
        text: 'Las contraseñas no coinciden',
        confirmButtonColor: '#cc2026'
      });
      document.getElementById('password_usuario2').focus();
    }
  });

  // Validación en tiempo real
  document.getElementById('password_usuario2').addEventListener('input', function() {
    const pass1 = document.getElementById('password_usuario').value;
    const pass2 = this.value;
    const feedback = document.getElementById('password-feedback');

    if (pass1 !== pass2) {
      this.classList.add('is-invalid');
      feedback.style.display = 'block';
    } else {
      this.classList.remove('is-invalid');
      feedback.style.display = 'none';
    }
  });
})
