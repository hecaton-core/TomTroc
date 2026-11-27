<?php require __DIR__ . '/partials/header.php'; ?>

<div class="auth-page">
    <section class="auth-content">
        <div class="auth-form-container">
            <h1>Inscription</h1>
            <?php if (!empty($errors)): ?>
                <div class="auth-errors">
                    <?php foreach ($errors as $error): ?>
                        <p><?= htmlspecialchars($error) ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            <form action="index.php?action=register" method="POST" class="auth-form">
                <input type="hidden" name="csrf_token"
                    value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">
                <label for="pseudo">Pseudo</label>
                <input type="text" id="pseudo" name="pseudo"
                    value="<?= htmlspecialchars($pseudo ?? '') ?>"
                    minlength="3" maxlength="50" required>
                <label for="email">Adresse email</label>
                <input type="email" id="email" name="email"
                    value="<?= htmlspecialchars($email ?? '') ?>"
                    maxlength="255" required>
                <label for="password">Mot de passe</label>
                <div class="password-wrapper">
                    <input type="password" id="password" name="password"
                    minlength="10" autocomplete="new-password" required>
                    <button type="button" class="password-toggle" aria-label="Afficher le mot de passe">
                        <img src="assets/images/password_eye.svg">
                    </button>
                </div>
                <button type="submit">S'inscrire</button>
            </form>

            <p class="auth-switch">
                Déjà inscrit ?
                <a href="index.php?action=login">Connectez-vous</a>
            </p>
        </div>
    </section>

    <div class="auth-image">
        <img src="assets/images/auth.png" alt="Bibliothèque de livres">
    </div>
</div>

<?php require __DIR__ . '/partials/footer.php'; ?>