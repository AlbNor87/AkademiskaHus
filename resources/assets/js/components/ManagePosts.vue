<template>

    <div class="akaContainer mt-4">
        
        <h2>Lägg till/Ändra post</h2>
        <!-- <button @click="log(post)" class="btn btn-danger mb-2">Log</button>
        <button @click="clearUpload()" class="btn btn-danger mb-2">Clear</button> -->
        <form @submit.prevent="addPost" class="mb-3">

            <div class="form-group">
                <input type="text" class="form-control" placeholder="Titel" v-model="post.title" id="postTitle">
            </div>

            <div class="form-group">
                <textarea class="form-control" placeholder="Innehåll" v-model="post.body"></textarea>
            </div>

            <div class="form-group">

                <input type="file" accept=".jpg,.png" data-max-size="32154" class="form-control" v-if="uploadReady" @change="imageChanged">
            </div>

            <button type="submit" class="btn btn-block akaBgBlue text-white">Spara</button>
 
        </form>

        <!-- Pagnation navbar -->
        <nav aria-label="Page navigation">

            <ul class="pagination justify-content-center">

                <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item">
                    <a class="page-link" href="#" @click="fetchPosts(pagination.prev_page_url)">❮❮</a>
                </li>

                 <li class="page-item disabled">
                     <a class="page-link text-dark" href="#">Sida {{ pagination.current_page }} av {{ pagination.last_page }} </a>
                 </li>

                <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item">
                    <a class="page-link" href="#" @click="fetchPosts(pagination.next_page_url)">❯❯</a>
                </li>

            </ul>

        </nav>

        <div class="card mb-4 akaPost border-0" v-for="post in posts" v-bind:key="post.id">

            <img v-if="post.image" class="card-img-top akaPostImage" :src="'http://akademiskahus.test/images/' + post.image" alt="image">

            <div class="card-body akaNoBottomMargin">
                <h3>{{ post.title }}</h3>
                
                <p>{{ post.body }}</p>

                <hr>

                <p class="akaTime">{{ post.created_at }}</p>
            </div> 
            <div class="akaButtonContainer">
                <button @click="editPost(post)" class="btn akaButton akaBorderBottomLeftRadius text-white">Ändra</button>

                <button @click="deletePost(post.id)" class="btn akaButton akaBorderBottomRightRadius akaMarginTinyLeft text-white">Ta Bort</button>
            </div>
            
        </div>

        <!-- Pagnation navbar -->
        <nav aria-label="Page navigation">

            <ul class="pagination justify-content-center">

                <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item">
                    <a class="page-link" href="#" @click="fetchPosts(pagination.prev_page_url)">❮❮</a>
                </li>

                 <li class="page-item disabled">
                     <a class="page-link text-dark" href="#">Sida {{ pagination.current_page }} av {{ pagination.last_page }} </a>
                 </li>

                <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item">
                    <a class="page-link" href="#" @click="fetchPosts(pagination.next_page_url)">❯❯</a>
                </li>

            </ul>

        </nav>

    </div>

</template>

<script>
    export default {
        data() {
            return {
                posts: [],
                post: {
                    id: '',
                    title: '',
                    body: '',
                    created_at: '',
                    image: ''
                },
                post_id: '',
                pagination: {},
                edit: false,
                uploadReady: true 
            }
        },

        created() {
            this.fetchPosts();
        },

        methods: {
            fetchPosts(page_url) {
                let vm = this;
                page_url = page_url || '/api/posts '
                fetch(page_url)
                .then(res => res.json())
                .then(res => {
                    this.posts = res.data;
                    vm.makePagination(res.meta, res.links);
                })
                .catch(err => console.log(e)); 
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
            deletePost(id) {
                if(confirm('Är du säker på att du vill ta bort posten?')) {
                    fetch(`api/post/${id}`, {
                        method: 'delete'
                    })
                    .then(res => res.json())
                    .then(data => {
                        alert('Post Borttagen');
                        this.fetchPosts();
                    })
                    .catch(err => console.log(err));
                }
            },
            addPost() {
                if(this.edit === false) {
                    // Add
                    fetch('api/post', {
                        method: 'post',
                        body: JSON.stringify(this.post),
                        headers: {
                            'content-type': 'application/json'
                        }
                    })
                    .then(res => res.json())
                    .then(data => {
                        this.clearUpload();
                        this.fetchPosts();
                        alert('Post Tillagd');
                    })
                    .catch(err => console.log(err));
                } else {
                    // Update
                    fetch('api/post', {
                        method: 'put',
                        body: JSON.stringify(this.post),
                        headers: {
                            'content-type': 'application/json'
                        }
                    })
                    .then(res => res.json())
                    .then(data => {
                        this.clearUpload();
                        this.fetchPosts();
                        alert('Post Uppdaterad');
                    })
                    .catch(err => console.log(err));
                }
            },
            editPost(post) {
                this.edit = true;
                this.post.id = post.id;
                this.post.post_id = post.id;
                this.post.title = post.title;
                this.post.body = post.body;
                // document.getElementById('top').scrollIntoView();
                document.getElementById('postTitle').focus();
            },
            imageChanged(e){
                console.log(e.target.files[0]);
                
                const fileReader = new FileReader();

                fileReader.readAsDataURL(e.target.files[0]);

                fileReader.onload = (e) => {
                    this.post.image = e.target.result;
                }
            },
            log(){
                console.log(this.post);
                console.log(this.uploadReady);
                console.log(process.env);
                
            },
            clearUpload(){
                this.uploadReady = false;
                this.$nextTick(() => {
                this.uploadReady = true;
                this.post.title = '';
                this.post.body = '';
                this.post.image = '';
                this.post.id = '';
            })
                console.log(this.uploadReady);
            }
        }
    }
</script>

