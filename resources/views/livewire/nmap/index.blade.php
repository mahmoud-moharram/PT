<div class="card-body">
    <div class="breadcrumb-line header-elements-md-inline  border-bottom border-2">
        <div class="d-flex h-flex">
            <div class="breadcrumb mb-1">
                <a href="" class="breadcrumb-item"><i class="fas fa-home"></i> الرئيسية</a>
                <span class="breadcrumb-item active">Nmap</span>
            </div>
            <a href="" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
    </div>
    <div class="row justify-content-center mt-2">
        <div class="col-md-12">
            <div class=" w-100">
                @include('livewire.nmap.create',['type' => 'Sv_scan','class' => 'btn-success'])
                @include('livewire.nmap.create',['type' => 'os_scan','class' => 'btn-primary'])
                @include('livewire.nmap.create',['type' => 'top_ports','class' => 'btn-warning'])
                @include('livewire.nmap.create',['type' => 'vulners','class' => 'btn-danger'])

                @include('livewire.nmap.create',['type' => 'Sc_scan','class' => 'btn-success'])
                @include('livewire.nmap.create',['type' => 'vuln','class' => 'btn-primary'])
                @include('livewire.nmap.create',['type' => 'port_80_433','class' => 'btn-warning'])
                @include('livewire.nmap.create',['type' => 'nmap_http','class' => 'btn-danger'])


                @include('livewire.nmap.create',['type' => 'ftp_anon','class' => 'btn-primary'])
                @include('livewire.nmap.create',['type' => 'ftp_vulns','class' => 'btn-success'])
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
        <table class="table table-bordered table-responsive" wire:poll.10s>
            <thead>
            <tr>
                <th>رقم الطلب</th>
                <th>اسم الدومين</th>
                <th>نوع الطلب</th>
                <th>الحالة</th>
                @if(auth()->user()->type == 1)
                <th>اسم المستخدم</th>
                @endif
                <th>تاريخ الطلب</th>
                <th>التحكم</th>
            </tr>
            </thead>
            <tbody>
            @forelse($data as $row)
                <tr>
                    <td>{{ $row->id }}</td>
                    <td>{{ $row->settings->domain }}</td>
                    <td>{{ $row->type }}</td>
                    <td>
                        @if($row->status == 0)
                            <span class="badge bg-warning">
                                جاري التنفيذ
                            <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                            </span>
                        @else
                            <span class="badge bg-success">تمت</span>
                        @endif
                    </td>
                    @if(auth()->user()->type == 1)
                    <td>{{ $row->user->name }}</td>
                    @endif
                    <td>{{ $row->created_at->format('Y-m-d H:i:s') }}</td>
                    <td>
                        @if(!is_null($row->result))
                            <a href="{{ route('pt.nmap.show',$row->id) }}" target="_blank" class="btn btn-primary btn-sm mr-2"><i class="fas fa-eye"></i></a>
                        @endif
                        <button wire:click="delete({{ $row->id }})" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">
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



