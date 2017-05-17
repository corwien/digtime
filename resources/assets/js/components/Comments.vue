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
                                <h4 class="media-heading">{{ comment.user.name }}</h4>
                                {{ comment.content }} <span class="pull-right">{{ comment.created_at }}</span>
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
            </div>
        </div>
</template>

<script>
    export default {
        // 为父组件传递到子组件的属性值，子组件使用props方法接收，model为question_id或answer_id
        props:['type', 'model', 'count'],

        // 模型绑定数据
        data(){
            return {
                content : '',
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
                    'type': this.type, 'model': this.model, 'content': this.content
                }).then((response) => {

                    console.log(response);
                     this.comments.push(response.data)
                     this.content = ''
                     this.count ++

                })
            }
        }

    }
</script>
