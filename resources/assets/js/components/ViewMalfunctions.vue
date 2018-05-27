<template>
    <div class="akaContainer mt-4 mb-5 akaMalfunction">

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
        }
    }
    
</script>