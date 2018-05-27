<template>
    <div class="akaContainer mb-4">
        <div class="akaNotificationContainer">
            <div class="akaMalfunctionNotification border-0" v-for="malfunction in malfunctions" v-bind:key="malfunction.id">
                                
                <div class="card-body" v-if="!malfunction.dissmissed">

                    <img class="akaWhiteCross" src="images/crossWhite.svg" alt="dissmiss" @click="dissmiss(malfunction.id)">

                    <h3>{{ malfunction.title }}</h3>
                    
                    <h4>{{ malfunction.summary }}</h4>
                    <h4 class="akaFontWeightL akaNoBottomMargin">Läs mer <a href="">här</a>.</h4>
                    <!-- <p class="akaTiny">{{ malfunction.created_at }}<br>{{ malfunction.location }}</p> -->
                </div> 
                
            </div>
        </div>
        <button @click="log(malfunction)" class="btn btn-danger mb-2">Log</button>
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
                    dissmissed: false
                },
                malfunction_id: '',
                dissmissedMalfunctions: [28, 27]
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
                })
                .catch(err => console.log(err)); 
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
                // console.log(id);
                
                const dissmissedCookie = this.getCookie("dissmissedMalfunctions");
                const array = [id];

                if (dissmissedCookie == null || '') {
                    console.log('Cookie does not exist... Created!');
                    const json = JSON.stringify(array);
                    this.setCookie("dissmissedMalfunctions", json);
                } else {

                    const dissmissedMalfunctions = JSON.parse(dissmissedCookie);

                    dissmissedMalfunctions.push(id);
                    const json = JSON.stringify(dissmissedMalfunctions);
                    this.setCookie("dissmissedMalfunctions", json);

                    console.log(dissmissedMalfunctions);

                }

                // Next step is to filter this.malfunctions thru the cookies and overwrite it with the new filtered array

                // const myCookie = this.getCookie("dissmissedMalfunctions");

                // this.setCookie("dissmissedMalfunctions", id)

                // const myCookie = this.getCookie("dissmissedMalfunctions");
                
                // console.log(myCookie)
                // console.log(this.malfunction);
            },
            log(){
                // document.cookie = "username=John Doe";
                // createCookie('name', 'albert');
                // console.log(this.malfunction);
                const test = this.malfunctions;
                const dissmissed = [28, 29];

                var filteredMalfunctions =
                test.filter(malfunction => !dissmissed.includes(malfunction.id));
                
                console.log(test)
                // console.log(arraj);
                // console.log(dissmissed);
                console.log(filteredMalfunctions);
                
            },
        },
        
        computed: {
            dissmissedMalfunctionsss(){
                var arr = ['foo', 'bar', 'baz'];
                var json_str = JSON.stringify(arr);
                createCookie('mycookie', json_str);

            }
        }
    }
    
</script>