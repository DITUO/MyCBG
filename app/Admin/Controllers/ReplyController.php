<?php

namespace App\Admin\Controllers;

use App\Model\Reply;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class ReplyController extends Controller
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
        return Admin::grid(Reply::class, function (Grid $grid) {

            $grid->id('ID')->sortable();
            $grid->topic_id('话题ID')->sortable();
            $grid->user_id('用户ID')->sortable();
            $grid->content('内容');

            $grid->created_at();
            $grid->updated_at();
            $grid->filter(function($filter){

                // 去掉默认的id过滤器
                $filter->disableIdFilter();
            
                // 在这里添加字段过滤器
                $filter->like('content', 'content');
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
        return Admin::form(Reply::class, function (Form $form) {

            $form->display('id', 'ID');
            $form->text('topic_id', '话题ID');
            $form->text('user_id', '用户ID');
            $form->textarea('content', '内容');

            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
        });
    }
}
