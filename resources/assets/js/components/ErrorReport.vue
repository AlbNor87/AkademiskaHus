<template>
    <div class="akaContainer mb-5 akaErrorReport" id="topOfpage">

        <div class="form-group">
            <h5>Plats <span class="akaTextProp">(valfritt)</span></h5>
            <googlemap v-if="this.renderMap"></googlemap>
        </div>

        <form @submit.prevent="sendErrorReport" class="mb-3 akaMt2rem">

            <div class="form-group akaMt2rem">
                <h5>Ämne/Kategori (typ av fel)*</h5>
                <input type="text" class="akaFormControl" placeholder="Titel" v-model="post.title" required>
            </div>

            <div class="form-group akaMt2rem">
                <h5>Problembeskrivning*</h5>
                <textarea class="akaFormControl" placeholder="Max 500 tecken" maxlength="500" v-model="post.body" required></textarea>
            </div>

            <div class="form-group akaMt2rem">
                <h5>Kompletterande bild <span class="akaTextProp">(valfritt)</span></h5>
                <h5>(jpg, png, max 4 MB)</h5>

                <input type="file" name="file-1[]" id="file-upload" accept=".jpg,.png" size="32154" class="inputfile inputfile-1" v-if="uploadReady" @change="imageChanged" hidden>
				<label for="file-upload" class="btn akaBgPink">

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

            <div  v-if="!this.auth" class="form-group akaMt2rem">
                <h5>Jag heter <span class="akaTextProp">(valfritt)</span></h5>
                <input type="text" class="akaFormControl" placeholder="Förnamn" v-model="post.firstName">
                <input type="text" class="akaFormControl mt-3 akaBorderRadius" placeholder="Efternamn" v-model="post.lastName">
            </div>
            
            <div v-if="!this.auth" class="form-group akaMt2rem">
                <h5>Telefonnummer <span class="akaTextProp">(valfritt)</span></h5>
                <input type="number" class="akaFormControl" placeholder="Telefonnummer" v-model="post.phone">
            </div>

            <div v-if="!this.auth" class="form-group akaMt2rem">
            <h5>E-post <span class="akaTextProp">(valfritt)</span></h5>
                <input type="email" class="akaFormControl" placeholder="exempel@epost.se" v-model="post.email">
            </div>

            <div class="form-group akaMt2rem akaFlexRow" v-if="!this.getBack">
                <input type="checkbox" name="vehicle" value="Bike"><h5 class="akaMl1rem">Jag vill ha återkoppling på ärendet</h5>
            </div>
    
           <button type="submit" class="btn btn-block akaBgPink text-white akaBorderRadius">Skicka</button>
 
        </form>

    </div>
</template>

<script>
    export default {
        props: ['auth'],
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
                    imageName: '',
                    firstName: '',
                    lastName: '',
                    phone: '',
                    email: '',
                    location: '',
                    lat: '',
                    lng: '',
                },
                post_id: '',
                pagination: {},
                edit: false,
                uploadReady: true,
                renderMap: true,
                getBack: false
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
                this.post.firstName = '';
                this.post.lastName = '';
                this.post.phone = '';
                this.post.email = '';
                
                this.getBack = true;
                var self = this;
                setTimeout(function(){
                self.getBack = false;
                }, 300); 
                
                this.renderMap = false;
                var self = this;
                setTimeout(function(){
                self.renderMap = true;
                }, 300); 
                
            })
                console.log(this.uploadReady);
            },
            sendErrorReport() {
                this.clearUpload();
                alert('Vi har mottagit din felanmälan, tack så mycket!');
            }
        }
    }
    
</script>