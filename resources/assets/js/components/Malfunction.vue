<template>
    <div class="akaContainer mb-5 akaMalfunction">

         <form class="mb-3 mt-3" id="malfunction">

            <div class="form-group">
                <h5>Rubrik till driftstörning*</h5>
                <input type="text" class="akaFormControl akaOrange" placeholder="Titel" id="postTitle" required>
            </div>

            <div class="form-group akaMt2rem akaShort">
                <h5>Sammanfattning* <span class="akaTextProp">(Underrubrik i notifikation)</span></h5>
                <textarea class="akaFormControl" placeholder="Max 150 tecken" maxlength="150" required></textarea>
            </div>
        </form>

        <div class="form-group akaMt2rem">
        <h5>Plats <span class="akaTextProp">(valfritt)</span></h5>
        <googlemap colorTheme="akaOrange"></googlemap>
        </div>

        <form class="mb-3 akaMt2rem" id="malfunction">   
            <div class="form-group akaMt2rem">
                <h5>Fullständig information</h5>
                <textarea class="akaFormControl" placeholder="Beskrivning av driftstörning" required></textarea>
            </div>

            <button form="malfunction" type="submit" class="btn btn-block akaBgOrange text-white akaBorderRadius">Skicka</button>
 
        </form>

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
                console.log(this.uploadReady);
            }
        }
    }
    
</script>