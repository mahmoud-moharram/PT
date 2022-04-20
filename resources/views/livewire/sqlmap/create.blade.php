<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#DomainAddModal">
    إضافة طلب
</button>

<div wire:ignore.self class="modal fade" id="DomainAddModal" tabindex="-1" role="dialog" aria-labelledby="DomainAddLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="DomainAddLabel">إضافة طلب جديد</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="domain">اختر الدومين</label>
                        <select class="form-control" wire:model.defer="pt_settings_id">
                            <option value="0">اختر الدومين</option>
                            @foreach($domains as $domain)
                                <option value="{{ $domain->id }}" >{{ $domain->domain }}</option>
                            @endforeach
                        </select>
                        @error('pt_settings_id') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" wire:click.prevent="store()" class="btn btn-primary close-modal" {{--data-bs-dismiss="modal"--}}>طلب فحص</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">اغلاق</button>
            </div>
        </div>
    </div>
</div>
