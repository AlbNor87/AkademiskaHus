<template>
    <div class="akaContainer mb-4">
        <div class="akaNotificationContainer">
            <div class="akaMalfunctionNotification border-0" v-for="malfunction in malfunctions" v-bind:key="malfunction.id">
                                
                <div class="card-body" v-if="!malfunction.dissmissed">

                    <img class="akaWhiteCross" src="images/crossWhite.svg" alt="dissmiss" title="Stäng" @click="dissmiss(malfunction.id)">

                    <h3>{{ malfunction.title }}</h3>
                    
                    <h4>{{ malfunction.summary }}</h4>
                    <h4 class="akaFontWeightL akaNoBottomMargin">Läs mer <a href="malfunction">här</a>.</h4>
                    <!-- <p class="akaTiny">{{ malfunction.created_at }}<br>{{ malfunction.location }}</p> -->
                </div> 
                
            </div>
        </div>
        <!-- <button @click="log(malfunction)" class="btn btn-danger mb-2">Log</button> -->
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
                    location: '',
                    lat: '',
                    lng: '',
                    dissmissed: false
                },
                malfunction_id: '',
            }
        },

        created() {
            this.fetchMalfunctions();
        },

        methods: {
            fetchMalfunctions(page_url) {
                page_url = page_url || '/api/malfunctions '
                fetch(page_url)
                .then(res => res.json())
                .then(res => {
                    this.malfunctions = res.data;
                    this.filterDissmissed();
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
            getCookie(cname){
                var name = cname + "=";
                    var decodedCookie = decodeURIComponent(document.cookie);
                    var ca = decodedCookie.split(';');
                    for(var i = 0; i <ca.length; i++) {
                        var c = ca[i];
                        while (c.charAt(0) == ' ') {
                            c = c.substring(1);
                        }
                        if (c.indexOf(name) == 0) {
                            return c.substring(name.length, c.length);
                        }
                    }
                    return null;
            },
            setCookie(cname, cvalue, exdays) {
                var d = new Date();
                d.setTime(d.getTime() + (exdays*24*60*60*1000));
                var expires = "expires="+ d.toUTCString();
                document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
            },
            dissmiss(id){
                
                // Check if cookie exists
                let dissmissedCookie = this.getCookie("dissmissedMalfunctions");

                if (dissmissedCookie == null || '') {
                    // If not create one with an empty array inside it
                    this.setCookie("dissmissedMalfunctions", '[]');
                } 
                
                // If cookie exist -> Get it
                dissmissedCookie = this.getCookie("dissmissedMalfunctions");
                
                // Turn into an array of dissmissed malfunctions
                const dissmissedMalfunctions = JSON.parse(dissmissedCookie);
                
                // Push the newly dissmissed id into the array
                dissmissedMalfunctions.push(id);

                // Turn it back into json and update the cookie
                const json = JSON.stringify(dissmissedMalfunctions);
                this.setCookie("dissmissedMalfunctions", json);

                // Remove the dissmissed item from view
                this.filterDissmissed();
            },
            filterDissmissed(){

                let dissmissedCookie = this.getCookie("dissmissedMalfunctions");
                
                // Check if cookie exists
                if (dissmissedCookie == null || '') return;

                // If cookie exist -> Get it
                dissmissedCookie = this.getCookie("dissmissedMalfunctions");
                
                // Turn into an array of dissmissed malfunctions
                const dissmissedMalfunctions = JSON.parse(dissmissedCookie);

                // Filter the malfunctions to be displayed
                // If the malfunction's id exists in the dissmissed array -> filter it out
                const allMalfunctions = this.malfunctions;
                var filteredMalfunctions = allMalfunctions.filter(malfunction => !dissmissedMalfunctions.includes(malfunction.id));
                
                // Update the malfunctions to be displayed
                this.malfunctions = filteredMalfunctions;
            }
        }
    }
    
</script>