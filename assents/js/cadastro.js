function togglePassword(id) {
    var input = document.getElementById(id);
    var icon = input.nextElementSibling.querySelector('i');
    if (input.type === "password") {
        input.type = "text";
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        input.type = "password";
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
}

document.addEventListener('DOMContentLoaded', function () {
    var today = new Date().toISOString().split('T')[0];
    document.getElementById('data_nascimento').setAttribute('max', today);
});

document.getElementById('cadastroForm').addEventListener('submit', function (event) {
    var senha = document.getElementById('senha').value;
    var confirmaSenha = document.getElementById('confirma_senha').value;
    var dataNascimento = new Date(document.getElementById('data_nascimento').value);
    var errorDiv = document.getElementById('error');
    var politicaPrivacidade = document.getElementById('politica_privacidade').checked;

    if (senha !== confirmaSenha) {
        event.preventDefault();
        errorDiv.textContent = 'As senhas não coincidem!';
        return;
    }

    if (senha.length < 8 || !/\d/.test(senha)) {
        event.preventDefault();
        errorDiv.textContent = 'A senha deve ter no mínimo 8 caracteres e conter números!';
        return;
    }

    var hoje = new Date();
    var maiorDeIdade = new Date(hoje.getFullYear() - 18, hoje.getMonth(), hoje.getDate());

    if (dataNascimento > maiorDeIdade) {
        event.preventDefault();
        errorDiv.textContent = 'Você deve ser maior de idade para se cadastrar!';
        return;
    }

    if (!politicaPrivacidade) {
        event.preventDefault();
        errorDiv.textContent = 'Você deve concordar com a política de privacidade!';
        return;
    }

    errorDiv.textContent = '';
});