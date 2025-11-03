<script>
document.addEventListener("DOMContentLoaded", function () {

  // ============================================================
  // 🖼️ SINGLE THUMBNAIL IMAGE PREVIEW
  // ============================================================
  const thumbInput = document.querySelector('input[name="thumb_image"]');
  if (thumbInput) {
    const existingPreview = document.createElement('div');
    existingPreview.id = 'thumbPreview';
    existingPreview.className = 'mt-3';
    thumbInput.insertAdjacentElement('afterend', existingPreview);

    thumbInput.addEventListener('change', function (event) {
      const file = event.target.files[0];
      if (!file) return;

      const reader = new FileReader();
      reader.onload = e => {
        existingPreview.innerHTML = `
          <div class="relative w-14 h-14 border rounded overflow-hidden">
            <img src="${e.target.result}" class="w-14 h-14 object-cover rounded">
            <button type="button" class="absolute m-1 top-0 left-0 bg-red-500 text-white text-xs px-1 py-0.5 rounded remove-thumb">✕</button>
          </div>
        `;
      };
      reader.readAsDataURL(file);
    });

    // Remove thumb before upload
    existingPreview.addEventListener('click', function (e) {
      if (e.target.classList.contains('remove-thumb')) {
        thumbInput.value = "";
        existingPreview.innerHTML = "";
      }
    });
  }

  // ============================================================
  // 🖼️ MULTIPLE GALLERY IMAGE PREVIEW (BEFORE UPLOAD)
  // ============================================================
  const galleryInput = document.getElementById('galleryInput');
  const galleryPreview = document.getElementById('galleryPreview');
  let selectedFiles = [];

  if (galleryInput) {
    galleryInput.addEventListener('change', function (event) {
      const newFiles = Array.from(event.target.files);
      selectedFiles = selectedFiles.concat(newFiles);
      renderPreviews();
    });

    function renderPreviews() {
      galleryPreview.innerHTML = '';
      selectedFiles.forEach((file, index) => {
        const reader = new FileReader();
        reader.onload = function (e) {
          const wrapper = document.createElement('div');
          wrapper.className = 'relative w-14 h-14 border rounded overflow-hidden';
          wrapper.innerHTML = `
            <img src="${e.target.result}" class="w-14 h-14 object-cover rounded">
            <button type="button" data-index="${index}" 
                    class="absolute top-0 m-1 left-0 bg-red-500 text-white text-xs px-1 py-0.5 rounded remove-preview">✕</button>
          `;
          galleryPreview.appendChild(wrapper);
        };
        reader.readAsDataURL(file);
      });
      updateInputFiles();
    }

    function updateInputFiles() {
      const dataTransfer = new DataTransfer();
      selectedFiles.forEach(file => dataTransfer.items.add(file));
      galleryInput.files = dataTransfer.files;
    }

    galleryPreview.addEventListener('click', function (e) {
      if (e.target.classList.contains('remove-preview')) {
        const index = parseInt(e.target.dataset.index);
        selectedFiles.splice(index, 1);
        renderPreviews();
      }
    });
  }

  // ============================================================
  // 🗑️ DELETE EXISTING GALLERY IMAGE (AJAX)
  // ============================================================
  document.querySelectorAll('.delete-image').forEach(btn => {
    btn.addEventListener('click', function () {
      if (confirm('Are you sure you want to delete this image?')) {
        fetch(`${this.dataset.url}`, {
          method: 'DELETE',
          headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
          }
        })
        .then(res => res.json())
        .then(data => {
          if (data.success) {
            this.closest('div.relative').remove();
          } else {
            alert('Failed to delete image');
          }
        })
        .catch(() => alert('Something went wrong'));
      }
    });
  });

    // Language button toggle
    const langButtons = document.querySelectorAll('.lang-btn');
  const langSections = document.querySelectorAll('.lang-section');

  langButtons.forEach(button => {
    button.addEventListener('click', () => {
      const targetLang = button.dataset.lang;

      // Toggle active button
      langButtons.forEach(btn => btn.classList.remove('active'));
      button.classList.add('active');

      // Toggle active language section
      langSections.forEach(section => {
        section.classList.remove('active');
        if (section.id === 'lang-section-' + targetLang) {
          section.classList.add('active');
        }
      });
    });
  });
  
});
</script>