<script type="text/template" id="additional-info-template">
<div class="border rounded-xl p-4 bg-slate-50 info-card">

    <div class="flex justify-between items-center mb-3">
        <h4 class="font-semibold">Additional Info</h4>
        <button type="button"
                class="btn btn-sm btn-outline-danger"
                onclick="this.closest('.info-card').remove()">
            Remove
        </button>
    </div>

    <label class="form-label">Info Type</label>
    <input class="form-control mb-4"
           name="infos[__INDEX__][type]"
           placeholder="e.g. Cancellation Policy"
           value="__TYPE__">

    <div class="flex gap-2 border-b pb-2 mb-3">
        __LANG_TABS__
    </div>

    __LANG_SECTIONS__
</div>
</script>
