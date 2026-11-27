// Affichage et masquage du mot de passe
document.querySelectorAll('.password-toggle').forEach(button => {

    button.addEventListener('click', () => {

        const input = button.closest('.password-wrapper')
            .querySelector('input');

        const isHidden = input.type === 'password';

        input.type = isHidden ? 'text' : 'password';

        const icon = button.querySelector('img');
            icon.src = isHidden
                ? 'assets/images/password_eye_off.svg'
                : 'assets/images/password_eye.svg';

        button.setAttribute('aria-label',
            isHidden ? 'Masquer le mot de passe'
                     : 'Afficher le mot de passe');
    });
});