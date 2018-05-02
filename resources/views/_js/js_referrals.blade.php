<script>

	let r = {
		refLinkInput: $('#refLink'),
		refCopy: $('.r-copy-click'),
		copyToClipboard() {
			let $temp = $("<input>");
			$("body").append($temp);
			$temp.val(r.refLinkInput.val()).select();
			document.execCommand("copy");
			$temp.remove();
		}
	};

	$(document).ready(() => {
		r.refCopy.click(() => {
			console.log(r.refLinkInput);
			r.copyToClipboard();
			$.notify('Ссылка скопирована', 'success');
			r.refLinkInput.focus();
			r.refLinkInput.select();
		});
	})
</script>