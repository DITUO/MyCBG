<?php

namespace App\Admin\Controllers;

use App\Model\Service;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class ServiceController extends Controller
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
        return Admin::grid(Service::class, function (Grid $grid) {

            $grid->id('ID')->sortable();
            $grid->name('名称');
            $grid->level('等级');
            $grid->gid('父级id');
            $grid->status('状态,1正常0关闭');

            $grid->create_time('开服时间')->display(function($time){
                return date('Y-m-d H:i:s',$time);
            });
            $grid->deleted_at('删除时间');
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
        return Admin::form(Service::class, function (Form $form) {
            $directors = [
                '1'  => '正常',
                '0' => '关闭',
            ];
            $form->display('id', 'ID');
            $form->text('name','名称');
            $form->number('level','等级');
            $form->number('gid','父级id');
            $form->select('status','状态')->options($directors);

            $form->display('create_time', '开服时间');
            $form->display('deleted_at', '删除时间');
        });
    }
}
