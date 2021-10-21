@extends('frontend.layouts.app')

@section('content')
    
   <section class="py-5">
        <div class="container">
            <div class="d-flex align-items-start">
                @include('frontend.inc.user_side_nav')

                <div class="aiz-user-panel">
                    <div class="aiz-titlebar mt-2 mb-4">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <b class="h4">{{translate('Tress')}}</b>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mx-auto">
                            <div class="bg-grad-5 text-white rounded-lg mb-4 overflow-hidden">
                                <div class="px-3 pt-3">
                                    <div class="h3 fw-700">{{ Auth::user()->tree_points }} {{ translate('Point(s)') }}</div>
                                    <div class="opacity-50">{{ translate('your TREE FUND') }}</div>
                                </div>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                                    <path fill="rgba(255,255,255,0.3)" fill-opacity="1" d="M0,192L26.7,192C53.3,192,107,192,160,202.7C213.3,213,267,235,320,218.7C373.3,203,427,149,480,117.3C533.3,85,587,75,640,90.7C693.3,107,747,149,800,149.3C853.3,149,907,107,960,112C1013.3,117,1067,171,1120,202.7C1173.3,235,1227,245,1280,213.3C1333.3,181,1387,107,1413,69.3L1440,32L1440,320L1413.3,320C1386.7,320,1333,320,1280,320C1226.7,320,1173,320,1120,320C1066.7,320,1013,320,960,320C906.7,320,853,320,800,320C746.7,320,693,320,640,320C586.7,320,533,320,480,320C426.7,320,373,320,320,320C266.7,320,213,320,160,320C106.7,320,53,320,27,320L0,320Z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <table class="table aiz-table mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{translate('Code')}}</th>
                                        <th data-breakpoints="lg">{{translate('Customer Name')}}</th>
                                        <th>{{translate('Latitude')}}</th>
                                        <th>{{translate('Longitude')}}</th>
                                        <th data-breakpoints="lg">{{translate('Planted At')}}</th>
                                        <th class="text-right">{{translate('Options')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($trees as $key => $tree)
                                        <tr>
                                            <td>{{ ($key+1) + ($trees->currentPage() - 1)*$trees->perPage() }}</td>
                                            <td>
                                                {{ $tree->code }}
                                            </td>
                                            <td>
                                                @if ($tree->user != null)
                                                    {{ $tree->user->name }}
                                                @else
                                                    {{ translate('User not found') }}
                                                @endif
                                            </td>
                                            <td>{{ $tree->latitude }}</td>
                                            <td>{{ $tree->longitude }}</td>
                                            <td>{{ $tree->planted_at }}</td>
                                            <td class="text-right">
                                                <a class="btn btn-soft-info btn-icon btn-circle btn-sm" href="{{ route('user.trees.certificate-view', $tree->id) }}" target="_blank" title="{{ translate('See Location') }}">
                                                    <i class="las la-eye"></i>
                                                </a>
                                                <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="http://www.google.com/maps/place/{{ $tree->latitude }},{{ $tree->longitude }}" target="_blank" title="{{ translate('See Location') }}">
                                                    <i class="las la-search-location"></i>
                                                </a>
                                                <a class="btn btn-soft-warning btn-icon btn-circle btn-sm" href="{{ route('user.trees.certificate-download', $tree->id) }}" title="{{ translate('Download Certificate') }}">
                                                    <i class="las la-download"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="aiz-pagination">
                                {{ $trees->appends(request()->input())->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('modal')
    {{-- <div class="modal fade" id="tree-location-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ translate('Address Edit') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="tree-location-modal-body">
                </div>
            </div>
        </div>
    </div> --}}
@endsection

@section('script')
    {{-- <script type="text/javascript">
        function tree_location(tree_id) {
            var url = '{{ route("user.trees.tree-location", ":id") }}';
            url = url.replace(':id', tree_id);
            
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,
                type: 'GET',
                success: function (response) {
                    $('#tree-location-modal-body').html(response.html);
                    $('#tree-location-modal').modal('show');
                    AIZ.plugins.bootstrapSelect('refresh');

                    @if (get_setting('google_map') == 1)
                        var lat     = -33.8688;
                        var long    = 151.2195;

                        // if(response.data.tree_data.latitude && response.data.tree_data.longitude) {
                        //     lat     = response.data.tree_data.latitude;
                        //     long    = response.data.tree_data.longitude;
                        // }

                        initialize(lat, long, 'tree_location_map');
                    @endif
                    
                }
            });
        }
    </script> --}}

    @if (get_setting('google_map') == 1)
    
        {{-- <script>
            function initialize(lat=-33.8688, long=151.2195, id_format='') {
                var map = new google.maps.Map(document.getElementById(id_format), {
                                center: {lat: lat, lng: long},
                                zoom: 13
                            });

                var myLatlng = new google.maps.LatLng(lat, long);

                // var input = document.getElementById(id_format + 'searchInput');
        //                console.log(input);
                // map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

                // var autocomplete = new google.maps.places.Autocomplete(input);

                // autocomplete.bindTo('bounds', map);

                var infowindow = new google.maps.InfoWindow();
                // var marker = new google.maps.Marker({
                //                 map: map,
                //                 position: myLatlng,
                //                 anchorPoint: new google.maps.Point(0, -29),
                //                 draggable:true,
                //             });

                // map.addListener('click',function(event) {
                //     marker.setPosition(event.latLng);
                //     document.getElementById(id_format + 'latitude').value = event.latLng.lat();
                //     document.getElementById(id_format+ 'longitude').value = event.latLng.lng();
                //     infowindow.setContent('Latitude: ' + event.latLng.lat() + '<br>Longitude: ' + event.latLng.lng());
                //     infowindow.open(map,marker);
                // });

                // google.maps.event.addListener(marker,'dragend',function(event) {
                //     document.getElementById(id_format + 'latitude').value = event.latLng.lat();
                //     document.getElementById(id_format + 'longitude').value = event.latLng.lng();
                //     infowindow.setContent('Latitude: ' + event.latLng.lat() + '<br>Longitude: ' + event.latLng.lng());
                //     infowindow.open(map,marker);
                // });

                var locations = [
                    ['Bondi Beach', -33.890542, 151.274856, 4],
                    ['Coogee Beach', -33.923036, 151.259052, 5],
                    ['Cronulla Beach', -34.028249, 151.157507, 3],
                    ['Manly Beach', -33.80010128657071, 151.28747820854187, 2],
                    ['Maroubra Beach', -33.950198, 151.259302, 1]
                ];

                var marker, i;

                for (i = 0; i < locations.length; i++) {  
                    marker = new google.maps.Marker({
                        position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                        map: map
                    });

                    google.maps.event.addListener(marker, 'click', (function(marker, i) {
                        return function() {
                        infowindow.setContent(locations[i][0]);
                        infowindow.open(map, marker);
                        }
                    })(marker, i));
                }

                // autocomplete.addListener('place_changed', function() {
                //     infowindow.close();
                //     marker.setVisible(false);
                //     var place = autocomplete.getPlace();

                //     if (!place.geometry) {
                //         window.alert("Autocomplete's returned place contains no geometry");
                //         return;
                //     }

                //     // If the place has a geometry, then present it on a map.
                //     if (place.geometry.viewport) {
                //         map.fitBounds(place.geometry.viewport);
                //     } else {
                //         map.setCenter(place.geometry.location);
                //         map.setZoom(17);
                //     }
                //     /*
                //     marker.setIcon(({
                //         url: place.icon,
                //         size: new google.maps.Size(71, 71),
                //         origin: new google.maps.Point(0, 0),
                //         anchor: new google.maps.Point(17, 34),
                //         scaledSize: new google.maps.Size(35, 35)
                //     }));
                //     */
                //     marker.setPosition(place.geometry.location);
                //     marker.setVisible(true);

                //     var address = '';
                //     if (place.address_components) {
                //         address = [
                //             (place.address_components[0] && place.address_components[0].short_name || ''),
                //             (place.address_components[1] && place.address_components[1].short_name || ''),
                //             (place.address_components[2] && place.address_components[2].short_name || '')
                //         ].join(' ');
                //     }

                //     infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
                //     infowindow.open(map, marker);

                //     //Location details
                //     for (var i = 0; i < place.address_components.length; i++) {
                //         if(place.address_components[i].types[0] == 'postal_code'){
                //             document.getElementById('postal_code').innerHTML = place.address_components[i].long_name;
                //         }
                //         if(place.address_components[i].types[0] == 'country'){
                //             document.getElementById('country').innerHTML = place.address_components[i].long_name;
                //         }
                //     }
                //     document.getElementById('location').innerHTML = place.formatted_address;
                //     document.getElementById(id_format + 'latitude').value = place.geometry.location.lat();
                //     document.getElementById(id_format + 'longitude').value = place.geometry.location.lng();
                // });

            }
        </script>

        <script src="https://maps.googleapis.com/maps/api/js?key={{ env('MAP_API_KEY') }}&libraries=places&language=en&callback=initialize" async defer></script> --}}
    @endif

@endsection
