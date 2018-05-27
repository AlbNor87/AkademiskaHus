<template>

    <div class="akaContainer mt-4 mb-5">
        
        <h2 class="akaGreen">Lägg till/Ändra post</h2>
        <!-- <button @click="log(post)" class="btn btn-danger mb-2">Log</button>
        <button @click="clearUpload()" class="btn btn-danger mb-2">Clear</button> -->
        <form @submit.prevent="addPost" class="mb-5">

            <div class="form-group">
                <input type="text" class="form-control" placeholder="Titel" v-model="post.title" id="postTitle">
            </div>

            <div class="form-group">
                <textarea class="form-control" placeholder="Innehåll" v-model="post.body"></textarea>
            </div>

            <div class="form-group">

                <input type="file" name="file-1[]" id="file-upload" accept=".jpg,.png" size="32154" class="inputfile inputfile-1" v-if="uploadReady" @change="imageChanged" hidden>
				<label for="file-upload" class="btn akaBgGreen">

                        
                        <span v-if="!post.image" class="akaJustifyCenter">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" fill="white" height="17" viewBox="0 0 20 17">
                            <path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/>
                        </svg>
                            Ladda Upp Bild</span>

                        <span v-if="post.image" class="akaUploadCaption">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" fill="white" height="17" viewBox="0 0 20 17">
                            <path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/>
                        </svg>
                            {{post.imageName}}</span>
                   
                </label>

            </div>

            <button type="submit" class="btn btn-block akaBgGreen text-white akaBorderRadius">Spara</button>
 
        </form>

        <div class="card mb-4 akaPost" v-for="post in posts" v-bind:key="post.id">

            <img v-if="post.image" class="card-img-top akaPostImage" :src="'/uploads/' + post.image" alt="image">

            <div class="card-body">
                <h3 class="akaPostTitle">{{ post.title }}</h3>
                
                <p class="akaPostText">{{ post.body }}</p>

                <hr>

                <p class="akaTime">{{ post.created_at }}</p>
            </div> 
            <div class="akaButtonContainer">
                <button @click="editPost(post)" class="btn akaButton akaBgGreen akaBorderBottomLeftRadius text-white">Ändra</button>

                <button @click="deletePost(post.id)" class="btn akaButton akaBgGreen akaBorderBottomRightRadius akaMarginTinyLeft text-white">Ta Bort</button>
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
                upload: '',
                posts: [],
                post: {
                    id: '',
                    title: '',
                    body: '',
                    created_at: '',
                    image: '',
                    imageName: ''
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
                document.getElementById('postTitle').focus();
            },
            imageChanged(e){
                console.log(e.target.files[0]);
                this.post.imageName = e.target.files[0].name;
                
                const fileReader = new FileReader();

                fileReader.readAsDataURL(e.target.files[0]);

                fileReader.onload = (e) => {
                    this.post.image = e.target.result;
                }

            },
            log(){
                console.log(this.post);
                // console.log(this.uploadReady);
                // console.log(process.env);
                
                
            },
            clearUpload(){
                this.uploadReady = false;
                this.$nextTick(() => {
                this.uploadReady = true;
                this.post.title = '';
                this.post.body = '';
                this.post.image = '';
                this.post.imageName = '';
                this.post.id = '';
                
            })

            }
        }
    }
    
</script>

