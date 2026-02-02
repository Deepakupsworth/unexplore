<script src="{{ asset('backend/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('backend/js/rt-plugins.js') }}"></script>
<script src="{{ asset('backend/js/app.js') }}"></script>

{{-- CKEditor Library (NO auto init) --}}
<script src="https://cdn.ckeditor.com/ckeditor5/41.3.1/classic/ckeditor.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll('textarea.editor').forEach((textarea) => {
            ClassicEditor
                .create(textarea, {
                    toolbar: [
                        'heading', '|',
                        'bold', 'italic', 'link', 'bulletedList', 'numberedList', '|',
                        'blockQuote', 'insertTable', 'undo', 'redo'
                    ],
                    heading: {
                        options: [{
                                model: 'paragraph',
                                title: 'Paragraph',
                                class: 'ck-heading_paragraph'
                            },
                            {
                                model: 'heading1',
                                view: 'h1',
                                title: 'Heading 1',
                                class: 'ck-heading_heading1'
                            },
                            {
                                model: 'heading2',
                                view: 'h2',
                                title: 'Heading 2',
                                class: 'ck-heading_heading2'
                            }
                        ]
                    }
                })
                .then(editor => {
                    console.log('CKEditor initialized for:', textarea.name);
                })
                .catch(error => {
                    console.error('CKEditor init error:', error);
                });
        });
    });
</script>
