<script>
    let a2 = {
        docImgInput: $('.doc-img-input'),
        dustbin: $('.dustbin'),
        readURL(input) {
	        let container = input.parent();
	        if (input[0].files) {
		        let reader = new FileReader();
		        reader.onload = (e) => {
			        container.children('.preview-doc-img').attr('src', e.target.result);
		        };
		        reader.readAsDataURL(input[0].files[0]);
	        }
        },
        deleteDoc(container, _this){
	        container.children('.preview-doc-img').attr('src', '');
	        _this.val('');
        }
    };


	$(document).ready(() => {
		a2.docImgInput.each(function(){
			let parent = $(this).parent();
	        $(this).change(() => {
		        a2.readURL($(this));
	        });

			parent.children('.dustbin').click(() => {
				a2.deleteDoc(parent, $(this));
            });
        });

	});
</script>