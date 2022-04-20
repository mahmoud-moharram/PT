<div class="card-body">
    <div class="breadcrumb-line header-elements-md-inline  border-bottom border-2">
        <div class="d-flex h-flex">
            <div class="breadcrumb mb-1">
                <a href="" class="breadcrumb-item"><i class="fas fa-home"></i> الرئيسية</a>
                <span class="breadcrumb-item">Sqlmap</span>
                <span class="breadcrumb-item active">Show Result {{ $data->settings->domain }}</span>
            </div>
            <a href="" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
    </div>


    <div class="row mt-5">
        <h3>{{ $data->settings->domain }}</h3>
        <table class="table table-bordered table-responsive">
            <thead>
            <tr>
                <th>#</th>
                <th>place</th>
                <th>parameter</th>
                <th>title</th>
                <th>payload</th>
            </tr>
            </thead>
            <tbody>
            @foreach($json['result'] as $key => $row)
                @if($loop->index == 1 and $row['type'] == 1)
                    @foreach($row['value'] as $val)
                        @foreach($val['data'] as $item)
                            <tr>
                                <td>{{ $loop->index +1 }}</td>
                                <td>{{ $val['place'] }}</td>
                                <td>{{ $val['parameter'] }}</td>
                                <td>{{ $item['title'] }}</td>
                                <td>{{ $item['payload'] }}</td>
                            </tr>
                        @endforeach
                    @endforeach
                @endif
            @endforeach

            </tbody>
        </table>
        {{--{{ $packages->links()}}--}}
    </div>



    <div style="clear:both;"></div>
    <!-- Modal -->


</div>



