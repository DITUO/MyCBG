<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 引入 Bootstrap -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <title>服务器列表</title>
</head>
    <body>
    <div id="app">
        <div style="float:left;display:inline-block;width:70%">
            <table class="table table-bordered" style="width:80%;float:left;margin-top:3%;table-layout:fixed;margin-right:10%;margin-left:10%;">
            <caption style="text-align:center;">选择服务器</caption>
            <tbody>
                @foreach($data1 as $service)
                    <tr>
                        @foreach($service as $v)
                            <td style="text-align:center;width:14.285714%;height:37px;"><a href="javascript:void(0)" v-on:click="dianji({{$v['id']}})">{{ $v['name'] }}</a></td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
            </table>
            <table class="table table-bordered" style="width:80%;margin-left:10%;margin-left:10%;table-layout:fixed;">
            <caption style="text-align:center;"></caption>
            <tbody>
                <tr v-for="item in data">
                    <td style="text-align:center;width:14.285714%;height:37px;" v-for="index in item"><a v-bind:href="'{{route('choose')}}?id='+index.id">@{{ index.name }}</a></td>
                </tr>  
            </tbody>
            </table>  
        </div>
        <div style="width:30%;margin-top:4%;display:inline-block;">
            <div style="width:80%;height:350px;margin-left:10%;margin-left:10%;table-layout:fixed;background-color:#ccc;">
            <table class="table table-bordered" style="width:80%;float:left;margin-top:3%;table-layout:fixed;margin-right:10%;margin-left:10%;">
            <caption style="text-align:center;">藏宝阁公告</caption>
            <tbody>
                @foreach($data3 as $announcement)
                    <tr>
                        <td style="text-align:center;"><a href="{{$announcement['url']}}" target="_blank">{{ $announcement['title'] }}</a></td>
                    </tr>
                @endforeach
            </tbody>
            </table>
            </div> 
        </div> 
    </div>

        <!-- jQuery (Bootstrap 的 JavaScript 插件需要引入 jQuery) -->
        <script src="https://code.jquery.com/jquery.js"></script>
        <script src="{{asset("public/js/vue.js")}}"></script>
        <script>
            var app = new Vue({
                    el: '#app',
                    data: {
                        data:{},
                    },
                    beforeCreate: function() { //创建前 this.a this.$el
                        var id=1;
                        var that = this;
                        $.ajax({ 
                            type: 'POST', 
                            url: "{{ asset("services") }}" , 
                            data: { _token : '<?php echo csrf_token()?>',
                                    service_id :id}, 
                            dataType: 'json', 
                            success: function(data){
                                that.data=data;
                            }, 
                            error: function(xhr, type){
                                alert('Ajax error!')   
                            } 
                        });
                    },   
                    created: function() {	//创建之后 
                    },        
                    beforeMount: function() {  //mount之前          
                    },
                    mounted:function(){ //需要执行的方法可以在mounted中进行触发，其获取的数据可以赋到data中后，可以放在前面进行渲染  //mount之后
                    },  			
                    beforeUpdate: function() { //更新前         
                    },          
                    updated: function() {    //更新完成
                    },          
                    beforeDestroy: function() {  //销毁前          
                    },         
                    destroyed: function() {    //已销毁       
                    }, 
                    //触发事件
                    methods: {  // 在 `methods` 对象中定义方法
                        dianji:function(id){
                            var that = this;
                            $.ajax({ 
                                type: 'POST', 
                                url: "{{ asset("services") }}" , 
                                data: { _token : '<?php echo csrf_token()?>',
                                        service_id :id}, 
                                dataType: 'json', 
                                success: function(data){
                                    that.data=data;
                                }, 
                                error: function(xhr, type){
                                    alert('Ajax error!')   
                                } 
                            });
                        }
                    } 
                })		 
        </script>
    </body>		
</html>
