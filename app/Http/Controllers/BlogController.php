<?php
namespace App\Http\Controllers;

use App\Blog;
use App\User;
use App\Category;
use App\Sys;
use Symfony\Component\HttpFoundation\Request;
use Illuminate\Support\Facades\Session;
class BlogController extends controller{
    public function index(){
        $post = Blog::paginate(12);
        $cate = Category::get();
        $hot_post = Blog::orderBy('see','DESC')->limit(5)->get();
        $user_num = User::paginate();
        return view('index',[
            'post' => $post,
            'cate' => $cate,
            'hot_post' => $hot_post,
            'user_num' => $user_num,
        ]);
    }

    public function post(Request $request,$id){
        $post = Blog::find($id);
        $hot_post = Blog::orderBy('see','DESC')->limit(5)->get();
        $num = $request->input('id');
        $cateGet = Category::get();
        $post->see = $post->see+1;
        $post->save();
        if (isset($num)){
            $post->likeof = $post->likeof+1;
            $post->save();
            return json_encode(array('status'=>200,'id'=>$num,'like'=>$post->likeof));
        }
        return view('post',[
            'post' => $post,
            'hot_post' => $hot_post,
            'cate' => $cateGet
        ]);

    }

    public function layout(){
        $cateGet = Category::get();
        return view('common.layout',[
            'cate' => $cateGet,
        ]);
    }

    public function footer(){
        return view('common.footer',[

        ]);
    }

    public function cateGet($id){
        $post = Blog::paginate();
        $cateGet = Category::get();
        $user_num = User::paginate();
        $postGet = Blog::where('cate_id',$id)->paginate(9);
        return view('category',[
            'post' => $post,
            'cate' => $cateGet,
            'user_num' => $user_num,
            'postGet' => $postGet
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

        return view('member.login',[
            'cate' => $cateGet
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

        $cateGet = Category::get();
        return view('member.register',[
            'cate' => $cateGet
        ]);
    }

    //退出
    public function un(){
        Session::forget('username');
        return redirect()->back();
    }
}
