<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Blog;
use App\Category;
use App\Sys;
use App\User;
use App\Index;
use App\Banner;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Request;
use Illuminate\Support\Facades\Storage;
class AdminController extends Controller{
    public function admin_login(Request $request){
        if (Session::has('adminuser')){
            return redirect('admin/index');
        }else{
            if ($request->isMethod('POST')){
                $adminuser = $request->input('name');
                $adminpass = $request->input('password');
                $adminsql = Admin::where('adminuser','=',$adminuser)->first();
                if ($adminsql == ''){
                    return response()->json([ 'state' => 404]);
                }else if($adminuser == $adminsql->adminuser && md5($adminpass) == $adminsql->adminpass){
                    Session::put('adminuser',$adminuser);
                    return response()->json([ 'state' => 200]);
                }else{
                    return response()->json([ 'state' => 201]);
                }
            }
        }
        return view('admin.login');
    }

    public function adminun(){
        Session::forget('adminuser');
        return redirect('admin/login');
    }

    public function index(){
        if (Session::has('adminuser')){
            $usernum = User::paginate();
            $postnum = Blog::paginate();
            $catenum = Category::paginate();
            $user = User::limit(6)->orderBy('id','DESC')->get();
            $post = Blog::limit(9)->orderBy('id','DESC')->get();
            return view('admin.index',[
                'user' => $user,
                'post' => $post,
                'usernum' => $usernum,
                'postnum' => $postnum,
                'catenum' => $catenum
            ]);
        }else{
            return redirect('admin/login');
        }
    }

    public function adSystem(Request $request){
        if (Session::has('adminuser')){
            $systems = Sys::first();
                //upload上传
                if($request->isMethod('POST')){
                    $data = $request->input('System');
                    $systems -> title = $data['title'];
                    $systems -> web_title = $data['web_title'];
                    $systems -> keyword = $data['keyword'];
                    $systems -> description = $data['description'];
                    $systems -> site = $data['site'];
                    $files = $request->file('source');
                    // 判断文件是否上传成功
                    if ($files != '') {
                        if ($files->isValid()) {
                            $originlNmae = $files->getClientOriginalName();//文件名
                            $ext = $files->getClientOriginalExtension();//扩展名
                            $type = $files->getClientMimeType();//文件类型
                            $realPath = $files->getRealPath();//临时绝对目录
                            $filename = uniqid() . '.' . $ext;
                            Storage::disk('uploads')->put($filename, file_get_contents($realPath)); //上传到指定路径
                            $systems->logo = '/app/uploads/' . $filename;
                            $systems->copyright = $data['copyright'];
                            $systems->save();
                        }
                    }
                }
        }else{
            return redirect('admin/login');
        }
        return view('admin.system',[
            'systems' => $systems
        ]);
    }

    public function post(){
        if (Session::has('adminuser')){
            $post = Blog::paginate(8);
            $cate = Category::get();
        }else{
            return redirect('admin/login');
        }
        return view('admin.post',[
            'post' => $post,
            'cate' => $cate
        ]);
    }

    public function c_post(Request $request,$id){
        if (Session::has('adminuser')) {
            $post = Blog::find($id);
            $cates = Category::get();
            $postname = $request->input('post_name');
            $select_content = $request->input('select_content');
            $content = $request->input('content');
            if ($request->isMethod('POST')) {
                $post->post_name = $postname;
                $post->cate_id = $select_content;
                $post->content = $content;
                $post->save();
                return redirect('admin/c_post/'.$id)->with('success','修改成功');
            }
            return view('admin.c_post', [
                'cates' => $cates,
                'post' => $post
            ]);
        }else{
            return redirect('admin/login');
        }
    }

    public function addpost(Request $request){
        if (Session::has('adminuser')) {
            $cates = Category::get();
            $postinfo = new Blog();
            if ($request->isMethod('POST')) {
                $files = $request->file('file');
                $postname = $request->input('post_name');
                $select_content = $request->input('select_content');
                $content = $request->input('content');
                $pict = $request->input('pict');
                if ($files != '') {
                    if ($files->isValid()) {
                        $originlNmae = $files->getClientOriginalName();//文件名
                        $ext = $files->getClientOriginalExtension();//扩展名
                        $type = $files->getClientMimeType();//文件类型
                        $realPath = $files->getRealPath();//临时绝对目录
                        $filename = uniqid() . '.' . $ext;
                        Storage::disk('uploads')->put($filename, file_get_contents($realPath)); //上传到指定路径
                        $pic = '/app/uploads/' . $filename;
                        return json_encode(['pic' => $pic]);
                    }
                }
                if ($postname == '') {
                    return redirect('admin/add_post')->with('error', '标题不得为空');
                } else {
                    $postinfo->post_name = $postname;
                    $postinfo->cate_id = $select_content;
                    $postinfo->content = $content;
                    $postinfo->pic = $pict;
                    $postinfo->see = 0;
                    $postinfo->likeof = 0;
                    $postinfo->author = 1;
                    $postinfo->save();

                    return redirect('admin/add_post')->with('success', '添加成功');
                }
            }
        }else{
            return redirect('admin/login');
        }

        return view('admin.addpost',[
            'cates' => $cates
        ]);
    }

    public function delete_post($id){
        $post_id = Blog::find($id);
        $post_id->delete();
        return redirect('admin/post')->with('success','删除成功');
    }
    //上传图片
    public function imageUpload(Request $request)
    {
        $files = $request->file('wangEditorH5File');
        if ($files != '') {
            if ($files->isValid()) {
                $originlNmae = $files->getClientOriginalName();//文件名
                $ext = $files->getClientOriginalExtension();//扩展名
                $type = $files->getClientMimeType();//文件类型
                $realPath = $files->getRealPath();//临时绝对目录
                $filename = uniqid() . '.' . $ext;
                Storage::disk('uploads')->put($filename, file_get_contents($realPath)); //上传到指定路径
            }
        }
        echo json_encode(array(
            "error" => 0,
            "data" => '/app/uploads/' . $filename,
        ));
    }


    public function getcate(){
        if(Session::has('adminuser')){
            $cates = Category::paginate(5);
        }else{
            return redirect('admin/login');
        }
        return view('admin.cate',[
            'cates' => $cates
        ]);

    }

    public function addcate(Request $request){
        if (Session::has('adminuser')) {
            $cate_name = $request->input('cate_name');
            $cate_othername = $request->input('cate_othername');
            if ($request->isMethod('POST')){
                if ($cate_name =='' || $cate_othername == ''){
                    return redirect('admin/add_cate')->with('error','分类名称或分类别名不得为空');
                }else{
                    $cate = new Category();
                    $cate->cate_name = $cate_name;
                    $cate->cate_othername = $cate_othername;
                    $cate->save();
                    return redirect('admin/add_cate')->with('success','添加成功');
                }
            }
        }else{
            return redirect('admin/login');
        }
        return view('admin.addcate');
    }

    public function c_cate(Request $request,$id){
        if (Session::has('adminuser')) {
            $cates = Category::find($id);
            $cate_name = $request->input('cate_name');
            $cate_othername = $request->input('cate_othername');
            if ($request->isMethod('POST')){
                $cates->cate_name = $cate_name;
                $cates->cate_othername = $cate_othername;
                $cates->save();
                return redirect('admin/c_cate/'.$id)->with('success','修改成功');
            }
        }else{
            return redirect('admin/login');
        }


        return view('admin.c_cate',[
            'cates' => $cates
        ]);
    }


    public function delete_cate($id){
        if (Session::has('adminuser')) {
            $cate_id = Category::find($id);
            $cate_id->delete();
        }else{
            return redirect('admin/login');
        }

        return redirect('admin/cate')->with('success','删除成功');
    }

    public function c_password(Request $request){
        if (Session::has('adminuser')) {
            $old_password = $request->input('old_password');
            $new_password = $request->input('new_password');
            $news_password = $request->input('news_password');
            $password = Admin::where('adminuser','=','admin')->first();
            $pass = $password->adminpass;
            if ($request->isMethod('POST')){
                if ($old_password == '' || $new_password == '' || $news_password == ''){
                    return redirect('admin/password')->with('error','密码不得为空');
                }else{
                    if (md5($old_password) != $pass){
                        return redirect('admin/password')->with('error','旧密码错误');
                    }else if($new_password != $news_password){
                        return redirect('admin/password')->with('error','二次密码不同');
                    }else{
                        $password->adminpass = md5($news_password);
                        $password->save();
                        return redirect('admin/password')->with('success','修改成功');
                    }
                }

            }
        }else{
            return redirect('admin/login');
        }

        return view('admin.password');
    }

    public function settings(Request $request){
        $ins = Index::first();
        $banner = Banner::get();
        if ($request->isMethod('post')){
            $name_A = $request->input('name_A');
            $name_B = $request->input('name_B');
            $name_C = $request->input('name_C');
            $name_D = $request->input('name_D');
            $pic_A = $request->input('pic_A');
            $pic_B = $request->input('pic_B');
            $pic_C = $request->input('pic_C');
            $pic_D = $request->input('pic_D');
            $index = Index::find(1);
            $index->name_A = $name_A;
            $index->name_B = $name_B;
            $index->name_C = $name_C;
            $index->name_D = $name_D;
            $index->pic_A = $pic_A;
            $index->pic_B = $pic_B;
            $index->pic_C = $pic_C;
            $index->pic_D = $pic_D;
            $index->save();
            return json_encode(['status'=>'200']);
        }
        return view('admin.setting',[
            'ins' => $ins,
            'banner' => $banner
        ]);
    }

    public function setting_data(){
        $insof = Index::first();
        return json_encode([
            'status'=>'201',
            'name_A'=>$insof->name_A,
            'name_B'=>$insof->name_B,
            'name_C'=>$insof->name_C,
            'name_D'=>$insof->name_D,
            'pic_A'=>$insof->pic_A,
            'pic_B'=>$insof->pic_B,
            'pic_C'=>$insof->pic_C,
            'pic_D'=>$insof->pic_D
        ]);
    }

    public function index_banner(Request $request){
        $files = $request->file('file');
        // 判断文件是否上传成功
        if ($files != '') {
            if ($files->isValid()) {
                $originlNmae = $files->getClientOriginalName();//文件名
                $ext = $files->getClientOriginalExtension();//扩展名
                $type = $files->getClientMimeType();//文件类型
                $realPath = $files->getRealPath();//临时绝对目录
                $filename = uniqid() . '.' . $ext;
                Storage::disk('uploads')->put($filename, file_get_contents($realPath)); //上传到指定路径
                $banner = new Banner();
                $banner->pics = '/app/uploads/' . $filename;
                $banner->save();
                return json_encode(['pic' => $banner->pics]);
            }
        }
    }

    public function del_img(Request $request,$id){
        $bs = Banner::find($id);
        $bs->delete();
        return redirect('admin/setting')->with('success','删除成功');
    }
}
