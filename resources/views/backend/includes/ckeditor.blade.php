<script>
    document.addEventListener("DOMContentLoaded", function () {

        document.querySelectorAll('.ckeditor').forEach((textarea) => {

            if (textarea.dataset.initialized) return;

            ClassicEditor.create(textarea, {
                toolbar: [
                    'heading', '|',
                    'bold', 'italic', 'link',
                    'bulletedList', 'numberedList', '|',
                    'blockQuote', 'insertTable',
                    'undo', 'redo'
                ],
            })
            .then(editor => {
                textarea.dataset.initialized = true;
            })
            .catch(error => {
                console.error(error);
            });

        });

    });
    </script>
