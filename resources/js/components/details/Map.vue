<template>
    <div class="right-content">
        <div id="map"></div>
    </div>
</template>
<script>

import mapboxgl from "mapbox-gl";

export default {
    props: ['deliveryid', 'latitude', 'longitude'],
    data() {
        return {
            map: null,
            lat: this.latitude,
            lng: this.longitude,
            markers: [],
            currentFeatures: [],
            deliveryId: this.deliveryid
        }
    },
    watch: {
    currentFeatures: {
      handler() {
        if (this.currentFeatures) {
          this.resetMarkers();
          this.updateMarkers();
        }
      },
      deep: true,
    }
    },
    methods: {
    resetMarkers() {
        this.markers.forEach((marker) => {
            marker.remove();
        });
        this.markers = [];
    },
    updateMarkers() {
        // this.markers =
     this.markers = this.currentFeatures.map((feature) => {

        const el = this.getBusinessMarker(feature.business_type,feature.top_business, feature.icon, feature.custom_icon);

        const marker = new mapboxgl.Marker(el).setLngLat([feature.longitude,feature.latitude]).addTo(this.map);
       // const markerDiv = marker.getElement();
      //  const pop = marker.getPopup();

        // markerDiv.addEventListener('mouseenter', () => {
        //     marker.togglePopup();
        // });

        // return new mapboxgl.Marker(el).setLngLat([feature.longitude,feature.latitude]).setPopup(popup).addTo(this.map);

        return marker;

      });
    },
    getBusinessMarker(businessType, topStatus, topIcon, customIcon) {
    
        const el = document.createElement("div");
        el.className = "marker";
        el.style.width = '56px';
        el.style.height = '77px';
        el.style.backgroundRepeat = 'no-repeat';
        el.style.cursor = 'pointer';

        if(businessType == 'Delivery') {
            if(topStatus == '1') {
                 el.style.backgroundImage = `url('${topIcon}')`;

            } else if(customIcon != null) {
                 el.style.backgroundImage = `url('${customIcon}')`;
            } else {
                 el.style.backgroundImage = "url('https://admin.420finder.net/images/business-icons/delivery-gold.png')";
            }

        }
        else if(businessType == 'Dispensary') {
             if(topStatus == '1') {
                 el.style.backgroundImage = `url('${topIcon}')`;
            }
            else if(customIcon != null) {
                 el.style.backgroundImage = `url('${customIcon}')`;
            } else {
                 el.style.backgroundImage = "url('https://admin.420finder.net/images/business-icons/dispensery-green.png')";
            }
        }
        return el;
    },
    initMap() {
      mapboxgl.accessToken = "pk.eyJ1IjoiYW5vbm1lIiwiYSI6ImNreWQwaWZ6bjB1azkydnFvcGl0MGtjMXEifQ.ocXtYLXe52NVqhXRt4yFFA";
      this.map = new mapboxgl.Map({
        container: "map",
        style: "mapbox://styles/mapbox/streets-v11",
        center: [this.lng, this.lat],
        zoom: 5,
      });

      this.map.on("load", () => {
        this.map.addControl(new mapboxgl.NavigationControl(), "top-right");

        if (this.markers.length > 0) {
          this.resetMarkers();
        }

        if (this.currentFeatures) {
          this.updateMarkers();
        }
      });
     },
     getRecord() {

        axios.get('/api/delivery/details/map', {
            params: {
                delivery_id: this.deliveryId
            }
        }).then((response) => {
             this.currentFeatures = [response.data.data];
        }).catch((err) => {
           // console.log(err);
        });
       }
    },
    mounted() {
       this.initMap();
       this.getRecord();
    }
}
</script>
