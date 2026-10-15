(() => {
    const dialog = document.querySelector('[data-donation-dialog]');
    const form = document.querySelector('[data-donation-form]');
    if (!dialog || !form) return;

    const status = dialog.querySelector('[data-donation-status]');
    const submit = dialog.querySelector('[data-donation-submit]');
    const defaultButtonText = submit.innerHTML;
    const supportsNativeDialog = typeof dialog.showModal === 'function';
    let activePublicId = null;
    let polling = false;

    const openDialog = () => {
        if (supportsNativeDialog) {
            dialog.showModal();
        } else {
            dialog.setAttribute('open', '');
            dialog.classList.add('is-open');
            document.body.classList.add('has-donation-dialog');
        }
        const firstInput = dialog.querySelector('input');
        if (firstInput) firstInput.focus();
    };

    const closeDialog = () => {
        if (supportsNativeDialog) {
            dialog.close();
        } else {
            dialog.removeAttribute('open');
            dialog.classList.remove('is-open');
            document.body.classList.remove('has-donation-dialog');
        }
    };

    document.querySelectorAll('[data-donation-open]').forEach((button) => button.addEventListener('click', openDialog));
    dialog.querySelector('[data-donation-close]').addEventListener('click', closeDialog);
    dialog.addEventListener('click', (event) => {
        if (event.target === dialog) closeDialog();
    });
    if (!supportsNativeDialog) {
        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape' && dialog.classList.contains('is-open')) closeDialog();
        });
    }

    const showStatus = (message, state = 'pending') => {
        status.textContent = message;
        status.dataset.state = state;
        status.hidden = false;
    };

    const setBusy = (busy) => {
        submit.disabled = busy;
        submit.innerHTML = busy ? 'Sending secure request…' : defaultButtonText;
    };

    async function pollDonation(publicId) {
        if (polling) return;
        polling = true;
        const template = dialog.dataset.statusUrl;
        const url = template.replace('__DONATION_ID__', encodeURIComponent(publicId));

        try {
            for (let attempt = 0; attempt < 100; attempt += 1) {
                const response = await fetch(url, { headers: { Accept: 'application/json' }, cache: 'no-store' });
                const result = await response.json();
                if (result.status === 'completed' || result.status === 'failed') {
                    showStatus(result.message, result.status);
                    setBusy(false);
                    activePublicId = null;
                    return;
                }
                showStatus(result.message || 'Waiting for your mobile money approval. Please check your phone.', 'pending');
                await new Promise((resolve) => window.setTimeout(resolve, 4000));
            }
            showStatus('Your payment is still being confirmed. You may close this window; if the payment completed, it will be recorded automatically.', 'pending');
            submit.textContent = 'Still checking payment…';
        } catch (_) {
            showStatus('We could not refresh the payment status. If you approved the request, please allow a moment for confirmation.', 'pending');
            if (!activePublicId) setBusy(false);
        } finally {
            polling = false;
        }
    }

    form.addEventListener('submit', async (event) => {
        event.preventDefault();
        status.hidden = true;
        setBusy(true);

        try {
            const response = await fetch(form.action, {
                method: 'POST',
                body: new FormData(form),
                headers: { Accept: 'application/json', 'X-Requested-With': 'XMLHttpRequest' },
            });
            const result = await response.json();

            if (!response.ok) {
                const firstValidationError = result.errors ? Object.values(result.errors).flat()[0] : null;
                throw new Error(firstValidationError || result.message || 'We could not start your donation. Please try again.');
            }

            activePublicId = result.public_id;
            showStatus(result.message, 'pending');
            await pollDonation(activePublicId);
        } catch (error) {
            showStatus(error.message || 'We could not start your donation. Please try again.', 'failed');
            setBusy(false);
        }
    });
})();
