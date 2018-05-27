<template>
    <div class="akaContainer mb-5 akaMalfunction">

        <div class="form-group">
            <h5>Plats <span class="akaTextProp">(valfritt)</span></h5>
            <googlemap v-if="this.renderMap" colorTheme="akaOrange" :location="malfunction.location" :lng="malfunction.lng" :lat="malfunction.lat" @locationSelected="setLocation"></googlemap>
        </div>

        <form @submit.prevent="addMalfunction" class="mb-5 mt-3">

            <div class="form-group akaMt2rem">
                <h5>Rubrik till driftstörning*</h5>
                <input type="text" class="akaFormControl akaOrange" placeholder="Titel" id="MalfunctionTitle" v-model="malfunction.title" required>
            </div>

            <div class="form-group akaMt2rem akaShort">
                <h5>Sammanfattning* <span class="akaTextProp">(Underrubrik i notifikation)</span></h5>
                <textarea class="akaFormControl" placeholder="Max 150 tecken" maxlength="150" v-model="malfunction.summary" required></textarea>
            </div>
    
            <div class="form-group akaMt2rem">
                <h5>Fullständig information</h5>
                <textarea class="akaFormControl" placeholder="Beskrivning av driftstörning" v-model="malfunction.body"></textarea>
            </div>

            <button type="submit" class="btn btn-block akaBgOrange text-white akaBorderRadius">Spara</button>
 
        </form>

        <div class="card mb-4 akaMalfunctionCard" v-for="malfunction in malfunctions" v-bind:key="malfunction.id">

            <div class="card-body">
                <h3 class="akaPostTitle">{{ malfunction.title }}</h3>
                
                <h4 class="akaPostText akaOrange akaFontWeightM">{{ malfunction.summary }}</h4>

                <hr>

                <p class="akaPostText">{{ malfunction.body }}</p>

                <hr>

                <p class="akaTime">{{ malfunction.created_at }}</p>
                <p class="akaTime">{{ malfunction.location }}</p>
            </div> 
            <div class="akaButtonContainer">
                <button @click="editMalfunction(malfunction)" class="btn akaButton akaBorderBottomLeftRadius akaBgOrange text-white">Ändra</button>

                <button @click="deleteMalfunction(malfunction.id)" class="btn akaButton akaBorderBottomRightRadius akaMarginTinyLeft akaBgOrange text-white">Ta Bort</button>
            </div>
            
        </div>

        <!-- Pagnation navbar -->
        <nav aria-label="Page navigation">

            <ul class="pagination justify-content-center">

                <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item">
                    <a class="page-link" href="#" @click="fetchMalfunctions(pagination.prev_page_url)">❮❮</a>
                </li>

                 <li class="page-item disabled">
                     <a class="page-link text-dark" href="#">Sida {{ pagination.current_page }} av {{ pagination.last_page }} </a>
                 </li>

                <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item">
                    <a class="page-link" href="#" @click="fetchMalfunctions(pagination.next_page_url)">❯❯</a>
                </li>

            </ul>

        </nav>

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
                    lng: 11.936401
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
                // Reload map...
                this.renderMap = false;
                var self = this;
                setTimeout(function(){
                self.renderMap = true;
                }, 300); 
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