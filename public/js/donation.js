(() => {
    const dialog = document.querySelector('[data-donation-dialog]');
    const form = document.querySelector('[data-donation-form]');
    if (!dialog || !form) return;

    const status = dialog.querySelector('[data-donation-status]');
    const submit = dialog.querySelector('[data-donation-submit]');
    const bankDetails = dialog.querySelector('[data-donation-bank]');
    const recheck = dialog.querySelector('[data-donation-recheck]');
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
        form.querySelectorAll('input:not([type="hidden"])').forEach((input) => { input.readOnly = busy; });
        submit.innerHTML = busy ? 'Sending secure request…' : defaultButtonText;
    };

    async function pollDonation(publicId) {
        if (polling) return;
        polling = true;
        recheck.hidden = true;
        const template = dialog.dataset.statusUrl;
        const url = template.replace('__DONATION_ID__', encodeURIComponent(publicId));

        try {
            for (let attempt = 0; attempt < 100; attempt += 1) {
                const response = await fetch(url, { headers: { Accept: 'application/json' }, cache: 'no-store' });
                if (!response.ok) throw new Error('Status unavailable');
                const result = await response.json();
                if (result.status === 'completed' || result.status === 'failed') {
                    bankDetails.hidden = result.bank_transfer_available !== true;
                    showStatus(result.message, result.status);
                    setBusy(false);
                    activePublicId = null;
                    return;
                }
                showStatus(result.message || 'Waiting for your mobile money approval. Please check your phone.', 'pending');
                await new Promise((resolve) => window.setTimeout(resolve, 4000));
            }
            showStatus('The payment provider has not confirmed the outcome yet. Please contact CHF if no prompt arrived. Check the status again before starting another payment.', 'pending');
            submit.textContent = 'Still checking payment…';
            recheck.hidden = false;
        } catch (_) {
            showStatus('We could not refresh the payment status. If you approved the request, please allow a moment for confirmation.', 'pending');
            if (!activePublicId) setBusy(false);
            else recheck.hidden = false;
        } finally {
            polling = false;
        }
    }

    recheck.addEventListener('click', () => {
        if (activePublicId) pollDonation(activePublicId);
    });

    form.addEventListener('submit', async (event) => {
        event.preventDefault();
        status.hidden = true;
        bankDetails.hidden = true;
        setBusy(true);

        try {
            const response = await fetch(form.action, {
                method: 'POST',
                body: new FormData(form),
                headers: { Accept: 'application/json', 'X-Requested-With': 'XMLHttpRequest' },
            });
            const result = await response.json();

            if (!response.ok) {
                bankDetails.hidden = result.bank_transfer_available !== true;
                const firstValidationError = result.errors ? Object.values(result.errors).flat()[0] : null;
                throw new Error(firstValidationError || result.message || 'We could not start your donation. Please try again.');
            }

            activePublicId = result.public_id;
            submit.textContent = 'Checking payment status…';
            showStatus(result.message, 'pending');
            await pollDonation(activePublicId);
        } catch (error) {
            showStatus(error.message || 'We could not start your donation. Please try again.', 'failed');
            setBusy(false);
        }
    });
})();
