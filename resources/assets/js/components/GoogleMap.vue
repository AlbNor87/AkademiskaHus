<template>
    <div class="akaRelative">
              
        <label class="akaMapInput" v-bind:class="this.colorTheme" @keyup.enter="addMarker">
        <button class="btn" @click="fetchLocation"></button>    
            <gmap-autocomplete
            @place_changed="setPlace" placeholder="Ange adress eller plats">
            </gmap-autocomplete>
        </label>
           
        <gmap-map class="akaGmap"
            :options="options"
            :center="center"
            :zoom="16"
            >
            <gmap-marker
            :key="index"
            v-for="(m, index) in markers"
            :position="m.position"
            @click="center=m.position"
            >
            </gmap-marker>
            
        </gmap-map>
    </div>
</template>

<script>
export default {
  props: ['colorTheme', 'location', 'lng', 'lat'],
  name: "GoogleMap",
  data() {
    return {
        center: { lat:this.lat, lng:this.lng },
        markers: [],
        places: [],
        options: {disableDefaultUI: true, zoomControl:true},
        currentPlace: null,
    };
  },

  mounted() {
    this.geolocate();
    this.disableDefaultUI="true";
  },

  methods: {
    // Receives a place object via the autocomplete component
    setPlace(place) {
      this.currentPlace = place;
    },
    addMarker() {
      if (this.currentPlace) {
        const marker = {
            lat: this.currentPlace.geometry.location.lat(),
            lng: this.currentPlace.geometry.location.lng()
        };
        this.markers.push({ position: marker });
        this.places.push(this.currentPlace);
        this.center = marker;
        this.$emit('locationSelected', this.center, this.currentPlace);
        this.currentPlace = null; 
      }
    },
    geolocate: function() {
      navigator.geolocation.getCurrentPosition(position => {
        this.center = {
            lat: position.coords.latitude,
            lng: position.coords.longitude
        };
      });
    },
    fetchLocation() {
            navigator.geolocation.getCurrentPosition(position => {
            this.center = {
                lat: position.coords.latitude,
                lng: position.coords.longitude
            };
        });
    }
  }
};
</script>

