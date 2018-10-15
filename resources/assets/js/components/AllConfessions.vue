<template>
    <div class="container">
        <div v-if="loading" class="text-center">
            <h4 class="mt-5">LOADING</h4> 
            <div class="mdl-spinner mdl-js-spinner is-active"></div>
            <!-- <div class="fa-3x mt-3">
                <i class="fas fa-circle-notch fa-spin"></i>
            </div> -->
        </div>
        <div v-else>
            <div class="card-columns">
                <div v-for="confession in confessions" :key="confession.id">
                    <div class="card">
                        <div class="card-body">
                            <p class="card-text">{{confession.id}}</p>
                            <p class="card-text">{{confession.confession}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data:function(){
        return{
            loading:'',
            confessions:[]
        }
    },
    created(){
        this.loading=true;
        this.fetchConfessions();
    },
    methods:{
        fetchConfessions(){
            fetch('/api/getallconfessions')
                .then(res => res.json())
                .then(res => {
                    this.confessions = res.data;
                    this.loading=false;
            })
        }
    }
    
}
</script>

