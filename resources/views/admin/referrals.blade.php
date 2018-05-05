<main class="a-wrapper r-wrapper">
    <section class="a-wrapper__header">
        <div class="a-wrapper__header_el r-user-id">id</div>
        <div class="a-wrapper__header_el r-wallet-to">Wallet</div>
        <div class="a-wrapper__header_el r-tokens">Tokens</div>
    </section>
    @foreach($data['adminReferrals'] as $ar)
        <section class="a-wrapper__section">
            <div class="a-wrapper__section_el r-user-id">{{ $ar->user_id }}</div>
            <div class="a-wrapper__section_el r-wallet-to">{{ $ar->wallet_to }}</div>
            <div class="a-wrapper__section_el r-tokens">{{ $ar->tokens }}</div>
        </section>
    @endforeach
</main>