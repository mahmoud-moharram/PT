<div class="card-body">
    <div class="breadcrumb-line header-elements-md-inline  border-bottom border-2">
        <div class="d-flex h-flex">
            <div class="breadcrumb mb-1">
                <a href="" class="breadcrumb-item"><i class="fas fa-home"></i> الرئيسية</a>
                <span class="breadcrumb-item">Nmap</span>
                <span class="breadcrumb-item active">Show Result {{ $data->settings->domain }}</span>
            </div>
            <a href="" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
    </div>


    <div class="row mt-5">
        <h3>{{ $data->settings->domain }}</h3>
        <p>النوع: {{ $data->type }}</p>
        @if(in_array($data->type,['Sv_scan','os_scan','Sc_scan','nmap_http']))
        <table class="table table-bordered table-responsive">
            <thead>
            <tr>
                <th>#</th>
                <th>protocol</th>
                <th>port</th>
                <th>state</th>
                <th>reason</th>
                @if($data->type != 'os_scan')
                <th>product</th>
                @endif
                @if($data->type == 'os_scan')
                    <th>Osmatch name</th>
                    <th>Osmatch accuracy</th>
                    <th>Osmatch vendor</th>
                    <th>Osmatch osgen</th>
                @endif
                <th>cpe</th>
            </tr>
            </thead>
            <tbody>
                    @if(in_array($data->type,['os_scan','Sc_scan','nmap_http']))
                        @foreach($json as $key => $row)
                            @if($loop->index == 0)
                                @foreach($row['ports'] as $port)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $port['protocol'] }}</td>
                                        <td>{{ $port['portid'] }}</td>
                                        <td>{{ $port['state'] }}</td>
                                        <td>{{ $port['reason'] }}</td>
                                        @if($data->type != 'os_scan')
                                            <td>{{ $port['service']['product'] ?? '' }}</td>
                                        @endif
                                        @if($data->type == 'os_scan')
                                            <td>{{ $row['osmatch'][0]['name'] ?? '' }}</td>
                                            <td>{{ $row['osmatch'][0]['accuracy'] ?? '' }}</td>
                                            <td>{{ $row['osmatch'][0]['osclass']['vendor'] ?? '' }}</td>
                                            <td>{{ $row['osmatch'][0]['osclass']['osgen'] ?? '' }}</td>
                                        @endif
                                        <td>{{  $row['osmatch'][0]['cpe'] ?? '' }}</td>
                                    </tr>
                                @endforeach
                                @break
                            @endif
                        @endforeach
                    @else
                        @foreach($json['results'] as $key => $row)
                            @if($loop->index == 0)
                                @foreach($row['ports'] as $port)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $port['protocol'] }}</td>
                                        <td>{{ $port['portid'] }}</td>
                                        <td>{{ $port['state'] }}</td>
                                        <td>{{ $port['reason'] }}</td>
                                        <td>{{ $port['service']['product'] ?? '' }}</td>
                                        <td>{{ isset($port['cpe']) ? $port['cpe'][0]['cpe'] : '' }}</td>
                                    </tr>
                                @endforeach
                                @break
                            @endif
                        @endforeach
                    @endif


            </tbody>
        </table>
        @elseif(in_array($data->type,['vulners','vuln','top_ports','port_80_433']))
            <table class="table table-bordered table-responsive">
                <thead>
                <tr>
                    <th>#</th>
                    <th>protocol</th>
                    <th>port</th>
                    <th>state</th>
                    <th>reason</th>
                    <th>product</th>
                    <th>scripts name</th>
                    <th>scripts</th>
                </tr>
                </thead>
                <tbody>
                @foreach($json as $key => $row)
                    @if($loop->index == 0)
                        @foreach($row['ports'] as $port)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $port['protocol'] }}</td>
                                <td>{{ $port['portid'] }}</td>
                                <td>{{ $port['state'] }}</td>
                                <td>{{ $port['reason'] }}</td>
                                <td>{{ $port['service']['product'] ?? '' }}</td>
                                <td>
                                    @if(isset($port['scripts']) and !empty($port['scripts']))
                                      {{ $port['scripts'][0]['name'] ?? '' }}
                                    @endif
                                </td>
                                <td>
                                    @if(isset($port['scripts']) and !empty($port['scripts']))
                                       @foreach($port['scripts'][0]['data'] as $k => $script)
                                          {{ $k != 0 ? $k : $script}}
                                        @endforeach
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        @break
                    @endif
                @endforeach

                </tbody>
            </table>
        @elseif(in_array($data->type,['ftp_anon','ftp_vulns']))
            <table class="table table-bordered table-responsive">
                <thead>
                <tr>
                    <th>#</th>
                    <th>protocol</th>
                    <th>port</th>
                    <th>state</th>
                    <th>service</th>
                </tr>
                </thead>
                <tbody>
                @foreach($json as $key => $row)
                    @if($loop->index == 0)
                        @foreach($row['ports'] as $port)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $port['protocol'] }}</td>
                                <td>{{ $port['portid'] }}</td>
                                <td>{{ $port['state'] }}</td>
                                <td>{{ $port['service']['name'] ?? '' }}</td>
                            </tr>
                        @endforeach
                        @break
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



