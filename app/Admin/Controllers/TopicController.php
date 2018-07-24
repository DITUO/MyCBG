<?php

namespace App\Admin\Controllers;

use App\Model\Topic;
use App\Model\User;
use App\Model\Service;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class TopicController extends Controller
{
    use ModelForm;

    /**
     * Index interface.
     *
     * @return Content
     */
    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header('header');
            $content->description('description');

            $content->body($this->grid());
        });
    }

    /**
     * Edit interface.
     *
     * @param $id
     * @return Content
     */
    public function edit($id)
    {
        return Admin::content(function (Content $content) use ($id) {

            $content->header('header');
            $content->description('description');

            $content->body($this->form()->edit($id));
        });
    }

    /**
     * Create interface.
     *
     * @return Content
     */
    public function create()
    {
        return Admin::content(function (Content $content) {

            $content->header('header');
            $content->description('description');

            $content->body($this->form());
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(Topic::class, function (Grid $grid) {

            $grid->column('id','ID')->sortable();
            $grid->column('title','标题');
            $grid->column('body','内容')->display(function($body) {
                return str_limit($body, 50, '...');
            });
            $grid->column('user.name','用户')->sortable();
            $grid->column('category.name','分类')->sortable();
            $grid->column('reply_count','回复数')->sortable();
            $grid->column('view_count','浏览数')->sortable();
            $grid->column('service.name','服务器ID')->sortable();

            $grid->column('created_at','创建时间');
            $grid->column('updated_at','更新时间');
            $grid->filter(function($filter){

                // 去掉默认的id过滤器
                $filter->disableIdFilter();
            
                // 在这里添加字段过滤器
                $filter->like('title', 'title');
            });
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(Topic::class, function (Form $form) {
            $directors = [
                '1'  => '梦幻币',
                '2' => '召唤兽',
                '3'  => '装备',
                '4'  => '其他',
            ];
            $users = User::all()->pluck('name','id')->toArray();
            $services = Service::where('level',2)->pluck('name','id')->toArray();
            $form->display('id', 'ID');
            $form->text('title', '标题');
            $form->textarea('body', '内容');
            $form->select('user_id', '用户名称')->options($users);
            $form->select('category_id', '分类id')->options($directors);
            $form->number('reply_count', '回复数');
            $form->number('view_count', '浏览数');
            $form->select('service_id', '服务器ID')->options($services);

            $form->display('created_at', '创建时间');
            $form->display('updated_at', '更新时间');
        });
    }
}
