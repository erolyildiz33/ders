<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ul>
                    <li class="errors" v-for="i in errors">
                        {{i}}
                    </li>
                </ul>
            </div>

        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <input type="text" class="form-control" v-model="name" placeholder="Ad Soyad">
                </div>
            </div>

            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" placeholder="Email"class="form-control" v-model="email">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" placeholder="Telefon"class="form-control" v-model="phone" v-mask="'##-###-###-##-##'">
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <input type="date" class="form-control" @change="SelectDate" v-model="date">
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-md-12">
                <ul class="select-time-ul">
                    <li class="select-time" v-for="item in workinhHours">
                        <input type="radio" v-model="saat" v-bind:value="item.id">
                        <span>{{item.hour}}</span>
                    </li>

                </ul>


            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <textarea v-model="text" cols="30" rows="10" class="form-control">

                    </textarea>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <button @click="store" class="btn btn-success">Randevu Oluştur</button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                errors:[],
                name:null,
                email:null,
                phone:null,
                date: new Date().toISOString().slice(0,10),
                text:null,
                workinhHours:[],
                saat:0,
            }
        },
        mounted() {
            axios.get('https://lara/api/working-hours')
            .then((res)=>{
                this.workinhHours =res.data;
                }
            )
        },
        methods:{
            validEmail: function (email) {
                var re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                return re.test(email);
            },
            store:function(){
                if(this.name && this.email && this.validEmail(this.email) && this.phone && this.saat!=0)
                {

                }
                this.errors=[];
                if(!this.name){
                    this.errors.push('Ad Soyad Girilmelidir!');
                }
                if(!this.email | !this.validEmail(this.email)){
                    this.errors.push('Eposta Doğru Formatta Girilmelidir!');
                }
                if(!this.phone){
                    this.errors.push('Telefon Numarası Girilmelidir!');
                }
                if(!this.saat){
                    this.errors.push('Randevu Saati Seçilmelidir!');
                }




            },
            SelectDate:function()
            {
                axios.get('https://lara/api/working-hours/${this.date}')
                    .then((res)=>{
                            this.workinhHours =res.data;
                        }
                    )
            }
        }
    }
</script>

<style scoped>

</style>
