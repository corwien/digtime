<?php

namespace App\Admin\Controllers;

use App\Models\Article;
use App\Models\User;
use Auth;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class ArticlesController extends Controller
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
        return Admin::grid(Article::class, function (Grid $grid) {

            $grid->id('ID')->sortable();
            $grid->user_id();
            $grid->column('title');

            $grid->content()->display(function($content) {
                return str_limit($content, 30, '...');
            });

            $grid->created_at();
            $grid->updated_at();
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(Article::class, function (Form $form) {

            $form->display('id', 'ID');
            $form->text('title', '标题')->rules('required|min:3');
            $form->text('subtitle', '副标题');

            $form->text('user_id', '作者ID')->default(4);
            $form->text('slug', 'Slug')->default('My-blog-4');
            $form->text('category_id', '分类ID')->default(1);
            $form->text('order', '排序')->default(1);
            $form->radio('is_excellent', '是否精华')->options(['F' => '否', 'T' => '是'])->default('T');

            // 图片路径为upload/images/
            $form->image('page_image', '上传文章背景图')->move('images', function($file){

                // 自定义文件名,时间戳+五个随机字符串+用户ID
                $file_name =  date("Ymd") . str_random(6);
                return $file_name . "." . $file->guessExtension();
            });

            $form->datetime('published_at', '发布作品时间')->format('YYYY-MM-DD HH:mm:ss');

            $form->display('created_at', trans('admin::lang.created_at'));
            $form->display('updated_at', trans('admin::lang.updated_at'));
            $form->editor('content')->rules('required|min:3');
        });
    }
}
