<?php
namespace App\Http\Controllers;

use App\Blog;
use App\Postmeta;
use App\User;
use App\Category;
use App\Sys;
use App\Index;
use App\Banner;
use Symfony\Component\HttpFoundation\Request;
use Illuminate\Support\Facades\Session;
class BlogController extends controller{
    public function index(){
        $post = Blog::orderBy('id','DESC')->paginate(12);
        $cate = Category::get();
        $hot_post = Blog::orderBy('see','DESC')->limit(5)->get();
        $user_num = User::paginate();
        $configs = Sys::first();
        $indexof = Index::first();
        $banner = Banner::get();
        return view('index',[
            'post' => $post,
            'cate' => $cate,
            'hot_post' => $hot_post,
            'user_num' => $user_num,
            'sys'=>$configs,
            'indexof' => $indexof,
            'banner' => $banner
        ]);
    }

    public function post(Request $request,$id){
        $post = Blog::find($id);
        $hot_post = Blog::orderBy('see','DESC')->limit(5)->get();
        $num = $request->input('id');
        $cateGet = Category::get();
        $post->see = $post->see+1;
        $post->save();
        $userid = User::where('username','=',session('username'))->first();
        $postMate = new Postmeta;
        if (!empty($_POST)){
            if (!session('username')){
                return ['status'=>'nologin','message'=>'你还没有登录'];
            }else{
                //查找是否存在
                $postme = Postmeta::where([
                    ['art_id','=',$num],
                   [ 'user_id','=',$userid->id]
                ])->first();
                if (!empty($postme)){
                    return json_encode(array('status'=>'error','message'=>'点赞失败'));
                }else{
                    $postMate->art_id = $num;
                    $postMate->user_id = $userid->id;
                    $postMate->save();
                    if (isset($num)){
                        $post->likeof = $post->likeof+1;
                        $post->save();
                        return json_encode(array('status'=>200,'id'=>$num,'like'=>$post->likeof,'message'=>'点赞成功'));
                    }
                }
            }
        }
        $configs = Sys::first();
        return view('post',[
            'post' => $post,
            'hot_post' => $hot_post,
            'cate' => $cateGet,
            'sys' => $configs
        ]);

    }

    public function layout(){
        $cateGet = Category::get();
        $configs = Sys::first();
        return view('common.layout',[
            'cate' => $cateGet,
            'sys' => $configs
        ]);
    }

    public function cateGet($id){
        $post = Blog::paginate();
        $cateGet = Category::get();
        $user_num = User::paginate();
        $postGet = Blog::where('cate_id',$id)->paginate(9);
        $configs = Sys::first();
        return view('category',[
            'post' => $post,
            'cate' => $cateGet,
            'user_num' => $user_num,
            'postGet' => $postGet,
            'sys' => $configs
        ]);
    }
    //login登录
    public function login(Request $request){
        if (Session::has('username')){
            return redirect('/');
        }else{
            $users = new User;
            $cateGet = Category::get();
            if($request->isMethod('POST')){
                $userinfo = $request->input('User');
                $usersql = User::where('username','=',$userinfo['username'])->first();
                if (!empty($userinfo['username']) && !empty($userinfo['password'])) {
                    if($usersql == ''){
                        return redirect('member/login')->with('error', '未查询到该账号');
                    }else if ($userinfo['username'] == $usersql->username && md5($userinfo['password']) == $usersql->password) {
                        Session::put('username',$userinfo['username']);
                        $ses = Session::get('username');
                        return redirect('/');
                    } else {
                        return redirect('member/login')->with('error', '账号或密码错误');
                    }
                }else{
                    return redirect('member/login')->with('error', '账号密码不能为空');
                }
            }
        }
        $configs = Sys::first();
        return view('member.login',[
            'cate' => $cateGet,
            'sys'=>$configs
        ]);
    }

    //注册
    public function register(Request $request){
        $users = new User;
        if (Session::has('username')){
            return redirect('/');
        }else{
            if($request->isMethod('POST')) {
                $newUser = $request->input('User');
                $username = $newUser['username'];
                $pass = $newUser['password'];
                $passt = $newUser['passwordt'];
                $isuser = User::where('username', '=', $newUser['username'])->first();
                if(empty($username) || empty($pass) || empty($passt)){
                    return redirect('member/register')->with('error','账号或密码不得为空');
                }else if (!empty($isuser->username)){
                    return redirect('member/register')->with('error','账号已存在');
                }else if($pass != $passt){
                    return redirect('member/register')->with('error','二次密码不同');
                }else{
                    $users->username = $username;
                    $users->password = md5($pass);
                    $users->ip = $_SERVER["REMOTE_ADDR"];
                    $users->avater_img = '/static/images/avatar.jpg';
                    $users->save();
                    return redirect('member/register')->with('success','注册成功');
                }
            }
        }
        $configs = Sys::first();
        $cateGet = Category::get();
        return view('member.register',[
            'cate' => $cateGet,
            'sys' => $configs
        ]);
    }


    //退出
    public function un(){
        Session::forget('username');
        return redirect()->back();
    }
}
