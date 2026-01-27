<div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto"
    id="addOptionModal" tabindex="-1" aria-hidden="true">

    <div class="modal-dialog relative w-auto pointer-events-none">
        <div
            class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto
                    bg-white rounded-md outline-none text-current">

            <div class="relative bg-white rounded-lg shadow dark:bg-slate-700">

                {{-- HEADER --}}
                <div class="flex items-center justify-between p-5 border-b rounded-t dark:border-slate-600 bg-black-500">
                    <h3 class="text-base font-medium text-white">
                        Add Optional Item
                    </h3>

                    <button type="button" class="text-white" data-bs-dismiss="modal">
                        ✕
                    </button>
                </div>

                {{-- BODY --}}
                <form id="optionForm">
                    @csrf

                    <div class="p-6 space-y-4">

                        <input type="hidden" name="package_day_id">

                        {{-- ITEM TYPE --}}
                        <div>
                            <label class="form-label">Item Type</label>
                            <select name="item_type" class="form-control" required>
                                <option value="">Select Type</option>
                                <option value="hotel">Hotel</option>
                                <option value="event">Event</option>
                                <option value="todo">To Do</option>
                            </select>
                        </div>

                        {{-- ITEM --}}
                        <div>
                            <label class="form-label">Item</label>
                            <select name="item_id" class="form-control" required>
                                <option value="">Select Item</option>
                            </select>
                        </div>

                        {{-- EXTRA PRICE --}}
                        <div>
                            <label class="form-label">Extra Price</label>
                            <input type="number" step="0.01" name="extra_price" class="form-control" value="0">
                        </div>

                        {{-- DEFAULT --}}
                        <div class="flex items-center gap-2">
                            <input type="checkbox" name="is_default" value="1">
                            <span class="text-sm">Default Option</span>
                        </div>

                    </div>

                    {{-- FOOTER --}}
                    <div class="flex items-center justify-end gap-3 p-6 border-t">
                        <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">
                            Cancel
                        </button>

                        <button class="btn text-white bg-black-500">
                            Save Option
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
