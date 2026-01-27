<script>
    let infoIndex = {{ isset($package) ? $package->infos->count() : 0 }};
    const languages = @json($languages);

    /* ================= CKEDITOR INIT ================= */
    function initEditors(context = document) {
        console.log(document,'document');
        context.querySelectorAll('.editor:not(.editor-loaded)').forEach(el => {
            ClassicEditor
                .create(el)
                .then(editor => {
                    el.classList.add('editor-loaded');
                })
                .catch(error => console.error(error));
        });
    }

    /* ================= ADD INFO CARD ================= */
    function addAdditionalInfo(existing = null) {

        const typeValue = existing?.type ?? '';
        let langTabs = '';
        let langSections = '';

        languages.forEach((lang, i) => {
            const code = lang.code.toLowerCase();
            const tr = existing?.translations?.find(t => t.language_code === code) || {};

            langTabs += `
                <button type="button"
                        class="lang-btn ${i === 0 ? 'active' : ''}"
                        data-info-lang="${infoIndex}-${code}">
                    ${code.toUpperCase()}
                </button>
            `;

            langSections += `
                <div class="info-lang-section ${i === 0 ? 'active' : ''}"
                     id="info-${infoIndex}-${code}">

                    <label class="form-label">Title</label>
                    <input class="form-control mb-2"
                           name="infos[${infoIndex}][translations][${code}][title]"
                           value="${tr.title ?? ''}">

                    <label class="form-label">Content</label>
                    <textarea class="form-control h-24 editor"
                              name="infos[${infoIndex}][translations][${code}][content]">${tr.content ?? ''}</textarea>
                </div>
            `;
        });

        let template = document.getElementById('additional-info-template').innerHTML;

        template = template
            .replaceAll('__INDEX__', infoIndex)
            .replace('__TYPE__', typeValue)
            .replace('__LANG_TABS__', langTabs)
            .replace('__LANG_SECTIONS__', langSections);

        const box = document.getElementById('additionalInfoBox');
        box.insertAdjacentHTML('beforeend', template);

        // 🔥 THIS IS THE KEY FIX
        // if (existing === null) {
        //     initEditors(box);
        // }
        // initEditors(box);
        infoIndex++;
    }

    /* ================= LANGUAGE TAB SWITCH ================= */
    document.addEventListener('click', function (e) {
        if (!e.target.dataset.infoLang) return;

        const key = e.target.dataset.infoLang;
        const card = e.target.closest('.info-card');

        card.querySelectorAll('.lang-btn').forEach(b => b.classList.remove('active'));
        card.querySelectorAll('.info-lang-section').forEach(s => s.classList.remove('active'));

        e.target.classList.add('active');
        card.querySelector('#info-' + key).classList.add('active');
    });

    /* ================= EDIT MODE LOAD ================= */
    document.addEventListener('DOMContentLoaded', () => {

        // init editors already present (EDIT PAGE)
        // initEditors();

        @if(isset($package))
            const existingInfos = @json($package->infos->load('translations'));
            existingInfos.forEach(info => addAdditionalInfo(info));
        @endif
    });
    </script>
