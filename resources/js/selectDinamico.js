import Axios from "axios";

const app = new Vue({
    el: '#app',
    data: {
        selected_provincia:'',
        selected_localidad:'',
        localidades:[] ,

    },
    methods: {
        loadLocalidades(){
            Axios.get('/localidades',{params:{provincia_id: this.selected_provincia}}).then((response)=>{
                this.localidades = response.data;
                console.log(response.data);
            });
        }
    }
});

