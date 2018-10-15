<template>
    <div>
        
        <div v-if="showReplies">
            <div v-if="replyLoading">

                <div class="fa-3x">
                    <i class="fas fa-circle-notch fa-spin"></i>
                </div>
            </div>

            <div v-else class="container">
                <button class="btn btn-link" @click="showReplies=false">hide replies</button>
                <div v-for="r in replies" :key="r.id">
                    <p>replies</p>
                    <h4>{{r.user_name}} says...</h4>
                    <p>{{r.reply}}</p>
                </div>
            </div>
        </div>
        <div v-else>
            <button class="btn btn-link" @click="showrep()">show replies</button>
        </div>
        <div v-if="!showReplyForm">

            <button class="btn btn-link" @click="showReplyForm=true">Reply</button>
        </div>
        <div v-else>
            <button class="btn btn-link" @click="showReplyForm=false">Hide Reply</button>
            <form>
                <label for="name" class="">Leave your name:</label>
                <input type="text" name="name" class="form-control" v-model="postedName">
                <textarea v-model="postedReply" class="mt-3 form-control" cols="25" rows="4" placeholder="comment here">

                </textarea><br>
                <div v-if="replyPostLoading">
                    <button class="btn btn-success" disabled>posting <i class="fas fa-circle-notch fa-spin"></i></button>
                </div>
                <div v-else>

                    <button @click.prevent="postreply()" class="btn btn-success">post Reply</button>
                </div>
            </form>
        </div>
    </div>
</template>
<script>
export default {
    data:function(){
        return{
            replies:[],
            reply:{id:'',reply:'',user_name:''},
            replyLoading:false,
            replyPostLoading:false,
            showReplies:false,
            showReplyForm:false,
            postedReply:'',
            postedName:'someone',
            replyData:{id:'',reply:'',name:''}
            }
    },
    props:{
        commentid: Number,
        commentreplies: Number
    },
    created(){
        
    
    },
    methods:{
        showreplies(){
            let id=this.commentid;
            fetch('/api/showreplies/'+id)
                .then(res => res.json())
                .then(res => {
                    this.replies = res.data;
                    this.replyLoading=false;
                    console.log(res.data);
                    })
                .catch(error =>{
                    this.isAvailable=false;
                    this.loading=false;
                    }
            )               
        },
        showrep(){
            this.replyLoading=true;
            this.showReplies=true;
            this.showreplies();
        },
        postreply(){
            //this.replyLoading=true;
            let id=this.commentid;
            this.replyPostLoading=true;
            this.replyData.id=id;
            this.replyData.reply=this.postedReply;
            this.replyData.name=this.postedName;
            console.log(this.replyData);
            let url='/api/postreplies';
            fetch(url ,{
                method:'post',
                body: JSON.stringify(this.replyData),
                headers: {
                    'content-type': 'application/json'
                }
            })
                .then(res => res.json())
                .then (res => {
                    this.postedReply='';
                    this.replyLoading=false;
                    this.replyPostLoading=false;
                    this.postedReplyName="someone";
                    this.showrep();
                   
                
            })

        }
    }
    
}
</script>

