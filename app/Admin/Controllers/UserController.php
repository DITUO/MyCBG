<?php

namespace App\Admin\Controllers;

use App\Model\User;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Encore\Admin\Auth\Database\Permission;
use Encore\Admin\Auth\Database\Role;
use Illuminate\Support\MessageBag;

class UserController extends Controller
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
        return Admin::grid(User::class, function (Grid $grid) {

            $grid->column('id','ID')->sortable();
            $grid->column('name','名称');
            $grid->column('email','邮箱');

            $grid->column('created_at','创建时间');
            $grid->column('updated_at','更新时间');
            $grid->filter(function($filter){

                // 去掉默认的id过滤器
                $filter->disableIdFilter();
            
                // 在这里添加字段过滤器
                $filter->like('name', 'name');
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
        return Admin::form(User::class, function (Form $form) {
            $form->display('id', 'ID');
            $form->text('name', '名称')->rules('required');
            $form->text('email', '邮箱')->rules('required');
            $form->image('avatar','头像')->uniqueName();
            $form->password('password', '密码')->rules('required|confirmed')->default(function ($form) {
                return $form->model()->password;
            });;
            $form->password('password_confirmation', '确认密码')->rules('required')->default(function ($form) {
                return $form->model()->password;
            });

            $form->ignore(['password_confirmation']);

            $form->display('created_at', '创建时间');
            $form->display('updated_at', '更新时间');
            $form->saving(function (Form $form) {
                if ($form->password && $form->model()->password != $form->password) {
                    $form->password = bcrypt($form->password);
                }
                if($form->name !== $form->model()->name && User::where('name',$form->name)->value('id')){
                    $error = new MessageBag(['title'=>'提示','message'=>'用户名已存在!']);
                    return back()->withInput()->with(compact('error'));
                }
                if($form->email !== $form->model()->email && User::where('email',$form->email)->value('id')){
                    $error = new MessageBag(['title'=>'提示','message'=>'邮箱已存在!']);
                    return back()->withInput()->with(compact('error'));
                }
            });
        });
    }
}
