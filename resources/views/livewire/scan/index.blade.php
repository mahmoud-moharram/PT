<div class="card-body">
    <div class="breadcrumb-line header-elements-md-inline  border-bottom border-2">
        <div class="d-flex h-flex">
            <div class="breadcrumb mb-1">
                <a href="" class="breadcrumb-item"><i class="fas fa-home"></i> الرئيسية</a>
                <span class="breadcrumb-item active">Scan All</span>
            </div>
            <a href="" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
    </div>
    <div class="row justify-content-center mt-2">
        <div class="col-md-12">
            <div class=" w-100">
                @include('livewire.scan.create')
            </div>
        </div>
    </div>

    <div class="row mt-5">
        @if (session()->has('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <table class="table table-bordered table-responsive">
            <thead>
            <tr>
                <th>رقم الطلب</th>
                <th>اسم الدومين</th>
                <th>الحالة</th>
                <th>التحكم</th>
            </tr>
            </thead>
            <tbody>
            @forelse($data as $row)
                <tr>
                    <td>{{ $row->id }}</td>
                    <td>{{ $row->settings->domain }}</td>
                    <td>
                        @if($row->status == 0)
                            <span class="badge bg-warning">جاري التنفيذ</span>
                        @else
                            <span class="badge bg-success">تمت</span>
                        @endif
                    </td>
                    <td>
                        @if(!is_null($row->result))
                            <button wire:click="show({{ $row->id }})"  class="btn btn-primary btn-sm"><i class="fas fa-eye"></i></button>
                        @endif
                        <button wire:click="delete({{ $row->id }})" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">
                        لا يوجد بيانات لعرضها
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
        {{--{{ $packages->links()}}--}}
    </div>



    <div style="clear:both;"></div>
    <!-- Modal -->


</div>

{{--@push('js')
    <script type="text/javascript">
        window.livewire.on('ScanEmit', () => {
            $('.modal').modal('hide');
        });
    </script>
@endpush--}}

