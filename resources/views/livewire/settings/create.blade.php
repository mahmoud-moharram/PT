<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#DomainAddModal">
   إضافة جديد
</button>

<div wire:ignore.self class="modal fade" id="DomainAddModal" tabindex="-1" role="dialog" aria-labelledby="DomainAddLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="DomainAddLabel">إضافة دومين جديد</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="domain">اسم الدومين</label>
                        <input type="text" class="form-control" id="domain" placeholder="أدخل اسم الدومين" wire:model.defer="domain">
                        @error('domain') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" wire:click.prevent="store()" class="btn btn-primary close-modal" {{--data-bs-dismiss="modal"--}}>حفظ</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">اغلاق</button>
            </div>
        </div>
    </div>
</div>
