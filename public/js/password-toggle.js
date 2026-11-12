document.querySelectorAll('.login-card input[type="password"]').forEach((input, index) => {
    if (input.name === 'password_confirmation') return;
    if (input.closest('.password-input-wrap')) return;

    const wrapper = document.createElement('span');
    wrapper.className = 'password-input-wrap';
    input.parentNode.insertBefore(wrapper, input);
    wrapper.append(input);

   

    button.addEventListener('click', () => {
        const visible = input.type === 'password';
        input.type = visible ? 'text' : 'password';
        button.setAttribute('aria-label', visible ? 'Hide password' : 'Show password');
        button.setAttribute('aria-pressed', String(visible));
        wrapper.classList.toggle('password-visible', visible);
    });
    
});
