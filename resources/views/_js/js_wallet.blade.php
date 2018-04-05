<script>
    let wa = {
        checkboxImg: $('.checkbox-img'),
        switchWalletLink: $('.switch-wallet-link'),
        editBtn: $('.edit-btn'),
        submitBtn: $('.sbmt-btn'),
        wInput: $('.w-input'),
        wInput0: $('#wallet_from0'),
        errorMessage: $('.error-message'),
        switchCheckBox(_this) {
            wa.checkboxImg.attr('src', '{{ asset('img/empty-checkbox.png') }}');
            _this[0].childNodes[1].childNodes[1].src = '{{ asset('img/checked-checkbox.png') }}';
        },

        editMode(_this) {
            _this.prop('disabled', false);
            _this.next().next().show();
            _this.prev().hide();
            setTimeout(() => {
                _this.focus();
            }, 1);
        },

        exitEditMode() {
            wa.wInput.prop('disabled', true);
            wa.submitBtn.hide();
            wa.editBtn.show();
	        wa.wInput.removeClass('isError');
	        wa.wInput.val('');
	        wa.errorMessage.html('');
        },

	    resetInput() {
		    wa.wInput.removeClass('isError');
		    wa.wInput.val('');
		    wa.errorMessage.html('');
	    }
    };


    //--------------------------------------


    $(document).ready(() => {
    	
	    let submitClicked = false;

        wa.switchWalletLink.each(function () {
            $(this).click(() => {
                wa.switchCheckBox($(this));
            })
        });

        wa.wInput.each(function () {
            $(this).prev().click(() => {
                wa.editMode($(this));
            });
        });

	    wa.submitBtn.click(() => {
		    submitClicked = true;
	    });

        wa.wInput.focusout(() => {
	        console.log(submitClicked);
	        	setTimeout(() => {
			        if(!submitClicked) {
				        wa.exitEditMode();
			        } else {
				        submitClicked = false;
			        }
		        },150);
        });

    });
</script>