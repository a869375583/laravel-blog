<?php
namespace App\Http\Controllers;

use App\Blog;
use App\Postmeta;
use App\User;
use App\Category;
use App\Sys;
use App\Index;
use App\Banner;
use App\Comment;
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
        $comment = Comment::where('post_id','=',$id)->get();
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
            'sys' => $configs,
            'comment' => $comment,
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
                        Session::put('userid', $usersql->id);
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

    //评论
    public function comment(Request $request,$id){
        if (Session::has('username')) {
            if ($request->isMethod('POST')){
                $comment = new Comment();
                $userid = $request->input('ids');
                $comment_content = $request->input('content');
                if ($comment_content == ''){
                    return json_encode(['status'=>400,'message'=>'评论内容不得为空']);
                }else{
                    $comment->user_id = $userid;
                    $comment->post_id = $id;
                    $comment->comment_content = $comment_content;
                    $comment->save();
                    return json_encode(['status'=>200,'userid'=>$userid,'post_id'=>$id,'content'=>$comment_content]);
                }
            }
        }else{
            return json_encode(['status'=>400,'message'=>'请先登录']);
        }

    }

    //支付功能
    public function Alipay(Request $request){
        $aop = new \AopClient();
        $aop->gatewayUrl = 'https://openapi.alipaydev.com/gateway.do';
        $aop->appId = '2019010162736506';
        $aop->rsaPrivateKey = 'MIIEowIBAAKCAQEAxfDZL++LSsbJHRpHVBNlHBrVzeQO/JCwCYjPatuB/C+HA0aXQ9dxu43y6PyLFB69GwSqd1iwAmGFi0Uy6+82BrAczHJUDVXT7SsPpsSEC1Z+/f6+am+jiXRiqYQMhuhgAt70oWsy2O/mU1wEvbLn9WtkGXf4VEaZbJveCwTpU8Ii8I38MhqmRv5mflRs9RknvQzUhMYb7VZGfdVFT2sMHUlfsCNLgkVCQEQXzWrZg1uB/trXz7Sc45mOt/le3r/9fem3dQ089ldowJeVTJYrZJF+uSYjgNB6pwQgkbhhsVcIsq2mHuOuKwbgZKHSInDWuRZttSHn5n1MWQrVdMxEewIDAQABAoIBAA2i+SN/SkZdiY9ytwVIzMdx5dboZkvqH+aYQUnoU30vPQrxuwwWdKRqNBjvBRnewEJzQNc2CfIwC8Y7fzWX5k3xphpDqhy9E/ub4tknYr1xORCAk1e71zVqCj4Jdd95dNvdxla0ju05IdIOXdk/0REsU9oZVMdhkcJUvqhdr0Fw2EyhJaU2s5PER27k01vE6igWjo2vShg9rxQZednOfgNXLVupXNPa2TNVV5twJqRMd+k4ywsmO+L3rx8lZgvMO8Tbw3cRSYXKAfe1tCIvayeAZz1FLM7hjS6HsyY9jTwiYi4bgsNzb56ouR0pwMdwWGHkBUo/wGJmtyv1xn0EBJECgYEA+jnBtcLDLyxMRTmlIjIOUfcCUDnlri8mi9LskOG2hCXclseejq7HXjUbetjkF/1y8RkRIr/9JrFs9oaFvQr0cDgZBPCikrsDRIlTRKaqT0+Ke6AbXlJWcpAbCnmP1UK3+OQP5dkL+98nwmJAHXM9WqU/65ndDsVJdti04CsysHMCgYEAyoI2O00hyEWgM5KTYaKJrUorBrBD1gpnVWn0yOGUkAcBsh/CkcdR1PN76Jr0S6za47JvQYKhr9kuAccqpgMRJa1DJ/PKDrMbAHRLaVGiTPnkqqodFHHfWcoWv3XX83k+8Ab+UXvAuqA4t0aK34niso1+N1xbqYzBqiTwRRN6wdkCgYEAgcDxcg9Mp2mRI1SBDPpn8pjj2jYro+dPVbJKedaRjnUTrhxVXCfFulRPq6RMoyQKNnuJJzvnSek3V57qOt0zY/2y+5zMsMnJKAEN7MuABSB57yFXD9IigcW4P/ZJX4z5WVbp54ZlcHaHZ4ULOjpH1nlabBGdT8t+DOLS6Gt+HYECgYA1OAkWhou1PQ7/3qpaw0NZRh+Oj24UZwGHAeRxkk7flufMLuqMMwx/YUmT9Hz1EkUoB7GTTsg9FV8w2m2L2Ux9UU5PxpK4UDttYCKdV/XGMvn0G+aug8qFp0VZJZgOBTQUElJtiY85vHeLOr+uRWdNM0ATPnNcWIBgvXpjPN5K6QKBgFXka9e4KXGwZacUeEEFMjSIs9oyThBHiTWi5ADx0thtyZpzbnVkJfMrcibXZN4eUbNj1/r3PKgJ0jYa6+AD8KToOrGXafIChIKzmpGStds5WQV+vCSAFpbaMRitbmKrm7Q/Anc1FOs80YmBQAT9wnIxSC0GwdEkUfaP7BdXPmC6';
        $aop->alipayrsaPublicKey = 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAsZqRFhxCtdWB8TXwK8PRuHCF70/TnxKa8zK4t7t41VHcs5ABVz9KSS2gkvADzioFwmyAyi+/0cFRfU6C3aiRGR0z4/46TvxBNu/zYbjtslCUDuXdq05VNAAt5Jp9ZWfGdu6R2DT3F9iSDtf0PntY0GwMOxqsCPzb6E+jQkH63+XbOU69w1F17CbGJANwBgGF2hZhu8If7e4PIAWAzoBnX8/b2jlu5vjmPOyvJg1jITW6MbEA4tPvPUUtnikP0SJstZE515HMOOldzXDasnFDkJzH66PweJ2UoZcCU9hzl5BDwYhqAlvw/Lfb+ZcGePkGGBt2sctp6LmTp2o94hVN+wIDAQAB';
        $aop->apiVersion = '1.0';
        $aop->postCharset = 'UTF-8';
        $aop->format = 'json';
        $aop->signType = 'RSA2';
        $date = date('YmdHis');
        $arr = range(1000,9999);
        shuffle($arr);
        $Order['out_trade_no'] = $date.$arr[0];
        $Order['total_amount'] = 0.01;
        $Order['subject'] = '测试';

        $request = new \AlipayTradePrecreateRequest();
        $request->setBizContent(json_encode($Order));
        $result = $aop->execute($request);
        var_dump($result);
        exit;
    }
}
