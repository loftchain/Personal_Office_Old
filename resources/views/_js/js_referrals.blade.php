<script>

	let r = {
		refLinkInput: $('#refLink'),
		refCopy: $('.r-copy-click'),
    refBonus: $('.x-refs__bonus'),
    refInputContainer: $('.x-refs__input-container'),
    refTableHeader: $('.x-refs__header'),
    refTableFooter: $('.x-refs__footer'),
    noWalletMsg: $('.x-refs__no-wallet'),
		copyToClipboard() {
			let $temp = $("<input>");
			$("body").append($temp);
			$temp.val(r.refLinkInput.val()).select();
			document.execCommand("copy");
			$temp.remove();
		},

        isWallet() {
            $.ajax({
                url: '{{ route('referral.check.wallet') }}',
                type: 'GET',
                success: data => {
                    if(data === 'ok'){
                        r.refBonus.show();
                        r.refInputContainer.show();
                        r.noWalletMsg.hide();
                    }
                }
            })
        },

        isReferral() {
		    $.ajax({
                url: '{{ route('referral.check') }}',
                type: 'GET',
                dataType: 'JSON',
                success: data => {
                    if(data.length > 0){
                        r.refTableHeader.show();
                        r.refTableFooter.show();
                        r.noWalletMsg.hide();
                    }
                }
            })
        }
	};



	$(document).ready(() => {
        r.refBonus.hide();
        r.refInputContainer.hide();
        r.refTableHeader.hide();
        r.refTableFooter.hide();

        r.isWallet();
        r.isReferral();

		r.refCopy.click(() => {
			r.copyToClipboard();
			$.notify('{!! trans('home/refs.linkCopied_js') !!}', 'success');
			r.refLinkInput.focus();
			r.refLinkInput.select();
		});
	})
</script>