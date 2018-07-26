<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <script src="https://cdn.jsdelivr.net/npm/vue"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="https://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>
    <title>myTest</title>
    <style type="text/css">
			#table table {
				width: 100%;
				font-size: 14px;
				border: 1px solid #eee
			}
			
			#table {
				padding: 0 10px;
			}
			
			table thead th {
				background: #f5f5f5;
				padding: 10px;
				text-align: left;
			}
			
			table tbody td {
				padding: 10px;
				text-align: left;
				border-bottom: 1px solid #eee;
				border-right: 1px solid #eee;
			}
			
			table tbody td span {
				margin: 0 10px;
				cursor: pointer;
			}
			
			.delete {
				color: red;
			}
			
			.edit {
				color: #008cd5;
			}
			
			.add {
				border: 1px solid #eee;
				margin: 10px 0;
				padding: 15px;
			}
			
			input {
				border: 1px solid #ccc;
				padding: 5px;
				border-radius: 3px;
				margin-right: 15px;
			}
			
			button {
				background: #008cd5;
				border: 0;
				padding: 4px 15px;
				border-radius: 3px;
				color: #fff;
			}
			
			#mask {
				background: rgba(0, 0, 0, .5);
				width: 100%;
				height: 100%;
				position: fixed;
				z-index: 4;
				top: 0;
				left: 0;
			}
			
			.mask {
				width: 300px;
				height: 250px;
				background: rgba(255, 255, 255, 1);
				position: absolute;
				left: 0;
				top: 0;
				right: 0;
				bottom: 0;
				margin: auto;
				z-index: 47;
				border-radius: 5px;
			}
			
			.title {
				padding: 10px;
				border-bottom: 1px solid #eee;
			}
			
			.title span {
				float: right;
				cursor: pointer;
			}
			
			.content {
				padding: 10px;
			}
			
			.content input {
				width: 270px;
				margin-bottom: 15px;
			}
		</style>
</head>
<body>
    <div id="app">
        <p v-text="message" style="text-align:center"></p>
        <div class="add">
            <input type="text" v-model="tests.title" name="title" value="" placeholder="标题">
            <input type="text" v-model="tests.user" name="user" value="" placeholder="发布人">
            <input type="text" v-model="tests.time" name="time" value="" placeholder="时间">
            <button @click="add">添加</button>
        </div>
        <table>
            <thead>
                <tr>
                    <th>序号</th>
                    <th>标题</th>
                    <th>发布人</th>
                    <th>发布时间</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody v-for="(test,index) in tests">
                <tr>
                    <td width="5%">@{{index + 1}}</td>
                    <td>@{{test.title}}</td>
                    <td width="10%">@{{test.user}}</td>
                    <td width="15%">@{{test.time}}</td>
                    <td width="10%"><span @click="aedit(test)" class="edit">编辑</span><span @click="del(index)" class="delete">删除</span></td>
                </tr>
            </tbody>
        </table>
        <div id="mask" v-if="edit">
            <div class="mask">
                <div class="title">
                    编辑
                    <span @click="edit=false">
                        X
                    </span>
                </div>
                <div class="content">
                    <input type="text" v-model="edits.title" name="title" value="" placeholder="标题" />
                    <input type="text" v-model="edits.user" name="user" value="" placeholder="发布人" />
                    <input type="text" v-model="edits.time" name="time" value="" placeholder="发布时间" />
                    <button @click="update">更新</button>
                    <button @click="edit=false">取消</button>
                </div>
            </div>
        </div>
    </div>
    <script>
    var app = new Vue({
        el: '#app',
        data: {
            message: 'hello Vue!',
            tests: '',
            edit: false,
			edits: {},
            editid:''
        },
        beforeCreate: function(){
            axios({
                method:'get',
                url:'/getData',
                })
                .then(function(response) {
                    console.log(response);
                    app.tests = response.data;
                });
        },
        methods: {
            add() {
                this.tests.push({
                    title: this.tests.title,
                    user: this.tests.user,
                    time: this.tests.time,
                })
            },
            aedit(item) {
                this.edits = ({
                    title: item.title,
                    user: item.user,
                    time: item.time,
                });
                this.edit = true,
                this.editid = item.id
            },
            del(id){
                this.tests.splice(id,1);
                axios({
                    method:'post',
                    url:'/getData1',
                    data:{
                        id: id
                    }
                    })
                    .then(function(response) {
                    });
            },
            update(){
                let that = this;
                for( let i = 0; i < that.tests.length; i++){
                    if(this.editid == that.tests[i]['id']){
                        that.tests[i] = {
                            title: this.edits.title,
                            user: this.edits.user,
                            time: this.edits.time,
                        }
                        this.edit = false
                    }
                }
            }
        }
    })
    </script>
</body>
</html>