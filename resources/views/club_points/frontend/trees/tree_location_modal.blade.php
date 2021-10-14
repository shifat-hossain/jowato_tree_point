
    <div class="p-3">
        
        @if (get_setting('google_map') == 1)
            <div class="row">
                <input id="tree_location_searchInput" class="controls" type="text" placeholder="Enter a location">
                <div id="tree_location_map"></div>
                <ul id="geoData">
                    <li style="display: none;">Full Address: <span id="location"></span></li>
                    <li style="display: none;">Postal Code: <span id="postal_code"></span></li>
                    <li style="display: none;">Country: <span id="country"></span></li>
                    <li style="display: none;">Latitude: <span id="lat"></span></li>
                    <li style="display: none;">Longitude: <span id="lon"></span></li>
                </ul>
            </div>

        @endif
    </div>
