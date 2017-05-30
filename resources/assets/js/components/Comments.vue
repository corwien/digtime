<template>
        <div class="row">
            <div class="col-md-8 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                       评论数：{{ count }}
                    </div>

                    <!-- 评论列表 --> 
                    <div class="panel-body">
                       <div v-if="comments.length > 0">
                            <div class="media" v-for="comment in comments">
                                <div class="media-left">
                                    <a :href="'/user/' + comment.user_id">
                                      <!-- 注意：这里的图片src，href 需要使用Vue中的资源特殊写法，否则编译不过去 -->
                                        <img width="36px" class="media-object" :src="comment.user.avatar"> 
                                    </a> 
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading">{{ comment.user.name }}
                                      <small><span class="pull-right">{{ comment.created_at }}</span></small> </h4>
                                    {{ comment.content }}<br/>
                                     <button class="button is-naked delete-button" v-on:click="showCommentsForm(comment.id)">回复</button> &nbsp;&nbsp;&nbsp;&nbsp;<a class="fa fa-thumbs-o-up"></a>

                                     <!-- 子回复 -->
                                     <div v-if="comment.sub_comments">
                                         <div class="media sub-comment" v-for="child_comment in comment.sub_comments">

                                            <div class="media-left">
                                              <a :href="'/user/' + child_comment.user_id">
                                                <!-- 注意：这里的图片src，href 需要使用Vue中的资源特殊写法，否则编译不过去 -->
                                                <img width="36px" class="media-object" :src="child_comment.user.avatar">
                                              </a>
                                            </div>

                                            <div class="media-body">
                                              <h4 class="media-heading">{{ child_comment.user.name }}
                                              <small><span class="pull-right">{{ child_comment.created_at }}</span></small> </h4>
                                              {{ child_comment.content }}<br/>
                                              <button class="button is-naked delete-button" v-on:click="showCommentsForm(child_comment.id,child_comment.group_id)">回复</button> &nbsp;&nbsp;&nbsp;&nbsp;<a class="fa fa-thumbs-o-up"></a>
                                           </div>

                                        </div>
                                     </div>
                                </div>
                            </div>
                       </div>
                   </div>

                    <!-- Modal Actions -->
                    <div class="modal-footer">
                        <textarea class="form-control" rows="5" name="content" v-model="content"></textarea>

                        <button type="button" class="btn btn-primary" @click="store">评论</button>
                    </div>
                </div>

                <div class="modal fade" id="reply_comment" tabindex="-1" role="dialog">
                   <div class="modal-dialog">
                       <div class="modal-content">
                           <!-- Modal Actions -->
                           <div class="modal-footer">
                             <textarea class="form-control" rows="3" name="reply-content" v-model="reply_content"></textarea>
                             <button type="button" class="btn btn-primary" @click="store">回复</button>
                           </div>
                       </div>
                   </div>
                </div>


            </div>
        </div>
</template>

<script>
    export default {
        // 为父组件传递到子组件的属性值，子组件使用props方法接收，model为question_id或answer_id
        props:['type', 'model', 'count', 'comment_id', 'group_id'],

        // 模型绑定数据
        data(){
            return {
                content : '',
                reply_content : '',
                comment_id : '',
                group_id : '',
                comments :[],
            }
        },
        // mounted 方法为钩子，在Vue实例化后自动调用
        mounted() {
            axios.get('/api/' + this.type + '/' + this.model + "/comments", {
            }).then((response) => {
               this.comments = response.data;
            })

        },
        methods: {
            // 发送评论
            store(){
                axios.post('/api/comment', {
                    'type': this.type, 'model': this.model, 'content': this.content,'reply_content': this.reply_content,
                    'comment_id': this.comment_id
                }).then((response) => {

                    // console.log(response);
                    if(this.comment_id > 0)
                    {
                        for(var index in this.comments)
                      {
                        if(this.comments[index].id == response.data.group_id)
                        {
                            this.comments[index].sub_comments.push(response.data)
                        }
                      }
                    }
                    else
                    {
                      this.comments.push(response.data)
                    }

                     this.content = ''
                     this.reply_content = ''
                    this.comment_id = ''
                    this.group_id   = ''
                    $("#reply_comment").modal('hide');
                     this.count ++

                })
            },
            showCommentsForm(comment_id, group_id){
                $("#reply_comment").modal('show');
                this.comment_id = comment_id;
                this.group_id   = group_id;
            }

        }

    }
</script>

<style lang="scss" scoped>

.media .sub-comment {
  border: 0px solid #eaeaea;

}


</style>
