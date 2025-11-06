   // --- Mapbox Initialization and Update Logic ---
    function initializeMap(centerCoords) {
        mapboxgl.accessToken = 'pk.eyJ1IjoibWNocmUwOTEiLCJhIjoiY21mcXhkZDAxMDNrczJycTQ3bnlweWsyMiJ9.EA6nnyDT-4cqAWQLzjtKVQ';
        map = new mapboxgl.Map({
            container: 'map',
            style: 'mapbox://styles/mapbox/standard',
            center: centerCoords,
            zoom: 10
        });
        map.addControl(new mapboxgl.NavigationControl());
    }

    function updateMap(locations, userLat, userLon) {
        if (!map) {
            initializeMap([userLon, userLat]);
        }

        // Clear existing markers
        markers.forEach(marker => marker.remove());
        markers = [];

        if (locations.length === 0) {
            map.setCenter([userLon, userLat]);
            map.setZoom(10);
            return;
        }

        const bounds = new mapboxgl.LngLatBounds();

        // Add user's location marker (blue)
        const userMarker = new mapboxgl.Marker({ color: 'blue' })
            .setLngLat([userLon, userLat])
            .setPopup(new mapboxgl.Popup().setText('Your Location'))
            .addTo(map);
        markers.push(userMarker);
        bounds.extend([userLon, userLat]);

        // Add facility markers (default red)
        locations.forEach(loc => {
            const marker = new mapboxgl.Marker()
                .setLngLat([loc.lng, loc.lat])
                .setPopup(new mapboxgl.Popup().setText(loc.name))
                .addTo(map);
            markers.push(marker);
            bounds.extend([loc.lng, loc.lat]);
        });

        map.fitBounds(bounds, { padding: 50, maxZoom: 15 });
    }

    // Initialize map on page load with a default location (e.g., Ottawa)
    document.addEventListener('DOMContentLoaded', () => {
        initializeMap([-75.6971, 45.4231]); // Default to Ottawa, ON
    });