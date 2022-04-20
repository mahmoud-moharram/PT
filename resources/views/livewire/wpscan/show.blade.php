<div class="card-body">
    <div class="breadcrumb-line header-elements-md-inline  border-bottom border-2">
        <div class="d-flex h-flex">
            <div class="breadcrumb mb-1">
                <a href="" class="breadcrumb-item"><i class="fas fa-home"></i> الرئيسية</a>
                <span class="breadcrumb-item">WpScan</span>
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
                <th>version</th>
                <th>authors</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>1</td>
                <td>{{ $json['results']['banner']['version'] }}</td>
                <td>{{ implode(',',$json['results']['banner']['authors']) }}</td>
            </tr>
            </tbody>
        </table>
        {{--{{ $packages->links()}}--}}
    </div>



    <div style="clear:both;"></div>
    <!-- Modal -->


</div>



