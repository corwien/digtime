<?php

namespace App\Admin\Controllers;

use App\Models\Article;
use App\Models\User;
use Encore\Admin\Auth\Permission;
use Auth;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

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

        // 检查权限，有create-article权限的用户或者角色可以访问创建文章页面
        Permission::check('create-article');

        return Admin::content(function (Content $content) {

            $content->header('header');
            $content->description('description');

            $content->body($this->form());
        });
    }


    /**
     *  重写 store 方法
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store()
    {
        $data = Input::all();

        // 将标题处理为slug格式
        // $data['slug'] = app('translug')->translug($data['title']);
        $data['slug'] =  str_random(6) . date("YmdH:i:s");

        // 重写方法，并传入参数
        return $this->form()->store_v2($data);
    }

    /**
     *  重写 update 方法
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id)
    {
        $data = Input::all();

        // 将标题处理为slug格式
        // $data['slug'] = app('translug')->translug($data['title']);
        $data['slug'] =  str_random(6) . date("YmdH:i:s");

        // 重写方法，并传入参数
        return $this->form()->update_v2($id, $data);
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
            //  $grid->column('title');

            $grid->title()->display(function($title) {
                // $title = User::find($userId)->name;
                return "<a href='/articles/{$this->id}' target='_blank'>{$title}</a>";
            });

            $grid->content()->display(function($content) {
                return str_limit($content, 30, '...');
            });

            $grid->created_at();
            $grid->model()->orderBy('created_at', 'desc');
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
        $author_id = user()->id;

        // src/Form.php  这个方法可以获取表单里的值  Illuminate\Http\Request;
        return Admin::form(Article::class, function (Form $form) use ($author_id) {

            $form->display('id', 'ID');
            $form->text('title', '标题')->rules('required|min:3');
            $form->text('subtitle', '副标题');
            $form->text('user_id', '作者ID')->default($author_id);
            $form->hidden('slug');
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
