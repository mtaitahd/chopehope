<dialog class="donation-dialog" aria-labelledby="donation-dialog-title" data-donation-dialog data-status-url="{{ url('/donate/mobile-money/__DONATION_ID__') }}">
    <div class="donation-dialog__header"><div><p class="eyebrow"><span></span> Secure mobile payment</p><h2 id="donation-dialog-title">Donate with mobile money</h2></div><button class="donation-dialog__close" type="button" aria-label="Close" data-donation-close>&times;</button></div>
    <p class="donation-dialog__intro">Enter your details. Abliner will route the request to the mobile money network for your number.</p>
    <form data-donation-form action="{{ route('donate.mobile-money') }}" method="post">
        @csrf
        <label for="donor-name">Your name</label><input id="donor-name" name="name" type="text" autocomplete="name" minlength="2" maxlength="120" required>
        <label for="donor-amount">Donation amount (TZS)</label><input id="donor-amount" name="amount" type="number" min="500" max="3000000" step="1" inputmode="numeric" required><small>Minimum TZS 500. Maximum TZS 3,000,000.</small>
        <label for="donor-phone">Mobile money number</label><input id="donor-phone" name="phone" type="tel" autocomplete="tel" inputmode="tel" placeholder="07XX XXX XXX or +255 7XX XXX XXX" pattern="(\+?255[ -]?|0)?[67]([0-9][ -]?){8}" maxlength="24" required><small>Carrier routing is selected automatically. You approve the charge with your PIN on your phone.</small>
        <p class="donation-dialog__status" role="status" aria-live="polite" data-donation-status hidden></p>
        <button class="button button--blue donation-dialog__submit" type="submit" data-donation-submit>Continue to mobile money <span aria-hidden="true">→</span></button>
    </form>
</dialog>
