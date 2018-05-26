<template>
    <div class="akaContainer mb-4">
        <div class="akaNotificationContainer">
            <div class="akaMalfunctionNotification border-0" v-for="malfunction in malfunctions" v-bind:key="malfunction.id">
                                
                <div class="card-body" v-if="this.show">

                    <img class="akaWhiteCross" src="images/crossWhite.svg" alt="">

                    <h3>{{ malfunction.title }}</h3>
                    
                    <h4>{{ malfunction.summary }}</h4>
                    <h4 class="akaFontWeightL">Läs mer <a href="">här.</a></h4>
                    <!-- <p class="akaTiny">{{ malfunction.created_at }}<br>{{ malfunction.location }}</p> -->
                </div> 
                
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                malfunctions: [],
                malfunction: {
                    id: '',
                    title: '',
                    body: '',
                    summary: '',
                    created_at: '',
                    location: 'Lärdomsgatan, Gothenburg, Sweden',
                    lat: 57.705982,
                    lng: 11.936401,
                    show: true
                },
                malfunction_id: '',
                pagination: {},
                edit: false,
                renderMap: true
            }
        },

        created() {
            this.fetchMalfunctions();
        },

        methods: {
            fetchMalfunctions(page_url) {
                let vm = this;
                page_url = page_url || '/api/malfunctions '
                fetch(page_url)
                .then(res => res.json())
                .then(res => {
                    this.malfunctions = res.data;
                    vm.makePagination(res.meta, res.links);
                })
                .catch(err => console.log(err)); 
            },
            makePagination(meta, links) {
                let pagination = {
                    current_page: meta.current_page,
                    last_page: meta.last_page,
                    next_page_url: links.next,
                    prev_page_url: links.prev
                }

                this.pagination = pagination;
            },
            deleteMalfunction(id) {
                if(confirm('Är du säker på att du vill ta bort driftstörningen?')) {
                    fetch(`api/malfunction/${id}`, {
                        method: 'delete'
                    })
                    .then(res => res.json())
                    .then(data => {
                        alert('Driftstörning Borttagen');
                        this.fetchMalfunctions();
                    })
                    .catch(err => console.log(err));
                }
            },
            addMalfunction() {
                if(this.edit === false) {
                    // Add
                    fetch('api/malfunction', {
                        method: 'post',
                        body: JSON.stringify(this.malfunction),
                        headers: {
                            'content-type': 'application/json'
                        }
                    })
                    .then(res => res.json())
                    .then(data => {
                        this.clearUpload();
                        this.fetchMalfunctions();
                        alert('Driftstörning Tillagd');
                    })
                    .catch(err => console.log(err));
                } else {
                    // Update
                    fetch('api/malfunction', {
                        method: 'put',
                        body: JSON.stringify(this.malfunction),
                        headers: {
                            'content-type': 'application/json'
                        }
                    })
                    .then(res => res.json())
                    .then(data => {
                        this.clearUpload();
                        this.fetchMalfunctions();
                        alert('Driftstörning Uppdaterad');
                    })
                    .catch(err => console.log(err));
                }
                // Reload...
                this.renderMap = false;
                var self = this;
                setTimeout(function(){
                self.renderMap = true;
                }, 300);
            },
            editMalfunction(malfunction) {
                this.edit = true;
                this.malfunction.id = malfunction.id;
                this.malfunction.malfunction_id = malfunction.id;
                this.malfunction.title = malfunction.title;
                this.malfunction.summary = malfunction.summary;
                this.malfunction.body = malfunction.body;
                this.malfunction.location = malfunction.location;
                document.getElementById('MalfunctionTitle').focus();
            },
            log(){
                console.log(this.malfunction);
            },
            clearUpload(){
                this.$nextTick(() => {
                this.malfunction.body = '';
                this.malfunction.title = '';
                this.malfunction.summary = '';
                this.malfunction.id = '';    
            })},
            setLocation (position, place) {
                this.malfunction.lat = position.lat;
                this.malfunction.lng = position.lng;
                this.malfunction.location = place.formatted_address;
                console.log(position.lat) // someValue
                console.log(position.lng) // someValue
                console.log(place.formatted_address) // someValue
            }
        }
    }
    
</script>