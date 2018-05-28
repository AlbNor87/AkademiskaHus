<template>
    <div class="akaRelative">

        <p v-if="this.loading" class="akaLoading">Laddar...</p>
              
        <label class="akaMapInput" v-bind:class="this.colorTheme" @keyup.enter="addMarker" title="Hämta min position">
        <button class="btn akaLocate" @click="geolocate"></button>    
            <gmap-autocomplete
            @place_changed="setPlace" placeholder="Ange adress eller plats">
            </gmap-autocomplete>
        <button class="btn akaSet" @click="addMarker" title="Ange denna position"></button> 
        </label>
           
        <gmap-map class="akaGmap"
            :options="options"
            :center="center"
            :zoom="14"
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
  props: ['colorTheme'],
  name: "GoogleMap",
  data() {
    return {
        center: { lat: 57.7058854, lng: 11.937102099999947 },
        markers: [],
        places: [],
        options: {disableDefaultUI: true, zoomControl:true},
        currentPlace: null,
        loading: false
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
        this.markers = [];
        this.markers.push({ position: marker });
        this.places.push(this.currentPlace);
        this.center = marker;
        this.$emit('locationSelected', this.center, this.currentPlace);
        this.currentPlace = null; 
      }

    },
    geolocate(){
      this.loading = true;
      navigator.geolocation.getCurrentPosition(position => {
        this.center = {
            lat: position.coords.latitude,
            lng: position.coords.longitude
        };
        const marker = {
            lat: position.coords.latitude,
            lng: position.coords.longitude
        };
        this.markers.push({ position: marker });
        this.center = marker;
        this.loading = false;
      });
    },
    fetchLocation() {
            navigator.geolocation.getCurrentPosition(position => {
            this.center = {
                lat: position.coords.latitude,
                lng: position.coords.longitude
            };
        });
    },
  }
};
</script>

