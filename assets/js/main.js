window.addEventListener("DOMContentLoaded", event => {
    const btnGeo = document.getElementById("btn-geo");
    const latitude = document.querySelector("#latitude");
    const longitude = document.querySelector("#longitude");
    console.log(btnGeo, latitude, longitude);

    btnGeo.addEventListener("click",
        () => navigator.geolocation.getCurrentPosition(
            position => {
                cordonnee.value = `${position.coords.latitude}`;
            }

        )
    )

});


const map = L.map("map-div");
const all_marker = document.getElementsByClassName("leaflet-marker-icon");
const all_circle = document.getElementsByClassName("circle");


// --- JSON ---
const fraJson = {
    "type": "FeatureCollection",
    "features": [
        {
            "type": "Feature",
            "id": "FRA",
            "properties": { "name": "France" },
            "geometry": {
                "type": "MultiPolygon",
                "coordinates": [
                    [
                        [
                            [3.588184, 50.378992],
                            [4.286023, 49.907497],
                            [4.799222, 49.985373],
                            [5.674052, 49.529484],
                            [5.897759, 49.442667],
                            [6.18632, 49.463803],
                            [6.65823, 49.201958],
                            [8.099279, 49.017784],
                            [7.593676, 48.333019],
                            [7.466759, 47.620582],
                            [7.192202, 47.449766],
                            [6.736571, 47.541801],
                            [6.768714, 47.287708],
                            [6.037389, 46.725779],
                            [6.022609, 46.27299],
                            [6.5001, 46.429673],
                            [6.843593, 45.991147],
                            [6.802355, 45.70858],
                            [7.096652, 45.333099],
                            [6.749955, 45.028518],
                            [7.007562, 44.254767],
                            [7.549596, 44.127901],
                            [7.435185, 43.693845],
                            [6.529245, 43.128892],
                            [4.556963, 43.399651],
                            [3.100411, 43.075201],
                            [2.985999, 42.473015],
                            [1.826793, 42.343385],
                            [0.701591, 42.795734],
                            [0.338047, 42.579546],
                            [-1.502771, 43.034014],
                            [-1.901351, 43.422802],
                            [-1.384225, 44.02261],
                            [-1.193798, 46.014918],
                            [-2.225724, 47.064363],
                            [-2.963276, 47.570327],
                            [-4.491555, 47.954954],
                            [-4.59235, 48.68416],
                            [-3.295814, 48.901692],
                            [-1.616511, 48.644421],
                            [-1.933494, 49.776342],
                            [-0.989469, 49.347376],
                            [1.338761, 50.127173],
                            [1.639001, 50.946606],
                            [2.513573, 51.148506],
                            [2.658422, 50.796848],
                            [3.123252, 50.780363],
                            [3.588184, 50.378992]
                        ]
                    ]
                ]
            }
        }
    ]
};

// --- /JSON ---
// --- MAP ---

navigator.geolocation.getCurrentPosition(function (position) {
    generate_map(position.coords.latitude, position.coords.longitude);
});

L.circle([48.8, 2.42], {
    color: "red",
    className: "circle",
    fillColor: "#f03",
    fillOpacity: 0.5,
    radius: 50000,
}).addTo(map);

const osm = new L.TileLayer.BoundaryCanvas(
    "https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png",
    {
        boundary: fraJson,
        minZoom: 6,
    }
);

map.addLayer(osm);
const frLayer = L.geoJSON(fraJson);
map.fitBounds(frLayer.getBounds());

const coord = osm.options.boundary.features.map((x) => x.geometry.coordinates);

map.addEventListener("click", function (e) {
    if (map.boxZoom._map._zoom <= 16){
        return;
    }
    coord.map((x) =>
        x.map((y) =>
            y.map((z) => {
                for (var i = 0, f = 0; i < z.length; i++) {
                    if (e.latlng.lng > 2) {
                        if (e.latlng.lat > 46.5) {
                            if (z[i][0] >= e.latlng.lng && z[i][1] >= e.latlng.lat) {
                                choose_display();
                                return L.marker(e.latlng).addTo(map);
                            }
                        } else {
                            if (z[i][0] >= e.latlng.lng && z[i][1] <= e.latlng.lat) {
                                choose_display();
                                return L.marker(e.latlng).addTo(map);
                            }
                        }
                    } else {
                        if (e.latlng.lat > 46.5) {
                            if (z[i][0] <= e.latlng.lng && z[i][1] >= e.latlng.lat) {
                                choose_display();
                                return L.marker(e.latlng).addTo(map);
                            }
                        } else {
                            if (z[i][0] <= e.latlng.lng && z[i][1] <= e.latlng.lat) {
                                choose_display();
                                return L.marker(e.latlng).addTo(map);
                            }
                        }
                    }
                }
            })
        )
    );
});

function display_marker_circle(marker_boolean, circle_boolean) {
    if (marker_boolean) {
        for (let i = 0; i < all_marker.length; i++) {
            all_marker[i].style.display = "block";
        }
    }
    if (circle_boolean) {
        for (let i = 0; i < all_circle.length; i++) {
            all_circle[i].style.display = "block";
        }
    }
}

function undisplay_marker_circle(marker_boolean, circle_boolean) {
    if (marker_boolean) {
        for (let i = 0; i < all_marker.length; i++) {
            all_marker[i].style.display = "none";
        }
    }
    if (circle_boolean) {
        for (let i = 0; i < all_circle.length; i++) {
            all_circle[i].style.display = "none";
        }
    }
}

function choose_display() {
    if (map.boxZoom._map._zoom >= 10) {
        display_marker_circle(true, false);
        undisplay_marker_circle(false, true);
    } else {
        display_marker_circle(false, true);
        undisplay_marker_circle(true, false);
    }
}

map.on("zoom", () => choose_display());

function generate_map(lat, lng) {
    map.setView([lat, lng], 13);
}

// --- /MAP ---