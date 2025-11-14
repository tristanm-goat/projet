document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('signupForm');
    const usernameEl = document.getElementById('username');
    const passwordEl = document.getElementById('password');
    const errorEl = document.getElementById('signupErrors');

    // Configuration
    const USERNAME_MIN = 3;
    const USERNAME_MAX = 20;
    const PASSWORD_MIN = 8;
    const PASSWORD_MAX = 64;
    const MIN_UPPERCASE = 1;
    const MIN_DIGITS = 1;
    const USERNAME_PATTERN = /^[A-Za-z0-9_]+$/; // allowed chars for username

    function validateAll() {
        const username = (usernameEl && usernameEl.value || '').trim();
        const password = (passwordEl && passwordEl.value) || '';

        const errors = [];

        // Username checks
        if (!username) {
            errors.push('Username is required.');
        } else {
            if (username.length < USERNAME_MIN || username.length > USERNAME_MAX) {
                errors.push(`Username must be ${USERNAME_MIN}-${USERNAME_MAX} characters.`);
            }
            if (!USERNAME_PATTERN.test(username)) {
                errors.push('Username may only contain letters, numbers and underscore (_).');
            }
        }

        // Password checks
        if (!password) {
            errors.push('Password is required.');
        } else {
            if (password.length < PASSWORD_MIN || password.length > PASSWORD_MAX) {
                errors.push(`Password must be ${PASSWORD_MIN}-${PASSWORD_MAX} characters.`);
            }
            if ((password.match(/[A-Z]/g) || []).length < MIN_UPPERCASE) {
                errors.push(`Password must contain at least ${MIN_UPPERCASE} uppercase letter${MIN_UPPERCASE > 1 ? 's' : ''}.`);
            }
            if ((password.match(/\d/g) || []).length < MIN_DIGITS) {
                errors.push(`Password must contain at least ${MIN_DIGITS} digit${MIN_DIGITS > 1 ? 's' : ''}.`);
            }
            if (/\s/.test(password)) {
                errors.push('Password cannot contain spaces.');
            }
        }

        return errors;
    }

    function showErrors(errors) {
        if (!errorEl) return;
        if (!errors.length) {
            errorEl.textContent = '';
            errorEl.style.display = 'none';
            return;
        }
        errorEl.style.display = 'block';
        errorEl.innerHTML = '<ul style="margin:0 0 0 18px;padding:0;">' + errors.map(e => `<li>${e}</li>`).join('') + '</ul>';
    }

    // Prevent submit if invalid
    if (form) {
        form.addEventListener('submit', (e) => {
            const errors = validateAll();
            if (errors.length) {
                showErrors(errors);
                e.preventDefault();
                e.stopPropagation();
            } else {
                showErrors([]);
                // allow submit; server-side validation must still run
            }
        });
    }

    // Live validation for better UX
    [usernameEl, passwordEl].forEach(el => {
        if (!el) return;
        el.addEventListener('input', () => {
            const errors = validateAll();
            showErrors(errors);
        });
        el.addEventListener('blur', () => {
            const errors = validateAll();
            showErrors(errors);
        });
    });
});