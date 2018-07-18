<?php

namespace App\Admin\Controllers;

use App\Model\Topic;

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

            $grid->id('ID')->sortable();
            $grid->column('title');
            $grid->body('内容');
            $grid->user_id('用户ID')->sortable();
            $grid->category_id('分类ID')->sortable();
            $grid->reply_count('回复数')->sortable();
            $grid->view_count('浏览数')->sortable();
            $grid->service_id('服务器ID')->sortable();

            $grid->created_at();
            $grid->updated_at();
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
            $form->display('id', 'ID');
            $form->text('title', '标题');
            $form->textarea('body', '内容');
            $form->text('user_id', '用户id');
            $form->select('category_id', '分类id')->options($directors);
            $form->text('reply_count', '回复数');
            $form->text('view_count', '浏览数');
            $form->text('service_id', '服务器ID');

            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
        });
    }
}
