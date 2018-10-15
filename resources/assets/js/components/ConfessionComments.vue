<template>
    <div class="container">
        <hr class="mt-5">
        <button class="btn btn-link" @click="commentPostView=true">post a comment</button>
        <hr>
        <div v-if="commentPostView">

            <form>
                <label for="name" class="">Leave your name:</label>
                <input type="text" name="name" class="form-control" v-model="postedname">
                <textarea v-model="postedcomment" class="mt-3 form-control" cols="25" rows="4" placeholder="comment here">

                </textarea><br>
                <div v-if="commentPostLoading">
                    <button class="btn btn-success" disabled>posting <i class="fas fa-circle-notch fa-spin"></i></button>
                </div>
                <div v-else>

                    <button @click.prevent="postcomment()" class="btn btn-success">post Comment</button>
                </div>
            </form>
        </div>
       
        <h3>comments</h3>
        <hr>
        <div v-if="loading" class="text-center">
            <h4>LOADING</h4> 
            <div class="fa-3x">
                <i class="fas fa-circle-notch fa-spin"></i>
            </div>
        </div>
        <div v-else>

            <div v-if="isAvailable==false">
                <p>no comments yet...</p>
            </div>
            <div v-else-if="isAvailable==true">
                <div v-for="comment in comments" class="card mt-5" :key="comment.id">
                    <div class="card-body">

                        <h4 class="card-text">{{comment.user_name}} says...</h4>
                        <hr>
                        <p class="card-text">{{comment.comment}}</p>
                        <div class="text-muted card-text text-right mr-5">
                            <small class="mr-5">
                                posted on {{comment.created_at}}
                            </small>
                        </div>
                        <div >
                            
                            <div >
                                <comment-replies :commentid="comment.id" :commentreplies="comment.replies"></comment-replies>  
                            </div>
                        </div> 
                        
                       <!--  <div v-if="replyform==true">
                             <form>
                                <label for="name" class="">Leave your name:</label>
                                <input type="text" name="name" class="form-control" v-model="postedname">
                                <textarea v-model="postedcomment" class="mt-3 form-control" cols="25" rows="4" placeholder="comment here">

                                </textarea><br>
                                <div v-if="commentPostLoading">
                                    <button class="btn btn-success" disabled>posting <i class="fas fa-circle-notch fa-spin"></i></button>
                                </div>
                                <div v-else>

                                    <button @click.prevent="postcomment()" class="btn btn-success">post Comment</button>
                                </div>
                            </form>
                        </div> -->

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
            comments:[],
            replies:[],
            showReply:[],
            commentPostView:false,
            showReplyForm:[],
            replyform:false,
            postedcomment:'',
            postedname:'someone',
            postedReply:'',
            postedReplyName:'someone',
            noOfReplies:'',
            replyLoading:false,
            isAvailable:false,
            loading:false, 
            commentPostLoading:false,
            dt:{id:'',comment:'',name:''},
            reply_data:{id:'',reply:'',replies:''}

        }
    },
    created(){
        this.loading=true;
        this.findComments();
        
    },
    props:{
        confessionid:Number,
    },
    methods:{
        findComments(){
            fetch('/api/getComments/'+this.confessionid)
                .then(res => res.json())
                .then(res => {
                    this.comments = res.data;
                    this.isAvailable=true;
                    this.loading=false;
                    //this.buildshowReplies();
                    })
                .catch(error =>{
                    this.isAvailable=false;
                    this.loading=false;
                    }
            )               
        },
        postcomment(){
            this.commentPostLoading=true;
            this.dt.id=this.confessionid;
            this.dt.comment=this.postedcomment;
            this.dt.name=this.postedname;
            console.log(this.dt);
            let url='/api/postComments';
            fetch(url ,{
                method:'post',
                body: JSON.stringify(this.dt),
                headers: {
                    'content-type': 'application/json'
                }
            })
                .then(res => res.json())
                .then (res => {
                    this.comments=res.data;
                    this.isAvailable=true;
                    this.postedcomment='';
                    this.commentPostLoading=false;
                    this.postedname="someone";
                
            })

        },
        buildshowReplies(){
            console.log('ok');
            for(comment in this.comments){
                console.log(comment);
                this.showReply[comment.id]=false;
                this.showReplyForm[comment.id]=false;
                console.log('reply'+this.showReplyForm[comment.id]);
            }
            
        },
        showReplies(id){
            this.showReply[id]=true;
        }
        

    }
}
</script>

