<div class="card-body">
    <div class="breadcrumb-line header-elements-md-inline  border-bottom border-2">
        <div class="d-flex h-flex">
            <div class="breadcrumb mb-1">
                <a href="" class="breadcrumb-item"><i class="fas fa-home"></i> الرئيسية</a>
                <span class="breadcrumb-item">SubDomains Tools</span>
                <span class="breadcrumb-item">{{ $data->type }}</span>
                <span class="breadcrumb-item active">Show Result {{ $data->settings->domain }}</span>
            </div>
            <a href="" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
    </div>


    <div class="row mt-5">
        <h3>{{ $data->settings->domain }}</h3>
        @if($data->type == 'bufferover_run')
        <table class="table table-bordered table-responsive">
            <thead>
            <tr>
                <th>#</th>
                <th>domain</th>
            </tr>
            </thead>
            <tbody>

            @foreach(array_unique($json['results']) as $key => $row)
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $row }}</td>
                </tr>
            @endforeach

            </tbody>
        </table>
        @elseif($data->type == 'hackertarget')
            <table class="table table-bordered table-responsive">
                <thead>
                <tr>
                    <th>#</th>
                    <th>domain</th>
                    <th>ip</th>
                </tr>
                </thead>
                <tbody>

                @foreach(array_unique($json) as $key => $row)
                    @if(!empty($row))
                    @php $item = explode(',',$row); @endphp
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $item[0] ?? '' }}</td>
                        <td>{{ $item[1] ?? '' }}</td>
                    </tr>
                    @endif
                @endforeach

                </tbody>
            </table>
        @elseif($data->type == 'amass')
            <table class="table table-bordered table-responsive">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Source</th>
                </tr>
                </thead>
                <tbody>

                @foreach(($json) as $key => $row)
                    @if(!empty($row))
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $row['name'] ?? '' }}</td>
                        <td>{{ implode(',',$row['sources']) ?? '' }}</td>
                    </tr>
                    @endif
                @endforeach

                </tbody>
            </table>
        @elseif($data->type == 'cert.sh')
            <table class="table table-bordered table-responsive">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Common</th>
                </tr>
                </thead>
                <tbody>

                @foreach(($json) as $key => $row)
                    @if(!empty($row))
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $row['name_value'] ?? '' }}</td>
                        <td>{{ $row['common_name'] }}</td>
                    </tr>
                    @endif
                @endforeach

                </tbody>
            </table>
        @elseif($data->type == 'fastsubs')
            <table class="table table-bordered table-responsive">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Domain Name</th>
                </tr>
                </thead>
                <tbody>

                @foreach(($json['subdomains']) as $key => $row)
                    @if(!empty($row))
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $row['name'] ?? '' }}</td>
                    </tr>
                    @endif
                @endforeach

                </tbody>
            </table>
        @endif
        {{--{{ $packages->links()}}--}}
    </div>



    <div style="clear:both;"></div>
    <!-- Modal -->


</div>



