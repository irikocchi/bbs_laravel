<?php

namespace App\Http\Controllers;

use App\Message;
use Illuminate\Http\Request;

class MessagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()//indexアクション
    {
        // // Messageモデルを使って、MySQLのmessagesテーブルから全データ取得
        // $messages = Message::all();
        
        // // フラッシュメッセージにnull をセット
        // $flash_message = null;
        // // エラーメッセージにnullをセット
        // $errors = null;
    
        // // 連想配列のデータを3セット（viewで引き出すキーワードと値のセット）引き連れてviewを呼び出す
        // return view('messages.index', compact('messages', 'flash_message', 'errors'));
         // Messageモデルを使って、MySQLのmessagesテーブルから全データ取得
        $messages = Message::all();
        
        // // フラッシュメッセージをセッションから取得
        // $flash_message = session('flash_message');
        // // セッション情報の破棄
        // session()->forget('flash_message');
        
        // // エラーメッセージにnullをセット
        // $errors = null;

        // 連想配列のデータを3セット（viewで引き出すキーワードと値のセット）引き連れてviewを呼び出す
        // return view('messages.index', compact('messages', 'flash_message', 'errors'));
        
        // 連想配列のデータを1セット（viewで引き出すキーワードと値のセット）引き連れてviewを呼び出す
        return view('messages.index', compact('messages'));
    }

       /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 空のメッセージインスタンスを作成
        $message = new Message();
        
        // 連想配列のデータを1セット（viewで引き出すキーワードと値のセット）引き連れてviewを呼び出す
        return view('messages.create', compact('message'));
    }


   /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // // 入力された値を取得
        // $name = $request->input('name');
        // $title = $request->input('title');
        // $body = $request->input('body');
        // // 画像ファイル情報の取得だけ特殊
        // $file =  $request->image;
        
        // // 画像ファイルが選択されていれば
        // if ($file) { 
        
        //     // 現在時刻ともともとのファイル名を組み合わせてランダムなファイル名作成
        //     $image = time() . $file->getClientOriginalName();
        //     // アップロードするフォルダ名取得
        //     $target_path = public_path('uploads/');

        // } else { // ファイルが選択されていなければ
        //     $image = null;
        // }
        
        // // 空のメッセージインスタンスを作成
        // $message = new Message();
        
        // // 入力された値をセット
        // $message->name = $name;
        // $message->title = $title;
        // $message->body = $body;
        // $message->image = $image;
        
        // // 入力エラーチェック
        // $errors = $message->validate();

        // // 入力エラーが1つもなければ
        // if(count($errors) === 0){
        //     // 画像アップロード処理
        //     $file->move($target_path, $image);
            
        //     // メッセージインスタンスをデータベースに保存
        //     $message->save();
            
        //     // セッションにflash_messageを保存
        //     session(['flash_message' => '新規投稿が成功しました']);
            
        //     // indexアクションにリダイレクト
        //     return redirect('/');
            
        // }else{
        //     // セッションに、入力したメッセージインスタンス と errors保存
        //     session(['errors' => $errors, 'message' => $message]);
            
        //     // createアクションにリダイレクト
        //     return redirect('/messages/create');
        // }
        
        // validation
        $this->validate($request, [
            'name' => 'required',
            'title' => 'required',
            'body' => 'required',
            'image' => [
                'required',
                'file',
                'mimes:jpeg,jpg,png'
            ]
        ]);
        
        // 入力された値を取得
        $name = $request->input('name');
        $title = $request->input('title');
        $body = $request->input('body');
        // 画像ファイル情報の取得だけ特殊
        $file =  $request->image;
        
        // 現在時刻ともともとのファイル名を組み合わせてランダムなファイル名作成
        $image = time() . $file->getClientOriginalName();
        // アップロードするフォルダ名取得
        $target_path = public_path('uploads/');
        // 画像アップロード処理
        $file->move($target_path, $image);

        // 空のメッセージインスタンスを作成
        $message = new Message();
        
        // 入力された値をセット
        $message->name = $name;
        $message->title = $title;
        $message->body = $body;
        $message->image = $image;

        // メッセージインスタンスをデータベースに保存
        $message->save();
        
        // セッションにフラッシュメッセージを保存しながら、indexアクションにリダイレクト
        return redirect('/')->with('flash_message', '新規投稿が成功しました');
           
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function show(Message $message)
    {
        // 連想配列のデータを1セット（viewで引き出すキーワードと値のセット）引き連れてviewを呼び出す
        return view('messages.show', compact('message'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function edit(Message $message)
    {
        
 // 連想配列のデータを1セット（viewで引き出すキーワードと値のセット）引き連れてviewを呼び出す
        return view('messages.edit', compact('message'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Message $message)
    {
        // validation
        $this->validate($request, [
            'name' => 'required',
            'title' => 'required',
            'body' => 'required',
        ]);
        
        // 入力された値を取得
        $name = $request->input('name');
        $title = $request->input('title');
        $body = $request->input('body');
        // 画像ファイル情報の取得だけ特殊
        $file =  $request->image;
        
        // 画像ファイルが選択されていれば
        if ($file) { 
        
            // 現在時刻ともともとのファイル名を組み合わせてランダムなファイル名作成
            $image = time() . $file->getClientOriginalName();
            // アップロードするフォルダ名取得
            $target_path = public_path('uploads/');
            // 画像アップロード処理
            $file->move($target_path, $image);

        } else { // ファイルが選択されていなければ元の値を保持
            $image = $message->image;
        }
        
        // 入力されたでインスタンス情報を更新
        $message->name = $name;
        $message->title = $title;
        $message->body = $body;
        $message->image = $image;

        // データベースを更新
        $message->save();
        
        // フラッシュメッセージを保存しながらshowアクションにリダイレクト
        return redirect('/messages/' . $message->id)->with('flash_message', 'id: ' . $message->id . 'の投稿の更新が成功しました');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message)
    {
        // 該当メッセージをデータベースから削除
        $message->delete();
        // フラッシュメッセージを保存しながらshowアクションにリダイレクト
        return redirect('/')->with('flash_message', 'id: ' . $message->id . 'の投稿を削除しました');
    }
}
